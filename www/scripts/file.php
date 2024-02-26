<?php
	$pageTitle = "Simple VLE Homepage"; 
	require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/preamble.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/functions.php");
	
?>


<?php
// Check if the ID parameter is present in the URL
if(isset($_GET['id'])) {
    // Retrieve the ID from the URL
    $id = $_GET['id'];
    // Use the ID in your script
    echo "The ID passed in the URL is: " . $id;

    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");
    $sql = "SELECT * FROM resources
            WHERE id='$id'
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
        echo "Name: " . $row['name'] . "<br>";
        // Add other columns as needed
    }

    getResource($resource_id);


} else {
    // If ID parameter is not present in the URL, handle it accordingly
    echo "No ID parameter found in the URL.";
}
?>