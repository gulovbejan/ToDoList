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

    public static function deleteTask($task, $date, $start_time, $end_time, $priority, $status) {
        $pdo = self::getPdoConnection();
        $statement = $pdo->prepare("DELETE FROM list WHERE task = ? AND date = ? AND start_time = ? AND end_time = ? AND priority = ? AND status = ?");
        $statement->execute([$task, $date, $start_time, $end_time, $priority, $status]);
    }
    

}
