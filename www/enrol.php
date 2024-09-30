<?php
	

	

	$pageTitle = "Enrol"; 
	require_once("includes/preamble.php");
	
	$enrolResult = "";
	if (isset($_POST["username"])) $enrolResult = enrol();

	require_once("includes/header.php");
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