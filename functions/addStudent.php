<?php
include '../includes/dbcon.php';
// Add Student
if (isset($_POST['save_student'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    // Check if all fields are filled
    if ($name == NULL || $email == NULL || $phone == NULL || $course == NULL) {
        // Respone Status and Message Response
        $res = [
            'status' => 422, // Error Number
            'message' => 'All fields are mandatory'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }

    // If all fields are completed
    $query = "INSERT INTO students (name,email,phone,course) VALUES ('$name','$email','$phone','$course')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        // Respone Status and Message Response
        $res = [
            'status' => 200, // Success Number
            'message' => 'Student Created Successfully'
        ];
        // Display message
        echo json_encode($res);
        return false;
    } else {
        // Respone Status and Message Response
        $res = [
            'status' => 500, // Error Number
            'message' => 'Student Not Created'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}