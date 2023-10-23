document.getElementById("employeeForm").addEventListener("submit", function(event) {
    event.preventDefault();

    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var email = document.getElementById("email").value;

    addEmployee(firstName, lastName, email);
    clearForm();
});

function addEmployee(firstName, lastName, email) {
    var table = document.getElementById("employeeList");
    var row = table.insertRow(-1);
    var firstNameCell = row.insertCell(0);
    var lastNameCell = row.insertCell(1);
    var emailCell = row.insertCell(2);

    firstNameCell.innerHTML = firstName;
    lastNameCell.innerHTML = lastName;
    emailCell.innerHTML = email;
}

function clearForm() {
    document.getElementById("firstName").value = "";
    document.getElementById("lastName").value = "";
    document.getElementById("email").value = "";
}