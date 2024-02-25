<?php
    //courses.php will display all courses of user
    


	$pageTitle = "Simple VLE Homepage"; 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/preamble.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/menu.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/functions.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/courses/coursefunctions.php");
?>


<div id="page-contents">

    <div id="page-header">
        <h1 id="page-title">Courses</h1>
    </div>

    
    <div class="card-container">
        <?php
            getEnrollments();
            getCourses();
            // Output the data
            foreach ($_SESSION['getCourses'] as $course_id => $courseData) {
                echo '<div class="card"> 
                    <a href= http://localhost/courses/view.php?c='. $courseData["id"]. '></a>
                    <h2 class="card-title">' . $courseData['title'] . '</h2>
                        <div class="card-contents card-subsection">
                        </div>
                        <div class="card-divider"></div>
                    </div>
                ';
                // Output other course details as needed
            }
        ?>

    </div>
</div>





<?php
	
	require_once("../includes/postamble.php");
?>


