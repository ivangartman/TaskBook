<?php

require_once 'config/init.php';

class Errors {
    public $name;
    public $email;
    public $content;
    public $first_name;
    public $password;
}

$errors_valid_user = new Errors();

if (isset($_POST['password']) and empty(trim($_POST['password']))) {
    $errors_valid_user->password = 'Введите пароль';
} elseif (mb_strlen(trim($_POST['password'])) > 20) {
    $errors_valid_user->password = 'Введите не более 20 символов';
}
if (isset($_POST['first_name']) and empty(trim($_POST['first_name']))) {
    $errors_valid_user->first_name = 'Введите имя пользователя';
} elseif (mb_strlen(trim($_POST['first_name'])) > 60) {
    $errors_valid_user->first_name = 'Введите не более 60 символов';
} else {
    //Проверяем есть ли такой пользователь в БД
    $link = mysqli_connect('localhost', 'root', '', 'taskBook');
    mysqli_set_charset($link, "utf8");
    $first_name = mysqli_real_escape_string($link, trim($_POST['first_name']));
    $user = $this->model->db_user($first_name);
    if ($user) {
        if (trim($_POST['password'] == $user['password'])) {
            $_SESSION['user'] = $user;
            $user_name = $_SESSION['user']['first_name'];
        } else {
            $errors_valid_user->password = 'Неверный пароль';
        }
    } else {
        $errors_valid_user->first_name = 'Такой пользователь не найден';
    }
}

foreach ($errors_valid_user as $key => $item ) {
    if ($item) {
        $errors_user = ['0'];
    }
}
