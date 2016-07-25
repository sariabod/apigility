<?php
//require_once 'module/MyCompany/src/MyCompany/Service/UserService.php';
use MyCompany\Bootstrap;
use MyCompany\Service\UserService;
use MyCompany\Entity\User;
require_once (__DIR__ . '/../bootstrap.php');

/**
 * UserService test case.
 */
class UserServiceTest extends PHPUnit_Framework_TestCase
{

    /**
     *
     * @var UserService
     */
    private $userService;
    
    protected function getORM()
    {
        $sm = Bootstrap::getServiceManager();
        $orm = $sm->get('doctrine.entitymanager.orm_default');
    
        return $orm;
    }

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        Bootstrap::init();
        
        // TODO Auto-generated UserServiceTest::setUp()
        
        $this->userService = Bootstrap::getServiceManager()->get(UserService::class);
        $orm = $this->getORM();
        $qb = $orm->createQueryBuilder()->select('u');
        $qb->from(User::class, 'u')->andWhere($qb->expr()
            ->like('u.email', ':email'));
        $qb->setParameter('email', '%unit_test%');
        $iterableResults = $qb->getQuery()->iterate();
        foreach ($iterableResults as $uAsArr) {
            $orm->remove($uAsArr[0]);
        }
        $orm->flush();
        $orm->clear();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated UserServiceTest::tearDown()
        $this->userService = null;
        
        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests UserService->__construct()
     */
    public function test__construct()
    {
        // TODO Auto-generated UserServiceTest->test__construct()
        //$this->markTestIncomplete("__construct test not implemented");
        
        //$this->userService->__construct(/* parameters */);
        $this->assertInstanceOf(UserService::class, $this->userService);
        
    }

    /**
     * Tests UserService->registerUser()
     */
    public function testRegisterUser()
    {
        // TODO Auto-generated UserServiceTest->testRegisterUser()
        //$this->markTestIncomplete("registerUser test not implemented");
        
        //$this->userService->registerUser(/* parameters */);
        $emailAddress = "test+unit_test@example.com";
        $password = "abc123";
        $userObj = $this->userService->registerUser($emailAddress, $password);
        
        $this->assertInstanceOf(User::class, $userObj);
    }
    
    /**
     * Tests UserService->registerUserEmailAlreadyExistsException()
     */
    public function testRegisterUserEmailAlreadyExistsException()
    {
 
        $emailAddress = "test+unit_test@example.com";
        $password = "abc123";
        $userObj = $this->userService->registerUser($emailAddress, $password);
        $this->assertInstanceOf(User::class, $userObj);
        
        $this->setExpectedException(\RuntimeException::class,UserService::USER_ALREADY_REGISTERED_MESSAGE,UserService::USER_ALREADY_REGISTERED_CODE);
        $userObj = $this->userService->registerUser($emailAddress, $password);
        
        
    }

    /**
     * Tests UserService->forgotPassword()
     */
    public function testForgotPassword()
    {
        // TODO Auto-generated UserServiceTest->testForgotPassword()
        $this->markTestIncomplete("forgotPassword test not implemented");
        
        $this->userService->forgotPassword(/* parameters */);
    }

    /**
     * Tests UserService->resetPassword()
     */
    public function testResetPassword()
    {
        // TODO Auto-generated UserServiceTest->testResetPassword()
        $this->markTestIncomplete("resetPassword test not implemented");
        
        $this->userService->resetPassword(/* parameters */);
    }

    /**
     * Tests UserService->fetchUser()
     */
    public function testFetchUser()
    {
        // TODO Auto-generated UserServiceTest->testFetchUser()
        $this->markTestIncomplete("fetchUser test not implemented");
        
        $this->userService->fetchUser(/* parameters */);
    }
}

