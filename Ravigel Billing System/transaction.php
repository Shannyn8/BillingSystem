<?php
session_start();
include 'database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event = $_POST['event'];
    $price = $_POST['price'];
    $payment = $_POST['payment'];
    $buyerID = $_SESSION['id'];
    $query = "INSERT INTO transaction (event, user, price, payment, date) 
              VALUES ('$event', '$buyerID', '$price', '$payment', NOW())";
    mysqli_query($db_connect, $query);
    echo '<script>';
    echo 'alert("Item Bought Successfully!");';
    echo 'setTimeout(function() {';
    echo '    window.location.href = "home.php";';
    echo '}, 3000);';  // 3000 milliseconds (3 seconds) delay
    echo '</script>';
} else {
    echo 'Invalid transaction request';
    echo $event;
    echo $price;
    echo $buyerID;
    echo $payment;
}
?>