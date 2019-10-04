<?php

/**
 *
 * @var array  $errors_validation Сообщение об ошибке валидации
 * @var string $class             Класс всплывающего окна
 * @var array  $task              Данные задачи
 * @var string $message           Сообщение для всплывающего окна
 *
 */
?>

<section class="add_edit_client">
    <form enctype="multipart/form-data" action="/edit" method="post">
        <div class="form__item">
            <label for="name">Имя пользователя</label>
            <input disabled id="name" type="text" name="name" placeholder="test" value="<?= isset($task['name']) ? $task['name'] : '' ?>">
        </div>
        <div class="form__item">
            <label for="email">E-mail</label>
            <input disabled id="email" type="text" name="email" placeholder="ivanov@mail.ru" value="<?= isset($task['email']) ? $task['email'] : '' ?>">
        </div>
        <div class="form__item form__item--wide <?= count($errors_edit) ? 'form__item--invalid' : '' ?>">
            <label for="content">Описание задачи</label>
            <textarea id="content" name="content" placeholder="Напишите описание задачи"><?= isset($task['content']) ? $task['content'] : '' ?></textarea>
            <span class="form__error"><?= isset($errors_edit) ? $errors_edit['content'] : '' ?></span>
        </div>
        <div class="form__item">
            <label for="status">Статус задачи</label>
            <select id="status" name="status">
                <option value="0">Активна</option>
                <option <?= $task['status'] == 1 ? 'selected' : '' ?> value="1">Выполнено</option>
            </select>
        </div>

        <button type="submit" class="button">Добавить изменения</button>
        <section class="modal modal-help <?= $class ?>">
            <p><?= $message ?></p>
            <button class="modal-close close" type="button">Закрыть</button>
        </section>
        <div class="modal modal-overlay <?= $class ?>"></div>
    </form>
</section>
