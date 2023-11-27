<?php
	$pageTitle = "Simple VLE Homepage"; 
	require_once("includes/preamble.php");
	require_once("includes/header.php");
	require_once("includes/menu.php");
?>

<div id="contents">
	<?php
		session_start();
		session_destroy();
		echo "<p>YOU HAVE SUCCESSFULLY LOGGED OUT.</p>";
	?>	
</div>

<?php
	require_once("includes/footer.php");
	require_once("includes/postamble.php");
?>