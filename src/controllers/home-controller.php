<?php

function homeController (string $method) {

    if ($method === "GET"){

        header("Content-type: text/html; charset=UTF-8");
        include_once __DIR__ . "/../../pages/admin-panel.php";

    } else{

        header("HTTP/1.1 405 Method Not Allowed");
        exit;

    }
}