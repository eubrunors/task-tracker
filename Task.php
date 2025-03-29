<?php
//some header
//namespace
class Task{

    private $action;
    private $taskID;
    private $message;
    private $file = 'task.json';

    public function __construct(string $action, int $taskID = 0, string $message = ''){
        $this->action = $action;
        $this->taskID = $taskID;
        $this->message = $message;
    }

    public function displayTask(){
        return[
            "action" => $this->action,
            "taskID" => $this->taskID,
            "message" => $this->message
        ];
    }

    public function getAction(){
        if( $this -> action === "add"){
            $this->addTask();
        }
//        elseif ( $action == "delete"){
//            // do something
//        }elseif ( $action == "update"){
//            // do something
//        }elseif ( $action == "list"){
//            // do something
//        }
        else{
            echo "error: action not known";
        }
    }

    public function addTask(){
        $tasks = file_exists($this->file) ? json_decode(file_get_contents($this->file), true) : [];

        $newID = count($tasks) > 0 ? (end($tasks)['id']+1) : 1;

        $newTask = [
            "id" => $newID,
            "description" => $this->message,
            "status" => "todo",
            "createdAt" => date("Y-m-d H:i:s"),
            "updatedAt" => date("Y-m-d H:i:s")
        ];

        $tasks[] = $newTask;

        file_put_contents($this->file, json_encode($tasks, JSON_PRETTY_PRINT));

        echo "Output: Task added successfully (ID: $newID)\n";
    }

}