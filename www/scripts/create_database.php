<?php
	$conn = mysqli_connect("localhost", "root", "root");

	$sql = "CREATE DATABASE IF NOT EXISTS aperturebase";
	if (mysqli_query($conn, $sql)) {
		echo "<p>SUCCESSFULLY CREATED DATABASE.</p>";
	}
	else {
		echo "<p>Database creation failed: " . mysqli_error($conn) . "</p>";
	}

	$sql = "USE aperturebase";
	mysqli_query($conn, $sql) or die("$sql<br/>" . mysqli_error($conn));


	$sql = "CREATE TABLE IF NOT EXISTS users (
				username VARCHAR(8) PRIMARY KEY,
				forename VARCHAR(30) NOT NULL,
				surname VARCHAR(50) NOT NULL,
				type VARCHAR(7) NOT NULL,
				password VARCHAR(255) NOT NULL
	        )";
	mysqli_query($conn, $sql) or die("$sql<br/>" . mysqli_error($conn));

	/*
	$sql = "INSERT INTO users(username, forename, surname)
						VALUES('08008784', 'Neil', 'Buckley'), 
							  ('23000000', 'Gertrude', 'Sillyface')";
	mysqli_query($conn, $sql) or die("$sql<br/>" . mysqli_error($conn));
	*/
?>