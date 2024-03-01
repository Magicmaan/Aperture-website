

<div id="menu">
	<?php
		require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/preamble.php");

		if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]) {
			echo '<div id="menu-title"> Welcome, ' . $_SESSION["username"] . ' ' . $_SESSION["user_id"] . '</div>';
		}
	?>
	<div id="menu-pullout" class="unselectable">
		<img src='../arrow.jpg'>
	</div>
	<div id="menu-content">
		<a href="/index.php">Homepage blah blah blah blah</a>
		<a href="/enrol.php">Enrol</a>
		<a href="/login.php">Login</a>
		<div class="menu-dropdown">
			<a href="#">Dropdown 1  blah blah blah blah </a>
			<div class="menu-dropdown-content">
                <a href="#">Submenu Item 1  blah blah blah blah</a>
                <a href="#">Submenu Item 2</a>
                <a href="#">Submenu Item 3</a>
            </div>
		</div>
		
		<a href="/logout.php">Logout</a>

		<div class="menu-dropdown">
			<a href="#">dropdown lvl 1</a>
			<div class="menu-dropdown-content">
                <a href="#">Submenu Item 1  blah blah blah blah</a>
				<div class="menu-dropdown">
					<a href="#">dropdown lvl 2</a>
					<div class="menu-dropdown-content">
                		<a href="#">Submenu Item 2</a>
                		<a href="#">Submenu Item 3</a>
					</div>
				</div>
            </div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {

		


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
		
		$('.menu-dropdown').each(function() {

			var trigger = $(this).children().first(); // Trigger / first element of dropdown menu
			trigger.text(trigger.text() + ' >');
			var content = $(this).find('.menu-dropdown-content'); // Get the dropdown content

			trigger.click(function(event) {
				event.preventDefault();
				// Toggle the visibility of the dropdown content
				content.toggleClass('active');
			});
		});

		//cool JQUERY AJAX stuff for future
		var userID = 1;

		// Make AJAX request to getData.php
		$.ajax({
			url: '/scripts/JQuery/getCourses.php',
			type: 'POST',
			success: function(data){
				$('#menu-title').css('background-image', 'url(' + data + ')');
			}	
		});

	});
</script>