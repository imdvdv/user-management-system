<?php

namespace core\pagination;

use core\request;
use core\response;
use core\view;

function paginate(int $total_records, int $per_page = PAGINATION_SETTINGS['per_page'], int $max_pages = PAGINATION_SETTINGS['max_pages']): array
{
    $count_pages = get_count_pages($total_records, $per_page);
    $current_page = get_current_page($count_pages);
    $offset = get_offset($current_page, $per_page);
    $view = get_pagination_html($current_page, $count_pages, $max_pages);
    return compact('per_page', 'max_pages', 'count_pages', 'current_page', 'offset', 'view');
}

function get_count_pages(int $total_records, int $per_page): int
{
    return (int) ceil($total_records / $per_page) ?: 1;
}

function get_current_page(int $count_pages)
{
    $query_params = request\get_data();
    $page = $query_params['page'] ?? 1;

    if ($page < 1) {
        response\redirect(request\get_url_with_new_params(['page' => null]));
    } elseif ($page > $count_pages) {
        response\redirect(request\get_url_with_new_params(['page' => $count_pages]));
    }

    return $page;
}

function get_page_steps(int $current_page, int $count_pages, int $max_pages): array
{
    $middle = ($count_pages <= $max_pages) ? $count_pages : floor($max_pages / 2);

    if ($current_page == 1) {
        $left = 0;
        $right = $max_pages - 1;
    } elseif ($current_page <= $middle) {
        $left = $current_page - 1;
        $right = ($max_pages - 1) - $left;
    } elseif ($current_page + $middle >= $count_pages) {
        $right = $count_pages - $current_page;
        $left = ($max_pages - 1) - $right;
    } else {
        $right = $middle;
        $left = $middle;
    }

    return compact('middle', 'left', 'right');
}

function get_offset(int $current_page, int $per_page): int
{
    return ($current_page - 1) * $per_page;
}

function get_page_link(int $page, ?string $uri = null): string
{
    $uri = $uri ?? request\get_url();
    $page = $page == 1 ? null : $page;
    return request\get_url_with_new_params(['page' => $page], $uri);
}

function get_pagination_html(int $current_page, int $count_pages, int $max_pages, string $view_name = PAGINATION_SETTINGS['template']): ?string
{
    $back = '';
    $forward = '';
    $first_page = '';
    $last_page = '';
    $pages_left = [];
    $pages_right = [];

    if ($count_pages > 1) {
        $steps = get_page_steps($current_page, $count_pages, $max_pages);

        if ($current_page > 1) {
            $back = get_page_link($current_page - 1);
        }

        if ($current_page < $count_pages) {
            $forward = get_page_link($current_page + 1);
        }

        if ($current_page > $steps['middle'] + 1) {
            $first_page = get_page_link(1);
        }

        if ($current_page < ($count_pages - $steps['middle'])) {
            $last_page = get_page_link($count_pages);
        }

        for ($i = $steps['left']; $i > 0; $i--) {
            if ($current_page - $i > 0) {
                $pages_left[] = [
                    'link' => get_page_link($current_page - $i),
                    'number' => $current_page - $i,
                ];
            }
        }

        for ($i = 1; $i <= $steps['right']; $i++) {
            if ($current_page + $i <= $count_pages) {
                $pages_right[] = [
                    'link' => get_page_link($current_page + $i),
                    'number' => $current_page + $i,
                ];
            }
        }
    }

    return view\template($view_name, compact('back', 'forward', 'first_page', 'last_page', 'pages_left', 'pages_right', 'current_page', 'count_pages'));
}