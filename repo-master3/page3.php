<?php

// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

try {
    // Connexion à la base de données MySQL via PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuration des options PDO pour afficher les erreurs de requête SQL
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour sélectionner toutes les entrées de la table "topics"
//    $sql = "SELECT id, title, resume, speciality, state, professeur FROM topic";
    $sql = "SELECT * FROM topic";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
<?php
// Paramètres de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

try {
    // Connexion à la base de données MySQL via PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configuration des options PDO pour afficher les erreurs de requête SQL
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour sélectionner toutes les entrées de la table "etudiantL3"
//    $sql = "SELECT * FROM users inner join assamentstudent on  assamentstudent.studentid = users.id  ";
    $sql = "SELECT users.*, topic.id as topic_id, topic.title as topic_title, wishsheet.id as wishsheet_id 
        FROM users 
        INNER JOIN wishsheet ON wishsheet.email = users.email 
        INNER JOIN topic ON wishsheet.theme = topic.title 
        WHERE topic.state = '0'";




//

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $students = $stmt->fetchAll();

  /*  echo '<pre>';
    print_r($students);
    echo '</pre>';*/

      /* $sql_topicid = "select id from topic inner join wishsheet on wishsheet.theme = topic.title";

    $stmt_topic = $conn->prepare($sql_topicid);
    $stmt_topic->execute();
    $topics = $stmt_topic->fetch();*/


} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code</title>
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name"> Options</div>
        <i class='bx bx-menu' id="btn"></i>
    </div>
    <ul class="nav-list">
        <li>
            <button onclick="showSearchBox()"><i class='bx bx-search'></i> Search</button>
            <span class="tooltip">Search</span>
        </li>
        <li>
            <a href="#" onclick="showPFEList()">
                <i class='bx bx-file'></i>
                <span class="links_name">PFE</span>
            </a>

            <span class="tooltip">PFE</span>
        </li>

        </li>

        <li id="teachersLink"> <!-- Added id for the li element -->
            <a href="#">
                <i class='bx bx-list-ul'></i>
                <span class="links_name"> Teachers </span>
            </a>
            <span class="tooltip"> Teachers </span>
        </li>

        <li id="rankingLink">
            <a href="#" onclick="showRankingList()">
                <i class='bx bx-bar-chart'></i>
                <span class="links_name"> Ranking </span>
            </a>
            <span class="tooltip"> Ranking </span>
        </li>


    <!--    <li id="assessmentLink">
            <a href="#" onclick="showassessment()">
                <i class='bx bx-bar-chart'></i>
                <span class="links_name">assessment</span>
            </a>
            <span class="tooltip"> Assessment </span>
        </li>-->


        <li onclick="showStudentList() ">
            <a href="#">
                <i class='bx bx-user'></i>
                <span class="links_name"> Students </span>
            </a>
            <span class="tooltip"> Students </span>
        </li>
        <li onclick="showAdminInfo()">
            <a href="#">
                <i class='bx bx-cog'></i>
                <span class="links_name"> Paramètre </span>
            </a>
            <span class="tooltip"> Paramètre </span>
        </li>

        <li>
            <a href="index.php" class="back-btn">
                <i class='bx bx-arrow-back'></i>
                <span class="links_name">Back</span>
            </a>
            <span class="tooltip">Back</span>
        </li>
    </ul>

</div>

<div class="section-container">
    <section class="home-section" id="topics">
        <div class="text">List of topics :</div>
        <!--      samer -->
        <?php
        //        print_r($topics);
        echo $topics[0]["isClosed"] ? '<button  onclick="closePFE()">Open Topics</button>' : '<button  onclick="closePFE()">Close Topics</button>';
        ?>
        <table id="topics" class="-table">

            <thead>
            <tr>
                <th>Id</th>
                <th>TITLE</th>
                <th>Description</th>
                <th>SPECIALITY</th>
                <th>STATE</th>
                <th>PROFESSEUR</th>
                <th>OPTION</th>

            </tr>
            </thead>
            <tbody>
            <!-- 40 صفاً هنا -->
            <!-- يمكنك تكرار هذا الصف حتى تصل إلى 40 صفاً -->
            <tr>


            </tbody>
            <?php foreach ($topics as $topic): ?>
                <tr>
                    <td><?php echo $topic['id']; ?></td>
                    <td><?php echo $topic['title']; ?></td>
                    <td><?php echo $topic['resume']; ?></td>
                    <td><?php echo $topic['speciality']; ?></td>
                    <td id="state_<?php echo $topic['id']; ?>"><?php echo $topic['state']; ?></td>
                    <!-- Ajoutez un ID unique pour chaque état -->
                    <td><?php echo $topic['professeur']; ?></td>
                    <td>
                        <!-- Option validation button -->
                        <a href="#" onclick="validateOption(this)" data-id="<?php echo $topic['id']; ?>"
                           class="validate-link"><i class='bx bx-check'></i></a>
                        <!-- Delete button -->
                        <a href="#" onclick="confirmDelete(this)"><i class='bx bx-x'></i></a>
                        <!-- Edit button -->
                        <a href="#" onclick="editTitle(this)"><i class='bx bx-edit'></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
</div>
<section class="home-section" id="teacher">
    <div class="text">List of Professors</div>
    <table id="teacherTable" class="-table">
        <thead>
        <tr>
            <th>professor ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>ID-PFE</th>
            <th>OPTIONS</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Paramètres de connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname_professor = "professor";
        $dbname_topic = "project"; // Nom de votre base de données pour les sujets

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

                // Affichage des résultats dans le tableau
                echo "<tr>";
                echo "<td>{$professor['id']}</td>";
                echo "<td>{$professor['Name']}</td>";
                echo "<td>{$professor['email']}</td>";
                echo "<td>{$topic_id}</td>"; // Affichage de l'ID du sujet associé
                echo "<td><a href=\"#\" onclick=\"confirmDelete(this)\"><i class='bx bx-x'></i></a></td>";
                echo "</tr>";
            }

        } catch (PDOException $e) {
            echo "<tr><td colspan='5'>Erreur PDO : " . $e->getMessage() . "</td></tr>";
        } catch (Exception $e) {
            echo "<tr><td colspan='5'>Erreur : " . $e->getMessage() . "</td></tr>";
        }
        ?>
        </tbody>
    </table>
</section>


<section class="home-section" id="ranking" style="display: none;">
    <div class="text">RANKING</div>
    <select id="specialitySelect" onchange="toggleRankingTable()">
        <option value="all">All Specialities</option>
        <option value="M2">SI</option>
    </select>
    <div id="rankingTableSI">
        <!--        <button onclick="sortAverage()">
                  Sort</button>-->
        <button onclick="sortAverage('ASC')">Sort Ascending</button>
        <button onclick="sortAverage('DESC')">Sort Descending</button>

        <button onclick="validateAllRankings(this)">Validate Ranking</button>
    </div>
    <div id="rankingTableISI" style="display: none;">
        <!--        <button onclick="sortAverage()">
                  Sort</button>-->

        <button onclick="sortAverage('ASC')">Sort Ascending</button>
        <button onclick="sortAverage('DESC')">Sort Descending</button>
        <table id="ranking" class="-table">
            <thead>
            <tr>
                <th>Theme</th>
                <th>first_name</th>
                <th>second_name</th>
                <th>third_name</th>
                <th>fourth_name</th>
                <th>Full-name</th>
                <th>Average</th>
                <th id="rankingLabel">Ranking</th>
                <th>option</th>
            </tr>
            </thead>
            <tbody>
            <?php
/*            echo '<pre>';
            print_r($students);
            echo '</pre>';*/

//            echo '<pre>';
//            print_r($wishsheets);
//            echo '</pre>';
            foreach ($students as $student): ?>
                <tr>
                    <td class="theme"><?php echo $student['topic_title']; ?></td>
                    <td><?php echo $student['first_name']; ?></td>
                    <td><?php echo $student['second_name']; ?></td>
                    <td><?php echo $student['third_name']; ?></td>
                    <td><?php echo $student['fourth_name']; ?></td>
                    <td><?php echo $student['full_name']; ?></td>

                    <td style="display: none" class="student-id"><?php echo $student['id']; ?></td>

                  <td style="display: none" class="student-email"><?php echo $student['email']; ?></td>
                  <td style="display:none" class="theme-id"><?php echo $student['topic_id']; ?></td>
                  <td style="display:none" class="wishid"><?php echo $student['wishsheet_id']; ?></td>
                    <td>
                        <input type="number" value="<?php echo $student['Average']; ?>" min="1"
                               data-student-id="<?php echo $student['id']; ?>" class="average-input">
                    </td>
                    <td>
                        <input type="number" value="<?php echo $student['Ranking']; ?>" min="1"
                               data-student-id="<?php echo $student['0']; ?>" class="ranking-input">
                    </td>
                    <td>
                        <a href="#" class="delete-ranking" onclick="DeleteRanking(this)"><i class='bx bx-x bx-tada' ></i></a>
                        <a href="#" class="delete-ranking" onclick="validwish(this)"><i class='bx bx-check bx-flip-vertical bx-tada' ></i></a>
                    </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
        <button onclick="validateAllRankings()">Validate Ranking</button>
</section>


<div>
<section class="home-section" id="assessment" style="display: none;">
   <h3>HI SAMER</h3>
</section>
</div>



</div>
<section class="home-section" id="students" style="display: none;">
    <div class="text">Liste des étudiants</div>
    <table id="studentTable" class="-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Full-name</th>
            <th>Email</th>
            <th>Ranking</th>
            <th>Options</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Paramètres de connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "project"; // Remplacez "your_database_name" par le nom de votre base de données

        try {
            // Connexion à la base de données MySQL via PDO
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Configuration des options PDO pour afficher les erreurs de requête SQL
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour récupérer les données des étudiants
            $sql = "SELECT id, `full_name`, email,ranking FROM users  WHERE education_level = 'L3'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Affichage des résultats dans le tableau
            foreach ($students as $student) {
                echo "<tr>";
                echo "<td>{$student['id']}</td>";
                echo "<td>{$student['full_name']}</td>";
                echo "<td>{$student['email']}</td>";
                echo "<td>{$student['ranking']}</td>";
                echo "<td><a href=\"#\" onclick=\"confirmDelete(this)\"><i class='bx bx-x'></i></a></td>";
                echo "</tr>";
            }

        } catch (PDOException $e) {
            echo "<tr><td colspan='6'>Erreur PDO : " . $e->getMessage() . "</td></tr>";
        } catch (Exception $e) {
            echo "<tr><td colspan='6'>Erreur : " . $e->getMessage() . "</td></tr>";
        }
        ?>
        </tbody>
    </table>
</section>

</div>

<div class="section-container">
    <section class="home-section" id="adminInfoSection" style="display: none;">
        <table id="adminInfoTable">
            <h2 id="adminInfoTitle">General Information</h2>
            <tr>
                <th>Nom</th>
                <td id="adminName"></td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td id="adminFirstName"></td>
            </tr>
            <tr>
                <th>Email</th>
                <td id="adminEmail"></td>
            </tr>
        </table>
    </section>
</div>
<div id="searchModal" class="search-modal">
    <div class="search-box">
        <input type="text" id="searchInput" placeholder="Enter search keyword...">
        <button onclick="searchTopics(document.getElementById('searchInput').value)">Search</button>
        <button onclick="hideSearchBox()">Close</button>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>

