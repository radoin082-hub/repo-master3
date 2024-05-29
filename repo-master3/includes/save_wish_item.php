<?php
session_start();
require_once('../config/db.php');

$data = json_decode(file_get_contents('php://input'), true);

try {
    // Get the current priority from the database
    $sql_priority = "SELECT MAX(priority) AS max_priority FROM wishsheet WHERE email = ?";
    $stmt_priority = mysqli_stmt_init($conn);
    $user_loggin_email = $_SESSION["email"];

    // Check if statement initialization was successful
    if ($stmt_priority && mysqli_stmt_prepare($stmt_priority, $sql_priority)) {
        mysqli_stmt_bind_param($stmt_priority, "s", $user_loggin_email);
        mysqli_stmt_execute($stmt_priority);
        $result_priority = mysqli_stmt_get_result($stmt_priority);
        $row_priority = mysqli_fetch_assoc($result_priority);
        $priority = ($row_priority['max_priority'] !== null) ? $row_priority['max_priority'] + 1 : 1; // Increment the priority by 1 or set to 1 if no existing records
    } else {
        throw new Exception("Error preparing SQL statement for getting max priority.");
    }

    // Prepare the SQL statement for new record insertion
    $sql_insert = "INSERT INTO wishsheet (theme, professor, description, priority, email) VALUES (?,?,?,?,?)";
    $stmt_insert = mysqli_stmt_init($conn);

    // Check if statement initialization was successful
    if ($stmt_insert && mysqli_stmt_prepare($stmt_insert, $sql_insert)) {
        // Bind parameters for new record insertion
        mysqli_stmt_bind_param($stmt_insert, "sssis", $data['theme'], $data['professor'], $data['description'], $priority, $user_loggin_email);
        // Execute the statement to insert new record
        mysqli_stmt_execute($stmt_insert);
        // Set HTTP response code and return success message
        http_response_code(200);
        echo json_encode(array("message" => "Wish list saved successfully."));
    } else {
        // If statement preparation failed, return error message
        throw new Exception("Error preparing SQL statement for inserting new record.");
    }

} catch(Exception $e) {
    // Set HTTP response code and return error message
    http_response_code(500);
    echo json_encode(array("message" => "Error: " . $e->getMessage()));
}
?>
