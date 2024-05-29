<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sujet"; // Le nom de votre base de données

try {
    // Connexion à la base de données MySQL via PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuration des options PDO pour afficher les erreurs de requête SQL
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si l'ID du sujet est passé en tant que paramètre POST
    if (isset($_POST['topic_id'])) {
        $topicId = $_POST['topic_id'];
        
        // Mettre à jour l'état du sujet dans la base de données
        $sql = "UPDATE topic SET state ='validated' WHERE id = :topicId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':topicId', $topicId, PDO::PARAM_INT);
        $stmt->execute();

        // Vérifier le nombre de lignes affectées (devrait être 1)
        if ($stmt->rowCount() > 0) {
            echo 'L\'état du sujet a été mis à jour avec succès.';
        } else {
            echo 'Aucune ligne mise à jour. Vérifiez l\'ID du sujet.';
        }
    } else {
        echo 'Identifiant du sujet non spécifié.';
    }
} catch(PDOException $e) {
    echo "Erreur PDO : " . $e->getMessage();
}
?>
