<?php

function getUsers(int|bool $userID = null): array {

    $pdo = getPDO();

    // Get one user
    if ($userID){
        $query = "SELECT id, name, email FROM users WHERE id = ? LIMIT 1";
        $values = [$userID];
        $stmt = executeQuery($pdo, $query, $values);
        $result = $stmt->fetch();

    // Get all users
    } else {
        $query = "SELECT id, name, email FROM users";
        $stmt = executeQuery($pdo, $query);
        $result = $stmt->fetchAll();
    }
    $statusCode = 200;

    if (!$result){

        // Prepare a negative response in case of errors
        $statusCode = 404;
        $result = [
            "status" => false,
            "message" => "Users not found",
        ];
    }
    
    http_response_code($statusCode);
    return $result;
}

