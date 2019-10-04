<?php

class controller_edit extends controller
{
    function __construct()
    {
        $this->model = new Model_Edit();
        $this->view = new View();
    }

	function action_index()
	{
        require_once 'config/init.php';

        if ( ! $user_name) {        
            header("Location: /login");
        } else {
            if (isset($_GET['page']) and filter_var(trim($_GET['page']), FILTER_VALIDATE_INT)) {
                $page             = trim($_GET['page']);
                $_SESSION['page'] = $page;
                //Получение данных о задаче по отправленному запросу "page"
                $task_data = $this->model->db_task_id($page);
                if (!$task_data) {
                    header("Location: /error");
                }
                foreach ($task_data as $task_edit) {
                    $task = $task_edit;
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!isset($_SESSION['page'])) {
                    header("Location: /error");
                }
                $page      = $_SESSION['page'];
                $task_data = $this->model->db_task_id($page);
                foreach ($task_data as $task_edit) {
                    $task = $task_edit;
                }
                $task_form  = $_POST;
                $task_new   = [''];
                //Валидация описания задачи
                if (isset($task_form['content']) && empty(trim($task_form['content']))) {
                    $errors_edit = ['content' => 'Введите описание задачи'];
                } elseif (mb_strlen(trim($_POST['content'])) > 50) {
                    $errors_edit = ['content' => 'Введите не более 50 символов'];
                }
                if (count($errors_edit)) {
                    $task = $task_form;
                } else {
                    /*Редактирование аккаунта*/
                    /*Находим в каком поле произведены изменения*/
                    foreach ($names_field as $name) {
                        if ($task[$name] != $task_form[$name]) {
                            $task_new = $this->model->db_edit($page, $name, $task_form[$name]);
                        }
                        if ($task['content'] != $task_form['content']) {
                            $task_new = $this->model->db_edit($page, 'edit_content', '1');
                        }
                    }
                    if ($task_new === ['']) {
                        $message = 'Измените описание задачи или измените статус задачи';
                        $class   = 'modal-show';
                    } else {
                        /*Возврат на предыдущею страницу*/
                        header("Location: main?$backward");
                    }
                }
            } else {
                header("Location: /error");
            }
        }

        $this->view->generate('edit_view.php', 'template_view.php', [
            'title'       => 'Редактирование задачи',
            'user_name'   => $user_name,
            'task'        => $task,
            'message'     => $message,
            'class'       => $class,
            'errors_edit' => $errors_edit,
        ]);
    }
}