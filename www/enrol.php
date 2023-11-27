<?php
	require_once("includes/preamble.php");

	$enrolResult = "";
	if (isset($_POST["username"])) $enrolResult = enrol();

	$pageTitle = "Enrol: Simple VLE"; 
	
	require_once("includes/header.php");
	require_once("includes/menu.php");
?>
<div id="contents">
	<?php
		if (isset($_POST["username"])) echo $enrolResult;
		else require_once("forms/enrol_form.php");
	?>
</div>

<?php
	require_once("includes/footer.php");
	require_once("includes/postamble.php");
?>