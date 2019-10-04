<?php

class controller_logout extends controller
{


	function action_index() {
        
        session_destroy();

        header("Location: main");
        exit();
    }
}
