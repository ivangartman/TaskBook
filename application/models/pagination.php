<?php

/*Пагинация*/
if (isset($_GET['page_pagination'])) {
    if (filter_var(trim($_GET['page_pagination']), FILTER_VALIDATE_INT)) {
        $cur_page = trim($_GET['page_pagination']);
    } else {
        $cur_page = 1;
    }
} else {
    $cur_page = 1;
}
$page_items = 3;
$cnt = count($tasks);
$pages_count = ceil($cnt / $page_items);
$offset = ($cur_page - 1) * $page_items;
$pages_pagination = range(1, $pages_count);
