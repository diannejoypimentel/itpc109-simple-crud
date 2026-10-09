<?php
require 'db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$stmt = $pdo->prepare('SELECT * FROM students WHERE id = ?');
$stmt->execute([$id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    exit('Student not found.');
}

$error = '';
if (isset($_GET['error'])) {
    $error = $_GET['error'] === 'duplicate'
        ? 'That student number already exists.'
        : 'All fields are required.';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
<h1>Edit Student</h1>

<?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form action="update.php" method="POST">
    <input type="hidden" name="id" value="<?= (int)$student['id'] ?>">
    <p>Student Number:
        <input name="student_number"
               value="<?= htmlspecialchars($student['student_number']) ?>" required>
    </p>
    <p>First Name:
        <input name="first_name"
               value="<?= htmlspecialchars($student['first_name']) ?>" required>
    </p>
    <p>Last Name:
        <input name="last_name"
               value="<?= htmlspecialchars($student['last_name']) ?>" required>
    </p>
    <p>Course:
        <input name="course"
               value="<?= htmlspecialchars($student['course']) ?>" required>
    </p>
    <button type="submit">Update Student</button>
</form>

<p><a href="index.php">Back to Student List</a></p>
</body>
</html>
