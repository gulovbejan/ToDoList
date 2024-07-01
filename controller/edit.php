<?php

require_once "../model/account.php";
require_once "../model/todolist.php";
require_once "../model/dataAccess.php";

session_start();

// Handle editing a Task
if (isset($_REQUEST["id"]) && isset($_REQUEST["task"]) && isset($_REQUEST["date"]) && isset($_REQUEST["start_time"]) &&
    isset($_REQUEST["end_time"]) && isset($_REQUEST["priority"]) && isset($_REQUEST["status"])) {  

    // Create a new instance of the EditTask class or stdClass
    $edit = new stdClass(); // Assuming you're using stdClass for simplicity
    // $edit = new EditTask(); // If you have a specific class for edit tasks

    // Assign values to the object properties
    $edit->id = $_REQUEST["id"];
    $edit->task = $_REQUEST["task"];
    $edit->date = $_REQUEST["date"];
    $edit->start_time = $_REQUEST["start_time"];
    $edit->end_time = $_REQUEST["end_time"];
    $edit->priority = $_REQUEST["priority"];
    $edit->status = $_REQUEST["status"];
    
    // Call the static method to edit task in DataAccess
    DataAccess::editTask($edit);

    header("Location: ../view/index_view.php");
    exit;
}
