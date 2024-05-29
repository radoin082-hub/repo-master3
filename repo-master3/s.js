
let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");

closeBtn.addEventListener("click", () => {
  toggleSidebar();
});

searchBtn.addEventListener("click", () => {
  toggleSidebar();
});

function toggleSidebar() {
  sidebar.classList.toggle("open");
  menuBtnChange();
}

function menuBtnChange() {
  let closeIcon = "bx-menu-alt-right";
  let openIcon = "bx-menu";
  closeBtn.classList.toggle(closeIcon);
  closeBtn.classList.toggle(openIcon);
}
function editTitle(element) {
  var titleElement = element.parentNode.parentNode.querySelector('td:nth-child(2)');
  var currentTitle = titleElement.textContent.trim();
  var newTitle = prompt("Enter the new title:", currentTitle);
  if (newTitle !== null) {
    titleElement.textContent = newTitle;
    var descElement = element.parentNode.parentNode.querySelector('td:nth-child(4)');
    var currentDesc = descElement.textContent.trim();
    var newDesc = prompt("Enter the new desc:", currentDesc);
    if (newDesc !== null) {
      descElement.textContent = newDesc;
      // Call the editTopicFromDatabase function to update the data in the database
      editTopicFromDatabase(currentTitle, newTitle, newDesc);
    }
  }
}
function editTopicFromDatabase(oldTitle, newTitle, newDesc) {
  // Prepare the data to be sent to the server
  var formData = new FormData();
  formData.append('oldTitle', oldTitle); // Old title
  formData.append('newTitle', newTitle); // New title
  formData.append('description', newDesc);
  
  // Send a POST request to the server to update the data in the database
  fetch('update_topic.php', {
      method: 'POST',
      body: formData
  })
  .then(response => {
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      return response.text();
  })
  .then(data => {
      // Handle the server response if necessary
      console.log(data);
      // Update the row in the table after successful update in the database
      updateRowTitle(oldTitle, newTitle);
  })
  .catch(error => {
      console.error('Error:', error);
  });
}

function updateRowTitle(oldTitle, newTitle) {
  var table = document.getElementById("topicsTable");
  var rows = table.getElementsByTagName("tr");

  for (var i = 0; i < rows.length; i++) {
    var titleCell = rows[i].querySelector('td:nth-child(2)');
    var title = titleCell.textContent.trim();
    if (title === oldTitle) {
      titleCell.textContent = newTitle;
      break;
    }
  }
}
function confirmDelete(element) {
  if (confirm("Are you sure you want to delete this topic?")) {
    var row = element.closest("tr");
    row.remove();
    deleteTopicFromDatabase(row); // Pass the row to delete from database
    alert("The topic has been successfully deleted!");
  } else {
    alert("Deletion canceled.");
  }
}

function deleteTopicFromDatabase(row) {
  // Get the title of the topic from the row
  var title = row.querySelector('td:nth-child(2)').textContent.trim();

  // Prepare the data to be sent to the server
  var formData = new FormData();
  formData.append('title', title);

  // Send a POST request to the server
  fetch('delete_topic.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    // Handle the response from the server
    console.log(data);
  })
  .catch(error => {
    console.error('Error:', error);
  });
}
      // دالة لعرض صندوق البحث
      function showSearchBox() {
        document.getElementById("searchModal").style.display = "block";
    }
    
    // دالة لإخفاء صندوق البحث
    function hideSearchBox() {
        document.getElementById("searchModal").style.display = "none";
    }
    
    // دالة للبحث في الجدول
    function searchTopics(keyword) {
        var table = document.getElementById("topicsTable");
        var rows = table.getElementsByTagName("tr");
        var originalDisplay = []; // تخزين حالة العرض الأصلية للصفوف
    
        keyword = keyword.trim(); // إزالة الفراغات الزائدة من بداية ونهاية الكلمة البحثية
    
        if (keyword === "") { // التأكد من أن الكلمة البحثية غير فارغة
            alert("Please enter a keyword to search.");
            return;
        }
// حفظ حالة العرض الأصلية لكل صف قبل البحث
for (var i = 0; i < rows.length; i++) {
    originalDisplay[i] = rows[i].style.display;
}

var found = false;
for (var i = 0; i < rows.length; i++) {
    var cells = rows[i].getElementsByTagName("td");
    var rowFound = false; // تعيين مؤشر للتحقق من العثور على الكلمة في الصف الحالي
    for (var j = 0; j < cells.length; j++) {
        var cellText = cells[j].textContent || cells[j].innerText;
        if (cellText.toUpperCase().includes(keyword.toUpperCase())) {
            rows[i].style.display = ""; // إظهار الصف إذا تم العثور على الكلمة في أحد الخلايا
            rowFound = true;
            found = true;
            break;
        }
    }
    if (!rowFound) {
        rows[i].style.display = "none"; // إخفاء الصف إذا لم يتم العثور على
       
    }
}

if (!found) {
    alert("No matching topics found.");
    // إذا لم يتم العثور على أي نتائج، استعادة حالة العرض الأصلية للصفوف
    for (var i = 0; i < rows.length; i++) {
        rows[i].style.display = originalDisplay[i];
    }
}
}

// تحديد الحقل النصي للبحث
var searchInput = document.querySelector(".nav-list input[type='text']");

// إضافة حدث "keydown" إلى الحقل النصي
searchInput.addEventListener("keydown", function(event) {
// التحقق مما إذا كان المفتاح المضغوط هو "Enter"
if (event.key === "Enter") {
    // استدعاء الدالة searchTopics بقيمة الكلمة المدخلة
    searchTopics(searchInput.value);
}
});
// عند النقر على أيقونة إضافة موضوع
document.querySelector(".bx-plus").addEventListener("click", () => {
    document.getElementById("addTopicModal").style.display = "block";
});

// عند تقديم النموذج لإضافة موضوع
document.getElementById("addTopicForm").addEventListener("submit", function(event) {
    event.preventDefault(); // منع الإرسال الافتراضي للنموذج

    // احصل على قيم المدخلات
    var title = document.getElementById("topicTitle").value;
    var resume = document.getElementById("topicresume").value;
    var professeur = document.getElementById("topicprofesseur").value;

    // أضف صفًا جديدًا إلى الجدول
    addTopicToTable(title, resume, professeur);

    // أغلق نافذة إضافة الموضوع
    closeAddTopicModal();

    // إعادة تعيين قيم المدخلات
    document.getElementById("addTopicForm").reset();
});

function addTopic() {

    // Check if all topics are closed
    var allTopicsClosed = topics.every(function(topic) {
      return topic.isClosed;
    });
   console.log(allTopicsClosed);
    if (allTopicsClosed) {
      alert("All topics are closed. You cannot add a new subject.");
    } else {
      var title = prompt("Enter the title of the topic:");

      if (title !== null && title !== "") {
        var resume = prompt("Enter the resume of the topic:");

        if (resume !== null && resume !== "") {
          var professeur = prompt("Enter the professeur/supervisor:");

          if (professeur !== null && professeur !== "") {
            var speciality = prompt("Enter the speciality:");

            if (speciality !== null && speciality !== "") { // تحقق من إدخال التخصص
              // Create a FormData object to send data to the server
              var formData = new FormData();
              formData.append('title', title);
              formData.append('resume', resume);
              formData.append('professeur', professeur);
              formData.append('speciality', speciality); // إرسال التخصص

              // Create an AJAX request
              var xhr = new XMLHttpRequest();
              xhr.open('POST', 's.php', true);
              xhr.onload = function () {
                if (xhr.status === 200) {
                  // The request was successful
                  alert(xhr.responseText); // Display the server response
                } else {
                  // The request failed
                  alert('Error: ' + xhr.status);
                }
              };
              // Send data to the server
              xhr.send(formData);

              // Add the new topic to the table
              var table = document.getElementById("topicsTable").getElementsByTagName('tbody')[0];
              var newRow = table.insertRow();
              newRow.innerHTML = `
                      <td>${table.rows.length}</td>
                      <td>${title}</td>
                      <td>${professeur}</td>
                      <td>${resume}</td>
                      <td>${speciality}</td> 
                      <td>
                          <a href="#" onclick="confirmDelete(this)"><i class='bx bx-x'></i></a>
                          <a href="#" onclick="editTitle(this)"><i class='bx bx-edit'></i></a>
                      </td>
                  `;

              alert("The topic has been successfully added!");
            } else {
              alert("speciality information is required.");
            }
          } else {
            alert("Professeur/supervisor information is required.");
          }
        } else {
          alert("Resume information is required.");
        }
      } else {
        alert("Title information is required.");
      }
    }
}


function showTopics() {
    // Get the table body
    var tableBody = document.getElementById("topicsTable").getElementsByTagName("tbody")[0];
    
    // Clear existing rows
    tableBody.innerHTML = "";
    
    // Sample data (replace this with your actual data)
    var topics = [
      { id: 1, title: "Topic 1", professeur: "professeur A", resume: "resume 1" },
      { id: 2, title: "Topic 2", professeur: "professeur B", resume: "resume 2" },
      { id: 3, title: "Topic 3", professeur: "professeur C", resume: "resume 3" }
    ];
    
    // Loop through the topics and add rows to the table
    topics.forEach(function(topic) {
      var newRow = tableBody.insertRow();
      newRow.innerHTML = `
        <td>${topic.id}</td>
        <td>${topic.title}</td>
        <td>${topic.professeur}</td>
        <td>${topic.resume}</td>
        <td>
          <a href="#" onclick="confirmDelete(this)"><i class='bx bx-x'></i></a>
          <a href="#" onclick="editTitle(this)"><i class='bx bx-edit'></i></a>
        </td>
      `;
    });
  }
  document.addEventListener("DOMContentLoaded", function() {
    // حدد العنصر الذي يتم النقر عليه لعرض المواضيع
    var subjectsLink = document.getElementById("subjectsLink");
    // إضافة معالج الحدث للنقر على الرابط الذي يتم تحديده
    subjectsLink.addEventListener("click", function(event) {
        event.preventDefault(); // منع السلوك الافتراضي للرابط

        // عرض المواضيع
        showTopics();
    });
});
// Fonction pour gérer le clic sur le bouton "Close Topic"
function closeTopic() {
    document.querySelector(".sidebar#addtopic").style.display = "none";
}
// Ajoutez un écouteur d'événement au bouton "Close Topic" pour appeler la fonction closeTopic()
document.getElementById("closeTopicButton").addEventListener("click", closeTopic);
// Variable pour suivre l'état de la barre latérale de l'ajout de sujet
let isAddTopicSidebarOpen = false;

// Fonction pour gérer le clic sur le bouton "Close Topic"
function closeTopic() {
    document.querySelector(".sidebar#addtopic").style.display = "none";
    isAddTopicSidebarOpen = false; // Mettre à jour l'état de la barre latérale
}

// Fonction pour désactiver la fonction addTopic() lorsque la barre latérale est ouverte
function disableAddTopic() {
    isAddTopicSidebarOpen = true;
}
// Ajoutez un gestionnaire d'événements pour le bouton "Close Topic"
document.getElementById("closeButton").addEventListener("click", function() {
  // Désactivez la fonction addTopic en mettant addTopicEnabled à false
  addTopicEnabled = false;
  console.log("La fonction addTopic a été désactivée.");
});
function submitTopic() {
  var title = document.getElementById("title").value;
  var professeur = document.getElementById("professeur").value;
  var resume = document.getElementById("resume").value;
  var speciality = document.getElementById("speciality").value; // إضافة التخصص

  var formData = new FormData();
  formData.append('title', title);
  formData.append('professeur', professeur);
  formData.append('resume', resume);
  formData.append('speciality', speciality); // إرسال التخصص

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 's.php', true);
  xhr.onload = function () {
      if (xhr.status === 200) {
          // La requête a réussi
          console.log(xhr.responseText);
          // Vous pouvez effectuer d'autres actions ici si nécessaire
      } else {
          // La requête a échoué
          console.error('Erreur lors de l\'ajout du sujet.');
      }
  };
  xhr.send(formData);
}

function addTopicToDatabase(title, description, professor, speciality) {
  // Build the SQL query
  var query = `INSERT INTO topic (title, description, professor, speciality) VALUES ('${title}', '${description}', '${professor}', '${speciality}')`;


  // Send the query to the server using AJAX
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "s.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
          // Receive the response from the server
          var response = xhr.responseText;
          // Update the user interface or take any additional actions based on the response
          alert(response); // Example of displaying a confirmation message
      }
  };
  xhr.send("query=" + encodeURIComponent(query));
}



// استدعاء الدالة لإضافة موضوع إلى قاعدة البيانات عند تقديم النموذج
document.getElementById("addTopicForm").addEventListener("submit", function (event) {
  event.preventDefault(); // منع الإرسال الافتراضي للنموذج

  // احصل على قيم المدخلات
  var title = document.getElementById("topicTitle").value;
  var description = document.getElementById("topicDescription").value;
  var professor = document.getElementById("topicProfessor").value;

  // إضافة الموضوع إلى قاعدة البيانات
  addTopicToDatabase(title, description, professor);

  // بعد إضافة الموضوع، يمكنك تحديث واجهة المستخدم أو أداء أي إجراء آخر بناءً على الحاجة
});
// Function to toggle the settings modal display
function showSettingsModal() {
  document.getElementById("settingsModal").style.display = "block";
}
function closeSettingsModal() {
  document.getElementById("settingsModal").style.display = "none";
}

// Add event listeners to the appropriate elements
document.getElementById("settingsLink").addEventListener("click", showSettingsModal);
document.getElementById("closeSettingsButton").addEventListener("click", closeSettingsModal);
