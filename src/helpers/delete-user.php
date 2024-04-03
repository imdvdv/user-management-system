<?php

function deleteUser (int $userID): array {

    // Delete user data from the database
    $pdo = getPDO();
    $values = [$userID];
    $query = "DELETE FROM users WHERE id = ? LIMIT 1";
    executeQuery($pdo, $query, $values);

    // Return a positive response
    return [
        "status" => true,
        "message" => "User (ID-$userID) has been deleted",
    ];
}