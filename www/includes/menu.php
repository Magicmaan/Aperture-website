<div id="menu">
	<?php
		session_start();
		if (isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"]) {
			echo "Welcome, " . $_SESSION["isLoggedIn"];
		}
	?>

	<a href="index.php">Homepage</a>
	<a href="enrol.php">Enrol</a>
	<a href="login.php">Login</a>
	<a href="logout.php">Logout</a>
</div>