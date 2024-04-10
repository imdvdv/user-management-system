<?php

// The function for updating user data on the profile page
function updateUser (int $userID, array $inputs): array {

    // Prepare a preliminary negative response in case of errors
    $statusCode = 400;
    $responseData = [
        "status" => false,
    ];
    $responseData = validateFields($inputs, $responseData); // updating response data after validation

   if (!isset($responseData["errors"])){

       // Update user data in the database
       $pdo = getPDO();
       $query = "UPDATE users SET name = ?, email = ? WHERE id = ?";
       $values = [$inputs["name"], $inputs["email"], $userID];
       executeQuery($pdo, $query, $values);

       // Prepare a positive response
       $statusCode = 200;
       $responseData = [
           "status" => true,
           "message" => "User (ID-$userID) was updated",
       ];
   }
   http_response_code($statusCode);
   return $responseData;
}