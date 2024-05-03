<?php

$routes = [];
$urlParts =  getUrlParts();
$endpoint = $urlParts[0];

function setRoute(string $path, callable $callback):void {
    global $routes;
    $routes[$path] = $callback;
}

function routing(): void {
    global $routes, $endpoint;
    $found = false;
    foreach ($routes as $path => $callback) {
        if ($path == "/{$endpoint}") {
            $found = true;
            $callback();
        }
    }

    if (!$found) {
        $notFoundCallback = $routes["/404"];
        $notFoundCallback();
    }
}



