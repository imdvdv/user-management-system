<?php

// Database params
const DB_HOST = "your DB Host", // "localhost" for local server
    DB_NAME = "your DB Name", // "ums" if you decide to use the database dump attached to the project
    DB_USERNAME = "your DB UserName", // "root" for phpMyAdmin
    DB_PASSWORD = "your DB Password", // "password" or without password for phpMyAdmin
    DB_PORT = "your DB Port"; // usually 3306

const VALIDATION_PARAMS = [
    "fields" => [
        "name" => [
            "pattern" => "/^([A-Za-z\s]{2,30}|[А-ЯЁа-яё\s]{2,30})$/",
            "error" => "name must be at least 2 characters and contain only letters",
        ],
        "email" => [
            "pattern" => "/^[^ ]+@[^ ]+\.[a-z]{2,3}$/",
            "error" => "enter a valid email address",
        ],
        "password" => [
            "pattern" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/",
            "error" => "password must be at least 6 character with number, small and capital letter",
        ],
    ],
];