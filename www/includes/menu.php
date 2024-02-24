<div id="menu">
	<?php
		if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]) {
			echo '<div id="menu-title"> Welcome, ' . $_SESSION["username"] . ' ' . $_SESSION["user_id"] . '</div>';
		}
	?>
	<div id="menu-pullout" class="unselectable">
		<img src='../arrow.jpg'>
	</div>
	<div id="menu-content">
		<a href="index.php">Homepage blah blah blah blah</a>
		<a href="enrol.php">Enrol</a>
		<a href="login.php">Login</a>
		<div class="menu-dropdown">
			<a href="#">Dropdown 1  blah blah blah blah </a>
			<div class="menu-dropdown-content">
                <a href="#">Submenu Item 1  blah blah blah blah</a>
                <a href="#">Submenu Item 2</a>
                <a href="#">Submenu Item 3</a>
            </div>
		</div>
		
		<a href="logout.php">Logout</a>

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
		<a href="logout.php">Logout</a>
		<a href="logout.php">Logout</a>
		<a href="logout.php">Logout</a>
		<a href="logout.php">Logout</a>
		<a href="logout.php">Logout</a>
		<a href="logout.php">Logout</a>
		<a href="logout.php">Logout</a>
		<a href="logout.php">Logout</a>
		<a href="logout.php">Logout</a>
		<a href="logout.php">Logout</a>
		<a href="logout.php">Logout</a>	
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {

		// Menu pullout
		var Menu = document.getElementById('menu');
		var MenuPullout = document.getElementById('menu-pullout');
		var MenuContent = document.getElementById('menu-content');
		MenuPullout.addEventListener('click', function() {
			Menu.classList.toggle('active');
			MenuPullout.classList.toggle('active');
		});

		var links = document.querySelectorAll('#menu-content a');

		// Iterate over each <a> tag
		links.forEach(function(link) {
			// Append "EEE" to the start of textContent
			link.textContent = "• " + link.textContent;
		});




		// Menu dropdowns
		var dropdowns = document.querySelectorAll('.menu-dropdown');

		dropdowns.forEach(function(dropdown) {
			var trigger = dropdown.firstElementChild; //trigger
			trigger.textContent = trigger.textContent + ' >';
			var content = dropdown.querySelector('.menu-dropdown-content'); // Get the dropdown content

			trigger.addEventListener('click', function(event) {
				event.preventDefault();
				// Toggle the visibility of the dropdown content
				content.classList.toggle('active');
			});
		});
	});
</script>