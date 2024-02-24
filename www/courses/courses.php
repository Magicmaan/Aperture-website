<?php
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

    <div id="card-row">
        <div id="card">
            <h2 id="card-title">Assignments</h2>
            <div id="card-contents" class="card-subsection">
            
            </div>
        </div>
    </div>

    <div id="card-row">
        <div id="card">
            <h2 id="card-title">Assignments</h2>
            <div id="card-contents" class="card-subsection">
            
            </div>
            <div id="card-divider"></div>
            <div id="card-files" class="card-subsection">
                <a href="default-pfp.png" download>Boo<a>
            </div>
        </div>

        <div id="card">
            <h2 id="card-title">Assignments</h2>
            <div id="card-contents" class="card-subsection">
            
            </div>
            <div id="card-divider"></div>
            <div id="card-files" class="card-subsection">
                <a href="default-pfp.png" download>Boo<a>
            </div>
        </div>
    </div>
</div>

<?php
    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");
		
	$data = getEnrollments();
    


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


