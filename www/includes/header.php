<div class="header-container">
	<div class="header">
		<div class="logo-container">
			<img class="icon" src="../icon.png">
			<p class="name unselectable">APERTURE</p>
		</div>
		<div class="buttons-container">
			<a href="../index.php" class="button button-large">Home</a>
			<?php
				if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]) { //if logged in do this else that 
					echo '<a href="../dashboard.php" class="button button-large">Dashboard</a>';
					echo '<a href="../courses/courses.php" class="button button-large">Courses</a>';
				} else {
					echo '<a class="button button-large" href="enrol.php">Enrol</a>';
					echo '<a class="button button-large" href="login.php">Login</a>';
				}
			?>
			
			
			<div class="button button-widget Profile-picture">
				<i class="fa-regular fa-circle-user"></i>
			</div>
			<div class="button button-widget Settings">
				<i class="fa-regular fa-circle-user fa-2xl"></i>
			</div>
		
		</div>
	</div>
</div>
