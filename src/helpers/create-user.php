<?php

function createUser (array $inputs): array {

    // Prepare a preliminary negative response in case of errors
    $statusCode = "HTTP/1.1 400 Bad Request";
    $responseData = [
        "status" => false,
        ];
    $responseData = validateFields($inputs, $responseData);  // updating the response in case of validation errors

    if (!isset($responseData["errors"]["email"])) {

        // Check the email exists in the database
        $pdo = getPDO();
        $query = "SELECT email FROM users WHERE email = ? LIMIT 1";
        $values = [$inputs["email"]];
        $stmt = executeQuery($pdo, $query, $values);

        if ($stmt->rowCount() > 0) {
            $responseData["errors"]["email"] = "this email already exists";
        } else {

            // Generate random password for a new user
            $password = generatePassword();
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Write user data to the database
            $query = "INSERT INTO users (name, email, password_hash)
            VALUES(?,?,?)";
            $values = [$inputs["name"], $inputs["email"], $passwordHash];
            executeQuery($pdo, $query, $values);

            // Prepare a positive response
            $statusCode = "HTTP/1.1 201 Created";
            $responseData = [
                "status" => true,
                "message" => "User has been created",
            ];
        }
    }
    header($statusCode);
    return $responseData;
}
