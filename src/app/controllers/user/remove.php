<?php

use core\helpers;
use core\response;
use app\models\user;

if (isset($slug['id']) && helpers\is_id($slug['id'])) {
    $user_id = $slug['id'];

    if (user\remove_by_id($user_id)) {
        response\set_body(status: 'success', message: "User with ID $user_id has been deleted");
    } else {
        helpers\write_to_log("Failed to delete user data by id {$user_id}", __FILE__);
        response\set_body(status: 'failure', message: "Failed to delete user data by id {$user_id}");
    }

} else {
    helpers\abort();
}
response\redirect($_SERVER['HTTP_REFERER'] ?? '/users');
;

