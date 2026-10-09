<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id             = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$student_number = trim($_POST['student_number'] ?? '');
$first_name     = trim($_POST['first_name'] ?? '');
$last_name      = trim($_POST['last_name'] ?? '');
$course         = trim($_POST['course'] ?? '');

if (!$id) {
    exit('Invalid student ID.');
}

// Server-side validation
if ($student_number === '' || $first_name === '' || $last_name === '' || $course === '') {
    header('Location: edit.php?id=' . $id . '&error=required');
    exit;
}

try {
    $stmt = $pdo->prepare(
        'UPDATE students
         SET student_number = ?, first_name = ?, last_name = ?, course = ?
         WHERE id = ?'
    );
    $stmt->execute([$student_number, $first_name, $last_name, $course, $id]);
} catch (PDOException $e) {
    if ($e->getCode() === '23000') {
        header('Location: edit.php?id=' . $id . '&error=duplicate');
        exit;
    }
    exit('Could not update the student.');
}

header('Location: index.php');
exit;
