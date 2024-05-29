const sidebar = document.querySelector(".sidebar");
const closeBtn = document.querySelector("#btn");
const searchBtn = document.querySelector(".bx-search");
closeBtn.addEventListener("click", () => {
  sidebar.classList.toggle("open");
  menuBtnChange(); //calling the function(optional)
});
searchBtn.addEventListener("click", () => {
  // Sidebar open when you click on the search iocn
  sidebar.classList.toggle("open");
  menuBtnChange(); //calling the function(optional)
});
// following are the code to change sidebar button(optional)
function menuBtnChange() {
  if (sidebar.classList.contains("open")) {
    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
  } else {
    closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
  }
}
function editTitle(element) {
  var titleElement =
    element.parentNode.parentNode.querySelector("td:nth-child(2)");
  var currentTitle = titleElement.textContent.trim();
  var newTitle = prompt("Enter the new title:", currentTitle);
  if (newTitle !== null) {
    titleElement.textContent = newTitle;
  }
  var descElement =
    element.parentNode.parentNode.querySelector("td:nth-child(4)");
  var currentDesc = descElement.textContent.trim();
  var newDesc = prompt("Enter the new desc:", currentDesc);
  if (newDesc !== null) {
    descElement.textContent = newDesc;
  }
}
function confirmDelete(element) {
  if (confirm("Are you sure you want to delete this topic?")) {
    // If the user clicks OK
    // You can add JavaScript code here to delete the row
    // In this example, we will delete the entire row
    var row = element.closest("tr");
    row.remove();
    alert("The topic has been successfully deleted!");
  } else {
    // If the user clicks Cancel
    // No changes will be made
    alert("Deletion canceled.");
  }
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

  if (keyword === "") {
    // التأكد من أن الكلمة البحثية غير فارغة
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
searchInput.addEventListener("keydown", function (event) {
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
document
  .getElementById("addTopicForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // منع الإرسال الافتراضي للنموذج

    // احصل على قيم المدخلات
    var title = document.getElementById("topicTitle").value;
    var description = document.getElementById("topicDescription").value;
    var professor = document.getElementById("topicProfessor").value;

    // أضف صفًا جديدًا إلى الجدول
    addTopicToTable(title, description, professor);

    // أغلق نافذة إضافة الموضوع
    closeAddTopicModal();

    // إعادة تعيين قيم المدخلات
    document.getElementById("addTopicForm").reset();
  });

document
  .getElementById("subjectForm")
  .addEventListener("submit", function (event) {
    event.preventDefault(); // Empêcher la soumission du formulaire par défaut
    addTopic(); // Appeler la fonction addTopic() pour envoyer les données
  });

var addedTopics = [];

function addTopic() {
  // Afficher le formulaire pour ajouter un nouveau sujet
  document.getElementById("addSubjectForm").style.display = "block";
  // Ajouter le sujet à la liste
}

function hideAddSubjectForm() {
  // Masquer le formulaire pour ajouter un nouveau sujet
  document.getElementById("addSubjectForm").style.display = "none";
}

function submitTopic() {
  var theme = document.getElementById("theme").value;
  var professor = document.getElementById("professor").value;
  var description = document.getElementById("description").value;

  var formData = new FormData();
  formData.append("theme", theme);
  formData.append("professor", professor);
  formData.append("description", description);

  var xhr = new XMLHttpRequest();
  xhr.open("POST", "add_subject.php", true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      // Request was successful
      console.log(xhr.responseText);
      // You can do something here after the subject is added, like updating the subjects list
      showTopics();
    } else {
      // Request failed
      console.error("Error adding subject.");
    }
  };
  xhr.send(formData);
}

function showTopics() {
  var tableBody = document
    .getElementById("topicsTable")
    .getElementsByTagName("tbody")[0];
  tableBody.innerHTML = ""; // Effacer le contenu actuel de la table

  // Parcourir les sujets ajoutés et les ajouter à la table
  addedTopics.forEach(function (topic, index) {
    var newRow = tableBody.insertRow();
    newRow.innerHTML = `
            <td>${index + 1}</td>
            <td>${topic.theme}</td>
            <td>${topic.professor}</td>
            <td>${topic.description}</td>
            <td>
                <a href="#" onclick="confirmDelete(this)"><i class='bx bx-x'></i></a>
                <a href="#" onclick="editTitle(this)"><i class='bx bx-edit'></i></a>
            </td>
        `;
  });
}

// Attachez l'événement de clic au lien "The Subjects"
document.getElementById("subjectsLink").addEventListener("click", showSubjects);

// انتظر حتى يتم تحميل المستند بالكامل
document.addEventListener("DOMContentLoaded", function () {
  // حدد العنصر الذي يتم النقر عليه
  var subjectsLink = document.querySelector(".nav-list li:nth-child(3) a");

  // إضافة معالج الحدث للنقر على الرابط الذي يتم تحديدة
  subjectsLink.addEventListener("click", function (event) {
    event.preventDefault(); // منع السلوك الافتراضي للرابط

    // عرض جميع الصفوف في الجدول
    var rows = document.querySelectorAll("#topicsTable tbody tr");
    rows.forEach(function (row) {
      row.style.display = "table-row"; // عرض الصف
    });
  });
});
