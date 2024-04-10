<?php

function deleteUser (int $userID): array {

    // Check user exists
    $result = getUsers($userID);
    if (isset($result["status"]) && $result["status"] === false){

        // Return a negative response
        return $result;
    }

    // Delete user data from the database
    $pdo = getPDO();
    $values = [$userID];
    $query = "DELETE FROM users WHERE id = ? LIMIT 1";
    executeQuery($pdo, $query, $values);

    // Return a positive response
    $statusCode = 200;
    http_response_code($statusCode);
    return [
        "status" => true,
        "message" => "User (ID-$userID) has been deleted",
    ];
}