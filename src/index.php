<?php
require 'db.php';

$stmt = $pdo->query('SELECT * FROM students ORDER BY id DESC');
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
</head>
<body>
<h1>Student Records</h1>

<p><a href="create.php">Add New Student</a></p>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Student Number</th>
        <th>Name</th>
        <th>Course</th>
        <th>Action</th>
    </tr>
    <?php foreach ($students as $student): ?>
    <tr>
        <td><?= htmlspecialchars($student['id']) ?></td>
        <td><?= htmlspecialchars($student['student_number']) ?></td>
        <td><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></td>
        <td><?= htmlspecialchars($student['course']) ?></td>
        <td>
            <a href="edit.php?id=<?= (int)$student['id'] ?>">Edit</a>
            |
            <a href="delete.php?id=<?= (int)$student['id'] ?>"
               onclick="return confirm('Delete this record?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
