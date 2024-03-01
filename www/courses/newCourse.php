<?php

	$pageTitle = "New Course"; 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/preamble.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/header.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/menu.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/functions.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/courses/coursefunctions.php");

    if (!isset($_SESSION["isLoggedIn"]) && !$_SESSION["isLoggedIn"]) {
        return;
    }
?>
<div id="contents">
	<?php
		
        require_once($_SERVER['DOCUMENT_ROOT'] . "/forms/course_form.php");
	?>
</div>

<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/postamble.php");
?>