<?php
// Check if the ID parameter is present in the URL
if(isset($_GET['course'])) {
    // Retrieve the ID from the URL
    $course = $_GET['course'];
    // Use the ID in your script
    echo "The ID passed in the URL is: " . $course;
    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");
    $sql = "SELECT * FROM courses
            WHERE id='$course'
            ";
    $data = mysqli_query($conn, $sql);
    if (!$data) {
        echo "Error executing query: " . mysqli_error($conn);
        return;
    }
    $numRows = mysqli_num_rows($data);
    if ($numRows == 0) {
        $loginSuccess = false;
        echo "File not found" . mysqli_error($conn);
        return;
    }
    while ($row = mysqli_fetch_assoc($data)) {
        echo "ID: " . $row['id'] . "<br>";
        echo "Name: " . $row['title'] . "<br>";
        // Add other columns as needed
    }
} else {
    // If ID parameter is not present in the URL, handle it accordingly
    echo "No ID parameter found in the URL.";
}
?>