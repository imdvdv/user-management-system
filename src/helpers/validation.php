<?php

function validateFields (array|object $inputData, array $params = VALIDATION_PARAMS["fields"]): array {

    $result = [
        "errors" => [],
    ];

    foreach ($inputData as $key => $value) {

        if (array_key_exists($key, $params)){

            $result[$key] = removeExtraSpaces($value);

            if (empty($result[$key])) {

                $result["errors"][$key] = "$key is required";

            } elseif (!preg_match($params[$key]["pattern"], $result[$key])){

                $result["errors"][$key] = $params[$key]["error"];

            }
        }

    }
    
    return $result;
}
