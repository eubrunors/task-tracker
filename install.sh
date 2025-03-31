#!/bin/bash

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "PHP is not installed. Please install PHP to proceed."
    exit 1
fi

if ! grep -q "alias task-cli=" ~/.bashrc; then
    echo "Adding alias to ~/.bashrc"
    echo "alias task-cli='$(pwd)/task-cli.php'" >> ~/.bashrc
    echo "Alias added, please run: 'source ~/.bashrc' "
    echo "And then use 'task-cli' to run app."

    # Garante que o script task-cli.php tenha permissão de execução
    chmod +x task-cli.php

    echo "Permissions set, you can now use 'task-cli'."
    echo "Please run: 'source ~/.bashrc' if you haven't already."
else 
    echo "Alias already exists in ~/.bashrc"
fi

