<?php
session_start();
include 'database.php';

if (
    !empty($_POST['signUpUsername']) &&
    !empty($_POST['signUpPassword']) &&
    !empty($_POST['confirmPassword']) &&
    !empty($_POST['signUpFirstName']) &&
    !empty($_POST['signUpLastName']) &&
    !empty($_POST['signUpGender']) &&
    !empty($_POST['signUpPhone']) &&
    !empty($_POST['signUpEmail'])
) {
    $signUpUsername = mysqli_real_escape_string($db_connect, $_POST['signUpUsername']);

    if (!preg_match("/^[a-zA-Z0-9_]+$/", $signUpUsername)) {
        $_SESSION['message'] = 'Invalid username format';
        header("Location: index.php");
        exit();
    }

    $signUpPassword = $_POST['signUpPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $signUpPassword)) {
        $_SESSION['message'] = 'Invalid password format';
        header("Location: index.php");
        exit();
    }

    $signUpFirstName = mysqli_real_escape_string($db_connect, $_POST['signUpFirstName']);
    $signUpLastName = mysqli_real_escape_string($db_connect, $_POST['signUpLastName']);
    $signUpGender = $_POST['signUpGender'];
    $signUpPhone = mysqli_real_escape_string($db_connect, $_POST['signUpPhone']);
    $signUpEmail = mysqli_real_escape_string($db_connect, $_POST['signUpEmail']);

    if (!preg_match("/^[a-zA-Z ]+$/", $signUpFirstName)) {
        $_SESSION['message'] = 'Invalid first name format';
        header("Location: index.php");
        exit();
    }
    if (!preg_match("/^[a-zA-Z ]+$/", $signUpLastName)) {
        $_SESSION['message'] = 'Invalid last name format';
        header("Location: index.php");
        exit();
    }
    if (!empty($signUpPhone) && !preg_match("/^\d{11}$/", $signUpPhone)) {
        $_SESSION['message'] = 'Invalid phone number format (must be 11 digits)';
        header("Location: index.php");
        exit();
    }

    if ($signUpPassword == $confirmPassword) {
        $db_query = "INSERT INTO users (username, password, firstname, lastname, gender, phone, email) 
                     VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($db_connect, $db_query);
        mysqli_stmt_bind_param($stmt, "sssssss", $signUpUsername, $signUpPassword, $signUpFirstName, $signUpLastName, $signUpGender, $signUpPhone, $signUpEmail);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['message'] = 'Account created successfully';
            header("Location: index.php");
        } else {
            $_SESSION['message'] = 'Error creating account';
            header("Location: index.php");
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['message'] = 'Passwords do not match';
        header("Location: index.php");
    }
} else {
    $_SESSION['message'] = 'All fields are required';
    header("Location: index.php");
}
?>
