<?php

function userController (string $method) {

    header("Content-type: application/json; charset=UTF-8");

    switch ($method) {

        // CREATE OPERATION
        case "POST":

            if (isset($_POST["name"], $_POST["email"])) {

                $inputData = $_POST;
                echo json_encode(createUser($inputData)); // add new user to the database

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
                $inputData = json_decode(file_get_contents("php://input"), true);

                if (isset($inputData->name, $inputData->email)) {

                    echo json_encode(updateUser($userID, $inputData)); // update user data in the database

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
}