<?php
require 'src/Task.php';

$task = new Task();

var_dump($task->create(1, 'Première tâche', '2026-10-10'));
var_dump($task->getByProject(1));