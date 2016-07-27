<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'Identity\\V1\\Rest\\User\\UserResource' => 'Identity\\V1\\Rest\\User\\UserResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'identity.rest.user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user[/:user_id]',
                    'defaults' => array(
                        'controller' => 'Identity\\V1\\Rest\\User\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'identity.rest.user',
        ),
    ),
    'zf-rest' => array(
        'Identity\\V1\\Rest\\User\\Controller' => array(
            'listener' => 'Identity\\V1\\Rest\\User\\UserResource',
            'route_name' => 'identity.rest.user',
            'route_identifier_name' => 'user_id',
            'collection_name' => 'user',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Identity\\V1\\Rest\\User\\UserEntity',
            'collection_class' => 'Identity\\V1\\Rest\\User\\UserCollection',
            'service_name' => 'User',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Identity\\V1\\Rest\\User\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'Identity\\V1\\Rest\\User\\Controller' => array(
                0 => 'application/vnd.identity.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'Identity\\V1\\Rest\\User\\Controller' => array(
                0 => 'application/vnd.identity.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Identity\\V1\\Rest\\User\\UserEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'identity.rest.user',
                'route_identifier_name' => 'user_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'Identity\\V1\\Rest\\User\\UserCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'identity.rest.user',
                'route_identifier_name' => 'user_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'Identity\\V1\\Rest\\User\\Controller' => array(
            'input_filter' => 'Identity\\V1\\Rest\\User\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'Identity\\V1\\Rest\\User\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\EmailAddress',
                        'options' => array(),
                    ),
                ),
                'filters' => array(),
                'name' => 'emailAddress',
                'description' => 'Email Address',
                'error_message' => 'Please enter a valid email',
            ),
            1 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '5',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'password',
                'description' => 'User Password',
                'error_message' => 'Please enter a password',
            ),
            
        ),
    ),
);
