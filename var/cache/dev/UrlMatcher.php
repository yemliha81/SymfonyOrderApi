<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/register' => [[['_route' => 'register', '_controller' => 'App\\Controller\\AuthController::register'], null, ['POST' => 0], null, false, false, null]],
        '/api' => [[['_route' => 'api', '_controller' => 'App\\Controller\\AuthController::api'], null, null, null, false, false, null]],
        '/login_check' => [[['_route' => 'login_check'], null, ['POST' => 0], null, false, false, null]],
        '/api/orders' => [[['_route' => 'orders', '_controller' => 'App\\Controller\\OrderController::orders'], null, null, null, false, false, null]],
        '/api/orders/create' => [[['_route' => 'orders_create', '_controller' => 'App\\Controller\\OrderController::create'], null, ['POST' => 0], null, false, false, null]],
        '/api/orders/find' => [[['_route' => 'orders_find', '_controller' => 'App\\Controller\\OrderController::find'], null, ['POST' => 0], null, false, false, null]],
        '/api/orders/edit' => [[['_route' => 'orders_edit', '_controller' => 'App\\Controller\\OrderController::edit'], null, ['PUT' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        35 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
