<?php
return array(
    'Identity\\V1\\Rest\\User\\Controller' => array(
        'description' => 'User Service - Basic user identity',
        'collection' => array(
            'description' => 'Register new user',
            'GET' => array(
                'response' => '{
   "_links": {
       "self": {
           "href": "/user"
       },
       "first": {
           "href": "/user?page={page}"
       },
       "prev": {
           "href": "/user?page={page}"
       },
       "next": {
           "href": "/user?page={page}"
       },
       "last": {
           "href": "/user?page={page}"
       }
   }
   "_embedded": {
       "user": [
           {
               "_links": {
                   "self": {
                       "href": "/user[/:user_id]"
                   }
               }
              "emailAddress": "Email Address",
              "password": "User Password"
           }
       ]
   }
}',
            ),
        ),
    ),
);
