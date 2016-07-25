<?php
namespace MyCompany\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use MyCompany\Service\UserService;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class UserServiceFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        if ($serviceLocator instanceof ServiceLocatorAwareInterface) {
            $serviceLocator = $serviceLocator->getServiceLocator();
        }
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $service = new UserService($em);
        return $service;
        
    }
}