<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('settings.php'); // Database connection

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Direct access is not allowed.";
    exit();
}

// Debug: Check if data is received
if (empty($_POST)) {
    echo "No data received.";
    exit();
} else {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
}

// Ensure the `eoi` table exists
$query = "CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    JobReference CHAR(5) NOT NULL,
    FirstName VARCHAR(20) NOT NULL,
    LastName VARCHAR(20) NOT NULL,
    DateOfBirth DATE NOT NULL,
    Gender ENUM('Male', 'Female', 'Other') NOT NULL,
    StreetAddress VARCHAR(40) NOT NULL,
    Suburb VARCHAR(40) NOT NULL,
    State ENUM('VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT') NOT NULL,
    Postcode CHAR(4) NOT NULL,
    Email VARCHAR(50) NOT NULL,
    Phone CHAR(12) NOT NULL,
    Skill1 VARCHAR(30),
    Skill2 VARCHAR(30),
    Skill3 VARCHAR(30),
    OtherSkills TEXT,
    Status ENUM('New', 'Current', 'Final') DEFAULT 'New'
)";


if (!$conn->query($query)) {
    die("Error creating table: " . $conn->error);
}

// Sanitize and validate inputs
function sanitize($input) {
    return htmlspecialchars(trim(stripslashes($input)));
}

$jobRef = sanitize($_POST['jobRef']);
$firstname = sanitize($_POST['firstname']);
$lastname = sanitize($_POST['lastname']);
$dob = sanitize($_POST['dob']); // Format: dd/mm/yyyy
$gender = sanitize($_POST['gender']);
$streetAddress = sanitize($_POST['streetAddress']);
$suburb = sanitize($_POST['suburb']);
$state = sanitize($_POST['state']);
$postcode = sanitize($_POST['postcode']);
$email = sanitize($_POST['email']);
$phone = sanitize($_POST['phone']);
$skill1 = isset($_POST['skill1']) ? sanitize($_POST['skill1']) : null;
$skill2 = isset($_POST['skill2']) ? sanitize($_POST['skill2']) : null;
$skill3 = isset($_POST['skill3']) ? sanitize($_POST['skill3']) : null;
$otherSkills = isset($_POST['otherSkills']) ? sanitize($_POST['otherSkills']) : null;

// Validate inputs
$errors = [];
if (!preg_match('/^[a-zA-Z0-9]{5}$/', $jobRef)) {
    $errors[] = "Job Reference Number must be exactly 5 alphanumeric characters.";
}
if (empty($firstname) || strlen($firstname) > 20 || !preg_match('/^[a-zA-Z]+$/', $firstname)) {
    $errors[] = "First Name must be max 20 alphabetic characters.";
}
if (empty($lastname) || strlen($lastname) > 20 || !preg_match('/^[a-zA-Z]+$/', $lastname)) {
    $errors[] = "Last Name must be max 20 alphabetic characters.";
}
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dob)) {
    $errors[] = "Date of Birth must be in dd/mm/yyyy format.";
} else {
    // Convert `yyyy-mm-dd` to `dd/mm/yyyy`
    $dobDate = DateTime::createFromFormat('Y-m-d', $dob);
    if (!$dobDate) {
        $errors[] = "Invalid Date of Birth.";
    } else {
        $formattedDob = $dobDate->format('d/m/Y');
        $age = (int)$dobDate->diff(new DateTime())->y;
        if ($age < 15 || $age > 80) {
            $errors[] = "Age must be between 15 and 80.";
        }
    }
}
if (empty($gender) || !in_array($gender, ['Male', 'Female', 'Other'])) {
    $errors[] = "Gender must be selected.";
}
if (empty($streetAddress) || strlen($streetAddress) > 40) {
    $errors[] = "Street Address must be less than 40 characters.";
}
if (empty($suburb) || strlen($suburb) > 40) {
    $errors[] = "Suburb must be less than 40 characters.";
}
if (!in_array($state, ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'])) {
    $errors[] = "Invalid State.";
}
if (!preg_match('/^\d{4}$/', $postcode)) {
    $errors[] = "Postcode must be 4 digits.";
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid Email Address.";
}
if (!preg_match('/^[0-9 ]{8,12}$/', $phone)) {
    $errors[] = "Phone number must be 8 to 12 digits.";
}
if (empty($otherSkills)) {
    $errors[] = "Other skills cannot be empty.";
}

if (!empty($errors)) {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['submitted_data'] = $_POST; // Retain user inputs for display if needed
    header('Location: apply_fail.php');
    exit();
}


// Debug: Check if query executes correctly
$query = "INSERT INTO eoi (JobReference, FirstName, LastName, DateOfBirth, Gender, StreetAddress, Suburb, State, Postcode, Email, Phone, Skill1, Skill2, Skill3, OtherSkills)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
if (!$stmt) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param('sssssssssssssss', $jobRef, $firstname, $lastname, $dob, $gender, $streetAddress, $suburb, $state, $postcode, $email, $phone, $skill1, $skill2, $skill3, $otherSkills);

if (!$stmt->execute()) {
    die("Error executing statement: " . $stmt->error);
} else {
    $_SESSION['success_data'] = [
        'EOInumber' => $stmt->insert_id,
        'jobRef' => $jobRef,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'dob' => $dob,
        'gender' => $gender,
        'streetAddress' => $streetAddress,
        'suburb' => $suburb,
        'state' => $state,
        'postcode' => $postcode,
        'email' => $email,
        'phone' => $phone,
        'skills' => array_filter([$skill1, $skill2, $skill3]),
        'otherSkills' => $otherSkills,
    ];
    
    header('Location: apply_success.php');
    exit();
}
