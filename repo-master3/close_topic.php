<?php
/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE topic SET isClosed = TRUE";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error: " . $conn->error);
    }

    if ($stmt->execute() === TRUE) {
        echo "All topics closed successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No data received.";
}
*/?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check the current state of the topics
    $sql = "SELECT isClosed FROM topic LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $isClosed = $row['isClosed'];

    // Toggle the state of the topics
    $newState = $isClosed ? "FALSE" : "TRUE";
    $sql = "UPDATE topic SET isClosed = $newState";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error: " . $conn->error);
    }

    if ($stmt->execute() === TRUE) {
        echo $newState === "TRUE" ? "All topics closed successfully" : "All topics opened successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No data received.";
}
?>
