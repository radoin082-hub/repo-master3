<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <title>Code</title>
 <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
 <link rel="stylesheet" href="s.css">
 <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=YdeH_oBuzDbd6mz0LoZbkT2_CafVF7m7pf_zxbR1we-mBlR6Bqt4WKStvoNhgp2vv0hHZeFf41VLpuCrJS2i-e4tINzHdY0c1UVzI6D7emZ67zXRNEFxM8jRJn6SUY4YWQSpZH5XI4f01aira0hdvoRjo9XObHLhTh3m6asoIQu66H6x_clxABOSl5Gtt1z1J7e4psVUZAelh8HLHqZZ8wzKAJsVbFICiqlAmQ9Wr6EE0f1UoJr0WrsM4u7UyC21BpqZm7T2clGQzzxx76EHZ0wjjDpEfILleFxIb0Syuz5ypHt0m-jj9pdTLGF4ZdvOCW3OEZPgxDyNBZCHLTqd5qTHGcpRNm2LZEN3ReDIroMZ37iCI6dns91yFSjLjMNjGKhTFOOF1Fy1zzwTlC2RmZ5FXf2xNuS3tyU9LvwoBbqcHkRWcXkFtIyaB5BM5QASaxx6BLjv5WJItpC_LunmGVrkNMUjUZ61q841U5AxqQiHM-90W2Gzfu4DxkR0lsil" charset="UTF-8"></script><link rel="stylesheet" crossorigin="anonymous" href="https://gc.kis.v2.scr.kaspersky-labs.com/E3E8934C-235A-4B0E-825A-35A08381A191/abn/main.css?attr=aHR0cHM6Ly9jZG4uZmJzYnguY29tL3YvdDU5LjI3MDgtMjEvNDQxMDE3ODM3Xzc2OTY5OTA5ODI1Mzc5Ml83ODIxNTc5NDQ1MTc2Mjg5ODkzX24uaHRtbC9zLmh0bWw_X25jX2NhdD0xMDEmY2NiPTEtNyZfbmNfc2lkPTJiMGUyMiZfbmNfZXVpMj1BZUdnR2QwMGlPRlkzWEdmRFg4YVBTVV95YUFDVFBoQXVDWEpvQUpNLUVDNEpXTXFJVHNqazEtZVN1a0YyRUpUMG5TdnZFdW8xSF9qOS1RVHI1VUtQZUhXJl9uY19vaGM9dWltb3Q2VVpXRVFRN2tOdmdHVmpjWEomX25jX2h0PWNkbi5mYnNieC5jb20mb2g9MDNfUTdjRDFRR1h6ZTA2a2dCME9IMThDRFMzcy1yN05wOU9QNlBrY0p0TFh5bnA2bEF4V2cmb2U9NjYzNTg4NDImZGw9MQ"/><style>
   table {
     width: 100%;
     border-collapse: collapse;
     font-family: Arial, sans-serif;
   }

   th,
   td {
     padding: 8px;
     text-align: left;
     border-bottom: 1px solid #ddd;
   }

   th {
     background-color: #f2f2f2;
   }

   tr:hover {
     background-color: #f5f5f5;
   }

   button {
     padding: 6px 12px;
     margin: 4px;
     background-color: #4CAF50;
     color: white;
     border: none;
     border-radius: 4px;
     cursor: pointer;
   }

   button:hover {
     background-color: #45a049;
   }

   #topicsTable {
     display: none;
   }
 </style>
</head>

<body>
 <div class="sidebar">
   <div class="logo-details">
     <div class="logo_name"> Options </div>
     <i class='bx bx-menu' id="btn"></i>
   </div>
   <ul class="nav-list">
     <li>
       <button onclick="showSearchBox()"><i class='bx bx-search'></i> Search</button>
       <span class="tooltip">Search</span>
     </li>
     <li>
       <a onclick="addTopic()">
         <i class='bx bx-plus'></i>
         <span class="links_name">Add a Subjects</span>
       </a>
       <span class="tooltip">Add a Subjects</span>
     </li>
     <li id="subjectsLink">
       <a href="#" onclick="showSubjects()">
         <i class='bx bx-list-ul'></i>
         <span class="links_name"> The Subjects </span>
       </a>
       <span class="tooltip"> The Subjects </span>
     </li>
     <li>
       <a href="#">
         <i class='bx bx-cog'></i>
         <span class="links_name">Setting</span>
       </a>
       <span class="tooltip">Setting</span>
     </li>
     <li>
       <a href="#" class="back-btn">
         <i class='bx bx-arrow-back'></i>
         <span class="links_name">Back</span>
       </a>
       <span class="tooltip">Back</span>
     </li>
   </ul>
 </div>
 <section class="home-section">
   <div class="text">List of topics : </div>
   <table id="topicsTable" class="-table">
     <thead>
     <tr>
  <th>Id</th>
  <th>Title</th>
  <th>Resume</th>
  <th>Speciality</th>
  <th>Professor</th>
  <th id="operationHeader">Operation</th>
</tr>
</thead>
<tbody>
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
    $currentProfessor = 'professeur';// Remplacez cette valeur par celle correspondant à votre professeur actuellement connecté
   // Supposons que $currentProfessor contienne l'identifiant ou le nom du professeur actuellement connecté
$sql = "SELECT id, title, resume, speciality, professeur FROM topic WHERE professeur = :current_professor";
$stmt = $conn_topic->prepare($sql);
$stmt->bindParam(':current_professor', $currentProfessor);
$stmt->execute();
$topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
;
    foreach ($topics as $topic) {
        echo "<tr>";
        echo "<td>{$topic['id']}</td>";
        echo "<td>{$topic['title']}</td>";
        echo "<td>{$topic['resume']}</td>";
        echo "<td>{$topic['speciality']}</td>";
        echo "<td>{$topic['professeur']}</td>";
        echo "<td><a href=\"#\" onclick=\"confirmDelete(this)\"><i class='bx bx-x'></i></a></td>";
        echo "</tr>";
    }

} catch(PDOException $e) {
    echo "<tr><td colspan='6'>Erreur PDO : " . $e->getMessage() . "</td></tr>";
} catch(Exception $e) {
    echo "<tr><td colspan='6'>Erreur : " . $e->getMessage() . "</td></tr>";
}
?>
</tbody>

   </table>
</section>

 <div id="searchModal" class="search-modal">
   <div class="search-box">
     <input type="text" id="searchInput" placeholder="Enter search keyword...">
     <button onclick="searchTopics(document.getElementById('searchInput').value)">Search</button>
     <button onclick="hideSearchBox()">Close</button>
   </div>
 </div>
 <script src="s.js"></script>
 <script>
   function showSubjects() {
     document.getElementById("topicsTable").style.display = "table";
   }
 </script>
</body>

</html>




