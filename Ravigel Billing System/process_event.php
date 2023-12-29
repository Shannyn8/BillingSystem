<?php
session_start();
include 'database.php';

// Check if the form is submitted
if (isset($_POST['upload'])) {
    // Validate and sanitize inputs
    $eventName = mysqli_real_escape_string($db_connect, $_POST['eventName']);
    $price = mysqli_real_escape_string($db_connect, $_POST['price']);

    // File upload handling
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./images/" . $filename;

    // Move the uploaded image to the folder
    if (move_uploaded_file($tempname, $folder)) {
        // Insert data into the "events" table
        $db_query = "INSERT INTO events (name, price, picture) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($db_connect, $db_query);
        mysqli_stmt_bind_param($stmt, "sss", $eventName, $price, $filename);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<h3>Event added successfully!</h3>";
        } else {
            echo "<h3>Failed to add event!</h3>";
        }

        mysqli_stmt_close($stmt);
        header("Location: home.php");
    } else {
        echo "<h3>Failed to upload image!</h3>";
        header("Location: home.php");
    }
}

mysqli_close($db_connect);
?>