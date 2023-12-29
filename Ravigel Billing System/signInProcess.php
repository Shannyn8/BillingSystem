<?php
session_start();
include 'database.php';

if (isset($_POST['signInUsername']) && isset($_POST['signInPassword'])) {
    $signInUsername = $_POST['signInUsername'];
    $signInPassword = $_POST['signInPassword'];
    $signInUsername = mysqli_real_escape_string($db_connect, $signInUsername);
    $signInPassword = mysqli_real_escape_string($db_connect, $signInPassword);

    $db_query = "SELECT * FROM users WHERE username = '$signInUsername' AND password = '$signInPassword'";
    $db_result = mysqli_query($db_connect, $db_query);

    if ($db_result) {
        if (mysqli_num_rows($db_result) > 0) {
            $row = mysqli_fetch_assoc($db_result);

            if ($row['is_disabled'] == 0) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['level'] = $row['level'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                header("Location: home.php");
                exit();
            } else {
                header("Location: index.php?disabled=true");
                exit();
            }
        } else {
            // Invalid username or password, display an error message
            header("Location: index.php?error=invalid");
            exit();
        }
    } else {
        // Handle the query error, display an error message
        echo "Error: " . mysqli_error($db_connect);
    }
} else {
    // Redirect to the login page if the form data is not set
    header("Location: index.php");
    exit();
}
?>
