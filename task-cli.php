<?php

require_once 'Task.php';

// add or update or delete or list
$action = isset($argv[1]) ? (string)$argv[1] : ' ';

if ($argv[1] === "add") {
    $taskID = 0;
    $message = isset($argv[2]) ? implode(' ', array_slice($argv, 2)) : '';

} elseif ($argv[1] === "update") {
    $taskID = isset($argv[2]) ? (int)$argv[2] : 0;
    $message = isset($argv[3]) ? implode(' ', array_slice($argv, 3)) : '';

} elseif ($argv[1] === "delete") {
    $taskID = isset($argv[2]) ? (int)$argv[2] : 0;
    $message = ' ';

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

} elseif ($argv[1] === "mark-done") {
    $taskID = (isset($argv[2])) ? (int)$argv[2] : 0;
    $message = 'done';

} elseif ($argv[1] === "mark-in-progress") {
    $taskID = (isset($argv[2])) ? (int)$argv[2] : 0;
    $message = 'in progress';

} elseif ($argv[1] === "mark-todo") {
    $taskID = (isset($argv[2])) ? (int)$argv[2] : 0;
    $message = 'todo';

} else {
    echo "Invalid action.\n";
    exit;
}

$task = new Task($action, $taskID, $message);
$task->getAction();