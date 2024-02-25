<?php
	$pageTitle = "Simple VLE Homepage"; 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/preamble.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/functions.php");
	
?>


<?php

//courses/enrol.php?c=00000%auth=00000000
//purpose of enrol.php will be to enrol user into a course. Done using temporary auth token thats linked to courseID and time limit
//on confirm will insert enrollment using session ID


// Check if the ID parameter is present in the URL
if(isset($_GET['c'])) {
    // Retrieve the ID from the URL
    $course_id = $_GET['course_id'];
    // Use the ID in your script
    echo "The ID passed in the URL is: " . $id;

    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");
    $sql = "SELECT * FROM courses
            WHERE id='$course_id'
            ";
    $data = mysqli_query($conn, $sql);

    if (!$data) {
        echo "Course not found" . mysqli_error($conn);
        return;
    }


    $numRows = mysqli_num_rows($data);
    if ($numRows == 0) {
        $loginSuccess = false;
        echo "File not found" . mysqli_error($conn);
        return;
    }

    while ($row = mysqli_fetch_assoc($data)) {
        echo "ID: " . $row['id'] . "<br>";
        echo "Name: " . $row['name'] . "<br>";
        // Add other columns as needed
    }

    getResource($resource_id);


} else {
    // If ID parameter is not present in the URL, handle it accordingly
    echo "No ID parameter found in the URL.";
}



//send temp code for link under token auth
//on timer, prompt user to update caches
?>

