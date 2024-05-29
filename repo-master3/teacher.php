<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname_professor = "professor"; 
$dbname_topic = "sujet"; // Nom de votre base de données pour les sujets

try {
    // Connexion à la base de données MySQL via PDO
    $conn_professor = new PDO("mysql:host=$servername;dbname=$dbname_professor", $username, $password);
    $conn_topic = new PDO("mysql:host=$servername;dbname=$dbname_topic", $username, $password);
    // Configuration des options PDO pour afficher les erreurs de requête SQL
    $conn_professor->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn_topic->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour récupérer tous les professeurs
    $sql_professor = "SELECT id, Name, email FROM professor";
    $stmt_professor = $conn_professor->prepare($sql_professor);
    $stmt_professor->execute();
    $professors = $stmt_professor->fetchAll(PDO::FETCH_ASSOC);

    // Parcourir chaque professeur pour récupérer l'ID du sujet associé
    foreach ($professors as $professor) {
        // Requête SQL pour récupérer l'ID du sujet associé à ce professeur
        $sql_topic = "SELECT id FROM topic WHERE professeur = :professor_name";
        $stmt_topic = $conn_topic->prepare($sql_topic);
        $stmt_topic->bindParam(':professor_name', $professor['Name']);
        $stmt_topic->execute();
        $topic_id = $stmt_topic->fetchColumn();

        echo "<tr>";
echo "<td>{$professor['id']}</td>";
echo "<td>{$professor['Name']}</td>";
echo "<td>{$professor['email']}</td>";
echo "<td>{$topic_id}</td>"; // Affichage de l'ID du sujet associé
echo "<td><a href=\"#\" onclick=\"confirmDelete(this)\"><i class='bx bx-x'></i></a></td>";
echo "</tr>";

     
    }

} catch(PDOException $e) {
    echo "Erreur PDO : " . $e->getMessage();
} catch(Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
