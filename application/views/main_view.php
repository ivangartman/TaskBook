<?php

/**
 *
 * @var array  $tasks            Данные задачи
 * @var string $class            Класс всплывающего окна
 * @var string $message          Сообщение для всплывающего окна
 * @var int    $cur_page         Текущая страница плагинации
 * @var int    $pages_count      Количество страниц плагинации
 * @var array  $pages_pagination Текущая страница плагинации
 * @var string $user_name        Имя пользователя
 * @var array  $theads           Имя пользователя
 * @var string $key              Имя пользователя
 * @var string $sort             Имя пользователя
 * @var string $edit_content     Имя пользователя
 *
 */
?>

<section class="promo">
    <table class="table__list">
        <tr class="table__item table__item--header">
            <?php
            foreach ($theads as $k => $thead) {
                if ($k === $key) {
                    $img   = "../img/$sort.png";
                    $soort = ($sort == 'desc' ? 'asc' : 'desc');
                } else {
                    $img   = "../img/fon.png";
                    $soort = 'asc';
                }
                $get = http_build_query([
                    'key'  => $k,
                    'sort' => $soort,
                ]);
                print "<td class='table__info table__info--{$thead['column']}'><a class='button_info' href=\"main?$get\">{$thead['name']} </a><img src='{$img}' width='12' height='12'></td>";
            }
            ?>
            <td class="table__info table__info--content">
                Описание задачи
            </td>

            <?php if ($user_name): ?>
                <td class="table__info table__info--edit">
                    Параметры
                </td>
            <?php endif ?>
        </tr>
        <?php foreach ($tasks as $task): ?>
            <tr class="table__item">
                <td class="table__info table__info--first_name">
                    <?= htmlspecialchars($task['name']) ?>
                </td>
                <td class="table__info table__info--email">
                    <?= htmlspecialchars($task['email']) ?>
                </td>
                <td class="table__info table__info--status">
                    <?= $task['status'] == 0 ? 'Активна' : 'Выполнено' ?><br>
                    <?= $task['edit_content'] == 0 ? '' : 'Изм. адм.' ?>
                </td>
                <td class="table__info table__info--content">
                    <?= htmlspecialchars($task['content']) ?>
                </td>
                <?php if ($user_name): ?>
                    <td class="table__info table__info--edit">
                        <a class="table_button" href="/edit?page=<?= htmlspecialchars($task['id']) ?>">Изменить</a>
                        <a class="table_button" href="?page_delete=<?= htmlspecialchars($task['id']) ?>">Удалить</a>
                    </td>
                <?php endif ?>
            </tr>
        <?php endforeach ?>
    </table>
</section>
<?php if ($pages_count) : ?>
    <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev <?= ($cur_page == 1) ? 'pagination-item-disabled' : '' ?>">
            <a href="main?page_pagination=<?= ($cur_page - 1 > 0) ? $cur_page - 1 : 1 ?>">Назад</a>
        </li>
        <?php foreach ($pages_pagination as $page): ?>
            <li class="pagination-item <?= ($page == $cur_page) ? 'pagination-item-active' : '' ?> <?= ($pages_count == 1) ? 'pagination-item-disabled' : '' ?>">
                <a href="main?page_pagination=<?= $page ?>"><?= $page ?></a>
            </li>
        <?php endforeach ?>
        <li class="pagination-item pagination-item-next <?= ($cur_page == $pages_count) ? 'pagination-item-disabled' : '' ?>">
            <a href="main?page_pagination=<?= ($cur_page + 1 < $pages_count) ? $cur_page + 1 : $pages_count ?>">Вперед</a>
        </li>
    </ul>
<?php endif ?>
<section class="modal modal-help <?= $class ?>">
    <form enctype="multipart/form-data" class="modal-form" action="/main" method="post" name="theform">
        <div class="modal-massage">
            <p><?= $message ?></p>
        </div>
        <div class="modal-button">
            <button type="submit" class="button button_delete">Удалить</button>
            <button type="button" class="button close"
                    OnClick="history.go(-1);">Отмена
            </button>
        </div>
    </form>
</section>
<div class="modal modal-overlay <?= $class ?>"></div>
