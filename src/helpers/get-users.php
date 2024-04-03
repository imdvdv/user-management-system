<?php

function getUsers(int|bool $userID = null): array|bool {
    $pdo = getPDO();
    if ($userID){
        $query = "SELECT id, name, email FROM users WHERE id = ? LIMIT 1";
        $values = [$userID];
        $stmt = executeQuery($pdo, $query, $values);
    } else {
        $query = "SELECT id, name, email FROM users";
        $stmt = executeQuery($pdo, $query);
    }
    return $stmt->fetchAll();
}

