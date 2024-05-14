<?php

// The function for updating user data on the profile page
function updateUser (int $userID, array $inputData): array {

    // Check user exists
    $result = getUsers($userID);

    if (isset($result["status"]) && !$result["status"]){

        // Return a negative response
        return $result;

    }

    // Prepare a preliminary negative response in case errors
    $statusCode = 400;
    $responseData = [
        "status" => false,
    ];
    
    // Validation fields
    $fieldsData = validateFields($inputData); // the function returns array includes prepared value and array of errors

    if (isset($fieldsData["name"], $fieldsData["email"]) && !isset($fieldsData["errors"]["email"], $fieldsData["errors"]["name"])) {

        // Update user data in the database
        $pdo = getPDO();
        $query = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        $values = [$fieldsData["name"], $fieldsData["email"], $userID];
        executeQuery($pdo, $query, $values);

        // Prepare a positive response
        $statusCode = 200;
        $responseData = [
            "status" => true,
            "message" => "User (ID-$userID) was updated",
        ];

    } elseif (isset($fieldsData["errors"])) {

        $responseData["errors"] = $fieldsData["errors"];

    }

    http_response_code($statusCode);
    return $responseData;
}