<?php
//some header
//namespace
class Task {

    private string $action;
    private int $taskID;
    private string $message;
    private const string FILE_PATH = 'task.json';

    public function __construct(string $action, int $taskID = 0, string $message = '') {
        $this->action = $action;
        $this->taskID = $taskID;
        $this->message = $message;
    }

    private function loadTasks(): array {
        return file_exists(self::FILE_PATH) ? json_decode(file_get_contents(self::FILE_PATH), true) : [];
    }

    private function saveTasks(array $tasks): void {
        file_put_contents(self::FILE_PATH, json_encode($tasks, JSON_PRETTY_PRINT));
    }

    public function displayTask(): array {
        return [
            "action" => $this->action,
            "taskID" => $this->taskID,
            "message" => $this->message
        ];
    }

    public function getAction(): void {
        if ($this->action === "add") {  $this->addTask();
        } elseif ($this->action === "update") { $this->updateTask();
        } elseif ($this->action === "delete") { $this->deleteTask();
        } elseif ($this->action === "mark-done") { $this->markDoneTask();
        } elseif ($this->action === "mark-todo") { $this->markTodoTask();
        } elseif ($this->action === "mark-in-progress") { $this->markInProgressTask();
        } elseif ($this->action === "list" && $this->message === ' ') { $this->listAllTasks();
        } elseif ($this->action === "list" && $this->message === 'done') { $this->listTasksByStatus();
        } elseif ($this->action === "list" && $this->message === 'todo') { $this->listTasksByStatus();
        } elseif ($this->action === "list" && $this->message === 'in-progress') { $this->listTasksByStatus(); }
    }

    public function addTask(): void {
        $tasks = $this->loadTasks();
        $newID = count($tasks) > 0 ? (end($tasks)['id'] + 1) : 1;

        $newTask = [
            "id" => $newID,
            "description" => $this->message,
            "status" => "todo",
            "createdAt" => date("Y-m-d H:i:s"),
            "updatedAt" => date("Y-m-d H:i:s")
        ];
        $tasks[] = $newTask;
        $this->saveTasks($tasks);
        echo "Output: Task added successfully (ID: $newID)\n";
    }

    public function updateTask(): void {
        $tasks = $this->loadTasks();

        $taskFound = false;
        foreach ($tasks as &$task) {
            if ($task['id'] === $this->taskID) {
                $task['description'] = $this->message;
                $task['updatedAt'] = date("Y-m-d H:i:s");
                $this->saveTasks($tasks);
                $taskFound = true;
                break;
            }
        }
        $this->logTaskUpdateDelete($taskFound);
    }

    public function deleteTask(): void {
        $tasks = $this->loadTasks();
        $taskFound = false;

        foreach ($tasks as $key => $task) {
            if ($task['id'] === $this->taskID) {
                unset($tasks[$key]);
                $taskFound = true;
                $this->saveTasks(array_values($tasks));
                break;
            }
        }
        $this->logTaskUpdateDelete($taskFound);
    }

    public function listAllTasks(): void {
        $tasks = $this->loadTasks();

        if (!empty($tasks)) {
            echo "Listing all tasks:\n";
            foreach ($tasks as $task) {
                echo "id: $task[id]\n";
                echo "description: $task[description]\n";
                echo "status: $task[status]\n";
                echo "createdAt: $task[createdAt]\n";
                echo "updatedAt: $task[updatedAt]\n";
                echo "----------------------------------\n";
            }

        } else {
            echo "No tasks found\n";
        }
    }

    public function listTasksByStatus(): void {
        $tasks = $this->loadTasks();

        if (!empty($tasks)) {
            echo "Listing $this->message tasks:\n";
            foreach ($tasks as $task) {
                if ($this->message === $task['status']) {
                    echo "id: $task[id]\n";
                    echo "description: $task[description]\n";
                    echo "status: $task[status]\n";
                    echo "createdAt: $task[createdAt]\n";
                    echo "updatedAt: $task[updatedAt]\n";
                    echo "----------------------------------\n";

                }
            }
        } else {
            echo "No tasks found\n";
        }
    }

    public function markDoneTask(): void {
        $this->message = 'done';
        $tasks = $this->loadTasks();
        $taskFound = false;
        foreach ($tasks as &$task) {
            if ($task['id'] === $this->taskID) {
                $task['status'] = 'done';
                $task['updatedAt'] = date("Y-m-d H:i:s");
                $this->saveTasks($tasks);
                $taskFound = true;
                break;
            }
        }
        $this->logMarkTask($taskFound);
    }

    public function markInProgressTask(): void {
        $this->message = 'in-progress';
        $tasks = $this->loadTasks();
        $taskFound = false;
        foreach ($tasks as &$task) {
            if ($task['id'] === $this->taskID) {
                $task['status'] = 'in-progress';
                $task['updatedAt'] = date("Y-m-d H:i:s");
                $this->saveTasks($tasks);
                $taskFound = true;
                break;
            }
        }
        $this->logMarkTask($taskFound);
    }

    public function markTodoTask(): void {
        $this->message = 'todo';
        $tasks = $this->loadTasks();
        $taskFound = false;
        foreach ($tasks as &$task) {
            if ($task['id'] === $this->taskID) {
                $task['status'] = 'todo';
                $task['updatedAt'] = date("Y-m-d H:i:s");
                $this->saveTasks($tasks);
                $taskFound = true;
                break;
            }
        }
        $this->logMarkTask($taskFound);
    }

    private function logMarkTask(bool $taskFound):void {
        if ($taskFound) {
            echo "Output: Task marked $this->message with successfully (ID: $this->taskID)\n";
        } else {
            echo "Task with ID: $this->taskID not found\n";
        }
    }
    private function logTaskUpdateDelete(bool $taskFound):void {
        if ($taskFound) {
            echo "Output: Task $this->action successfully (ID: $this->taskID)\n";
        } else {
            echo "Task with ID: $this->taskID not found\n";
        }
    }
}