<?php

namespace core\helpers;

use core\request;
use core\response;

function abort(string $code = '404'): void
{
    response\redirect("/$code");
}

function generate_password(int $length = 8): string
{
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $all_chars = "{$uppercase}{$lowercase}{$numbers}";
    $password = '';
    $password .= substr(str_shuffle($uppercase), 0, 1);
    $password .= substr(str_shuffle($lowercase), 0, 1);
    $password .= substr(str_shuffle($numbers), 0, 1);

    for ($i = 0; $i < ($length - 3); $i++) {
        $password .= substr(str_shuffle($all_chars), 0, 1);
    }
    return str_shuffle($password);
}

function check_allowed_paths(array $allowed_paths, ?string $current_path = null): bool
{
    $current_path = $current_path ?? request\get_path();
    foreach ($allowed_paths as $path) {

        if (is_string($path) && $path == $current_path) {
            return true;
        }

    }
    return false;
}

function check_referer(?array $allowed_paths = null): bool
{
    $result = false;
    if (isset($_SERVER['HTTP_REFERER']) && str_starts_with($_SERVER['HTTP_REFERER'], BASE_URL)) {
        $result = true;
        if (isset($allowed_paths)) {
            $referer_path = request\get_path($_SERVER['HTTP_REFERER']);
            $result = check_allowed_paths($allowed_paths, $referer_path);
        }
    }
    return $result;
}

function is_id(int|string $value): bool
{
    return preg_match('/^[1-9]+\d*$/', $value);
}

function is_email(string $value): bool
{
    return preg_match('/^[^ ]+@[^ ]+\.[a-z]{2,3}$/', $value);
}

function is_username(string $value): bool
{
    return preg_match('/^([A-Za-z\s]{1,30}|[А-ЯЁа-яё\s]{1,30})$/', $value);
}

function has_array_keys(array $array, array $keys): bool
{
    foreach ($keys as $key) {
        if (!array_key_exists($key, $array)) {
            return false;
        }
    }
    return true;
}

function remove_extra_spaces(string $string): string
{
    return trim(preg_replace('/\s+/', ' ', $string));
}

// function get_clean_string(string $string): mixed
// {
//     return htmlspecialchars(remove_extra_spaces($string));
// }

function write_to_log(string $message, ?string $path = null): void
{
    $year = date('Y');
    $month = date('M');
    $day = date('d');
    $dir_path = LOGS_DIR . "/$year/$month/$day";

    if (!is_dir($dir_path)) {
        mkdir($dir_path, 0777, true);
    }

    $timestamp = date('Y-m-d H:i:s');
    $path = isset($path) ? ". Path: {$path}" : '';
    file_put_contents("$dir_path/log.txt", "[$timestamp] " . rtrim($message, '.') . "{$path}\n", FILE_APPEND);
}
