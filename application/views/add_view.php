<?php

/**
 *
 * @var array $errors_validation Сообщение об ошибке валидации
 * @var array $task Данные задачи
 *
 */
?>

<section class="add_edit_client">
    <form enctype="multipart/form-data" action="/add" method="post">
        <div class="form__item <?= isset($errors_validation->name) ? 'form__item--invalid' : '' ?>">
            <label for="name">Имя пользователя</label>
            <input id="name" type="text" name="name" placeholder="test" value="<?= isset($task['name']) ? $task['name'] : '' ?>">
            <span class="form__error"><?= isset($errors_validation->name) ? $errors_validation->name : '' ?></span>
        </div>
        <div class="form__item <?= isset($errors_validation->email) ? 'form__item--invalid' : '' ?>">
            <label for="email">E-mail</label>
            <input id="email" type="text" name="email" placeholder="ivanov@mail.ru" value="<?= isset($task['email']) ? $task['email'] : '' ?>">
            <span class="form__error"><?= isset($errors_validation->email) ? $errors_validation->email : '' ?></span>
        </div>
        <div class="form__item form__item--wide <?= isset($errors_validation->content) ? 'form__item--invalid' : '' ?>">
            <label for="message">Описание задачи</label>
            <textarea id="message" name="content" placeholder="Напишите описание задачи"><?= isset($task['content']) ? $task['content'] : '' ?></textarea>
            <span class="form__error"><?= isset($errors_validation->content) ? $errors_validation->content : '' ?></span>
        </div>
        <button type="submit" class="button">Добавить</button>
        <section class="modal modal-help <?= $class ?>">
            <p><?= $message ?></p>
            <button class="modal-close close" type="button">Закрыть</button>
        </section>
        <div class="modal modal-overlay <?= $class ?>"></div>
    </form>
</section>
