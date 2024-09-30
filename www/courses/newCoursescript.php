<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/preamble.php");
    if (!isset($_SESSION["isLoggedIn"]) && !$_SESSION["isLoggedIn"]) {
        return;
    }


    $title = $_POST["title"];
    $description = $_POST["description"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    
    $instructor_id = $_SESSION["user_id"];
    $files = "";

    
    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");
    $sqlInsertToken = "INSERT INTO courses (title,description,start_date,end_date,instructor_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sqlInsertToken);
    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "ssssi", $title, $description, $start_date, $end_date, $instructor_id);
    $success = mysqli_stmt_execute($stmt);

    // Check if execution was successful
    if ($success) {
        // Token inserted successfully
        echo "Course created and inserted successfully.";
    } else {
        // Handle insertion error
        echo "Error: " . mysqli_error($conn);
        return;
    }
    $user_id = $instructor_id;
    $course_id = mysqli_insert_id($conn);


    $sqlInsertEnrollment = "INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)";
    $stmtInsertEnrollment = mysqli_prepare($conn, $sqlInsertEnrollment);
    mysqli_stmt_bind_param($stmtInsertEnrollment, "ii", $user_id, $course_id);
    $success = mysqli_stmt_execute($stmtInsertEnrollment);
    
    if ($success) {
        echo "Enrollment record inserted successfully.";
    } else {
        echo "Error inserting enrollment record: " . mysqli_error($conn);
    }
    
    return true;

?>