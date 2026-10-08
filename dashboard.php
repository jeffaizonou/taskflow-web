<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>TaskFlow</title>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">--> 
    <link href="assets/bootstrap.css" rel="stylesheet">
 
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4">Mes tâches</h1>

        <form id="taskForm" class="row g-2 mb-4">
            <div class="col-8">
                <input type="text" id="title" class="form-control" placeholder="Nouvelle tâche" required>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary w-100">Ajouter</button>
            </div>
        </form>

        <ul id="taskList" class="list-group"></ul>
    </div>

    <script src="assets/js/app.js"></script>
</body>
</html>