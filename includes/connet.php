<?php
try {
    $pdo  = new PDO('mysql:host=localhost;dbname=cmsg2a', 'root', '');
} catch (PDOException $e) {
    die($e->getMessage());
}