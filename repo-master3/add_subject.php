<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Check if the form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $title = $_POST['title'];
    $professeur = $_POST['professeur'];
    $resume = $_POST['resume'];
    $speciality = $_POST['speciality']; 

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $sql = "INSERT INTO topic (title, resume, professeur, speciality) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $title, $resume, $professeur, $speciality);

    // Execute SQL statement
    if ($stmt->execute() === TRUE) {
        // Get the ID of the inserted row
        $last_id = $conn->insert_id;
        // Prepare the response data
        $responseData = array(
            'id' => $last_id,
            'title' => $title,
            'professeur' => $professeur,
            'resume' => $resume,
            'speciality'=> $speciality
        );
        // Convert the response data to JSON format
        $jsonResponse = json_encode($responseData);
        // Return the JSON response
        echo $jsonResponse;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();
} else {
    echo "No data received.";
}