<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $priority = $_POST['priority'] ?? 'medium';
    $due_date = $_POST['due_date'] ?? null;

    if (!in_array($priority, ['low', 'medium', 'high'], true)) {
        $priority = 'medium';
    }
    if ($due_date === '') {
        $due_date = null;
    }

    if ($title !== '') {
        $stmt = $pdo->prepare("INSERT INTO tasks (title, priority, due_date) VALUES (?, ?, ?)");
        $stmt->execute([$title, $priority, $due_date]);
    }
}

header('Location: index.php');
exit;
