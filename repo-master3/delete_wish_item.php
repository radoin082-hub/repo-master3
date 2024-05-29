<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data from the AJAX request
$data = json_decode(file_get_contents('php://input'), true);

$theme = $data['theme'];
$professor = $data['professor'];
$description = $data['description'];

// SQL query to delete the item from the database
$sql = "DELETE FROM wishsheet WHERE theme = '$theme' AND professor = '$professor' AND description = '$description'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>