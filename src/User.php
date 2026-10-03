<?php
require_once __DIR__ . '/../config/Database.php';

class User
{
    private PDO $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->connect();
    }

    public function register(string $name, string $email, string $password): bool
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare(
            "INSERT INTO users (name, email, password_hash) VALUES (:name, :email, :password_hash)"
        );

        try {
            return $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password_hash' => $hash,
            ]);
        } catch (PDOException $e) {
            // Email déjà utilisé ou autre erreur SQL
            return false;
        }
    }

    public function login(string $email, string $password): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }

        return null;
    }
}