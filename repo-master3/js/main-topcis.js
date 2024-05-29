let wishList = [];
function addToWishList(element) {
  const row = element.closest("tr");
  const theme = row.querySelector("td:nth-child(2)").textContent;
  const professor = row.querySelector("td:nth-child(3)").textContent;
  const description = row.querySelector("td:nth-child(5").textContent;

  const item = {
    theme,
    professor,
    description,
  };

  wishList.push(item);
  alert("Item added to Wish sheet");
  populateWishListTable();
}

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
      deleteFromWishList(index);
    });
    operationCell.appendChild(deleteButton);
    row.appendChild(operationCell);

    tableBody.appendChild(row);
  });
}

function deleteFromWishList(index) {
  wishList.splice(index, 1);
  populateWishListTable();
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
