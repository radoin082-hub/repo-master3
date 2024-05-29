let wishList = [];

function addToWishList(element) {

    const row = element.closest("tr");
    const theme = row.querySelector("td:nth-child(2)").textContent;
    const professor = row.querySelector("td:nth-child(5)").textContent;
    const description = row.querySelector("td:nth-child(3)").textContent;

    const item = {
        theme,
        professor,
        description,
    };

    wishList.push(item);
    localStorage.setItem('wishList', JSON.stringify(wishList));
    console.log(wishList);
    saveWishItemToDatabase(item);

    alert("Item added to Wish sheet");
    populateWishListTable();
}

function saveWishItemToDatabase(item) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "includes/save_wish_item.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Wish item saved successfully.");
            } else {
                console.error("Error saving wish item.");
            }
        }
    };
    xhr.send(JSON.stringify(item));
}


function deleteFromWishList(element) {
    /*console.log(wishList);*/

    // Get the parent row of the button
    var row = element.parentNode.parentNode;

    // Get all rows in the table
    var rows = document.getElementById("wishListTable").getElementsByTagName("tr");

    // Find the index of the row in the table
    var index = Array.prototype.indexOf.call(rows, row) - 1; // Subtract 1 because the first row is the header

    console.log(index); // Log the index
    var confirmation = confirm("هل أنت متأكد أنك تريد حذف هذا الموضوع؟");
    if (confirmation) {
        console.log("Wishlist");
        console.log(wishList);
        console.log("Index: " + index);
        var deletedItem = wishList.splice(index, 1)[0];
        localStorage.removeItem('wishList');
        localStorage.setItem('wishList', JSON.stringify(wishList));
        if (deletedItem) {
            populateWishListTable();
            deleteFromDatabase(deletedItem.theme, deletedItem.professor, deletedItem.description);
        } else {
            console.log(deletedItem);
            console.error("No item found at index", index);
        }
    }
}


/*
function deleteFromWishList(element) {
  const row = element.closest("tr");
  const theme = row.querySelector("td:nth-child(1)").textContent;
  const professor = row.querySelector("td:nth-child(2)").textContent;
  const description = row.querySelector("td:nth-child(3)").textContent;

  // Find the item in the wishList array
  const index = wishList.findIndex(item => item.theme === theme && item.professor === professor && item.description === description);

  // If the item was found
  if (index !== -1) {
    // Remove the item from the wishList array
    wishList.splice(index, 1);

    // Update the wishList in local storage
    localStorage.setItem('wishList', JSON.stringify(wishList));

    // Delete the item from the database
    deleteFromDatabase(theme, professor, description);

    // Repopulate the wish list table
    populateWishListTable();
  }
}

*/


function populateWishListTable() {
    const tableBody = document.getElementById("wishListTable");
    tableBody.innerHTML = "";

    wishList.forEach((item, index) => {
        const row = document.createElement("tr");

        const themeCell = document.createElement("td");
        themeCell.textContent = item.theme;
        row.appendChild(themeCell);

        const professorCell = document.createElement("td");
        professorCell.textContent = item.professor;
        row.appendChild(professorCell);

        const descriptionCell = document.createElement("td");
        descriptionCell.textContent = item.description;
        row.appendChild(descriptionCell);

        const priorityCell = document.createElement("td");
        priorityCell.textContent = index + 1;
        row.appendChild(priorityCell);

        const operationCell = document.createElement("td");
        const deleteButton = document.createElement("button");
        deleteButton.innerHTML = "&#128465;"; // رمز القمامة
        deleteButton.addEventListener("click", () => {
            deleteFromWishList(deleteButton);
        });
        operationCell.appendChild(deleteButton);
        row.appendChild(operationCell);

        tableBody.appendChild(row);
    });
}

function deleteFromDatabase(theme, professor, description) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "delete_wish_item.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log("Wish item deleted from database");
                location.reload();
            } else {
                console.error("Error deleting wish item from database");
            }
        }
    };
    xhr.send(JSON.stringify({theme: theme, professor: professor, description: description}));
}

function searchTopics(keyword) {
    var table = document.querySelector(".home-section#topics .-table");
    var rows = table.getElementsByTagName("tr");
    var originalDisplay = [];

    for (var i = 0; i < rows.length; i++) {
        originalDisplay[i] = rows[i].style.display;
    }

    var found = false;
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("td");
        var rowFound = false;
        for (var j = 0; j < cells.length; j++) {
            var cellText = cells[j].textContent || cells[j].innerText;
            if (cellText.toUpperCase().includes(keyword.toUpperCase())) {
                rows[i].style.display = "";
                rowFound = true;
                found = true;
                break;
            }
        }
        if (!rowFound) {
            rows[i].style.display = "none";
        }
    }

    if (!found) {
        alert("No matching topics found.");
        for (var i = 0; i < rows.length; i++) {
            rows[i].style.display = originalDisplay[i];
        }
    }
}

function showPFEList() {
    document.querySelector(".home-section#topics").style.display = "block";
    document.querySelector(".home-section#wishSheetSection").style.display =
        "none";
    document.querySelector(".home-section#assessment").style.display = "none";
}

function toggleWishSheet() {
    document.querySelector(".home-section#topics").style.display = "none";
    document.querySelector(".home-section#wishSheetSection").style.display =
        "block";
    document.querySelector(".home-section#assessment").style.display = "none";
}

function showassessment() {
    document.querySelector(".home-section#topics").style.display = "none";
    document.querySelector(".home-section#wishSheetSection").style.display = "none";
    document.querySelector(".home-section#assessment").style.display = "block";
}


function showSearchBox() {
    document.getElementById("searchModal").style.display = "block";
}

function hideSearchBox() {
    document.getElementById("searchModal").style.display = "none";
}
