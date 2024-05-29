<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$studentId = $_GET['studentId'];

$sql = "DELETE FROM users WHERE id = :studentId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':studentId', $studentId);
if ($stmt->execute()) {
    echo 'success';
} else {
    echo 'error';
}
?>