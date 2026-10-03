<?php
require 'src/User.php';

$user = new User();

// Test inscription (à ne lancer qu'une fois, sinon email dupliqué)
$ok = $user->register('Paul', 'paul@test.com', 'motdepasse123');
var_dump($ok);

// Test connexion
$result = $user->login('paul@test.com', 'motdepasse123');
var_dump($result);