<?php

$valid_id = '[1-9]+\d*';
$query_params = '\?[a-zA-Z0-9]+(=[a-zA-Z0-9]+)?(&[a-zA-Z0-9]+(=[a-zA-Z0-9]+)?)*';

return [

    // PAGES
    '/^\/?$/' => [
        'method' => 'GET',
        'controller' => 'page/home',
    ],
    "/^users($query_params)?$/" => [
        'method' => 'GET',
        'controller' => 'page/users',
    ],
    '/^users\/add\/?$/' => [
        'method' => 'POST',
        'controller' => 'user/store',
    ],
    "/^users\/edit\/($valid_id)$/" => [
        'method' => 'PATCH',
        'controller' => 'user/update',
        'slug' => ['id' => 1]
    ],
    "/^users\/delete\/($valid_id)$/" => [
        'method' => 'DELETE',
        'controller' => 'user/remove',
        'slug' => ['id' => 1]
    ],
    '/^users\/search\/?$/' => [
        'method' => 'POST',
        'controller' => 'user/search',
    ],

    // POPUPS
    '/^popup\/add-user\/?$/' => [
        'method' => 'GET',
        'controller' => 'popup/add_user',
        'middleware' => 'allowed_referer'
    ],
    "/^popup\/edit-user\/($valid_id)$/" => [
        'method' => 'GET',
        'controller' => 'popup/edit_user',
        'middleware' => 'allowed_referer',
        'slug' => ['id' => 1]
    ],
    "/^popup\/delete-user\/($valid_id)$/" => [
        'method' => 'GET',
        'controller' => 'popup/delete_user',
        'middleware' => 'allowed_referer',
        'slug' => ['id' => 1]
    ],
    '/^popup\/search-user\/?$/' => [
        'method' => 'GET',
        'controller' => 'popup/search_user',
        'middleware' => 'allowed_referer'
    ],

    // ERRORS
    '/^403\/?$/' => [
        'method' => 'GET',
        'controller' => 'errors/403'
    ],
    '/^404\/?$/' => [
        'method' => 'GET',
        'controller' => 'errors/404'
    ],
    '/^500\/?$/' => [
        'method' => 'GET',
        'controller' => 'errors/500'
    ],
];