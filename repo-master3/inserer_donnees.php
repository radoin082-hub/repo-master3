<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = ""; // Assurez-vous que le mot de passe est vide s'il n'y en a pas
$dbname = "wishsheet";

// Vérifiez si des données ont été envoyées via la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['wishList'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO wishsheet (title, description, professor, priority) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $theme, $description, $professor, $priority);

    foreach ($_POST['wishList'] as $item) {
        $theme = $item['theme'];
        $professor = $item['professor'];
        $description = $item['description'];
        $priority = $item['priority'];

        if ($stmt->execute() !== TRUE) {
            echo "Error: " . $conn->error;
        }
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No data received.";
}
?>
