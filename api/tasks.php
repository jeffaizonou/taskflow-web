<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../src/Task.php';

$task = new Task();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $projectId = (int) ($_GET['project_id'] ?? 0);
    echo json_encode($task->getByProject($projectId));
    exit;
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $ok = $task->create(
        (int) $data['project_id'],
        $data['title'],
        $data['due_date'] ?? null
    );

    echo json_encode(['success' => $ok]);
    exit;
}

if ($method === 'PATCH') {
    $data = json_decode(file_get_contents('php://input'), true);
    $ok = $task->updateStatus((int) $data['id'], $data['status']);
    echo json_encode(['success' => $ok]);
    exit;
}

if ($method === 'DELETE') {
    $id = (int) ($_GET['id'] ?? 0);
    $ok = $task->delete($id);
    echo json_encode(['success' => $ok]);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Méthode non autorisée']);