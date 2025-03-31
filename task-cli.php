#!/usr/bin/env php
<?php

require_once 'Task.php';

// add or update or delete or list
$action = isset($argv[1]) ? (string)$argv[1] : ' ';

if ($argv[1] === "add") {
    $taskID = 0;
    $message = isset($argv[2]) ? implode(' ', array_slice($argv, 2)) : '';
    if(empty($message)) {
        echo "Arguments Invalid: Missing task Description\n";
        echo "Expected arguments: task-cli [command] (string)[new description]\n";
        exit(1);

    }

} elseif ($argv[1] === "update") {
    $taskID = isset($argv[2]) ? (int)$argv[2] : 0;
    $message = isset($argv[3]) ? implode(' ', array_slice($argv, 3)) : '';
    if ($taskID === 0 || $message === '' || !isset($message)) {
        echo "Arguments Invalid: Missing task ID or Description\n";
        echo "Expected arguments: task-cli [command] (int)[id] (string)[new description]\n";
        exit(1);
    }

} elseif ($argv[1] === "delete") {
    $taskID = isset($argv[2]) ? (int)$argv[2] : 0;
    $message = ' ';
    if ($taskID === 0) {
        echo "Arguments Invalid: Missing task ID  \n";
        echo "Expected arguments: task-cli [command] (int)[id] (string)[new description]\n";
        exit(1);
    }

} elseif ($argv[1] === "list" && (!isset($argv[2]))) {
    $taskID = 0;
    $message = ' ';

} elseif ($argv[1] === "list" && $argv[2] === 'done') {
    $taskID = 0;
    $message = 'done';

} elseif ($argv[1] === "list" && $argv[2] === 'in-progress') {
    $taskID = 0;
    $message = 'in-progress';

} elseif ($argv[1] === "list" && $argv[2] === 'todo') {
    $taskID = 0;
    $message = 'todo';

} elseif ($argv[1] === "mark-done" ||
    $argv[1] === "mark-in-progress" ||
    $argv[1] === "mark-todo") {

    $taskID = (isset($argv[2])) ? (int)$argv[2] : 0;
    $message = '';
    if ($taskID === 0) {
        echo "Arguments Invalid: Missing task ID  \n";
        echo "Expected arguments: task-cli [command] (int)[id] (string)[new description]\n";
        exit(1);
    }

} else {
    echo "Invalid action.\n";
    exit(1);
}

$task = new Task($action, $taskID, $message);
$task->getAction();