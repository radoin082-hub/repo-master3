<?php
include('config/db.php');

$sql = "SELECT * FROM topic";
$result = mysqli_query($conn, $sql);
$topics = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Encode topics data into JSON format
$topics_json = json_encode($topics);
echo "<script>var topics = JSON.parse('$topics_json');</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Code</title>
 <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
 <link rel="stylesheet" href="s.css">
 <style>
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
   #settingsModal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
}
.settings-box {
  background-color: #fefefe;
  margin: 20% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 40%;
}
.settings-box h2 {
  margin-bottom: 10px;
}
.settings-box input {
  width: 100%;
  margin-bottom: 10px;
  padding: 8px;
}
.settings-box button {
  padding: 6px 12px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-right: 5px;
}
.settings-box button:hover {
  background-color: #45a049;
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
      <a href="#" onclick="showSettingsModal()">
        <i class='bx bx-cog'></i>
        <span class="links_name">Settings</span>
      </a>
      <span class="tooltip">Settings</span>
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
         <th>Theme</th>
         <th>Professor</th>
         <th>the description</th>
         <th>Speciality</th>
         <th id="operationHeader">the operation</th>
       </tr>
     </thead>
     <tbody>
      <!-- Table rows will be dynamically added here -->
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
 <div id="settingsModal" class="settings-modal">
  <div class="settings-box">
    <h2>Professor Settings</h2>
    <label for="profName">Name:</label>
    <input type="text" id="profName" placeholder="Enter professor's name...">
    <label for="profEmail">Email:</label>
    <input type="email" id="profEmail" placeholder="Enter professor's email...">
    <label for="profPassword">Password:</label>
    <input type="password" id="profPassword" placeholder="Enter professor's password...">
    <button onclick="saveProfessorSettings()">Save</button>
    <button onclick="closeSettingsModal()">Close</button>
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