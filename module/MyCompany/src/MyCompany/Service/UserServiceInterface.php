<?php
namespace MyCompany\Service;

interface UserServiceInterface
{
    public function registerUser($emailAddress, $password);
    
    public function forgotPassword($emailAddress);
    
    public function resetPassword($emailAddress,$resetToken, $newPassword);
    
    public function fetchUser($email);
}

