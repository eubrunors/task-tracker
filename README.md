# TODO Task Tracker CLI - PHP Application

This is a simple command-line interface (CLI) application written in PHP for managing tasks.
It allows users to create, view, update, and delete tasks, as well as manage their task list through a local JSON file.
This README provides detailed information on how to install, configure, and use the application, along with its full set of functionalities.

### Getting Started

These instructions will help you set up and run the Task Tracker CLI on your local machine.

#### Prerequisites

- PHP (7.x or higher)
- Bash shell (for alias setup)

#### Project Initialization

1. Clone the repository to your local machine:

```bash
git clone <repository-url>
```

2. Navigate to the project directory.

```bash
cd task-tracker-cli
```

3. Run the script:

```bash
./install.sh
```

- The script will do the following:

	- Will check if an alias already exists `task-cli` in the file `~/.bashrc`
	- If the alias does not exist, the script will automatically add it and ensure that the file `task-cli.php` has execute permission.
	- It will then display a message that the setup is complete and prompt you to run the command source `~/.bashrc` to load the alias in the terminal.

4. To activate the alias in your terminal, run the following command:

```bash
source ~/.bashrc
```

5. Now to can use the command task-cli directly in the terminal.
     - Example
	```bash
		task-cli add "Buy groceries"
	```

#### Commands 

```bash
# Adding a new task
task-cli add "Buy groceries"
# Output: Task added successfully (ID: 1)

# Updating and deleting tasks
task-cli update 1 "Buy groceries and cook dinner"
task-cli delete 1

# Marking a task as in progress or done
task-cli mark-in-progress 1
task-cli mark-done 1

# Listing all tasks
task-cli list

# Listing tasks by status
task-cli list done
task-cli list todo
task-cli list in-progress

```

#### Features:

- **Add a new task**: Add tasks to your list.
- **List all tasks**: View all tasks with their details.
- **List tasks by status**: View tasks with selected status.
- **Mark a task as completed**: Set a task's status to completed.
- **Delete a task**: Remove a task from the list.
- **Update a task**: Edit the description of an existing task.

#### Task Properties

`id`: A unique identifier for the task
`description`: A short description of the task
`status`: The status of the task (todo, in-progress, done)
`createdAt`: The date and time when the task was created
`updatedAt`: The date and time when the task was last updated

