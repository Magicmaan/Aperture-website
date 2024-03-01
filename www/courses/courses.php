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
                echo '<a href= view.php?c=' . $courseData["id"] . '>
						<div class="card" id="' . $courseData["id"] . '"> 
						
						<h2 class="card-title">' . $courseData['title'] . '</h2>
							<div class="card-contents card-subsection">
							</div>
							<div class="card-divider"></div>
						</div>
					</a>
                ';
                // Output other course details as needed
            }
        ?>
    </div>
</div>

<script>
	$(document).ready(function() {


		$('.card').each(function() {
            const courseID = $(this).attr('id');
            


			var img = $('<img>', {
				src: '/resources/courses/' + courseID + '/splash.png', 
				alt: 'Image for card: ' + courseID
			});
			var settingsbar = $('<div class="courses-bar">	</div>');



			$(this).find('.card-contents').append(img);
			$(this).append(settingsbar);
			$(this).find('.courses-bar').text(courseID);
			$(this).find('.courses-bar').append('<a href= settings.php?c=' + courseID + '>Settings</a>');

		});

		

	});
</script>



<?php
	
	require_once("../includes/postamble.php");
?>


