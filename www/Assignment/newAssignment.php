<?php

	$pageTitle = "New assignment"; 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/preamble.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/menu.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/functions.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/courses/coursefunctions.php");

    if (!isset($_SESSION["isLoggedIn"]) && !$_SESSION["isLoggedIn"]) {
        return;
    }

    if(isset($_GET['c'])) {
        // Retrieve the ID from the URL
        $course = $_GET['c'];
        // Use the ID in your script
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
            return;
        }
        $_SESSION["course_id"] = $course;
    } else {
        // If ID parameter is not present in the URL, handle it accordingly
        echo "No ID parameter found in the URL.";
        return;
    }
?>
<div id="contents">
	<?php
		
        require_once($_SERVER['DOCUMENT_ROOT'] . "/forms/assignment_form.php");
	?>
</div>

<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/postamble.php");
?>