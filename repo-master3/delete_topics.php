<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sujet";

try {
    // Connexion à la base de données MySQL via PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuration des options PDO pour afficher les erreurs de requête SQL
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['topic_id'])) {
        $topicId = $_POST['topic_id'];
        
        // Requête SQL pour supprimer le sujet de la base de données
        $sql = "DELETE FROM topic WHERE id = :topicId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':topicId', $topicId, PDO::PARAM_INT);
        $stmt->execute();

        echo 'Le sujet a été supprimé avec succès de la base de données.';
    } else {
        echo 'Identifiant du sujet non spécifié.';
    }
}  catch(PDOException $e) {
    echo "Erreur PDO : " . $e->getMessage();
}

?>
