// Class Style For Alerts
const successMessage = "text-bg-success";
const failMessage = "text-bg-danger";
const warningMessage = "text-bg-warning";

// Add Student | submit button | form id (#)
$(document).on("submit", "#saveStudent", function (e) {
  // Prevents the page from reloading
  e.preventDefault();

  // Function to display form message
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertAddStudent");
    alert.find("#formAlertMessageAddStudent").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  // Getting the submit form
  var formData = new FormData(this);

  // Manually appending the button into the form upon submit
  formData.append("save_student", true);

  $.ajax({
    type: "POST",
    url: "./functions/addStudent.php",
    data: formData,
    // When submitting form, process data and content type must be checked
    processData: false,
    contentType: false,
    // (Not Required)dataType: "dataType",

    // If successful
    success: function (response) {
      // Parsing the data acquired from code.php
      var res = jQuery.parseJSON(response);

      // Handling error messages
      if (res.status == 422) {
        displayFormMessage(warningMessage, res.message);
      } else if (res.status == 200) {
        // if status == 200 error number
        // Add class
        $("#errorMessage").addClass("d-none");
        // Close modal
        $("#studentAddModal").modal("hide");
        // After success, empty the input fields
        $("#saveStudent")[0].reset();
        // Refresh table (make sure to add space inside href "[space] tableName")
        $("#myTable").load(" #myTable > *");
      }
    },
  });
});

// Edit Student (Display Student Details in the modal based in student id) | edit button | button class (.) // Went ahead with using id in the button tag instead
$(document).on("click", "#editStudentButton", function () {
  // Getting the data from the table using the student id
  var student_id = $(this).val();

  $.ajax({
    type: "GET",
    url: "./functions/editStudent.php?student_id=" + student_id,
    success: function (response) {
      // Parsing data acquired
      var res = jQuery.parseJSON(response);
      // Handling error messages
      if (res.status == 200) {
        $("#student_id").val(res.data.id);
        $("#editName").val(res.data.name);
        $("#editEmail").val(res.data.email);
        $("#editPhone").val(res.data.phone);
        $("#editCourse").val(res.data.course);
        // If student is found, show student edit modal
        $("#studentEditModal").modal("show");
      } else {
        // If student is not found
        alert(res.message);
      }
    },
  });
});

// Update Student (Based on selected edit button in the table)
$(document).on("submit", "#updateStudent", function (e) {
  // Prevents the page from reloading
  e.preventDefault();

  // Function to display form message
  function displayFormMessage(classStyle, messageContent) {
    var option = {
      animation: true,
      delay: 3000,
    };
    var alert = $("#formAlertUpdateStudent");
    alert.find("#formAlertMessageUpdateStudent").text(messageContent);
    alert.addClass(classStyle);
    var showAlert = new bootstrap.Toast(alert, option);
    showAlert.show();
    setTimeout(() => {
      alert.removeClass(classStyle);
    }, 3500);
  }

  // Getting the submit form
  var formData = new FormData(this);

  // Manually appending the button into the form upon submit
  formData.append("update_student", true);

  $.ajax({
    type: "POST",
    url: "./functions/updateStudent.php",
    data: formData,
    // When submitting form, process data and content type must be checked
    processData: false,
    contentType: false,
    // (Not Required)dataType: "dataType",

    // If successful
    success: function (response) {
      // Parsing the data acquired from code.php
      var res = jQuery.parseJSON(response);

      // Handling error messages
      if (res.status == 422) {
        displayFormMessage(failMessage, res.message);
      } else if (res.status == 200) {
        // if status == 200 error number
        // Add class
        $("#errorMessageUpdate").addClass("d-none");
        // Close modal
        $("#studentEditModal").modal("hide");
        // After success, empty the input fields
        $("#updateStudent")[0].reset();
        // Refresh table (make sure to add space inside href "[space] tableName")
        // $("#myTable").load(location.href + " #myTable");
        // Or better alternative is to add space followed by (> *)
        $("#myTable").load(" #myTable > *");
      }
    },
  });
});

// View Student | click is used instead of submit
$(document).on("click", "#viewStudentButton", function () {
  // Getting the data from the table using the student id
  var student_id = $(this).val();
  // alert(student_id);

  // Same function of displaying the data in code.php will be used
  $.ajax({
    type: "GET",
    url: "./functions/viewStudent.php?student_id=" + student_id, // code.php inside functions folder
    // url: "../code.php?student_id=" + student_id,         // code.php in root directory
    success: function (response) {
      // Parsing data acquired
      var res = jQuery.parseJSON(response);
      // Handling error messages
      if (res.status == 404) {
        // If student is not found
        alert(res.message);
      } else if (res.status == 200) {
        // if status == 200 error number
        // Fetch all and each data (each data will be stored in and ID embedded the input tag)
        // (Not Needed anymore since we're simply viewing the data)$('#student_id').val(res.data.id);

        // Replace .val class with .text
        // .val is only used for input tags, if other tags are used, use .text instead
        $("#view_name").text(res.data.name);
        $("#view_email").text(res.data.email);
        $("#view_phone").text(res.data.phone);
        $("#view_course").text(res.data.course);

        // If student is found, show student edit modal
        $("#studentViewModal").modal("show");
      }
    },
  });
});

// Delete Student | submit is used similar to update instead of click
$(document).on("click", "#deleteStudentButton", function (e) {
  // Prevents the page from reloading
  e.preventDefault();

  // Show alert message to confirm deletion
  if (confirm("Are you sure you want to delete this data?")) {
    // Get student id to be deleted
    var student_id = $(this).val();

    // Proceed to perform delete by isset($_POST['delete_student'])
    $.ajax({
      type: "POST",
      url: "./functions/deleteStudent.php",
      data: {
        delete_student: true,
        student_id: student_id,
      },
      success: function (response) {
        var res = jQuery.parseJSON(response);
        if (res == 500) {
          alert(res.message);
        } else {
          alert(res.message);

          $("#myTable").load(" #myTable > *");
        }
      },
    });
  }
});
