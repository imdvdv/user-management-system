<?php

namespace core\model;

use core\db;
use core\helpers;

function add_row(string $query, array $params): ?string
{
    if (str_starts_with($query, 'INSERT')) {
        db\execute_query($query, $params);
        return db\get_last_id();
    } else {
        helpers\write_to_log("Incorrect query: $query", __FILE__);
        helpers\abort(500);
    }
}

function count_columns(string $query, array $params = []): mixed
{
    if (str_starts_with($query, 'SELECT COUNT')) {
        $stmt = db\execute_query($query, $params);
        return $stmt->fetchColumn();
    } else {
        helpers\write_to_log("Incorrect query: $query", __FILE__);
        helpers\abort(500);
    }
}

function count_all_columns(string $table): mixed
{
    $query = "SELECT COUNT(*) FROM $table";
    return count_columns($query);
}

function find_one(string $query, array $params): ?array
{
    if (str_starts_with($query, 'SELECT')) {
        $stmt = db\execute_query($query, $params);
        $result = $stmt->fetch();
        return is_array($result) ? $result : null;
    } else {
        helpers\write_to_log("Incorrect query: $query", __FILE__);
        helpers\abort(500);
    }
}

function find_all(string $query, array $params = []): ?array
{
    if (str_starts_with($query, 'SELECT')) {
        $stmt = db\execute_query($query, $params);
        $result = $stmt->fetchAll();
        return is_array($result) ? $result : null;
    } else {
        helpers\write_to_log("Incorrect query: $query", __FILE__);
        helpers\abort(500);
    }
}

function find_with_offset(string $query, array $params = []): ?array
{
    if (str_starts_with($query, 'SELECT') && str_contains($query, ' LIMIT ') && str_contains($query, ' OFFSET ')) {
        $stmt = db\execute_query($query, $params);
        $result = $stmt->fetchAll();
        return is_array($result) ? $result : null;
    } else {
        helpers\write_to_log("Incorrect query: $query", __FILE__);
        helpers\abort(500);
    }
}

function update(string $query, array $params): bool
{
    if (str_starts_with($query, 'UPDATE')) {
        $stmt = db\execute_query($query, $params);
        return $stmt->rowCount() > 0 ? true : false;
    } else {
        helpers\write_to_log("Incorrect query: $query", __FILE__);
        helpers\abort(500);
    }
}

function remove(string $query, array $params): bool
{
    if (str_starts_with($query, 'DELETE')) {
        $stmt = db\execute_query($query, $params);
        return $stmt->rowCount() > 0 ? true : false;
    } else {
        helpers\write_to_log("Incorrect query: $query", __FILE__);
        helpers\abort(500);
    }
}