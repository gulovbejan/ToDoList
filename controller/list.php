<?php

require_once "../model/todolist.php";
require_once "../model/dataAccess.php";

if (session_status() == PHP_SESSION_NONE) 
{
    session_start();
}





// V
require_once "../view/index_view.php";

