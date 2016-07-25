<?php
use MyCompany\Service\UserService;
use MyCompany\Factory\UserServiceFactory;

return array(
    'service_manager' => array(
        'factories'=> array(
            UserService::class => UserServiceFactory::class
        )
    )
);