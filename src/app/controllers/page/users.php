<?php

use core\pagination;
use core\response;
use core\request;
use core\helpers;
use core\view;
use app\models\user;

$db_params = [];
$content_data = [];
$per_page = PAGINATION_SETTINGS['per_page'];
$query_params = request\get_data();

if (!empty($query_params)) {

    if (isset($query_params['id']) && helpers\is_id($query_params['id'])) {
        $db_params['id'] = $query_params['id'];
    }
    if (isset($query_params['email']) && helpers\is_email($query_params['email'])) {
        $db_params['email'] = $query_params['email'];
    }
    if (isset($query_params['name']) && is_string($query_params['name'])) {
        $db_params['name'] = $query_params['name'];
    }

}

$users_count = isset($users) ? count($users) : user\count_columns($db_params);

if (isset($users_count) && $users_count !== 0) {

    if ($users_count > $per_page) {
        $pagination_data = pagination\paginate($users_count);
        $users = isset($pagination_data['offset']) ? user\get_with_offset($per_page, $pagination_data['offset'], $db_params) : null;
    } else {
        $users = user\get_all($db_params);
    }

} elseif (isset($db_params['id']) || isset($db_params['email']) || isset($db_params['name'])) {
    response\set_body(status: 'failure', message: 'Users not found');
}

$content_data = [
    'users' => $users ?? null,
    'pagination' => $pagination_data['view'] ?? null
];
view\render_page('users', $content_data);