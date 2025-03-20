<?php

namespace core\request;

function get_url(string $default = '/'): ?string
{
    return trim(urldecode($_SERVER['REQUEST_URI']), '/') ?? $default;
}

function get_parse_url(?string $url = null): ?array
{
    $url_data = null;
    $url = parse_url($url ?? get_url());
    $url_data['path'] = $url['path'] ?? null;

    if (isset($url['query'])) {
        parse_str($url['query'], $url_data['query']);
    }
    return $url_data;
}

function get_path(?string $uri = null): ?string
{
    $uri = $uri ?? get_url();
    $uri = parse_url($uri);
    return $uri['path'] ?? null;
}

function get_query_params(?string $url = null): ?array
{
    $url = $url ?? get_url();
    $url = parse_url($url);
    $result = null;

    if (isset($url['query']) && is_string($url['query'])) {
        parse_str($url['query'], $result);
    }

    return $result;
}

function get_url_with_new_params(array $params, ?string $url = null): string
{
    $url = $url ?? get_url();
    $url_data = parse_url($url);
    $path = $url_data['path'] ?? '/';

    if (isset($url_data['query'])) {
        parse_str($url_data['query'], $query);
        $params = array_merge($query, $params);
    }

    $params = http_build_query(array_filter($params, fn($param) => $param !== null || is_string($param) || is_numeric($param)));
    return rtrim("{$path}?{$params}", '?&');
}

function get_method(): string
{
    return strtoupper($_POST['_method'] ?? $_SERVER['REQUEST_METHOD']);
}

function get_data(): array
{
    $result = [];
    $method = get_method();

    if ($method == 'POST' || $method == 'PUT' || $method == 'PATCH') {
        $request_data = array_merge($_POST, $_FILES);
    } elseif ($method == 'GET') {
        $request_data = $_GET;
    }

    foreach ($request_data as $key => $value) {
        $result[$key] = $value;
    }
    return $result;
}

function get_ip(): ?string
{
    return $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? null;
}


