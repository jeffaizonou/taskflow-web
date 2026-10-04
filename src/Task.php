<?php
require_once __DIR__ . '/../config/Database.php';

class Task
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->connect();
    }

    public function getByProject(int $projectId): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE project_id = :project_id ORDER BY id DESC");
        $stmt->execute([':project_id' => $projectId]);
        return $stmt->fetchAll();
    }

    public function create(int $projectId, string $title, ?string $dueDate = null): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO tasks (project_id, title, due_date) VALUES (:project_id, :title, :due_date)"
        );
        return $stmt->execute([
            ':project_id' => $projectId,
            ':title' => $title,
            ':due_date' => $dueDate,
        ]);
    }

    public function updateStatus(int $taskId, string $status): bool
    {
        $stmt = $this->pdo->prepare("UPDATE tasks SET status = :status WHERE id = :id");
        return $stmt->execute([':status' => $status, ':id' => $taskId]);
    }

    public function delete(int $taskId): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id");
        return $stmt->execute([':id' => $taskId]);
    }
}