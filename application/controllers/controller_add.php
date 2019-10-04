<?php


class controller_add extends controller
{
    function __construct()
    {
        $this->model = new Model_Add();
        $this->view = new View();
    }


    function action_index()
    {

        require_once 'config/init.php';

        if ($add) {
            $message              = 'Новая задача успешно добавлена';
            $class                = 'modal-show';
            $_SESSION['add'] = 0;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = $_POST;
            require_once 'application/models/validation_task.php';
            if (count($errors)) {
                $this->view->generate('add_view.php', 'template_view.php', [
                    'title'             => 'Добавление новой задачи',
                    'user_name'         => $user_name,
                    'task'              => $task,
                    'errors_validation' => $errors_validation,
                ]);
            } else {
                //Добавление новой записи в таблицу tasks в MySQL
                $data = [
                    trim($task['name']),
                    trim($task['email']),
                    trim($task['content']),
                ];
                $res  = $this->model->db_insert($data);
                if ($res) {
                    $_SESSION['add'] = 1;
                    header("Location: /add");
                } else {
                    header("Location: /error");
                }
            }
        } else {
            $this->view->generate('add_view.php', 'template_view.php', [
                'title'             => 'Добавление новой задачи',
                'user_name'         => $user_name,
                'tasks'             => $tasks,
                'errors_validation' => $errors_validation,
                'message'           => $message,
                'class'             => $class
            ]);
        }

    }
}