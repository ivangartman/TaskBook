<?php



class Errors
{
		public $name;
		public $email;
		public $content;
		public $first_name;
		public $password;

}

require_once 'config/init.php';

$errors_validation = new Errors;
//Валидация имени
if (isset($_POST['name']) && empty(trim($_POST['name']))) {
    $errors_validation->name = 'Введите название задачи';
} elseif (mb_strlen(trim($_POST['name'])) > 40) {
    $errors_validation->name = 'Введите не более 40 символов';
}
//Валидация e-mail
if (isset($_POST['email']) && empty(trim($_POST['email']))) {
    $errors_validation->email = 'Введите E-mail';
} elseif (mb_strlen(trim($_POST['email'])) > 40) {
          $errors_validation->email = 'Введите не более 40 символов';
} elseif (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
    $errors_validation->email = 'Введите коректный E-mail';
}
//Валидация организации
if (isset($_POST['content']) && empty(trim($_POST['content']))) {
    $errors_validation->content = 'Введите описание задачи';
} elseif (mb_strlen(trim($_POST['content'])) > 50) {
    $errors_validation->content = 'Введите не более 50 символов';
}

foreach ($errors_validation as $key => $item ) {
    if ($item) {
        $errors = ['0'];
    }
}
