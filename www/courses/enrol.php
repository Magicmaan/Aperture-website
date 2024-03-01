<?php
    
    
?>


<?php

//courses/enrol.php?c=00000&t=00000000
//purpose of enrol.php will be to enrol user into a course. Done using temporary auth token thats linked to courseID and time limit
//on confirm will insert enrollment using session ID

session_start();
// Check if the ID parameter is present in the URL
if (!isset($_SESSION["isLoggedIn"]) && !$_SESSION["isLoggedIn"]) {
    echo "Please login";
    return;
}
$user_id = $_SESSION["user_id"];
echo $user_id;

if(isset($_GET['c'])) {
    // Retrieve the ID from the URL
    $course = $_GET['c'];
    // Use the ID in your script
    echo "The ID passed in the URL is: " . $course . "<br>";
    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");
    $sql = "SELECT * FROM courses
            WHERE id='$course'
            ";
    $data = mysqli_query($conn, $sql);
    if (!$data) {
        echo "Error executing query: " . mysqli_error($conn);
        return;
    }
    $numRows = mysqli_num_rows($data);
    if ($numRows == 0) {
        echo "Course not found";
        return;
    }
    while ($row = mysqli_fetch_assoc($data)) {
        $coursetitle = $row['title'];
        // Add other columns as needed
    }
} else {
    // If ID parameter is not present in the URL, handle it accordingly
    echo "No ID parameter found in the URL.";
    return;
}

if(isset($_GET['t'])) {
    // Retrieve the ID from the URL
    $authtoken = $_GET['t'];
    // Use the ID in your script
    echo "The token passed in the URL is: " . $authtoken . "<br>";
    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");
    $sql = "SELECT * FROM tokens WHERE token = ? AND course_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $authtoken, $course);
    mysqli_stmt_execute($stmt);
    $data = mysqli_stmt_get_result($stmt);
    if (!$data) {
        echo "Error executing query: " . mysqli_error($conn);
        return;
    }
    $numRows = mysqli_num_rows($data);
    if ($numRows == 0) {
        echo "Token not valid";
        return;
    }
    while ($row = mysqli_fetch_assoc($data)) {
        $regTimestamp = strtotime($row['reg_date']); // Convert reg_date to a Unix timestamp
        $expTimestamp = $regTimestamp + ($row['exp_time'] * 3600); // Add exp_time (in hours) to reg_date (in seconds)
        if ($expTimestamp < time()) {
            echo "Token not valid past expiry";
            return;
        }
    }
} else {
    // If ID parameter is not present in the URL, handle it accordingly
    echo "No ID parameter found in the URL.";
    return;
}

$pageTitle = "Enrol" . $coursetitle; 
require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/functions.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/courses/coursefunctions.php");

// Establish database connection
$conn = mysqli_connect("localhost", "root", "root", "aperturebase");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is already enrolled in the course
$sqlCheckEnrollment = "SELECT * FROM enrollments WHERE course_id = ? AND user_id = ?";
$stmtCheckEnrollment = mysqli_prepare($conn, $sqlCheckEnrollment);
mysqli_stmt_bind_param($stmtCheckEnrollment, "ii", $course, $user_id);
mysqli_stmt_execute($stmtCheckEnrollment);
$resultCheckEnrollment = mysqli_stmt_get_result($stmtCheckEnrollment);

if (!$resultCheckEnrollment) {
    echo "Error executing query: " . mysqli_error($conn);
    mysqli_close($conn);
    return;
}

$numRows = mysqli_num_rows($resultCheckEnrollment);
if ($numRows == 0) {
    // If the user is not already enrolled, insert a new enrollment record
    $sqlInsertEnrollment = "INSERT INTO enrollments (user_id, course_id) VALUES (?, ?)";
    $stmtInsertEnrollment = mysqli_prepare($conn, $sqlInsertEnrollment);
    mysqli_stmt_bind_param($stmtInsertEnrollment, "ii", $user_id, $course);
    $success = mysqli_stmt_execute($stmtInsertEnrollment);
    
    if ($success) {
        echo "Enrollment record inserted successfully.";
    } else {
        echo "Error inserting enrollment record: " . mysqli_error($conn);
    }
} else {
    echo "Already enrolled";
}

