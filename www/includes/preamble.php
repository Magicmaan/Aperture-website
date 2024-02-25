<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/functions.php");

	session_start();
	$_SESSION['cacheTimeout'] = 5;

	if ($_SESSION['cacheTimer'] > $_SESSION['cacheTimeout']++) {
		$_SESSION['cacheTimer'] = 0;
	}

	if(isset($_SESSION['cacheTimer'])) {
		// Increment the counter
		$_SESSION['cacheTimer']++;
	} else {
		// Initialize the counter
		$_SESSION['cacheTimer'] = 0;
	}
	echo $_SESSION['cacheTimer'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $pageTitle;?></title>
	<link rel="stylesheet" href="../styles/styles.css" type="text/css"/>
	<script src="https://kit.fontawesome.com/1cc2316f60.js" crossorigin="anonymous"></script>
</head>
<body>
