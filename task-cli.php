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

} else {
    var_dump($argv[1],$argv[2],$argv[3]);
    echo "Invalid action.\n";
    exit;
}



print_r((new Task($action, $taskID, $message))
	-> displayTask());


// Instancia a classe Task e executa a ação
$task = new Task($action, $taskID, $message);
$task->getAction();