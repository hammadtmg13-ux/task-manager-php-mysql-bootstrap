# TaskFlow - Simple Task Manager

A simple task manager built with HTML, CSS, JavaScript, Bootstrap, MySQL and PHP.

## Features
- Add a task with title, priority and due date
- Mark tasks as done or not done
- Delete tasks
- Filter tasks by All, Active and Completed
- Search tasks
- Clean Bootstrap 5 interface with custom CSS and JavaScript

## Tech stack
- HTML and CSS
- JavaScript
- Bootstrap 5
- PHP with PDO
- MySQL

## Setup
1. Create the database and table using `database.sql`:
```sql
mysql -u root -p < database.sql
```
2. Update the database details in `config.php` if needed.
3. Copy the project folder to your web server, for example `htdocs` for XAMPP.
4. Open `http://localhost/task-manager-php-mysql/` in your browser.

## Database
Database name: `task_manager`
Table: `tasks`
- id: INT, auto increment, primary key
- title: VARCHAR(255)
- priority: ENUM low, medium, high
- due_date: DATE, nullable
- is_done: TINYINT, default 0
- created_at: TIMESTAMP, default current timestamp

## Project structure
- `index.php` - main page and task list
- `config.php` - MySQL connection with PDO
- `add_task.php` - handles new tasks
- `toggle_task.php` - marks a task done or not done
- `delete_task.php` - deletes a task
- `database.sql` - database and table setup
- `assets/css/style.css` - custom styles
- `assets/js/script.js` - filters, search and confirm delete

## Author
Built by Hammad
