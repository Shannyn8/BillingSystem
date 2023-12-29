<?php
    session_start();
    include 'database.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_id'])) {
        $userId = $_GET['user_id'];
        $query = "DELETE FROM users WHERE id = $userId";
        $result = mysqli_query($db_connect, $query);

        if ($result) {
            echo 'User deleted successfully';
        } else {
            die("Error deleting user: " . mysqli_error($db_connect));
        }
    } else {
        echo 'Invalid request';
    }
    header("Location: users.php"); 
?>
