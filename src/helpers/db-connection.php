<?php

function getPDO ():PDO {
    try {
        return new PDO("mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
            DB_USERNAME, DB_PASSWORD, DB_OPTIONS);
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
