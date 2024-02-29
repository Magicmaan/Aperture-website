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
                echo '<div class="card" id="' . $courseData["id"] . '"> 
                    <a href= http://localhost/courses/view.php?c=' . $courseData["id"] . '></a>
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

<script>
	$(document).ready(function() {

		$('.card').each(function() {
            var courseID = $(this).attr('id');
            $(this).find('.card-title').text(courseID + ' JQ');

		});


		// Menu pullout
		var Menu = document.getElementById('menu');
		var MenuPullout = document.getElementById('menu-pullout');
		var MenuContent = document.getElementById('menu-content');
		$("#menu-pullout").click(function() {
			Menu.classList.toggle('active');
			MenuPullout.classList.toggle('active');
		});

		$('#menu-content a').each(function() {
			// Update the text content of each <a> tag
			$(this).text("• " + $(this).text());
    	});



		// Menu dropdowns
		
		

		//cool JQUERY AJAX stuff for future
		var userID = 1;

		// Make AJAX request to getData.php
		$.ajax({
			url: 'scripts/JQuery/getCourses.php',
			type: 'POST',
			success: function(data){
				// Update the webpage with the returned data
				// Example: $('#result').html(data);
				console.log("boo");
				console.log(data);
				$('#menu-title').css('background-image', 'url(' + data + ')');
			}	
		});

	});
</script>



<?php
	
	require_once("../includes/postamble.php");
?>


