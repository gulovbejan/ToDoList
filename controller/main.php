<?php
error_reporting(-1);
require_once "../model/account.php";
require_once "../model/todolist.php";
require_once "../model/dataAccess.php";

session_start();

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Attempt login
    $user = DataAccess::loginAccess($username, $password);

    if (!empty($user)) {
        $_SESSION['userLogIn'] = $user[0];
        header("Location: ../view/index_view.php");
        exit;
    } else {
        $_SESSION['error'] = "Invalid username or password";
        header("Location: ../view/login_view.php");
        exit;
    }
}

// Ensure the user is logged in for the following actions
if (!isset($_SESSION['userLogIn'])) {
    header("Location: ../view/login_view.php");
    exit;
}

// Handle adding a new task
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['delete_task']) && isset($_SESSION['userLogIn'])) {
    if (isset($_POST["task"]) && isset($_POST["date"]) && isset($_POST["start_time"]) && isset($_POST["end_time"]) && isset($_POST["priority"]) && isset($_POST["status"])) {
        $addNewTask = new toDoList();
        $addNewTask->task = $_POST["task"];
        $addNewTask->date = $_POST["date"];
        $addNewTask->start_time = $_POST["start_time"];
        $addNewTask->end_time = $_POST["end_time"];
        $addNewTask->priority = $_POST["priority"];
        $addNewTask->status = $_POST["status"];

        DataAccess::addNewTask($addNewTask);

        header("Location: ../view/index_view.php");
        exit;
    }
}

// Handle deleting a task
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_task'])) {
    $requiredFields = ['id', 'task', 'date', 'start_time', 'end_time', 'priority', 'status'];
    $missingFields = [];
    
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $missingFields[] = $field;
        }
    }

    if (count($missingFields) == 0) {
        DataAccess::deleteTask($_POST["id"], $_POST["task"], $_POST["date"], $_POST["start_time"], $_POST["end_time"], $_POST["priority"], $_POST["status"]);
        header("Location: ../view/index_view.php");
        exit;
    } else {
        echo "Missing data for: " . implode(', ', $missingFields);
    }
}



// Handle editing a Task
if (isset($_REQUEST["id"]) && isset($_REQUEST["task"]) && isset($_REQUEST["date"]) && isset($_REQUEST["start_time"]) &&
isset($_REQUEST["end_time"]) && isset($_REQUEST["priority"]) && isset($_REQUEST["status"])) {  
    $id = $_REQUEST["id"];
    $task = $_REQUEST["task"];
    $date = $_REQUEST["date"];
    $start_time = $_REQUEST["start_time"];
    $end_time = $_REQUEST["end_time"];
    $priority = $_REQUEST["priority"];
    $status = $_REQUEST["status"];

    $edit->id = $id;
    $edit->task = $task;
    $edit->date = $date;
    $edit->start_time = $start_time;
    $edit->end_time = $end_time;
    $edit->priority = $priority;
    $edit->status = $status;
    
    DataAccess::editTask($edit);

    header("Location: ../view/index_view.php");
    exit;
}

?>
