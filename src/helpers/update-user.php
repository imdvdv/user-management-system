<?php

// The function for updating user data on the profile page
function updateUser (int $userID, array $inputs): array {

    // Prepare a preliminary negative response in case of errors
    $statusCode = "HTTP/1.1 400 Bad Request";
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
       $statusCode = "HTTP/1.1 200 OK";
       $responseData = [
           "status" => true,
           "message" => "User (ID-$userID) was updated",
       ];
   }
   header($statusCode);
   return $responseData;
}