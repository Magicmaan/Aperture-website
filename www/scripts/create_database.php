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
			status ENUM('active','suspended','banned'),
			reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	$sqlToken = "CREATE TABLE IF NOT EXISTS tokens (
		id INT AUTO_INCREMENT PRIMARY KEY,
		token VARCHAR(64),
		user_id INT NOT NULL,
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	$sqlUserData = "CREATE TABLE IF NOT EXISTS userdata (
		id INT AUTO_INCREMENT PRIMARY KEY,
		user_id INT NOT NULL,
		FOREIGN KEY (user_id) REFERENCES users(id),
		profilepicture int NOT NULL,
		FOREIGN KEY (profilepicture) REFERENCES resources(id),

		username VARCHAR(255) NOT NULL, -- Adjusted length for username
		forename VARCHAR(30) NOT NULL,
		surname VARCHAR(50) NOT NULL,
		type ENUM('student', 'instructor', 'admin') NOT NULL DEFAULT 'student',
		status ENUM('active','suspended','banned'),
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
		FOREIGN KEY (instructor_id) REFERENCES users(id),

		course_id INT NOT NULL,
		FOREIGN KEY (course_id) REFERENCES courses(id)
		
		
	)";
	$sqlAssignmentSubmission = "CREATE TABLE IF NOT EXISTS assignmentsubmissions (
		id INT AUTO_INCREMENT PRIMARY KEY,
		user_id INT NOT NULL,
		FOREIGN KEY (user_id) REFERENCES users(id),
	
		assignment_id INT NOT NULL,
		FOREIGN KEY (assignment_id) REFERENCES assignments(id),
	
		resource_id INT NOT NULL,
		FOREIGN KEY (resource_id) REFERENCES resources(id),
	
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	$sqlUploads = "CREATE TABLE IF NOT EXISTS uploads (
		id INT AUTO_INCREMENT PRIMARY KEY,
		user_id INT NOT NULL,
		FOREIGN KEY (user_id) REFERENCES users(id),
		resource_id INT NOT NULL,
		FOREIGN KEY (resource_id) REFERENCES resources(id),
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";


	/*Document table */
	$sqlDocument = "CREATE TABLE IF NOT EXISTS documents (
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

	$sqlResource = "CREATE TABLE IF NOT EXISTS resources (
		id INT AUTO_INCREMENT PRIMARY KEY,
		filename VARCHAR(512),
		filetype VARCHAR(100),
		filesize INT,
		filepath VARCHAR(512),
		reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";

	mysqli_query($conn, $sqlUser) or die("$sqlUser<br/>" . mysqli_error($conn));

	mysqli_query($conn, $sqlToken) or die("$sqlToken<br/>" . mysqli_error($conn));

	mysqli_query($conn, $sqlResource) or die("$sqlResource<br/>" . mysqli_error($conn));

	mysqli_query($conn, $sqlUserData) or die("$sqlUserData<br/>" . mysqli_error($conn));

	mysqli_query($conn, $sqlCourse) or die("$sqlCourse<br/>" . mysqli_error($conn));

	mysqli_query($conn, $sqlAssignment) or die("$sqlAssignment<br/>" . mysqli_error($conn));

	mysqli_query($conn, $sqlAssignmentSubmission) or die("$sqlAssignmentSubmission<br/>" . mysqli_error($conn));

	mysqli_query($conn, $sqlUploads) or die("$sqlUploads<br/>" . mysqli_error($conn));

	mysqli_query($conn, $sqlDocument) or die("$sqlDocument<br/>" . mysqli_error($conn));

	mysqli_query($conn, $sqlEnrollment) or die("$sqlEnrollment<br/>" . mysqli_error($conn));
	
	
	/*
	$sql = "INSERT INTO users(username, forename, surname)
						VALUES('08008784', 'Neil', 'Buckley'), 
							  ('23000000', 'Gertrude', 'Sillyface')";
	mysqli_query($conn, $sql) or die("$sql<br/>" . mysqli_error($conn));
	*/
?>