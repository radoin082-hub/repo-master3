<?php



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


$topicId = $_GET['topicId'];


$sql = "DELETE FROM topic WHERE id = :topicId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':topicId', $topicId);
if ($stmt->execute()) {
    echo 'success';
} else {
    echo 'error';
}
?>