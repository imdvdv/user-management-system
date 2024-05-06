<?php

include_once __DIR__ . "/../config/includes.php";

// Home page
setRoute("/", function () {

    $method = $_SERVER["REQUEST_METHOD"];
    homeController($method);

});

// Endpoint for CRUD operations with users
setRoute("/users", function () {

    $method = $_SERVER["REQUEST_METHOD"];
    userController($method);
    
});

// Not Found
setRoute("/404", function () {

    openErrorPage();

});

routing();
