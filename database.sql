CREATE DATABASE IF NOT EXISTS task_manager CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE task_manager;

CREATE TABLE IF NOT EXISTS tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  priority ENUM('low', 'medium', 'high') NOT NULL DEFAULT 'medium',
  due_date DATE NULL,
  is_done TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO tasks (title, priority, due_date, is_done) VALUES
('Plan the next project idea', 'high', CURDATE(), 0),
('Review Bootstrap layout on mobile', 'medium', DATE_ADD(CURDATE(), INTERVAL 1 DAY), 0),
('Write README for the project', 'low', NULL, 1);
