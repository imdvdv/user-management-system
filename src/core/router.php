<?php

namespace core\router;

use core\request;
use core\helpers;

function routing(): void
{
    $routes = include ROUTES;
    $url = parse_url(request\get_url());
    $path = $url['path'] ?? '';
    $method = request\get_method();
    $controller = CONTROLLERS . '/errors/404.php';

    foreach ($routes as $route => $properties) {
        $matches = [];

        if (preg_match($route, $path, $matches) && $properties['method'] == $method) {

            if (isset($properties['controller'])) {
                $controller = CONTROLLERS . "/{$properties['controller']}.php";

                if (file_exists($controller)) {

                    if (isset($properties['middleware'])) {
                        $middleware_path = MIDDLEWARE . "/{$properties['middleware']}.php";

                        if (file_exists($middleware_path)) {
                            $middleware_handle = "core\\middleware\\{$properties['middleware']}\\handle";
                            call_user_func(callback: $middleware_handle);
                        } else {
                            helpers\write_to_log("Middleware $middleware_path not found", __FILE__);
                            $controller = CONTROLLERS . '/errors/500.php';
                        }

                    }

                    if (isset($properties['slug'])) {

                        foreach ($properties['slug'] as $name => $num) {
                            $slug[$name] = $matches[$num];
                        }

                    }

                    break;
                } else {
                    helpers\write_to_log("Controller $controller not found", __FILE__);
                    $controller = CONTROLLERS . '/errors/500.php';
                }
            }

        }

    }
    require $controller;
}