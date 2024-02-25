<?php
    $pageTitle = "Simple VLE Homepage"; 
    require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/preamble.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/menu.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/functions.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/courses/coursefunctions.php");
?>


<?php
//courses/view.php?c=00000
//view.php will view course contents
// Check if the ID parameter is present in the URL

if (!isset($_SESSION["isLoggedIn"]) && !$_SESSION["isLoggedIn"]) {
    return;
}
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
        echo "ID: " . $row['id'] . "<br>";
        echo "Name: " . $row['title'] . "<br>";
        // Add other columns as needed
    }
} else {
    // If ID parameter is not present in the URL, handle it accordingly
    echo "No ID parameter found in the URL.";
    return;
}
    //check if user can access course
    $Coursedata = getCourses();
    $canAccess = false;
    foreach ($Coursedata as $row) {
        echo $row['id'];
        if ($row['id'] == $course) {
            $canAccess = true;
            break;
        }
    }
    if (!$canAccess) {
        echo "access denied lol";
        return null;
    }
    
    echo "yo";
    

    echo '<div id="menu-title"> Welcome, ' . $_SESSION["username"] . ' ' . $_SESSION["user_id"] . '</div>';

    //check if user can access course channel
    //if so carry on


    
    //display assignments
    //display lessons etc
    //parse variables to menu (rework in menu soon)


?>




    <div id="page-contents">
        <?php
        $data = getAssignments($course);
        foreach($data as $row) {
            echo $row['id'] . " " . $row['title'];
        }
        ?>
    </div>

    <?php
        require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
        require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/postamble.php");
    ?>