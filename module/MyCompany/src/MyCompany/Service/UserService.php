<?php
namespace MyCompany\Service;

use Doctrine\ORM\EntityManagerInterface;
use MyCompany\Entity\User;


class UserService implements UserServiceInterface
{
    
    protected $entityManager;
    
    const USER_ALREADY_REGISTERED_CODE = 2;
    const USER_ALREADY_REGISTERED_MESSAGE = 'User has already registered';
    
    public function __construct(EntityManagerInterface $em) {
        $this->entityManager = $em;
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
     $userObj->setPassword($password);
     $userObj->setRoles(array());
     $userObj->setCreatedAt(new \DateTime());
     $userObj->setIsActivated(false);
     $userObj->setIsEmailConfirmed(false);
     
     $this->entityManager->persist($userObj);
     $this->entityManager->flush();
     
     return $userObj;
 }

 /** 
  * {@inheritDoc}
  * @see \MyCompany\Service\UserServiceInterface::forgotPassword()
  */
 public function forgotPassword($emailAddress) {
  // TODO: Auto-generated method stub

 }

 /**
  * {@inheritDoc}
  * @see \MyCompany\Service\UserServiceInterface::resetPassword()
  */
 public function resetPassword($emailAddress, $resetToken) {
  // TODO: Auto-generated method stub

 }

 /**
  * {@inheritDoc}
  * @see \MyCompany\Service\UserServiceInterface::fetchUser()
  */
 public function fetchUser($email) {
  // TODO: Auto-generated method stub

 }

}