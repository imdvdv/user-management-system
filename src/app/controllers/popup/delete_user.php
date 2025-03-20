<?php

use core\helpers;
use core\view;
use core\popup;

if (isset($slug['id']) && helpers\is_id($slug['id'])) {
    $user_id = $slug['id'];
    $buttons_data = [
        'items' => [
            ['action' => "/users/delete/$user_id", 'method' => 'delete', 'text' => 'Delete', 'class' => 'button_delete popup__button popup__button_delete'],
            ['tag' => 'a', 'href' => $_SERVER['HTTP_REFERER'] ?? BASE_URL . '/users', 'class' => 'button_cancel popup__button popup__button_cancel']
        ]
    ];
    $popup_data = [
        'popup_text' => "Are you sure you want to delete user by ID {$user_id} ?",
        'popup_buttons' => view\template('partials/buttons', $buttons_data)
    ];
    popup\render_popup('Delete user', $popup_data);
} else {
    helpers\abort();
}