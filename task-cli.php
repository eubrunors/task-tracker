<?php

require_once 'Task.php';

// add or update or delete or list
$action = isset($argv[1]) ? (string)$argv[1] : ' ';

if ($argv[1]==="add"){
    $taskID = 0;
    $message = isset($argv[2]) ? implode(' ',array_slice($argv,2)) : '';
}


print_r((new Task($action, $taskID, $message))
	-> displayTask());


// Instancia a classe Task e executa a ação
$task = new Task($action, $taskID, $message);
$task->getAction();