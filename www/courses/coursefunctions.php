<?php

function getEnrollments() {

    //caches enrollment data
    if (isset($_SESSION["getEnrollments"]) && $_SESSION['cacheTimer'] < $_SESSION['cacheTimeout']) {
        return $_SESSION["getEnrollments"];
    }


    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM enrollments WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $user_id);
    mysqli_stmt_execute($stmt);
    $data = mysqli_stmt_get_result($stmt);

    if (!$data) {
        echo "Error executing query: " . mysqli_error($conn);
        return;
    }

    $numRows = mysqli_num_rows($data);
    if ($numRows == 0) {
        echo "No courses";
        return null;
    }

    //echo "Courses found: " . $numRows . "<br>";
    // Rewind the result set pointer
    mysqli_data_seek($data, 0);
    
    $_SESSION["getEnrollments"] = $data;
    return $data;
}

function getAssignments($course_id) {
    if (!isset($course_id)) {
        echo "not set";
        return null;
    }

    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");
    $sql = "SELECT * FROM assignments WHERE course_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $course_id);
    mysqli_stmt_execute($stmt);
    $data = mysqli_stmt_get_result($stmt);

    if (!$data) {
        echo "Error executing query: " . mysqli_error($conn);
        return null;
    }

    $numRows = mysqli_num_rows($data);
    if ($numRows == 0) {
        echo "No courses";
        return null;
    }

    mysqli_data_seek($data, 0);
    return $data;
}

function getCourses() {
    // Check if the course data is already cached in the session
    if (isset($_SESSION['getCourses']) || $_SESSION['cacheTimer'] < $_SESSION['cacheTimeout']) {
        return $_SESSION['getCourses'];
    }

    // Initialize the session cache array if not already set
    $_SESSION['getCourses'] = [];

    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");

    // Check connection
    if (!$conn) {
        echo "Connection failed: " . mysqli_connect_error();
        return;
    }

    // Execute the query to fetch enrollments
    $data = $_SESSION['getEnrollments'];

    // Loop through the query results and cache them in the session
    while ($row = mysqli_fetch_assoc($data)) {
        $course_id = $row['id']; // Assuming 'id' is the primary key of the 'courses' table

        $sqlnew = "SELECT * FROM courses WHERE id = ?";
        $stmtnew = mysqli_prepare($conn, $sqlnew);
        mysqli_stmt_bind_param($stmtnew, "s", $course_id);
        mysqli_stmt_execute($stmtnew);
        $courseData = mysqli_stmt_get_result($stmtnew);

        if (!$courseData) {
            echo "Error executing query: " . mysqli_error($conn);
            return;
        }

        // Fetch course data
        $courseRow = mysqli_fetch_assoc($courseData);

        // Cache the course data in the session
        $_SESSION['getCourses'][$courseRow["id"]] = $courseRow;
    }

    // Close the database connection
    mysqli_close($conn);

    // Return the cached course data
    return $_SESSION['getCourses'];
}



?>