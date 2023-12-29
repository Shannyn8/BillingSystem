<?php
session_start();
include 'database.php';

if ($_SESSION['level'] === "Admin" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Perform the DELETE operation
    $query = "DELETE FROM events WHERE id = $id";
    mysqli_query($db_connect, $query);

    // Redirect back to the events page
    header("Location: home.php");
    exit();
} else {
    // Redirect to an error page or home page
    header("Location: test.php");
    exit();
}
?>