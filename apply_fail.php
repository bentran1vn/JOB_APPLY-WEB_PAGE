<?php
session_start();
if (!isset($_SESSION['form_errors'])) {
    header('Location: apply.php');
    exit();
}

$errors = $_SESSION['form_errors'];
$submittedData = $_SESSION['submitted_data'] ?? [];
unset($_SESSION['form_errors'], $_SESSION['submitted_data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Failed</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <main class="main-content">
        <div class="fail-container">
            <h1>Application Submission Failed</h1>
            <p>Please review the errors below and try again:</p>
            <ul class="error-list">
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="apply.php" class="back-link">Go Back to Application Form</a>
        </div>
    </main>
</body>
</html>
