<?php

include_once __DIR__ . "/../config/includes.php";

// Home page
setRoute("/", function () {

    $method = $_SERVER["REQUEST_METHOD"];
    if ($method === "GET"){

        header("Content-type: text/html; charset=UTF-8");
        include_once __DIR__ . "/../pages/admin-panel.php";

    } else{

        header("HTTP/1.1 405 Method Not Allowed");
        exit;

    }
});

// Endpoint for CRUD operations with users
setRoute("/users", function () {

    header("Content-type: application/json; charset=UTF-8");
    $method = $_SERVER["REQUEST_METHOD"];
    switch ($method) {

        // CREATE OPERATION
        case "POST":

            if (isset($_POST["name"], $_POST["email"])) {

                $inputs = [
                    "name" => trim(removeExtraSpaces($_POST["name"])),
                    "email" => trim($_POST["email"]),
                ];
                echo json_encode(createUser($inputs)); // add new user to the database

            } else {
                header("HTTP/1.1 400 Bad Request");
            }
            break;

        // READ OPERATION
        case "GET":

            $urlParts = getUrlParts();
            if (isset($urlParts[1]) && is_numeric($urlParts[1])) {

                $userID = $urlParts[1];
                echo json_encode(getUsers($userID)); // get one user from the database

            } else {
                echo json_encode(getUsers()); // get all users from the database
            }
            break;

        // UPDATE OPERATION
        case "PATCH":

            $urlParts = getUrlParts();
            if (isset($urlParts[1]) && is_numeric($urlParts[1])) {

                $userID = $urlParts[1];
                $inputData = json_decode(file_get_contents("php://input"));

                if (isset($inputData->name, $inputData->email)) {

                    $inputs = [
                        "name" => trim(removeExtraSpaces($inputData->name)),
                        "email" => trim($inputData->email),
                    ];
                    echo json_encode(updateUser($userID, $inputs)); // update user data in the database

                } else {
                    header("HTTP/1.1 400 Bad Request");
                }

            } else {
                header("HTTP/1.1 400 Bad Request");
            }
            break;

        // DELETE OPERATION
        case "DELETE":

            $urlParts = getUrlParts();
            if (isset($urlParts[1]) && is_numeric($urlParts[1])) {

                $userID = $urlParts[1];
                echo json_encode(deleteUser($userID)); // delete user from the database

            } else {
                header("HTTP/1.1 400 Bad Request");
            }
            break;

        default:

            header("HTTP/1.1 405 Method Not Allowed");
            break;
    }
});

// Not Found
setRoute("/404", function () {

    openErrorPage();

});

routing();
