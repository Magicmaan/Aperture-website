<?php
    //courses.php will display all courses of user
    


	$pageTitle = "Simple VLE Homepage"; 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/preamble.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/menu.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/functions.php");
?>


<div id="page-contents">
    <div id="page-header">
        <h1 id="page-title">Courses</h1>

    </div>

    

    <div class="card-row">
        <div class="card">
            <h2 class="card-title">Assignments</h2>
            <div class="card-contents card-subsection">
            
            </div>
            <div class="card-divider"></div>
            <div class="card-files card-subsection">
                <a href="default-pfp.png" download>Boo<a>
            </div>
        </div>

        <div class="card">
            <h2 class="card-title">Assignments</h2>
            <div class="card-contents card-subsection">
            
            </div>
            <div class="card-divider"></div>
            <div class="card-files card-subsection">
                <a href="default-pfp.png" download>Boo<a>
            </div>
        </div>
    </div>
    <div class="card-row">
        <div class="card">
            <h2 class="card-title">Assignments</h2>
            <div class="card-contents card-subsection">
            
            </div>
            <div class="card-divider"></div>
            <div class="card-files card-subsection">
                <a href="default-pfp.png" download>Boo<a>
            </div>
        </div>

        <div class="card">
            <h2 class="card-title">Assignments</h2>
            <div class="card-contents card-subsection">
            
            </div>
            <div class="card-divider"></div>
            <div class="card-files card-subsection">
                <a href="default-pfp.png" download>Boo<a>
            </div>
        </div>
    </div>
</div>

<?php
	$data = getEnrollments();

    if (!isset($data)) {
        echo "No Courses found";
        return;
    }
// Output the data
while ($row = mysqli_fetch_assoc($data)) {
    $course_id = $row['course_id']; // Corrected variable name

    $sqlnew = "SELECT * FROM courses WHERE id = ?";
    $stmtnew = mysqli_prepare($conn, $sqlnew);
    mysqli_stmt_bind_param($stmtnew, "s", $course_id); // Corrected variable name
    mysqli_stmt_execute($stmtnew);
    $courseData = mysqli_stmt_get_result($stmtnew);

    if (!$courseData) {
        echo "Error executing query: " . mysqli_error($conn);
        return;
    }

    // Fetch course data
    $courseRow = mysqli_fetch_assoc($courseData);
    echo  "<a href= " . $_SERVER['DOCUMENT_ROOT'] . '/courses/view.php?course='. $courseRow['id']. ">" . $courseRow['id'] . ": ". $courseRow['title'] . "</a> <br>" ;
}

?>



<?php
	
	require_once("../includes/postamble.php");
?>


