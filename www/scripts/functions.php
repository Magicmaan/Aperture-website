<?php
function enrol() {
	$enrolSuccess = true;
	$email = $_POST["email"];
	$password = md5($_POST["password"]);
	$password2 = md5($_POST["confpassword"]);
	if ($password != $password2) {
		return false;
	}
	$username = $_POST["username"];
	$forename = $_POST["forename"];
	$surname = $_POST["surname"];
	$userType = $_POST["userType"];
	$userType = 'admin';
	
	$image = null;
	
	$conn = mysqli_connect("localhost", "root", "root", "aperturebase");
	
	// Check connection
	if (!$conn) {
		echo "Connection failed: " . mysqli_connect_error();
		return false;
	}
	
	// Prepare the statement
	$stmt = mysqli_prepare($conn, "INSERT INTO users (email, password, username, forename, surname, type) VALUES (?, ?, ?, ?, ?, ?)");
	
	// Bind the parameters
	mysqli_stmt_bind_param($stmt, "ssssss", $email, $password, $username, $forename, $surname,$userType);
	
	// Execute the statement
	if (mysqli_stmt_execute($stmt)) {
		echo "Enrolment successful!";
	} else {
		echo "Enrolment failed with the following error message: " . mysqli_error($conn);
		$enrolSuccess = false;
	}
	
	// Close the statement and connection
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	
	return $enrolSuccess;
	}

	function login() {
		$loginSuccess = true;
		$email = $_POST["username"];
		$password = md5($_POST["password"]);

		$conn = mysqli_connect("localhost", "root", "root", "aperturebase");

		$sql = "SELECT * FROM users
				WHERE email='$email'
				AND password='$password'
				";
		$data = mysqli_query($conn, $sql);

		if (!$data) {
			echo "Error executing query: " . mysqli_error($conn);
			return;
		}


		$numRows = mysqli_num_rows($data);
		if ($numRows == 0) {
			$loginSuccess = false;
			$loginResult = "<p style='color: red'>LOGIN FAILED!!</p>";	
			return;
		}
		
		$row = mysqli_fetch_assoc($data);
        // Extract the 'id' field and assign it to $user_id
        $user_id = $row['id'];
		$username = $row['username'];

		$loginResult = "<p style='color: green'>You have successfully logged in as $username.</p>";

		session_start();
		$_SESSION["isLoggedIn"] = true;
		$_SESSION["username"] = $username;
		$_SESSION["user_id"] = $user_id;

		return $loginResult;
	}
	
	

	function getResource($resource_id) {
		// Check if $resource_id is set
		if (!isset($resource_id)) {
			return null; // or handle the case when $resource_id is not set
		}

		// Establish database connection
		$conn = mysqli_connect("localhost", "root", "root", "aperturebase");

		// Check if connection is successful
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		// Prepare SQL query
		$sql = "SELECT filepath FROM resources WHERE id = ?";
		$stmt = mysqli_prepare($conn, $sql);

		// Bind parameters
		mysqli_stmt_bind_param($stmt, "s", $resource_id);

		// Execute query
		mysqli_stmt_execute($stmt);

		// Get result
		$result = mysqli_stmt_get_result($stmt);

		// Check if there is any row returned
		if (mysqli_num_rows($result) > 0) {
			// Fetch the data
			$row = mysqli_fetch_assoc($result);
			// Output the filepath
			echo $row['filepath'];
		} else {
			echo "No result found.";
		}

		// Close statement and connection
		mysqli_stmt_close($stmt);
		mysqli_close($conn);
	}

	function addResource($filepath) {
		if (!isset($resource_url)) {
			return null; // or handle the case when $resource_id is not set
		}
		if (!file_exists($filepath)) {
			echo "File does not exist";
			return null;
		}

		$metadata = stat($filepath);
		echo "$metadata";
	}
?>