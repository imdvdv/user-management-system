<?php

function createUser (array $inputData): array {

    // Prepare a preliminary negative response in case of errors
    $statusCode = 400;
    $responseData = [
        "status" => false,
    ];

    // Validation fields
    $fieldsData = validateFields($inputData); // the function returns array includes prepared values and array of errors
    $responseData["errors"] = $fieldsData["errors"];

    if (isset($fieldsData["email"]) && !isset($fieldsData["errors"]["email"])) {

        // Check the email exists in the database
        $pdo = getPDO();
        $query = "SELECT email FROM users WHERE email = ? LIMIT 1";
        $values = [$fieldsData["email"]];
        $stmt = executeQuery($pdo, $query, $values);

        if ($stmt->rowCount() > 0) {

            $responseData["errors"]["email"] = "this email already exists";

        } elseif (empty($responseData["errors"]) && isset($fieldsData["name"])) {

            // Generate random password for a new user
            $password = generatePassword();
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Write user data to the database
            $query = "INSERT INTO users (`name`, `email`, `password_hash`)
            VALUES(?,?,?)";
            $values = [$fieldsData["name"], $fieldsData["email"], $passwordHash];
            executeQuery($pdo, $query, $values);

            // Prepare a positive response
            $statusCode = 201;
            $responseData = [
                "status" => true,
                "message" => "User has been created",
            ];

        }
    }
    
    http_response_code($statusCode);
    return $responseData;
}
