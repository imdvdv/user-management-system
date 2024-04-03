<?php

function validateFields (array $inputs, array $response, array $params = VALIDATION_PARAMS["fields"]): array {
    foreach ($inputs as $key => $value) {
        if (empty($value)) {
            $response["errors"][$key] = $key ." is required";
        } else if (!preg_match($params[$key]["pattern"], $value)){
            $response["errors"][$key] = $params[$key]["error"];
        }
    }
    return $response;
}
