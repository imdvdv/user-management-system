<?php

use core\helpers;
use core\view;
use core\popup;
use core\session;
use app\models\user;

if (isset($slug['id']) && helpers\is_id($slug['id'])) {
    $user_id = $slug['id'];

    if (session\has_selected_user() && session\get_selected_user('id') == $user_id) {
        $user_name = session\get_selected_user('name');
        $user_email = session\get_selected_user('email');
    } else {
        $user = user\get_by_id($user_id);

        if (is_array($user) && helpers\has_array_keys($user, ['name', 'email'])) {
            session\set_selected_user($user_id, $user['email'], $user['name']);
            $user_name = $user['name'];
            $user_email = $user['email'];
        } else {
            helpers\write_to_log("User with id {$user_id} was not found in the database", __FILE__);
        }

    }

    $fields = [
        ['name' => 'name', 'type' => 'text', 'title' => 'Name', 'value' => $user_name ?? '', 'width' => 70],
        ['name' => 'email', 'type' => 'text', 'title' => 'Email *', 'value' => $user_email ?? '', 'width' => 70]
    ];
    $buttons_data = [
        'items' => [
            ['class' => 'form__button form__button_confirm'],
            ['tag' => 'a', 'href' => $_SERVER['HTTP_REFERER'] ?? BASE_URL . '/users', 'class' => 'form__button form__button_cancel button_cancel']
        ]
    ];
    $form_data = [
        'action' => "/users/edit/{$user_id}",
        'method' => 'patch',
        'name' => 'form_edit',
        'class' => 'popup-form',
        'fields' => $fields,
        'buttons' => view\template('partials/buttons', $buttons_data)
    ];
    isset($user_email) ? popup\render_popup('Edit user', $form_data, 'partials/form') : helpers\abort();
}