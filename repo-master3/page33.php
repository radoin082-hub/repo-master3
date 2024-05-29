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

        <button href="prof.html?addTopicEnabled=false" id="closeButton" onclick="closePFE()">Close Topic</button>
        <table id="topics" class="-table">

            <thead>
            <tr>
                <th>Id</th>
                <th>TITLE</th>
                <th>Description</th>
                <th>SPECIALITY</th>
                <th>STATE</th>
                <th>PROFESSOR</th>
                <th>OPTION</th>

            </tr>
            </thead>
            <tbody>
            <!-- 40 صفاً هنا -->
            <!-- يمكنك تكرار هذا الصف حتى تصل إلى 40 صفاً -->
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td> <!-- Option validation button -->
                    <a href="#" onclick="validateOption(this)" class="validate-link"><i class='bx bx-check'></i></a>

                    <!-- Delete button -->
                    <a href="#" onclick="confirmDelete(this)"><i class='bx bx-x'></i></a>
                    <!-- Edit button -->
                    <a href="#" onclick="editTitle(this)"><i class='bx bx-edit'></i></a>
                </td>
            </tbody>
        </table>
    </section>
</div>
<section class="home-section" id="teacher" style="display: none;">
    <!-- Your teacher table goes here -->
    <div class="text">TEACHERS</div>
    <table id="teacher" class="-table">
        <thead>
        <tr>
            <th>Teacher ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>PFE</th>
            <th>ID-PFE</th>
            <th>OPTIONS</th>
            <!-- Add more headers if needed -->
        </tr>
        </thead>
        <tbody>
        <!-- Teacher data goes here -->


        </tr>
        <!-- Répétez ce bloc pour d'autres lignes si nécessaire -->
        </tbody>
    </table>
</section>


<section class="home-section" id="ranking" style="display: none;">
    <div class="text">RANKING</div>
    <select id="specialitySelect" onchange="toggleRankingTable()">
        <option value="all">All Specialities</option>
        <option value="L3">IA</option>
        <option value="M2">SIOD</option>
    </select>
    <div id="rankingTableSI">
        <button onclick="launchAssignment()">
            start assignment
        </button>
        <table id="ranking" class="-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>First-name</th>
                <th>Last-name</th>
                <th>Email</th>
                <th>average</th>
                <th>Ranking</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <a href="#" class="delete-ranking" onclick="DeleteRanking(this)"><i class='bx bx-x'></i></a>
                <a href="#" class="edit-ranking" onclick="editRanking(this)"><i class='bx bx-edit'></i></a>
            </td>


            <!-- Répétez ce bloc pour d'autres lignes si nécessaire -->
            </tbody>
        </table>
        <button onclick="validateAllRankings()">Validate Ranking</button>
    </div>
    <div id="rankingTableISI" style="display: none;">
        <button onclick="launchAssignment()">
            start assignment
        </button>
        <table id="ranking" class="-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>First-name</th>
                <th>Last-name</th>
                <th>Email</th>
                <th>average</th>
                <th>Ranking</th>
                <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <a href="#" class="delete-ranking" onclick="DeleteRanking(this)"><i class='bx bx-x'></i></a>
                <a href="#" class="edit-ranking" onclick="editRanking(this)"><i class='bx bx-edit'></i></a>
            </td>

            <!-- Répétez ce bloc pour d'autres lignes si nécessaire -->
            </tbody>
        </table>
        <button onclick="validateAllRankings()">Validate Ranking</button>
    </div>
</section>


<section class="home-section" id="students" style="display: none;">
    <div class="text">Students</div>
    <table id="studentTable" class="-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Ranking</th>
            <th>Options</th>
        </tr>
        </thead>

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
