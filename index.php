<?php
// نجلب المهام من الـ backend
require_once "../backend/config/database.php";
require_once "../backend/controllers/TodoController.php";

$todo = new TodoController($pdo);
$tasks = $todo->all();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todolist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Todolist</a>
        </div>
    </nav>

    <div class="container mt-4">

        <!-- Formulaire d'ajout -->
        <form action="../backend/actions/handle.php" method="POST" class="mb-4">
            <div class="row">
                <div class="col-md-8">
                    <input type="text" name="title" class="form-control" placeholder="Task Title" required>
                </div>
                <div class="col-md-4">
                    <button type="submit" name="action" value="new" class="btn btn-primary w-100">Add</button>
                </div>
            </div>
        </form>

        <!-- Liste des tâches -->
        <div class="list-group">
            <?php foreach ($tasks as $tache): ?>
                <div class="list-group-item <?= $tache['done'] ? 'list-group-item-success' : 'list-group-item-warning' ?>">
                    <div class="d-flex justify-content-between align-items-center">
                        
                        <!-- Task title -->
                        <span><?= htmlspecialchars($tache['title']) ?></span>

                        <!-- Buttons -->
                        <form action="../backend/actions/handle.php" method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?= $tache['id'] ?>">

                            <button type="submit" name="action" value="toggle" 
                                    class="btn btn-sm <?= $tache['done'] ? 'btn-warning' : 'btn-success' ?>">
                                <?= $tache['done'] ? 'Undo' : 'Done' ?>
                            </button>

                            <button type="submit" name="action" value="delete" class="btn btn-sm btn-danger">
                                X
                            </button>
                        </form>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>