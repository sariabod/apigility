<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'test\\V1\\Rest\\Tester\\TesterResource' => 'test\\V1\\Rest\\Tester\\TesterResourceFactory',
            'test\\V1\\Rest\\Zoltan\\ZoltanResource' => 'test\\V1\\Rest\\Zoltan\\ZoltanResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'test.rest.tester' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/tester[/:tester_id]',
                    'defaults' => array(
                        'controller' => 'test\\V1\\Rest\\Tester\\Controller',
                    ),
                ),
            ),
            'test.rest.zoltan' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/zoltan[/:zoltan_id]',
                    'defaults' => array(
                        'controller' => 'test\\V1\\Rest\\Zoltan\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            0 => 'test.rest.tester',
            1 => 'test.rest.zoltan',
        ),
    ),
    'zf-rest' => array(
        'test\\V1\\Rest\\Tester\\Controller' => array(
            'listener' => 'test\\V1\\Rest\\Tester\\TesterResource',
            'route_name' => 'test.rest.tester',
            'route_identifier_name' => 'tester_id',
            'collection_name' => 'tester',
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
            'entity_class' => 'test\\V1\\Rest\\Tester\\TesterEntity',
            'collection_class' => 'test\\V1\\Rest\\Tester\\TesterCollection',
            'service_name' => 'tester',
        ),
        'test\\V1\\Rest\\Zoltan\\Controller' => array(
            'listener' => 'test\\V1\\Rest\\Zoltan\\ZoltanResource',
            'route_name' => 'test.rest.zoltan',
            'route_identifier_name' => 'zoltan_id',
            'collection_name' => 'zoltan',
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
            'entity_class' => 'test\\V1\\Rest\\Zoltan\\ZoltanEntity',
            'collection_class' => 'test\\V1\\Rest\\Zoltan\\ZoltanCollection',
            'service_name' => 'zoltan',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'test\\V1\\Rest\\Tester\\Controller' => 'HalJson',
            'test\\V1\\Rest\\Zoltan\\Controller' => 'HalJson',
        ),
        'accept_whitelist' => array(
            'test\\V1\\Rest\\Tester\\Controller' => array(
                0 => 'application/vnd.test.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
            'test\\V1\\Rest\\Zoltan\\Controller' => array(
                0 => 'application/vnd.test.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'test\\V1\\Rest\\Tester\\Controller' => array(
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
            ),
            'test\\V1\\Rest\\Zoltan\\Controller' => array(
                0 => 'application/vnd.test.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'test\\V1\\Rest\\Tester\\TesterEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.tester',
                'route_identifier_name' => 'tester_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'test\\V1\\Rest\\Tester\\TesterCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.tester',
                'route_identifier_name' => 'tester_id',
                'is_collection' => true,
            ),
            'test\\V1\\Rest\\Zoltan\\ZoltanEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.zoltan',
                'route_identifier_name' => 'zoltan_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'test\\V1\\Rest\\Zoltan\\ZoltanCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'test.rest.zoltan',
                'route_identifier_name' => 'zoltan_id',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'test\\V1\\Rest\\Tester\\Controller' => array(
            'input_filter' => 'test\\V1\\Rest\\Tester\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'test\\V1\\Rest\\Tester\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'aaa',
                'description' => 'aaa',
                'field_type' => '',
                'error_message' => 'aaa',
            ),
            1 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'aaa',
                'description' => 'aaa',
                'field_type' => '',
                'error_message' => 'aaa',
            ),
            2 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'bbb',
                'description' => 'bbb',
                'field_type' => 'bbb',
            ),
            3 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'aaa',
                'description' => 'aaa',
                'field_type' => '',
                'error_message' => 'aaa',
            ),
            4 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'aaa',
                'description' => 'aaa',
                'field_type' => '',
                'error_message' => 'aaa',
            ),
            5 => array(
                'required' => true,
                'validators' => array(),
                'filters' => array(),
                'name' => 'bbb',
                'description' => 'bbb',
                'field_type' => 'bbb',
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'test\\V1\\Rest\\Test-V1-Rest-Zoltan-Controller\\Controller' => array(
                'collection' => array(
                    'GET' => false,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
            ),
        ),
    ),
);
