<?php

function getUrlParts (): array {
    $query = $_GET["query"] ?? "/";
    return explode("/", $query);
}