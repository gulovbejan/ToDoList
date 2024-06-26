<?php

require_once 'connectDb.php';

class DataAccess 
{
    private static function getPdoConnection() 
    {
        // Get the singleton instance of ConnectDb and then get the PDO connection from it.
        return ConnectDb::getInstance()->getConnection();
    }

    public static function getAllList() 
    {
        $pdo = self::getPdoConnection();
        $statement = $pdo->prepare("SELECT * FROM list");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, "toDoList");
    }

    public static function loginAccess($username, $password) 
    {
        $pdo = self::getPdoConnection();
        $statement = $pdo->prepare("SELECT * FROM account WHERE username = ? AND password = ?");
        $statement->execute([$username, $password]);
        return $statement->fetchAll(PDO::FETCH_CLASS, "Account");
    }

    public static function addNewTask($addTask) 
    {
        $pdo = self::getPdoConnection();
        $statement = $pdo->prepare("INSERT INTO list (task, date, start_time, end_time, priority, status) VALUES (?, ?, ?, ?, ?, ?)");
        $statement->execute([$addTask->task, $addTask->date, $addTask->start_time, $addTask->end_time, $addTask->priority, $addTask->status]);
    }

    public static function deleteTask($id, $task, $date, $start_time, $end_time, $priority, $status) {
        $pdo = self::getPdoConnection();
        $statement = $pdo->prepare("DELETE FROM list WHERE id = ?  task = ? AND date = ? AND start_time = ? AND end_time = ? AND priority = ? AND status = ?");
        $statement->execute([$id, $task, $date, $start_time, $end_time, $priority, $status]);
    }
    
    public static function editTask($task) 
    {
        $pdo = self::getPdoConnection();
        $statement = $pdo->prepare("UPDATE list SET task = ?, date = ?, start_time = ?, end_time = ?, priority = ?, status = ? WHERE id = ?");
        $statement->execute([$task->task, $task->date, $task->start_time, $task->end_time, $task->priority, $task->status, $task->id]);
    }

}
