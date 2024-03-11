<?php
include '../includes/dbcon.php';
if (isset($_GET['student_id'])) {
    $student_id = mysqli_real_escape_string($con, $_GET['student_id']);

    $query = "SELECT * FROM students WHERE id ='$student_id'";
    $query_run = mysqli_query($con, $query);

    if (mysqli_num_rows($query_run) == 1) {

        // Fetching data of student into array
        $student = mysqli_fetch_array($query_run);

        // Respone Status and Message Response
        $res = [
            'status' => 200, 
            'message' => 'Student fetched successfully by id',
            'data' => $student // Store array data of student into data
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    } else {
        // Respone Status and Message Response
        $res = [
            'status' => 404, // Error Number
            'message' => 'Student ID not found'
        ];
        // Display the error message
        echo json_encode($res);
        return false;
    }
}