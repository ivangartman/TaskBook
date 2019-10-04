<?php


class controller_error extends controller
{

    function action_index()
    {
        require_once 'config/init.php';

        http_response_code(404);
            $this->view->generate('error_view.php', 'template_view.php', [
                'title'             => 'Ошибка',
                'user_name'         => $user_name,
            ]);
        die;

    }
}
