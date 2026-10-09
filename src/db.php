<?php
$host = 'db';
$db   = 'student_db';
$user = 'student_user';
$pass = 'student_pass';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    exit("Database connection failed.");
}
