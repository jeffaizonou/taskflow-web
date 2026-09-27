<?php
require 'config/Database.php';

$db = new Database();
$pdo = $db->connect();

$stmt = $pdo->query("SHOW TABLES");
print_r($stmt->fetchAll());