<?php
function enrol() {
		$enrolSuccess = true;
		$username = $_POST["username"];
		$forename = $_POST["forename"];
		$surname = $_POST["surname"];
		$userType = $_POST["userType"];
		$password = md5($_POST["password"]);

		$conn = mysqli_connect("localhost", "root", "root", "aperturebase");

		$sql = "INSERT INTO users
				VALUES('$username', '$forename', '$surname', '$userType', '$password')";
		if (!mysqli_query($conn, $sql)) {
			$enrolSuccess = false;
			$enrolResult = "<p style='color: red;'>Enrolment failed with the following error message: </p>" . mysqli_error($conn);
		}
		else $enrolResult = "<p style='color: green;'>You have successfully enrolled.</p>";

		return $enrolResult;
	}

	function login() {
		$loginSuccess = true;
		$username = $_POST["username"];
		$password = md5($_POST["password"]);

		$conn = mysqli_connect("localhost", "root", "root", "aperturebase");

		$sql = "SELECT * FROM users
				WHERE username='$username'
				AND password='$password'";
		$data = mysqli_query($conn, $sql);
		$numRows = mysqli_num_rows($data);

		if ($numRows == 0) {
			$loginSuccess = false;
			$loginResult = "<p style='color: red'>LOGIN FAILED!!</p>";	
		}
		else {
			$loginResult = "<p style='color: green'>You have successfully logged in as $username.</p>";

			session_start();
			$_SESSION["isLoggedIn"] = true;
			$_SESSION["username"] = $username;

			return $loginResult;
		}
	}
?>