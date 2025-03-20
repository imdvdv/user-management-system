<?php

use core\view;
use core\popup;

$fields = [
    ['name' => 'id_search', 'type' => 'number', 'title' => 'ID', 'width' => 35],
    ['name' => 'name_search', 'type' => 'text', 'title' => 'Name', 'width' => 70],
    ['name' => 'email_search', 'type' => 'text', 'title' => 'Email', 'width' => 70]
];
$buttons_data = [
    'items' => [
        ['class' => 'form__button form__button_confirm'],
        ['tag' => 'a', 'href' => $_SERVER['HTTP_REFERER'] ?? BASE_URL . '/users', 'class' => 'form__button form__button_cancel button_cancel']
    ]
];
$form_data = [
    'action' => '/users/search',
    'name' => 'form_search',
    'class' => 'popup-form',
    'fields' => $fields,
    'buttons' => view\template('partials/buttons', $buttons_data)
];
popup\render_popup('Search user', $form_data, 'partials/form');