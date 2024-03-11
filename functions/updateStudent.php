<?php
include '../includes/dbcon.php';

// Update Student (Save New Data)
if (isset($_POST['update_student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
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
    $query = "UPDATE students 
                SET name = '$name', email = '$email', phone = '$phone', course = '$course' 
                WHERE id = '$student_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        // Respone Status and Message Response
        $res = [
            'status' => 200, // Success Number
            'message' => 'Student Updated Successfully'
        ];
        // Display message
        echo json_encode($res);
        return false;
    } else {
        // Respone Status and Message Response
        $res = [
            'status' => 500, // Error Number
            'message' => 'Student Not Updated'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}