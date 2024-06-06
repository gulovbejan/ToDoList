<?php
class toDoList 
{
  private $id;
  private $task;
  private $date;
  private $start_time;
  private $end_time;
  private $priority;
  private $status;


  function __get($name) 
  {
    return $this->$name;
  }

  function __set($name,$value) 
  {
    $this->$name = $value;
  }
}



