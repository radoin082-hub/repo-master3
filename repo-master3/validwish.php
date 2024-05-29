<?php
print_r($_POST);
if (!isset($_POST['student_email'], $_POST['theme_id'])) {
    echo 'Error: student_email or theme_id not set in POST data';
    exit;
}

$studentId = $_POST['student_email'];
$title_id = $_POST['theme_id'];

// Database connection setup (adjust these values as necessary)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to insert the student ID into the database
$stmt = $conn->prepare("INSERT INTO assamentstudent (student_email, title_id) VALUES (?, ?)");
$stmt->bind_param("ss", $studentId, $title_id);
$result  = $stmt->execute();

if ($result) {
    echo 'success';
} else {
    echo 'Error: ' . $result . '<br>' . $conn->error;
}

// Close connection
$conn->close();
?>