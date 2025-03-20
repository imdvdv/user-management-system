<?php

namespace core\session;

use core\helpers;

function check_regenerate(): bool
{
    return isset($_SESSION['regenerate']['expiration_time']) && is_int($_SESSION['regenerate']['expiration_time']) && $_SESSION['regenerate']['expiration_time'] > time();
}

function regenerate(int $term = ONE_HOUR): void
{
    if (session_regenerate_id()) {
        $_SESSION['regenerate']['expiration_time'] = time() + $term;
    } else {
        helpers\write_to_log('Failed regenerate session id', __FILE__);
    }
}

function set(string $key, mixed $value): void
{
    $_SESSION[$key] = $value;
    regenerate();
}

function has(string $key): bool
{
    return isset($_SESSION[$key]);
}

function remove(string $key): void
{
    unset($_SESSION[$key]);
    regenerate();
}

function get(string $key, bool $destroy = false, mixed $default = null): mixed
{
    $result = $_SESSION[$key] ?? $default;

    if ($destroy) {
        remove($key);
    }
    return $result;
}

function set_temp_content(array $content_data): void
{
    set('temp_content', $content_data);
}

function get_temp_content(): array
{
    return get('temp_content', true, []);
}

function set_selected_user(int|string $id, string $email, ?string $name = null): void
{
    set('selected_user', [
        'id' => $id,
        'email' => $email,
        'name' => $name,
    ]);
}

function has_selected_user(?string $key = null): bool
{
    if (is_string($key)) {
        return isset($_SESSION['selected_user'][$key]) && !empty($_SESSION['selected_user'][$key]);
    }
    return isset($_SESSION['selected_user']['id'], $_SESSION['user']['email']) && helpers\is_id($_SESSION['selected_user']['id']) && helpers\is_email($_SESSION['selected_user']['email']);
}

function get_selected_user(?string $key = null): mixed
{
    return isset($key) ? $_SESSION['selected_user'][$key] ?? null : get('selected_user');
}

