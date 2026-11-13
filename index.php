<?php
require 'config.php';
$filter = $_GET['filter'] ?? 'all';
$search = trim($_GET['search'] ?? '');

$sql = "SELECT * FROM tasks WHERE 1=1";
$params = [];

if ($filter === 'active') {
    $sql .= " AND is_done = 0";
} elseif ($filter === 'completed') {
    $sql .= " AND is_done = 1";
}

if ($search !== '') {
    $sql .= " AND title LIKE ?";
    $params[] = '%' . $search . '%';
}

$sql .= " ORDER BY is_done ASC, FIELD(priority, 'high', 'medium', 'low'), due_date ASC, created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$tasks = $stmt->fetchAll();

function priorityBadge($priority) {
    if ($priority === 'high') return 'danger';
    if ($priority === 'medium') return 'warning';
    return 'success';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>TaskFlow - Simple Task Manager</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="text-center mb-4">
        <h1 class="fw-bold">TaskFlow</h1>
        <p class="text-muted">A simple task manager built with PHP, MySQL and Bootstrap</p>
      </div>

      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <form action="add_task.php" method="POST" class="row g-2">
            <div class="col-md-6">
              <input type="text" name="title" class="form-control" placeholder="Add a new task" required maxlength="255">
            </div>
            <div class="col-md-2">
              <select name="priority" class="form-select">
                <option value="low">Low</option>
                <option value="medium" selected>Medium</option>
                <option value="high">High</option>
              </select>
            </div>
            <div class="col-md-2">
              <input type="date" name="due_date" class="form-control">
            </div>
            <div class="col-md-2 d-grid">
              <button type="submit" class="btn btn-primary">Add Task</button>
            </div>
          </form>
        </div>
      </div>

      <form method="GET" class="row g-2 mb-3">
        <div class="col-md-8">
          <input type="search" name="search" value="<?php echo htmlspecialchars($search); ?>" class="form-control" placeholder="Search tasks">
        </div>
        <div class="col-md-4">
          <div class="btn-group w-100" role="group">
            <a href="?filter=all" class="btn btn-outline-primary <?php echo $filter === 'all' ? 'active' : ''; ?>">All</a>
            <a href="?filter=active" class="btn btn-outline-primary <?php echo $filter === 'active' ? 'active' : ''; ?>">Active</a>
            <a href="?filter=completed" class="btn btn-outline-primary <?php echo $filter === 'completed' ? 'active' : ''; ?>">Completed</a>
          </div>
        </div>
      </form>

      <?php if (empty($tasks)): ?>
        <div class="alert alert-info text-center">No tasks found. Add your first task above.</div>
      <?php else: ?>
        <ul class="list-group shadow-sm" id="taskList">
          <?php foreach ($tasks as $task): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center task-item <?php echo $task['is_done'] ? 'done' : ''; ?>">
              <div>
                <span class="task-title"><?php echo htmlspecialchars($task['title']); ?></span>
                <div class="small text-muted">
                  <span class="badge bg-<?php echo priorityBadge($task['priority']); ?>"><?php echo htmlspecialchars($task['priority']); ?></span>
                  <?php if ($task['due_date']): ?> Due: <?php echo htmlspecialchars($task['due_date']); ?><?php endif; ?>
                  <?php if ($task['is_done']): ?> Completed <?php endif; ?>
                </div>
              </div>
              <div class="btn-group">
                <a href="toggle_task.php?id=<?php echo (int)$task['id']; ?>" class="btn btn-sm btn-outline-success"><?php echo $task['is_done'] ? 'Undo' : 'Done'; ?></a>
                <a href="delete_task.php?id=<?php echo (int)$task['id']; ?>" class="btn btn-sm btn-outline-danger delete-btn">Delete</a>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>

      <p class="text-center text-muted small mt-4">Built with HTML, CSS, JavaScript, Bootstrap, MySQL and PHP</p>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>
