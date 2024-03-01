<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/preamble.php");
    if (!isset($_SESSION["isLoggedIn"]) && !$_SESSION["isLoggedIn"]) {
        return;
    }


    $title = $_POST["title"];
    $description = $_POST["description"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $course_id = $_SESSION["course_id"];
    $instructor_id = $_SESSION["user_id"];
    $files = "";

    
    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");
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


    $jsonString = json_encode($jsonarray);
    // Specify the file path
    $directoryPath = $_SERVER['DOCUMENT_ROOT'] . "/resources/assignments/" . $id . "/";
    $filePath = $directoryPath . "data.json";

    // Check if the directory exists
    if (!is_dir($directoryPath)) {
        // Attempt to create the directory
        if (!mkdir($directoryPath, 0777, true)) {
            // Failed to create the directory
            echo "Failed to create directory";
            return false;
        }
    }

    // Check if the file already exists
    if (file_exists($filePath)) {
        echo "File already exists";
        return false;
    }

    // Write the JSON string to the file
    if (file_put_contents($filePath, $jsonString) !== false) {
        echo "JSON data has been saved to $filePath";
        return true;
    } else {
        echo "Failed to write JSON data to file";
        return false;
    }
    
    return true;

?>