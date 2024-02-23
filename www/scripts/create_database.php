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


	$sqlUsers = "CREATE TABLE IF NOT EXISTS users (
				id INT AUTO_INCREMENT PRIMARY KEY,
				email VARCHAR(100),
				password VARCHAR(255) NOT NULL,
				username VARCHAR(8) NOT NULL,
				forename VARCHAR(30) NOT NULL,
				surname VARCHAR(50) NOT NULL,
				type ENUM('student', 'instructor', 'admin') NOT NULL DEFAULT 'student',
				reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	)";
	
	$sqlCourse = "CREATE TABLE IF NOT EXISTS courses (
				id INT AUTO_INCREMENT PRIMARY KEY,
				title VARCHAR(255) NOT NULL,
				description TEXT,
				
				start_date DATETIME,
				end_date DATETIME,
				reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				instructor_id INT NOT NULL,
				FOREIGN KEY (instructor_id) REFERENCES users(id)
	)";

	mysqli_query($conn, $sql) or die("$sql<br/>" . mysqli_error($conn));

	/*
	$sql = "INSERT INTO users(username, forename, surname)
						VALUES('08008784', 'Neil', 'Buckley'), 
							  ('23000000', 'Gertrude', 'Sillyface')";
	mysqli_query($conn, $sql) or die("$sql<br/>" . mysqli_error($conn));
	*/
?>