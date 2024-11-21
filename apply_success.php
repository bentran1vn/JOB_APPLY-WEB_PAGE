<?php
session_start();
if (!isset($_SESSION['success_data'])) {
    echo "No data to display.";
    exit();
}

$data = $_SESSION['success_data'];
unset($_SESSION['success_data']); // Clear session data after use
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Submitted</title>
    <link rel="stylesheet" href="styles/normalize.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <main class="main-content">
        <div class="success-message">
            <h1>Application Submitted Successfully</h1>
            <p>Thank you for your submission!</p>
            <ul>
                <li><strong>EOI Number:</strong> <?php echo htmlspecialchars($data['EOInumber']); ?></li>
                <li><strong>Job Reference:</strong> <?php echo htmlspecialchars($data['jobRef']); ?></li>
                <li><strong>First Name:</strong> <?php echo htmlspecialchars($data['firstname']); ?></li>
                <li><strong>Last Name:</strong> <?php echo htmlspecialchars($data['lastname']); ?></li>
                <li><strong>Date of Birth:</strong> <?php echo htmlspecialchars($data['dob']); ?></li>
                <li><strong>Gender:</strong> <?php echo htmlspecialchars($data['gender']); ?></li>
                <li><strong>Street Address:</strong> <?php echo htmlspecialchars($data['streetAddress']); ?></li>
                <li><strong>Suburb:</strong> <?php echo htmlspecialchars($data['suburb']); ?></li>
                <li><strong>State:</strong> <?php echo htmlspecialchars($data['state']); ?></li>
                <li><strong>Postcode:</strong> <?php echo htmlspecialchars($data['postcode']); ?></li>
                <li><strong>Email:</strong> <?php echo htmlspecialchars($data['email']); ?></li>
                <li><strong>Phone:</strong> <?php echo htmlspecialchars($data['phone']); ?></li>
                <li><strong>Skills:</strong> <?php echo htmlspecialchars(implode(', ', $data['skills'])); ?></li>
                <li><strong>Other Skills:</strong> <?php echo htmlspecialchars($data['otherSkills']); ?></li>
            </ul>
            <a href="apply.php">Submit Another Application</a>
        </div>
    </main>
</body>
</html>
