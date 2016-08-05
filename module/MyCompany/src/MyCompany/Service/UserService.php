<?php
namespace MyCompany\Service;

use Doctrine\ORM\EntityManagerInterface;
use MyCompany\Entity\User;
use Zend\View\Model\ViewModel;
use Zend\Mail\Message;
use SlmMail\Mail\Transport\HttpTransport;
use Zend\View\Renderer\RendererInterface;
use Zend\Crypt\Password\Bcrypt;
use MyCompany\Authentication\iAuthAwareInterface;
use MyCompany\RBAC\ServiceRBAC;



class UserService implements UserServiceInterface, iAuthAwareInterface
{
    
    protected $entityManager;
    protected $mailTemplateRenderer;
    protected $mailService;
    protected $authenticatedIdentity;
    protected $serviceRBAC;
    
    const USER_ALREADY_REGISTERED_CODE = 2;
    const USER_ALREADY_REGISTERED_MESSAGE = 'User has already registered';
    const USER_NOT_FOUND_CODE = 3;
    const USER_NOT_FOUND_MESSAGE = 'Unable to locate a user with the provided parameters';
    const INVALID_RESET_TOKEN_PROVIDED_CODE = 4;
    const INVALID_RESET_TOKEN_PROVIDED_MESSAGE = 'The provided password reset token does not match what was expected.';
    const PERMISSION_DENIED_CODE = 5;
    const PERMISSION_DENIED_MESSAGE = 'Your account does not have sufficient privileges to perform the requested action.';
    const MUST_BE_LOGGED_IN_CODE = 6;
    const MUST_BE_LOGGED_IN_MESSAGE = 'You must be authenticated to perform the requested action.';
    
    public function __construct(EntityManagerInterface $em, HttpTransport $mailService, RendererInterface $mailTemplateRenderer, ServiceRBAC $serviceRbac) {
        $this->entityManager = $em;
        $this->mailService = $mailService;
        $this->mailTemplateRenderer = $mailTemplateRenderer;
        $this->serviceRBAC = $serviceRbac;
        
        $this->serviceRBAC->getRBAC()
        ->getRole(ServiceRBAC::ROLE_USER)
        ->addPermission(__CLASS__ . '::changeEmailAddress');
    }
    
    /**
     * {@inheritDoc}
     * @see \MyCompany\Authentication\iAuthAwareInterface::setAuthenticatedIdentity()
     */
    public function setAuthenticatedIdentity(User $user) {

            $this->authenticatedIdentity = $user;
    }
    
    /**
     * {@inheritDoc}
     * @see \MyCompany\Authentication\iAuthAwareInterface::getAuthenticatedIdentity()
     */
    public function getAuthenticatedIdentity() {
                
        if (! $this->authenticatedIdentity instanceof User)
            throw new \RuntimeException(self::MUST_BE_LOGGED_IN_MESSAGE, self::MUST_BE_LOGGED_IN_CODE);
        return $this->authenticatedIdentity;
    
    }
    
    public function isMethodAllowed($func, $assertion = null)
    {
        try {
            /**
             *
             * @var $userEntity User
             */
            $userEntity = $this->getAuthenticatedIdentity();
    
            if (! $userEntity instanceof User)
                return false;
    
                foreach ($userEntity->getRoles() as $role) {
    
                    if ($this->serviceRBAC->getRBAC()->isGranted($role, $func, $assertion)) {
                        return true;
                    }
                }
                return false;
        } catch (\Exception $e) {
            return false;
        }
    }
    
    
    protected function _getActivationCode(User $userObj)
    {
        return hash('sha256', $userObj->getId() . $userObj->getEmail() . $userObj->getPassword() . $userObj->getCreatedAt()->getTimestamp());
    }
    
 /**
  * {@inheritDoc}
  * @see \MyCompany\Service\UserServiceInterface::registerUser()
  */
 public function registerUser($emailAddress, $password) {
 
     $userObj = $this->entityManager->getRepository(User::class)->findOneBy(array('email'=>$emailAddress));
    
     if ($userObj instanceof User)
     {
         throw new \RuntimeException(self::USER_ALREADY_REGISTERED_MESSAGE,self::USER_ALREADY_REGISTERED_CODE);
     }
     
     $userObj = new User();
     $userObj->setEmail($emailAddress);
     
     
     //$userObj->setPassword($password);
     $bcrypt = new Bcrypt();
     $bcrypt->setCost(14);
     $userObj->setPassword($bcrypt->create($password));
     
     $userObj->setRoles(array());
     $userObj->setCreatedAt(new \DateTime());
     $userObj->setIsActivated(false);
     $userObj->setIsEmailConfirmed(false);
     
     $this->entityManager->persist($userObj);
     $this->entityManager->flush();
     
     /**
      * SEND EMAIL
      */
     /*
     $message = new Message();
     $message->setSubject('Welcome to MyCompany! Please activate your account.');
     
     $viewContent = new ViewModel(array(
         'activationURL' => 'http://192.168.33.10/user-activate/' . urlencode($userObj->getEmail()) . "/" . $this->_getActivationCode($userObj)
     ));
     $viewContent->setTemplate('MyCompany/mail/user/signup');
     
     $content = $this->mailTemplateRenderer->render($viewContent);
     $message->setFrom('noreply@sandbox77f5c0d6980b4ab2a8871b3c8ad2623d.mailgun.org');
     
     $htmlPart = new \Zend\Mime\Part($content);
     $htmlPart->type = 'text/html';
     $body = new \Zend\Mime\Message();
     $body->setParts(array(
         $htmlPart
     ));
     $message->setTo($userObj->getEmail());
     $message->setBody($body);
     $this->mailService->send($message);
     */
     
     
     return $userObj;
 }

 /** 
  * {@inheritDoc}
  * @see \MyCompany\Service\UserServiceInterface::forgotPassword()
  */
 public function forgotPassword($emailAddress) {
  
     $userObj = $this->entityManager->getRepository(User::class)->findOneBy(array('email'=>$emailAddress));
     
     if (! $userObj instanceof User) {
         throw new \RuntimeException(self::USER_NOT_FOUND_MESSAGE,self::USER_NOT_FOUND_CODE);
     }
     
     /**
      * SEND EMAIL
      */
      
     $message = new Message();
     $message->setSubject('Forgot your password?');
      
     $viewContent = new ViewModel(array(
         'resetURL' => 'http://192.168.33.10/user-reset-password/' . urlencode($userObj->getEmail()) . "/" . $this->_getActivationCode($userObj)
     ));
     $viewContent->setTemplate('MyCompany/mail/user/forgot-password');
      
     $content = $this->mailTemplateRenderer->render($viewContent);
     $message->setFrom('noreply@sandbox77f5c0d6980b4ab2a8871b3c8ad2623d.mailgun.org');
      
     $htmlPart = new \Zend\Mime\Part($content);
     $htmlPart->type = 'text/html';
     $body = new \Zend\Mime\Message();
     $body->setParts(array(
         $htmlPart
     ));
     $message->setTo($userObj->getEmail());
     $message->setBody($body);
     $this->mailService->send($message);

     return array('isMailSent'=>true);
 }

 /**
  * {@inheritDoc}
  * @see \MyCompany\Service\UserServiceInterface::resetPassword()
  */
 public function resetPassword($emailAddress, $resetToken, $newPassword) {
  
     $userObj = $this->entityManager->getRepository(User::class)->findOneBy(array('email'=>$emailAddress));
      
     if (! $userObj instanceof User) {
         throw new \RuntimeException(self::USER_NOT_FOUND_MESSAGE,self::USER_NOT_FOUND_CODE);
     }
     
     $expectedResetToken = $this->_getActivationCode($userObj);
     
     if ($expectedResetToken !== $resetToken)
     {
         throw new \RuntimeException(self::INVALID_RESET_TOKEN_PROVIDED_MESSAGE, self::INVALID_RESET_TOKEN_PROVIDED_CODE);
     }
     
         $bcrypt = new Bcrypt();
         $bcrypt->setCost(14);
         $userObj->setPassword($bcrypt->create($newPassword));
     
         $this->entityManager->persist($userObj);
         $this->entityManager->flush();
     
         return $userObj;
 }

 /**
  * {@inheritDoc}
  * @see \MyCompany\Service\UserServiceInterface::fetchUser()
  */
 public function fetchUser($email) {

     $userObj = $this->entityManager->getRepository(User::class)->findOneBy(array(
         'email' => $email
     ));
     
     if (! $userObj instanceof User)
     {
         throw new \RuntimeException(self::USER_NOT_FOUND_MESSAGE, self::USER_NOT_FOUND_CODE);
     }
     
     return $userObj;
 }



}