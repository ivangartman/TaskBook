<?php

/**
 *
 * @var array $errors_valid_user Ошибки валидации
 * @var array $login             Данные пользователя
 *
 */
?>

<section class="add_edit_client">

    <form enctype="multipart/form-data" action="/login" method="post">
        <div class="form__item <?= isset($errors_valid_user->first_name) ? 'form__item--invalid' : '' ?>">
            <label for="first_name">Имя пользователя</label>
            <input id="first_name" type="text" name="first_name" placeholder="test" value="<?= isset($login['first_name']) ? $login['first_name'] : '' ?>">
            <span class="form__error"><?= isset($errors_valid_user->first_name) ? $errors_valid_user->first_name : '' ?></span>
        </div>
        <div class="form__item <?= isset($errors_valid_user->password) ? 'form__item--invalid' : '' ?>">
            <label for="password">E-mail</label>
            <input id="password" type="password" name="password" placeholder="Введите пароль" value="<?= isset($login['password']) ? $login['password'] : '' ?>">
            <span class="form__error"><?= isset($errors_valid_user->password) ? $errors_valid_user->password : '' ?></span>
        </div>
        <button type="submit" class="button" name="submit">Войти</button>
    </form>
</section>
