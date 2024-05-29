<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);


$sortOrder = $_GET['sortOrder'];
$sql = "SELECT * FROM users WHERE education_level = 'L3' ORDER BY Average ". $sortOrder;
$stmt = $conn->prepare($sql);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($students);
?>