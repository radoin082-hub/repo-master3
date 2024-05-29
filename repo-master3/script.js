let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");

// Toggle sidebar function
function toggleSidebar() {
    sidebar.classList.toggle("open");
    menuBtnChange();
}

// Function to change menu button icon
function menuBtnChange() {
    if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
    } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
}

// Add event listeners for sidebar toggle buttons
closeBtn.addEventListener("click", toggleSidebar);
searchBtn.addEventListener("click", toggleSidebar);
// Add event listener for the "Teachers" link to show teacher section
document.getElementById("teachersLink").addEventListener("click", showTeacherList);

// Function to show teacher section and hide home section

function editTitle(element, entryType) {
    // Récupérer l'ID de l'entrée depuis l'élément parent de l'élément cliqué
    var entryId = element.parentNode.parentNode.cells[0].innerText; // Assurez-vous que la première colonne contient l'ID

    // Afficher l'ID dans la console pour le débogage
    console.log("ID de l'entrée:", entryId);

    // Définir le texte de l'en-tête en fonction de l'entrée spécifiée
    var headerText = "Title ";
    switch (entryType) {
        case "title":
            headerText += "Title";
            break;
        case "topic":
            headerText += "Topic";
            break;
        case "speciality":
            headerText += "Speciality";
            break;
        case "state":
            headerText += "State";
            break;
        case "professor":
            headerText += "Professor";
            break;
        default:
            headerText += "Entry";
    }

    // Créer une boîte de dialogue modale
    var modal = `
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">${headerText}</h5>
                    </div>
                    <div class="modal-body">
                        <form id="editForm">
                            <div class="form-group">
                                <label for="newEntry">New ${headerText}</label>
                                <input type="text" class="form-control" id="newEntry">
                            </div>
                            <div class="form-group">
                                <label for="newSpeciality">New Speciality</label>
                                <input type="text" class="form-control" id="newSpeciality">
                            </div>
                            <div class="form-group">
                                <label for="newState">New State</label>
                                <input type="text" class="form-control" id="newState">
                            </div>
                            <div class="form-group">
                                <label for="newProfessor">New Professor</label>
                                <input type="text" class="form-control" id="newProfessor">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="closeModalBtn">Close</button>
                        <button type="button" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Ajouter la boîte de dialogue modale au corps du document
    document.body.insertAdjacentHTML('beforeend', modal);

    var closeModalBtn = document.getElementById('closeModalBtn');
    var saveChangesBtn = document.getElementById('saveChangesBtn');

    // Ajouter un écouteur d'événements pour le bouton "Close"
    closeModalBtn.addEventListener('click', function () {
        // Fermer la boîte de dialogue modale
        var editModal = document.getElementById('editModal');
        editModal.classList.remove('show');
        editModal.style.display = 'none';
    });

    // Ajouter un écouteur d'événements pour le bouton "Save Changes"
    saveChangesBtn.addEventListener('click', function () {
        var newEntry = document.getElementById('newEntry').value;
        var newSpeciality = document.getElementById('newSpeciality').value;
        var newState = document.getElementById('newState').value;
        var newProfessor = document.getElementById('newProfessor').value;

        // Préparer les données à envoyer au serveur
        var data = {
            entryType: entryType,
            newEntry: newEntry,
            newSpeciality: newSpeciality,
            newState: newState,
            newProfessor: newProfessor,
            entryId: entryId // Assurez-vous que l'ID est correctement inclus
        };

        // Envoyer les données modifiées au serveur via une requête AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_entry.php", true); // Remplacez "update_entry.php" par le chemin de votre script serveur
        xhr.setRequestHeader("Content-Type", "application/json");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Si la requête est terminée et réussie, vous pouvez gérer la réponse du serveur ici si nécessaire
                console.log(xhr.responseText);
            }
        };

        xhr.send(JSON.stringify(data));

        // Fermer la boîte de dialogue modale
        var editModal = document.getElementById('editModal');
        editModal.classList.remove('show');
        editModal.style.display = 'none';
    });

    // Afficher la boîte de dialogue modale
    var editModal = document.getElementById('editModal');
    editModal.classList.add('show');
    editModal.style.display = 'block';
}

editTitle(element, 'title'); // Pour éditer le titre
editTitle(element, 'topic'); // Pour éditer le sujet
editTitle(element, 'speciality'); // Pour éditer la spécialité
editTitle(element, 'state'); // Pour éditer l'état
editTitle(element, 'professor'); // Pour éditer le professeur


// Function to confirm topic deletion
function confirmDelete(element) {
    // Ask for confirmation
    var confirmation = confirm("Are you sure you want to delete this topic?");

    // If confirmed, delete the topic
    if (confirmation) {
        var row = element.closest("tr");
        var topicId = row.querySelector("td:first-child").textContent; // Get the topic ID from the first cell

        // Send an AJAX request to delete the topic from the database
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete_topics.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Remove the row from the table if deletion was successful
                row.remove();
                console.log("Topic deleted from the database");
            } else {
                console.error("Error deleting topic from the database");
            }
        };
        xhr.send("topic_id=" + topicId);
    }
}


// Function to show search box
function showSearchBox() {
    var searchModal = document.getElementById('searchModal');
    searchModal.style.display = 'block';
}

function hideSearchBox() {
    var searchModal = document.getElementById('searchModal');
    searchModal.style.display = 'none';
}


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
searchInput.addEventListener("keydown", function (event) {
// التحقق مما إذا كان المفتاح المضغوط هو "Enter"
    if (event.key === "Enter") {
// استدعاء الدالة searchTopics بقيمة الكلمة المدخلة
        searchTopics(searchInput.value);
    }
});
// Event listener for "Add Topic" icon click
document.querySelector(".bx-plus").addEventListener("click", () => {
    document.getElementById("addTopicModal").style.display = "block";
});

// Event listener for submitting the add topic form
document.getElementById("addTopicForm").addEventListener("submit", function (event) {
    event.preventDefault();
    // Your implementation here
});

// Ajouter un événement pour le lien de "Ranking" pour afficher la section de classement
document.getElementById("rankingLink").addEventListener("click", function (event) {
    event.preventDefault(); // Empêcher le comportement par défaut du lien
    showRankingList(); // Appeler la fonction pour afficher la section de classement
});

// Function to show PFE section and hide other sections
function showPFEList() {
    document.querySelector(".home-section#topics").style.display = "block";
    document.querySelector(".home-section#teacher").style.display = "none";
    document.querySelector(".home-section#ranking").style.display = "none";
    document.querySelector(".home-section#students").style.display = "none"; // Hide student section
    document.querySelector(".home-section#adminInfoSection").style.display = "none"; // Hide student section

}

// Function to show teacher section and hide other sections
function showTeacherList() {
    document.querySelector(".home-section#students").style.display = "none";

    document.querySelector(".home-section#topics").style.display = "none";
    document.querySelector(".home-section#teacher").style.display = "block";
    document.querySelector(".home-section#ranking").style.display = "none";
}

// Function to show ranking section and hide other sections
function showRankingList() {
    document.querySelector(".home-section#topics").style.display = "none";
    document.querySelector(".home-section#teacher").style.display = "none";
    document.querySelector(".home-section#ranking").style.display = "block";
}


// Add event listeners for sidebar links to show respective sections

document.getElementById("pfeLink").addEventListener("click", showPFEList);
document.getElementById("teachersLink").addEventListener("click", showTeacherList);
document.getElementById("rankingLink").addEventListener("click", showRankingList);

// Function to show student section and hide other sections

function showStudentList() {
    document.querySelector(".home-section#topics").style.display = "none";
    document.querySelector(".home-section#teacher").style.display = "none";
    document.querySelector(".home-section#ranking").style.display = "none";
    document.querySelector(".home-section#students").style.display = "block"; // Show student section
}


// Add event listener for the "Students" link to show student section
document.getElementById("studentsLink").addEventListener("click", showStudentList);

// Function to delete a student entry
function deleteStudent(element) {
    var confirmation = confirm("Are you sure you want to delete this student?");
    if (confirmation) {
        var row = element.closest("tr");
        row.remove();
        console.log("Student deleted");
    }
}


function editStudent(element) {
    // Récupérer les éléments de la ligne de l'étudiant
    var row = element.closest('tr');
    var currentId = row.querySelector('td:nth-child(1)').textContent.trim();
    var currentName = row.querySelector('td:nth-child(2)').textContent.trim();
    var currentEmail = row.querySelector('td:nth-child(3)').textContent.trim();
    var currentRanking = row.querySelector('td:nth-child(4)').textContent.trim();

    // Créer une boîte de dialogue modale pour éditer les détails de l'étudiant
    var modal = `
        <div class="modal fade" id="editStudentModal" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                    </div>
                    <div class="modal-body">
                        <form id="editStudentForm">
                            <div class="form-group">
                                <label for="newId">New ID</label>
                                <input type="text" class="form-control" id="newId" value="${currentId}">
                            </div>
                            <div class="form-group">
                                <label for="newName">New Name</label>
                                <input type="text" class="form-control" id="newName" value="${currentName}">
                            </div>
                            <div class="form-group">
                                <label for="newEmail">New Email</label>
                                <input type="email" class="form-control" id="newEmail" value="${currentEmail}">
                            </div>
                            <div class="form-group">
                                <label for="newRanking">New Ranking</label>
                                <input type="text" class="form-control" id="newRanking" value="${currentRanking}">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="closeModalBtn" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveChangesBtn">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Ajouter la boîte de dialogue modale au corps du document
    document.body.insertAdjacentHTML('beforeend', modal);

    // Récupérer le bouton "Save Changes"
    var saveChangesBtn = document.getElementById('saveChangesBtn');
    var closeModalBtn = document.getElementById('closeModalBtn');

    // Ajouter un écouteur d'événements pour le bouton "Close"
    closeModalBtn.addEventListener('click', function () {
        // Fermer la boîte de dialogue modale d'édition des étudiants
        var editStudentModal = document.getElementById('editStudentModal');
        editStudentModal.classList.remove('show');
        editStudentModal.style.display = 'none';
    });

    // Ajouter un écouteur d'événements pour le bouton "Save Changes"
    saveChangesBtn.addEventListener('click', function () {
        // Récupérer les nouvelles valeurs des champs
        var newId = document.getElementById('newId').value;
        var newName = document.getElementById('newName').value;
        var newEmail = document.getElementById('newEmail').value;
        var newRanking = document.getElementById('newRanking').value;

        // Mettre à jour les valeurs dans la ligne de l'étudiant
        row.querySelector('td:nth-child(1)').textContent = newId;
        row.querySelector('td:nth-child(2)').textContent = newName;
        row.querySelector('td:nth-child(3)').textContent = newEmail;
        row.querySelector('td:nth-child(4)').textContent = newRanking;

        // Fermer la boîte de dialogue modale
        var editStudentModal = document.getElementById('editStudentModal');
        editStudentModal.classList.remove('show');
        editStudentModal.style.display = 'none';
    });


    // Afficher la boîte de dialogue modale d'édition des étudiants
    var editStudentModal = document.getElementById('editStudentModal');
    editStudentModal.classList.add('show');
    editStudentModal.style.display = 'block';
}

function validateOption(button) {
    // Récupérer l'identifiant de l'option à partir de l'attribut data-id
    var topicId = button.getAttribute('data-id');
    console.log("ID du sujet:", topicId); // Vérifier si l'ID est correctement récupéré

    // Envoyer une requête AJAX au serveur pour mettre à jour l'état de l'option
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_state.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Mettre à jour l'interface utilisateur si nécessaire
            console.log(xhr.responseText);
            // Mettre à jour l'interface utilisateur en changeant le contenu de la cellule d'état
            var row = button.parentNode.parentNode;
            var stateCell = row.querySelector('td:nth-child(5)');
            stateCell.textContent = "Validated";
            // Afficher une confirmation
            alert("Option validated successfully!");
        } else {
            console.error('Erreur lors de la mise à jour de l\'état de l\'option.');
        }
    };
    xhr.send('topic_id=' + topicId);
}


/*function validateAllRankings(element) {
    var rankingInputs = document.querySelectorAll('#ranking tbody input[type="number"]');

    // Placeholder array to store rankings data
    var rankingsData = [];

    // Parcourir tous les inputs de classement
    rankingInputs.forEach(function (input) {
        /!*var studentId = input.closest('tr').querySelector('td:first-child').innerText;*!/
        var studentIdElement = document.querySelector('.student-id');
        var studentId = studentIdElement.textContent;
        var newRanking = input.value;

        // Ajouter les données du classement à l'array rankingsData
        rankingsData.push({"student_id": studentId, "new_ranking": newRanking});
           console.log(rankingsData);
        // Mettre à jour la cellule de classement dans la table HTML
        var rankingCell = input.closest('tr').querySelector(
            'td:nth-child(5)');
        rankingCell.innerText = newRanking; // Mettre à jour le texte avec le nouveau classement
    });

    // Afficher un message de confirmation avec une boîte de dialogue modale
    var modal = document.createElement("div");
    modal.classList.add("modal");
    modal.innerHTML = "<div class='modal-content'>All rankings validated successfully!</div>";
    document.body.appendChild(modal);

    // Supprimer la boîte de dialogue modale après quelques secondes
    setTimeout(function () {
        document.body.removeChild(modal);
    }, 3000); // Supprime la boîte de dialogue après 3 secondes

    // Envoyer les données à la page PHP via une requête POST AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_ranking.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Afficher la réponse de la page PHP dans la console
            console.log(xhr.responseText);
        }
    };
    xhr.send(JSON.stringify(rankingsData));
}*/
function validateAllRankings() {
    console.log("validateAllRankings function called");
    var rankingInputs = document.querySelectorAll('#ranking tbody .ranking-input');
    var averageInputs = document.querySelectorAll('#ranking tbody .average-input');

    var rankingValues = [];
    var averageValues = [];

    var studentData = []; // This will hold both ranking and average data

    // Parcourir tous les inputs de classement
    rankingInputs.forEach(function (input, index) {
       /* var studentId = input.closest('tr').querySelector('td:first-child').innerText;*/

        var studentIdElement = document.querySelector('.student-id');
        var studentId = studentIdElement.textContent;
        var newRanking = input.value;
        var newAverage = averageInputs[index].value; // Get the corresponding average value

        rankingValues.push(newRanking);
        averageValues.push(newAverage);

        if (isNaN(newRanking) || newRanking < 1 || newRanking > rankingInputs.length) {
            console.error("Invalid ranking:", newRanking);
            return; // Skip this input
        }

        if (isNaN(newAverage) || newAverage < 1 || newAverage >20) {
            console.error("Invalid average:", newAverage);
            return; // Skip this input
        }

        // Add the ranking and average data to the studentData array
        studentData.push({ "student_id": studentId, "new_ranking": newRanking, "new_average": newAverage });

        var rankingCell = input.closest('tr').querySelector('td:nth-child(5)');
        rankingCell.innerText = newRanking;

        var averageCell = input.closest('tr').querySelector('td:nth-child(4)');
        averageCell.innerText = newAverage;
    });

    var minRanking = Math.min(...rankingValues);
    var maxRanking = Math.max(...rankingValues);
    var rankingLabel = document.querySelector('#rankingLabel');
    rankingLabel.textContent += ` (${minRanking} - ${maxRanking})`;

    var modal = document.createElement("div");
    modal.classList.add("modal");
    modal.innerHTML = "<div class='modal-content'>All rankings validated successfully!</div>";
    document.body.appendChild(modal);

    setTimeout(function () {
        document.body.removeChild(modal);
    }, 3000);

    console.log(JSON.stringify(studentData));

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "update_ranking.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        } else if (xhr.readyState === 4 && xhr.status === 400 ) {
            console.error('The student ID does not exist in the database.');
        } else if (xhr.status !== 200) {
            throw new Error('Error with status code ' + xhr.status);
        }
    };
    xhr.send(JSON.stringify(studentData)); // Send the combined student data
}
// Fonction pour supprimer un classement
/*function DeleteRanking(element) {
    // Demander une confirmation à l'utilisateur avant de supprimer
    var confirmation = confirm("Are you sure you want to delete this ranking?");

    // Si l'utilisateur confirme la suppression
    if (confirmation) {
        // Récupérer la ligne parente de l'élément actuel (la ligne du tableau)
        var row = element.parentNode.parentNode;

        // Supprimer la ligne du tableau
        row.parentNode.removeChild(row);
    }
}*/

// Fonction pour modifier un classement
function editRanking(element) {
    // Récupérer la cellule contenant le classement actuel
    var rankingCell = element.parentNode.previousElementSibling;

    // Récupérer le classement actuel
    var currentRanking = rankingCell.textContent.trim();

    // Demander à l'utilisateur de saisir le nouveau classement
    var newRanking = prompt("Enter the new ranking:", currentRanking);

    // Si l'utilisateur entre un nouveau classement et clique sur "OK"
    if (newRanking !== null) {
        // Mettre à jour le texte de la cellule avec le nouveau classement
        rankingCell.textContent = newRanking;
    }
}

/*function showAdminInfo() {
    // Récupérer les informations de l'administrateur (nom, prénom, email) depuis votre source de données
    var adminName = "John Doe";
    var adminFirstName = "Admin";
    var adminEmail = "admin@example.com";

    // Mettre à jour les informations dans le tableau
    document.getElementById("adminName").textContent = adminName;
    document.getElementById("adminFirstName").textContent = adminFirstName;
    document.getElementById("adminEmail").textContent = adminEmail;

    // Afficher la section d'informations de l'administrateur
    document.getElementById("adminInfoSection").style.display = "none";
    document.querySelector(".home-section#topics").style.display = "none";
    document.querySelector(".home-section#teacher").style.display = "none";
    document.querySelector(".home-section#ranking").style.display = "none";
    document.querySelector(".home-section#students").style.display = "none"; // Hide student section
    document.querySelector(".home-section#adminInfoSection").style.display = "block"; // Hide student section
}*/
function toggleRankingTable() {
    var specialitySelect = document.getElementById('specialitySelect');
    var rankingTableSI = document.getElementById('rankingTableSI');
    var rankingTableISI = document.getElementById('rankingTableISI');

    if (specialitySelect.value === 'L3') {
        rankingTableSI.style.display = 'block';
        rankingTableISI.style.display = 'none';
    } else if (specialitySelect.value === 'M2') {
        rankingTableSI.style.display = 'none';
        rankingTableISI.style.display = 'block';
    } else {
        rankingTableSI.style.display = 'block';
        rankingTableISI.style.display = 'block';
    }
}

// Fonction pour marquer les états comme invalides par défaut
function markStatesAsInvalid() {
    var stateCells = document.querySelectorAll('#topics tbody td:nth-child(5)');
    stateCells.forEach(function (cell) {
        cell.textContent = 'Invalid';
        cell.style.color = 'blue'; // Stylez la couleur en bleu
        cell.style.fontStyle = 'italic'; // Stylez le texte en italique
    });
}

document.addEventListener("DOMContentLoaded", function () {
    // Récupérer les paramètres de l'URL
    const urlParams = new URLSearchParams(window.location.search);
    const addTopicEnabled = urlParams.get('addTopicEnabled');

    // Récupérer le bouton "Close Topic"
    const closeButton = document.getElementById("closeButton");

    // Ajouter un écouteur d'événements au bouton "Close Topic"
    closeButton.addEventListener("click", function () {
        // Bloquer la fonction addTopic si addTopicEnabled est false
        if (addTopicEnabled === 'false') {
            // Désactiver la fonction addTopic
            addTopicEnabled = false;
            console.log("La fonction addTopic est désactivée.");
        }
    });
});


function sortAverage(sortOrder) {

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'sortAverage.php?sortOrder=' + sortOrder, true);

    xhr.onload = function () {
        if (this.status == 200) {

            var students = JSON.parse(this.responseText);


            var tbody = document.querySelector('#ranking tbody');
            tbody.innerHTML = '';

            for (var i = 0; i < students.length; i++) {
                var row = document.createElement('tr');

                var cellId = document.createElement('td');
                cellId.textContent = students[i].id;
                row.appendChild(cellId);

                var cellFirstName = document.createElement('td');
                cellFirstName.textContent = students[i].first_name;
                row.appendChild(cellFirstName);

                var cellSecondName = document.createElement('td');
                cellSecondName.textContent = students[i].second_name;
                row.appendChild(cellSecondName);

                var cellThirdName = document.createElement('td');
                cellThirdName.textContent = students[i].third_name;
                row.appendChild(cellThirdName);

                var cellFourthName = document.createElement('td');
                cellFourthName.textContent = students[i].fourth_name;
                row.appendChild(cellFourthName);

                var cellFullName = document.createElement('td');
                cellFullName.textContent = students[i].full_name;
                row.appendChild(cellFullName);

                var cellAverage = document.createElement('td');
                var averageInput = document.createElement('input');
                averageInput.type = 'number';
                averageInput.value = students[i].Average;
                averageInput.min = '1';
                averageInput.dataset.studentId = students[i].id;
                cellAverage.appendChild(averageInput);
                row.appendChild(cellAverage);

                var cellRanking = document.createElement('td');
                var rankingInput = document.createElement('input');
                rankingInput.type = 'number';
                rankingInput.value = students[i].Ranking;
                rankingInput.min = '1';
                rankingInput.dataset.studentId = students[i].id;
                cellRanking.appendChild(rankingInput);
                row.appendChild(cellRanking);

                var cellOption = document.createElement('td');
                var deleteLink = document.createElement('a');
                deleteLink.href = "#";
                deleteLink.className = "delete-ranking";
                deleteLink.onclick = function () {
                    DeleteRanking(this);
                };
                var deleteIcon = document.createElement('i');
                deleteIcon.className = 'bx bx-x';
                deleteLink.appendChild(deleteIcon);
                cellOption.appendChild(deleteLink);
                row.appendChild(cellOption);

                tbody.appendChild(row);
            }
        }
    };
    xhr.send();
}

function DeleteRanking(element) {
    var studentId = element.parentElement.parentElement.querySelector('input').dataset.studentId;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'deleteStudent.php?studentId=' + studentId, true);
    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText == 'success') {
                element.parentElement.parentElement.remove();
            } else {
                console.error('Error deleting student:', this.responseText);
            }
        }
    };
    xhr.send();
}

function validwish(element) {

    var student_email = element.parentElement.parentElement.querySelector('.student-email').textContent;
    var theme_id = element.parentElement.parentElement.querySelector('.theme-id').textContent;

    var theme = element.parentElement.parentElement.querySelector('.theme').textContent;



    console.log(student_email);
    console.log(theme_id);
    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'validwish.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        console.log(xhr.responseText);
        if (this.status == 200) {
            console.log(this.responseText);

            const item = {
                theme,
                theme_id
            };

            deleteFromDatabasewishsheet(item);
            if (this.responseText === 'success') {
                console.log('Student added successfully');
                console.log('wishsheet added successfully');


            }
        }
    };
    xhr.send('student_email=' + encodeURIComponent(student_email) + '&theme_id=' + encodeURIComponent(theme_id) + '&theme=' + encodeURIComponent(theme));
}
 function deleteFromDatabasewishsheet(item) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'delete_wish_item2.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('Wish item deleted from database');

            } else {
                console.error('Error deleting wish item from database');
            }
        }
    };
    xhr.send(JSON.stringify(item));

}


function closePFE() {
    var xhr = new XMLHttpRequest();
    var button = document.querySelector('button[onclick="closePFE()"]');
    xhr.open("POST", "close_topic.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                alert(xhr.responseText);
                // Change the text of the button based on the response
                if (xhr.responseText.includes("closed")) {
                    button.textContent = "Open Topic";
                } else {
                    button.textContent = "Close Topic";
                }
            } else {
                console.error("Error toggling topics");
            }
        }
    };
    xhr.send();
}