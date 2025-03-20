<?php

define('ROOT', dirname(__DIR__));
const CONFIG = ROOT . '/config';
const ROUTES = CONFIG . '/routes.php';
const APP = ROOT . '/src/app';
const MODELS = APP . '/models';
const VIEWS = APP . '/views';
const CONTROLLERS = APP . '/controllers';
const CORE = ROOT . '/src/core';
const MIDDLEWARE = CORE . '/middleware';
const HELPERS = CORE . '/helpers';
const PUBLIC_DIR = ROOT . '/public';
const LOGS_DIR = ROOT . '/src/logs';
const APP_TITLE = 'UMS';
const BASE_URL = 'YOUR_BASE_URL'; // http://localhost (for example)

const TIMEZONE = 'UTC';
const ONE_HOUR = 3600,
    ONE_WEEK = 604800,
    ONE_MONTH = ONE_WEEK * 4;

const SESSION_SETTINGS = [
    'strict_mode' => 1,
    'only_cookies' => 1,
    'path' => '/',
    'domain' => '',
    'secure' => false,
    'httponly' => true
];

const COOKIE_SETTINGS = [
    'path' => '/',
    'domain' => '',
    'secure' => false,
    'httponly' => true,
];

const DB_SETTINGS = [
    'driver' => 'mysql',
    'host' => 'your_host',
    'db_name' => 'your_db_name', // ums
    'username' => 'your_username',
    'password' => 'your_password',
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'port' => 'your_port', // 3306
    'prefix' => '',
    'options' => [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ],
];

const PAGINATION_SETTINGS = [
    'per_page' => 10,
    'max_pages' => 7,
    'template' => 'partials/pagination',
];

const POPUP_SETTINGS = [
    'template' => 'partials/popup/template',
];

const ALLOWED_REFERERS = [
    'users/search' => ['/users'],
    'popup/search-user' => ['/users'],
    'popup/add-user' => ['/users'],
    'popup/edit-user' => ['/users'],
    'popup/delete-user' => ['/users']
];



