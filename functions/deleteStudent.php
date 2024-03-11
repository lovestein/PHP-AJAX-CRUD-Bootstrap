<?php
include '../includes/dbcon.php';

// Delete Student
if (isset($_POST['delete_student'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);

    $query = "DELETE FROM students WHERE id = '$student_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        // Respone Status and Message Response
        $res = [
            'status' => 200, // Success Number
            'message' => 'Student Deleted Successfully'
        ];
        // Display message
        echo json_encode($res);
        return false;
    } else {
        // Respone Status and Message Response
        $res = [
            'status' => 500, // Error Number
            'message' => 'Student Not Deleted'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}
