<?php

function getPDO ():PDO {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME,
            DB_USERNAME, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e){
        http_response_code(500);
        die("Connection failed : ". $e->getMessage());
    }
}

function executeQuery (PDO $pdo, string $query, array $values = null):PDOStatement {
    try {
        $stmt = $pdo->prepare($query);
        $values ? $stmt->execute($values) : $stmt->execute();
        return $stmt;
    } catch(PDOException $e){
        http_response_code(500);
        die("Connection failed : ". $e->getMessage());
    }
}
