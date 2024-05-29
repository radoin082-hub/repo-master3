<?php

// Database connection
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "project"; // replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data from the AJAX request
$data = json_decode(file_get_contents('php://input'), true);

$theme    = $data['theme'];
$theme_id = $data['theme_id'];

// Prepare the SQL query to delete the item from the database
$stmt = $conn->prepare("DELETE FROM wishsheet WHERE theme = ?");
$stmt->bind_param("s", $theme);

// Execute the delete query
if ($stmt->execute()) {
    echo "Record deleted successfully";

    // Prepare the SQL query to update the state in the topic table
    $stmt2 = $conn->prepare("UPDATE topic SET state = '1' WHERE id = ?");
    $stmt2->bind_param("s", $theme_id);

    // Execute the update query
    if ($stmt2->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt2->error;
    }

    // Close the second statement
    $stmt2->close();
} else {
    echo "Error deleting record: " . $stmt->error;
}

// Close the first statement and the connection
$stmt->close();
$conn->close();
