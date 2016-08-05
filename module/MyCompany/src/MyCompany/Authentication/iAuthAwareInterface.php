<?php
namespace MyCompany\Authentication;

use MyCompany\Entity\User;

interface iAuthAwareInterface
{
    
    public function setAuthenticatedIdentity(User $user);
    
    
    public function getAuthenticatedIdentity();
    
}

