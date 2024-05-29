<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = ""; // Mot de passe vide, si vous n'en avez pas spécifié
$database = "sujet";

try {
    // Connexion à la base de données MySQL via PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Configuration des options PDO pour afficher les erreurs de requête SQL
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les données envoyées depuis JavaScript
    $data = json_decode(file_get_contents("php://input"), true);

    // Parcourir les données et exécuter la mise à jour pour chaque enregistrement
    foreach ($data as $item) {
        $entryType = $item['entryType'];
        $newEntry = $item['newEntry'];
        $newSpeciality = $item['newSpeciality'];
        $newState = $item['newState'];
        $newProfessor = $item['newProfessor'];
        $entryId = $item['entryId'];

        // Construire et exécuter la requête de mise à jour en utilisant $entryId
        switch ($entryType) {
            case 'title':
                $sql = "UPDATE topic SET title=:newEntry WHERE id=:entryId";
                break;
            case 'resume':
                $sql = "UPDATE topic SET resume=:newEntry WHERE id=:entryId";
                break;
            case 'speciality':
                $sql = "UPDATE topic SET speciality=:newSpeciality WHERE id=:entryId";
                break;
            case 'state':
                $sql = "UPDATE topic SET state=:newState WHERE id=:entryId";
                break;
            case 'professor':
                $sql = "UPDATE topic SET professor=:newProfessor WHERE id=:entryId";
                break;
            default:
                break;
        }

        $stmt = $conn->prepare($sql);
        // Liaison des paramètres
        $stmt->bindParam(':newEntry', $newEntry, PDO::PARAM_STR);
        $stmt->bindParam(':newSpeciality', $newSpeciality, PDO::PARAM_STR);
        $stmt->bindParam(':newState', $newState, PDO::PARAM_STR);
        $stmt->bindParam(':newProfessor', $newProfessor, PDO::PARAM_STR);
        $stmt->bindParam(':entryId', $entryId, PDO::PARAM_INT);

        // Exécuter la requête de mise à jour
        $stmt->execute();
    }

    echo "Les enregistrements ont été mis à jour avec succès";
} catch(PDOException $e) {
    echo "Erreur lors de la mise à jour des enregistrements : " . $e->getMessage();
}

// Fermer la connexion à la base de données
?>
