<?php
include 'database.php';

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
    $query = "UPDATE users SET is_disabled = 1 WHERE id = $userId";
    mysqli_query($db_connect, $query);
    header("Location: users.php");
    exit();
}
?>
