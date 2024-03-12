<?php
include 'dbconn.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: Payment.php?error=Please login first");
    exit();
}	

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $status = $_POST['status']; // Get the selected status from the form

    // Update the user's status in the database
    $sql = "UPDATE cart SET status='$status' WHERE cart_id='$user_id'";
    if ($conn->query($sql) === TRUE) {
        // Redirect to user dashboard or any other page
        header("Location: myqrcode.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
