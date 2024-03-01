<?php
	$pageTitle = "Login"; 
	require_once("includes/preamble.php");

	$loginResult = "";
	if (isset($_POST["username"])) $loginResult = login();

	
	require_once("includes/header.php");

?>
<div id="contents">
	<?php
		if (isset($_POST["username"])) echo $loginResult;
		else require_once("forms/login_form.php");
	?>
</div>

<?php
	require_once("includes/footer.php");
	require_once("includes/postamble.php");
?>