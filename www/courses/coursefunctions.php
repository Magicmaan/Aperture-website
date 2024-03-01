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

    

    $temp = array();
    while ($row = mysqli_fetch_assoc($data)) {
        if ($row['active'] == '1') { $temp[] = $row; };
        
    }
    $_SESSION["getEnrollments"] = $temp;

    //echo "Courses found: " . $numRows . "<br>";
    // Rewind the result set pointer
    mysqli_data_seek($data, 0);

    // Close the prepared statement for this iteration
    mysqli_stmt_close($stmt);

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
    // Get the current PHP time as a Unix timestamp
    $current_time = time();
    $temp = array();
    while ($row = mysqli_fetch_assoc($data)) {
        // Convert MySQL DATETIME to Unix timestamp
        $start_time_unix = strtotime($row["start_time"]);
        // Compare the timestamps
        if ($start_time_unix < $current_time) {
            $temp[] = $row;
        }
    }

    //echo "Courses found: " . $numRows . "<br>";
    // Rewind the result set pointer
    mysqli_data_seek($data, 0);

    // Close the prepared statement for this iteration
    mysqli_stmt_close($stmt);

    return $temp;
}

function getCourses() {
    // Initialize the session cache array if not already set
    if (!isset($_SESSION['getCourses'])) {
        $_SESSION['getCourses'] = [];
    }
    
    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");

    // Check connection
    if (!$conn) {
        echo "Connection failed: " . mysqli_connect_error();
        return;
    }

    $data = getEnrollments();
    // Loop through the query results and cache them in the session
    
    foreach ($data as $row) {
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
    
        // Fetch all course data from the result set
        $courseRows = mysqli_fetch_all($courseData, MYSQLI_ASSOC);
    
        // Cache the course data in the session
        foreach ($courseRows as $courseRow) {
            $_SESSION['getCourses'][$courseRow["id"]] = $courseRow;
        }
    
        // Free the result set
        mysqli_free_result($courseData);

        // Close the prepared statement for this iteration
        mysqli_stmt_close($stmtnew);
    }


    // Return the cached course data
    return $_SESSION['getCourses'];
}

function genCourseInvite($courseID, $expiretime = 2) {
    if (!isset($_SESSION["isLoggedIn"]) && !$_SESSION["isLoggedIn"]) {
        return;
    }

    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");
    $user_id = $_SESSION["user_id"];    
    $sql = "SELECT * FROM courses WHERE id = ? AND instructor_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $courseID, $user_id);
    mysqli_stmt_execute($stmt);
    $data = mysqli_stmt_get_result($stmt);

    if (!$data) {
        echo "Error executing query: " . mysqli_error($conn);
        return;
    }
    $numRows = mysqli_num_rows($data);
    if ($numRows == 0) {
        echo "User is not instructor of course";

        $sql = "SELECT * FROM enrollments WHERE course_id = ? AND user_id = ? AND admin_access = '1' ";
        $stmtenrollments = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmtenrollments, "ii", $courseID, $user_id);
        mysqli_stmt_execute($stmtenrollments);
        $dataenrollments = mysqli_stmt_get_result($stmtenrollments);

        if (!$dataenrollments) {
            echo "Error executing query: " . mysqli_error($conn);
            return null;
        }

        $numRowsenrollments = mysqli_num_rows($dataenrollments);
        if ($numRowsenrollments == 0) {
            echo "User is not admin of course";
            return null;
        }
    }
    
    $token = bin2hex(random_bytes(32)); // Generates a 64-character token


    // Establish a connection to the database
    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");
    $sqlInsertToken = "INSERT INTO tokens (token, type, course_id, exp_time) VALUES (?, 'course', ?, ?)";
    $stmt = mysqli_prepare($conn, $sqlInsertToken);
    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "sii", $token, $courseID, $expiretime); // "si" indicates a string followed by an integer
    $success = mysqli_stmt_execute($stmt);

    // Check if execution was successful
    if ($success) {
        // Token inserted successfully
        echo "Token generated and inserted successfully.";
    } else {
        // Handle insertion error
        echo "Error: " . mysqli_error($conn);
    }

    echo "http://localhost/courses/enrol?c=" . $courseID ."&t=" . $token;

}

function removeUser($courseID, $userIDtoRemove) {
    if (!isset($_SESSION["isLoggedIn"]) && !$_SESSION["isLoggedIn"]) {
        return;
    }
    $user_id = $_SESSION["user_id"];   

    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");
     
    $sql = "SELECT * FROM courses WHERE id = ? AND instructor_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $courseID, $user_id);
    mysqli_stmt_execute($stmt);
    $data = mysqli_stmt_get_result($stmt);

    if (!$data) {
        echo "Error executing query: " . mysqli_error($conn);
        return;
    }
    $numRows = mysqli_num_rows($data);
    if ($numRows == 0) {
        echo "User is not instructor of course";

        $sql = "SELECT * FROM enrollments WHERE course_id = ? AND user_id = ? AND admin_access = '1' ";
        $stmtenrollments = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmtenrollments, "ii", $courseID, $user_id);
        mysqli_stmt_execute($stmtenrollments);
        $dataenrollments = mysqli_stmt_get_result($stmtenrollments);

        if (!$dataenrollments) {
            echo "Error executing query: " . mysqli_error($conn);
            return null;
        }

        $numRowsenrollments = mysqli_num_rows($dataenrollments);
        if ($numRowsenrollments == 0) {
            echo "User is not admin of course";
            return null;
        }
    }

    $sqlUpdateEnrollment = "UPDATE enrollments SET active = 0 WHERE user_id = ? AND course_id = ?";
    $stmtDeleteEnrollment = mysqli_prepare($conn, $sqlDeleteEnrollment);
    mysqli_stmt_bind_param($stmtDeleteEnrollment, "ii", $userIDtoRemove, $courseID);
    $success = mysqli_stmt_execute($stmtDeleteEnrollment);
    
    if ($success) {
        echo "Enrollment record removed successfully.";
    } else {
        echo "Error inserting enrollment record: " . mysqli_error($conn);
    }
}

function newAssignment() {
    if (!isset($_SESSION["isLoggedIn"]) && !$_SESSION["isLoggedIn"]) {
        return;
    }


    $title = $_POST["title"];
    $description = $_POST["description"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $course_id = $_POST["course_id"];
    $instructor_id = $_SESSION["user_id"];

    
    
    $sqlInsertToken = "INSERT INTO assignments (title,description,start_date,end_date,instructor_id,course_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sqlInsertToken);
    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "ssssii", $title, $description, $start_date, $end_date, $instructor_id, $course_id);
    $success = mysqli_stmt_execute($stmt);

    // Check if execution was successful
    if ($success) {
        // Token inserted successfully
        echo "Token generated and inserted successfully.";
    } else {
        // Handle insertion error
        echo "Error: " . mysqli_error($conn);
        return;
    }
    $id = mysqli_insert_id($conn);




    $jsonarray = array(
        "id" => $id,
        "title" => $title,
        "description" => $description,
        "start_date" => $start_date,
        "end_date" => $end_date,
        "instructor_id" => $instructor_id,
        "course_id" => $course_id,
        "files" => $files,
    );


    $jsonString = json_encode($data);
    // Specify the file path
    $filePath = "/resources/assignments/" . $id . "/data.json";


    if (!file_exists($filePath)) {
        mkdir($dirPath, 0777, true); // Create directory recursively
        echo "Directory created successfully";
    } else {
        echo "Directory already exists";
    }
    // Write the JSON string to the file
    file_put_contents($filePath, $jsonString);

    echo "http://localhost/assignments/enrol?c=" . $courseID ."&t=" . $token;
    
    return true;


}


?>