<?php

use core\controller;
use core\request;
use core\response;
use app\models\user;

$query_params = [];
$fields = controller\prepare_form_data(user\LABELS['form_search']);
$errors = user\validate($fields);

if (empty($errors)) {

    if (isset($fields['id_search']) && !empty($fields['id_search'])) {
        $query_params['id'] = $fields['id_search'];
    }

    if (isset($fields['email_search']) && !empty($fields['email_search'])) {
        $query_params['email'] = $fields['email_search'];
    }

    if (isset($fields['name_search']) && !empty($fields['name_search'])) {
        $query_params['name'] = $fields['name_search'];
    }

    if (!empty($query_params)) {
        $query_params['page'] = null;
        response\redirect(request\get_url_with_new_params($query_params, '/users'));
    }

}

response\set_body(values: $fields, errors: $errors);
response\redirect('/popup/search-user');