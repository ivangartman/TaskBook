<?php

require_once 'application/models/functions.php';


$backward = isset($_SESSION['backward']) ? $_SESSION['backward'] : '';
$pages_count = '';
$cur_page = '';
$pages_pagination = '';
$task = ['0' =>'0'];
$errors = [];
$page = null;
$message ='';
$class = '';
$tasks = [];
$data = [];
$error_message = '';
$user_name = isset($_SESSION['user']['first_name']) ? $_SESSION['user']['first_name'] : '';
$key = isset($_SESSION['key']) ? $_SESSION['key'] : 'name';
$sort = isset($_SESSION['sort']) ? $_SESSION['sort'] : 'asc';
$redirect = isset($_SESSION['redirect']) ? $_SESSION['redirect'] : '0';
$add = isset($_SESSION['add']) ? $_SESSION['add'] : '0';
$errors_user = [];
$page = null;
$names_field = ['content', 'status'];
$errors_edit = [];
$edit_content  = '';

$key_array  = ['name', 'email', 'status'];
$sort_array = ['asc', 'desc'];

$theads = [
    'name'   => ['name' => 'Имя пользователя', 'column' => 'name'],
    'email'  => ['name' => 'E-mail', 'column' => 'email'],
    'status' => ['name' => 'Статус', 'column' => 'status'],
];
