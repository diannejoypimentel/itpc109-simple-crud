<?php
require 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_number = trim($_POST['student_number'] ?? '');
    $first_name     = trim($_POST['first_name'] ?? '');
    $last_name      = trim($_POST['last_name'] ?? '');
    $course         = trim($_POST['course'] ?? '');

    // Server-side validation
    if ($student_number === '' || $first_name === '' || $last_name === '' || $course === '') {
        $error = 'All fields are required.';
    } else {
        try {
            $stmt = $pdo->prepare(
                'INSERT INTO students (student_number, first_name, last_name, course)
                 VALUES (?, ?, ?, ?)'
            );
            $stmt->execute([$student_number, $first_name, $last_name, $course]);
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            $error = ($e->getCode() === '23000')
                ? 'That student number already exists.'
                : 'Could not save the student.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>
<h1>Add Student</h1>

<?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">
    <p>Student Number:
        <input name="student_number" required
               value="<?= htmlspecialchars($_POST['student_number'] ?? '') ?>">
    </p>
    <p>First Name:
        <input name="first_name" required
               value="<?= htmlspecialchars($_POST['first_name'] ?? '') ?>">
    </p>
    <p>Last Name:
        <input name="last_name" required
               value="<?= htmlspecialchars($_POST['last_name'] ?? '') ?>">
    </p>
    <p>Course:
        <input name="course" required
               value="<?= htmlspecialchars($_POST['course'] ?? '') ?>">
    </p>
    <button type="submit">Save Student</button>
</form>

<p><a href="index.php">Back to Student List</a></p>
</body>
</html>
