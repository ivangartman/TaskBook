<?php


class controller_login extends controller
{
    function __construct()
    {
        $this->model = new Model_Login();
        $this->view = new View();
    }

	function action_index()
	{
        require_once 'config/init.php';

        if ($user_name) {
            header("Location: /error");
        } else {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $login = $_POST;

                require_once 'application/models/validation_user.php';

                if (count($errors_user)) {
                    $this->view->generate('login_view.php', 'template_view.php', [
                        'user_name'         => $user_name,
                        'title'             => 'Вход в систему',
                        'login'             => $login,
                        'errors_valid_user' => $errors_valid_user,
                    ]);
                } else {
                    header("Location: main");
                }
            } else {
                $this->view->generate('login_view.php', 'template_view.php', [
                    'user_name' => $user_name,
                    'title'     => 'Вход в систему',
                ]);
            }
        }       
    }
}
