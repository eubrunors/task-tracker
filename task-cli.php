<?php

    require_once 'Task.php';

    // add or update or delete or list
    $action = isset($argv[1]) ? (string)$argv[1] : ' ';

    if ($argv[1]==="add"){
        $taskID = 0;
        $message = isset($argv[2]) ? implode(' ',array_slice($argv,2)) : '';

    } elseif ($argv[1] === "update"){
        $taskID = isset($argv[2]) ?  (int)$argv[2] : 0;
        $message = isset($argv[3]) ? implode(' ',array_slice($argv,3)) : '';

    } elseif ($argv[1] === "delete") {
        $taskID = isset($argv[2]) ? (int)$argv[2] : 0;
        $message = null;
    }elseif ($argv[1] === "list"){
        $taskID = 0;
        $message = ' ';
    }else{
        echo "Invalid action.\n";
        exit;
    }

    $task = new Task($action, $taskID, $message);
    $task->getAction();