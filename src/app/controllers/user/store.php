<?php

use core\controller;
use core\helpers;
use core\response;
use app\models\user;

$fields = controller\prepare_form_data(user\LABELS['form_add']);
$errors = user\validate($fields);

if (is_array($fields) && helpers\has_array_keys($fields, ['name', 'email'])) {

    if (!isset($errors['email'])) {
        $user_db = user\get_by_email($fields['email']);

        if (is_array($user_db) && isset($user_db['email'])) {
            $errors['email'] = 'this email already exists';
        }
    }

    if (empty($errors)) {
        $db_params = [
            'name' => $fields['name'],
            'email' => $fields['email'],
            'hash' => password_hash(helpers\generate_password(), PASSWORD_DEFAULT),
        ];
        $user_id = user\store($db_params);

        if (helpers\is_id($user_id)) {
            response\set_body(status: 'success', message: "User with ID {$user_id} was successfully created");
            response\redirect($_SERVER['HTTP_REFERER'] ?? '/users');
        } else {
            helpers\write_to_log("Failed to add user with email: {$fields['email']}", __FILE__);
        }

    }

}
response\set_body(values: $fields, errors: $errors);
response\redirect('/popup/add-user');


