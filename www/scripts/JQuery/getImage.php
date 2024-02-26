<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/scripts/functions.php");

    if(isset($_GET['img'])) {
        // Retrieve the ID from the URL
        $imgid = $_GET['img'];
        // Use the ID in your script
    } else {
        echo null;
        return;
    }
       
    $conn = mysqli_connect("localhost", "root", "root", "aperturebase");
    $sql = "SELECT *
            FROM resources
            WHERE id = ?
    ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $imgid);
    mysqli_stmt_execute($stmt);
    $data = mysqli_stmt_get_result($stmt);
    if (!$data) {
        echo "Error executing query: " . mysqli_error($conn);
        return;
    }

    foreach ($data as $row) {
        if ($row["filetype"] == "image") {
            echo($row["filepath"]);
        }
        echo null;
    }
?>