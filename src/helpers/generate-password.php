<?php

function generatePassword(int $length = 8): string {
    $uppercase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $lowercase = "abcdefghijklmnopqrstuvwxyz";
    $numbers = "0123456789";

    $allChars = $uppercase . $lowercase . $numbers;

    $password = "";
    $password .= substr(str_shuffle($uppercase), 0, 1);
    $password .= substr(str_shuffle($lowercase), 0, 1);
    $password .= substr(str_shuffle($numbers), 0, 1);

    for ($i = 0; $i < ($length - 3); $i++) {
        $password .= substr(str_shuffle($allChars), 0, 1);
    }

    return str_shuffle($password);
}