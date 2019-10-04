<?php


class controller_main extends controller
{
    function __construct()
    {
        $this->model = new Model_Main();
        $this->view = new View();
    }

	function action_index()
	{
        require_once 'config/init.php';
        
        if (isset($_GET['page_delete']) and filter_var(trim($_GET['page_delete']), FILTER_VALIDATE_INT)) {
            if (!$user_name) {
                header("Location: /login");
            }
            /*Удаление задачи*/
            $page             = trim($_GET['page_delete']);
            $_SESSION['page'] = $page;
            $tasks            = $this->model->db_task_id($page);
            if (!$tasks) {
                header("Location: /error");
            }
            foreach ($tasks as $task_edit) {
                $task_data = $task_edit;
            }
            $message = "Действительно хотите удалить задачу пользователя:  $task_data[name]";
            $class   = 'modal-show';
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$user_name) {
                header("Location: /login");
            }
            /*Удаление задачи*/
            $page = $_SESSION['page'];
            $this->model->db_task_delete($page);
            /*Возврат на предыдущею страницу*/
            header("Location: main?$backward");
        } else {
                //Сортировка
            if (isset($_GET['key'])) {
                $key              = $_GET['key'];
                $sort             = $_GET['sort'];
                $_SESSION['key']  = $key;
                $_SESSION['sort'] = $sort;
                header("Location: main?$backward");
            }
            if (in_array($key, $key_array) && in_array($sort, $sort_array)) {
                $tasks = $this->model->db_tasks_id();
                require_once 'application/models/pagination.php';//Пагинация
                $tasks = $this->model->db_task_id_page($page_items, $offset, $key, $sort);
                /*Запоминие текущей страницы*/
                $backward             = $_SERVER['QUERY_STRING'];
                $_SESSION['backward'] = $backward;
            }
        }
        
		$this->view->generate('main_view.php', 'template_view.php', [
            'title'            => 'Задачник',
            'user_name'        => $user_name,
            'tasks'            => $tasks,
            'pages_pagination' => $pages_pagination,
            'pages_count'      => $pages_count,
            'cur_page'         => $cur_page,
            'theads'           => $theads,
            'key'              => $key,
            'sort'             => $sort,
            'message'          => $message,
            'class'            => $class,
        ]);
    }
}
