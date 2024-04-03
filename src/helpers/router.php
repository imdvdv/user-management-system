<?php

$routes = [];
$query = isset($_GET["endpoint"]) ? "/" . $_GET["endpoint"] : "/";

function setRoute(string $path, callable $callback):void {
    global $routes;
    $routes[$path] = $callback;
}

function routing(): void {
    global $routes, $query;
    $found = false;
    foreach ($routes as $path => $callback) {
        if ($path == $query) {
            $found = true;
            $callback();
        }
    }

    if (!$found) {
        $notFoundCallback = $routes["/404"];
        $notFoundCallback();
    }
}



