<?php

namespace core\controller;

use core\request;
use core\helpers;

function prepare_form_data(array $labels): array
{
    $attributes = [];
    $request_data = request\get_data();

    foreach ($labels as $field) {

        if (array_key_exists($field, $request_data)) {
            $attributes[$field] = is_string($request_data[$field]) ? helpers\remove_extra_spaces($request_data[$field]) : $request_data[$field];
        } else {
            $attributes[$field] = null;
        }

    }
    return $attributes;
}
