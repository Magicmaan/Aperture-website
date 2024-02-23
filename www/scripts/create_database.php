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


	/*Users table */
	$sqlUser = "CREATE TABLE IF NOT EXISTS users (
			id INT AUTO_INCREMENT PRIMARY KEY,
			email VARCHAR(100),
			password VARCHAR(255) NOT NULL,
			username VARCHAR(255) NOT NULL, -- Adjusted length for username
			forename VARCHAR(30) NOT NULL,
			surname VARCHAR(50) NOT NULL,
			type ENUM('student', 'instructor', 'admin') NOT NULL DEFAULT 'student',
			reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	/*Courses table */
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

	/*Assignment table */
	$sqlAssignment = "CREATE TABLE IF NOT EXISTS assignments (
		id INT AUTO_INCREMENT PRIMARY KEY,
		title VARCHAR(255) NOT NULL,
		description TEXT,
		start_date DATETIME,
		end_date DATETIME,
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
		instructor_id INT NOT NULL,
		course_id INT NOT NULL,
	
		FOREIGN KEY (instructor_id) REFERENCES users(id),
		FOREIGN KEY (course_id) REFERENCES courses(id)
	)";

	/*Book table */
	$sqlBook = "CREATE TABLE IF NOT EXISTS book (
		id INT AUTO_INCREMENT PRIMARY KEY,
		title VARCHAR(255) NOT NULL,
		description TEXT,
		start_date DATETIME,
		end_date DATETIME,
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	
		instructor_id INT NOT NULL,
		FOREIGN KEY (instructor_id) REFERENCES users(id),
	
		course_id INT NOT NULL,
		FOREIGN KEY (course_id) REFERENCES courses(id)
	)";

	$sqlEnrollment = "CREATE TABLE IF NOT EXISTS enrollments (
			id INT AUTO_INCREMENT PRIMARY KEY,
			read_access BOOLEAN DEFAULT 1, 
			write_access BOOLEAN DEFAULT 0,
			comment_access BOOLEAN DEFAULT 1,
			post_access BOOLEAN DEFAULT 0,
			admin_access BOOLEAN DEFAULT 1,
			reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			user_id INT,
			FOREIGN KEY (user_id) REFERENCES users(id),

			course_id INT NOT NULL,
			FOREIGN KEY (course_id) REFERENCES courses(id)
	)";
	mysqli_query($conn, $sqlUser) or die("$sqlUser<br/>" . mysqli_error($conn));
	mysqli_query($conn, $sqlCourse) or die("$sqlCourse<br/>" . mysqli_error($conn));
	mysqli_query($conn, $sqlAssignment) or die("$sqlAssignment<br/>" . mysqli_error($conn));
	mysqli_query($conn, $sqlBook) or die("$sqlBook<br/>" . mysqli_error($conn));
	mysqli_query($conn, $sqlEnrollment) or die("$sqlEnrollment<br/>" . mysqli_error($conn));

	/*
	$sql = "INSERT INTO users(username, forename, surname)
						VALUES('08008784', 'Neil', 'Buckley'), 
							  ('23000000', 'Gertrude', 'Sillyface')";
	mysqli_query($conn, $sql) or die("$sql<br/>" . mysqli_error($conn));
	*/
?>