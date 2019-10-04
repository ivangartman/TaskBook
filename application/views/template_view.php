<?php

/**
 *
 * @var string $title Название страницы
 * @var string $user_name Имя пользователя
 *
 */
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <title><?= $title ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>

<body>
<header class="main-header">
    <nav class="main-navigation">
        <div class="user-menu">
            <?php if ($user_name): ?>
                <div class="user-menu__logged">
                    <p><b><?= strip_tags($user_name) ?></b></p>
                    <a class="user-menu__logout" href="/logout">Выход</a>
                </div>
            <?php else: ?>
                <div class="user-menu__logged">
                    <p><b>Авторизация</b></p>
                    <a class="user-menu__logout" href="/login">Вход</a>
                </div>
            <?php endif ?>
        </div>
        <div class="site-navigation">
            <ul class="site-navigation-list">
                <li class="nav__item--current"><a href="/main">Список задач</a></li>
                <li class="nav__item--current"><a href="/add">Добавить задачу</a></li>
            </ul>
        </div>
    </nav>
</header>
<main class="container">
    <?php include 'application/views/'.$content_view; ?>
</main>

<script src="/js/popup.js"></script>
</body>
</html>
