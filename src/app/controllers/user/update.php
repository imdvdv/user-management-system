<?php

use core\controller;
use core\helpers;
use core\session;
use core\response;
use app\models\user;

$user_id = $slug['id'] ?? session\get_selected_user('id') ?? null;

if (helpers\is_id($user_id)) {
    $fields = controller\prepare_form_data(user\LABELS['form_edit']);
    $errors = user\validate($fields);

    if (is_array($fields) && helpers\has_array_keys($fields, ['name', 'email']) && empty($errors)) {

        if ($fields['name'] !== session\get_selected_user('name')) {
            $db_params['name'] = $fields['name'];
        }

        if ($fields['email'] !== session\get_selected_user('email')) {
            $db_params['email'] = $fields['email'];
        }

        if (!empty($db_params)) {
            $db_params['id'] = $user_id;

            if (user\update_by_id($db_params)) {
                session\remove('selected_user');
                response\set_body(status: 'success', message: "User data by id {$user_id} updated successfully");
            } else {
                response\set_body(status: 'failure', message: "Failed to update user data by id: {$user_id}");
                helpers\write_to_log($massage, __FILE__);
            }

            response\redirect($_SERVER['HTTP_REFERER'] ?? '/users');
        }

    } else {
        response\set_body(values: $fields, errors: $errors);
    }

    response\redirect("/popup/edit-user/{$user_id}");
} else {
    helpers\abort();
}
