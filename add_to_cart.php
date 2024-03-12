<?php
session_start(); // Start the session to access session variables

// Include your database connection file
include 'dbconn.php';

// Check if the product ID is provided in the URL
if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Check if the product ID is valid (you may need additional validation here)
    // For example, checking if it exists in your database

    // If the product ID is valid, add it to the cart table
    if(!isset($_SESSION['user_id'])) {
        // If user is not logged in, redirect to login page or handle the error accordingly
        header('Location: login.php');
        exit();
    }

    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Check if the product is already in the cart
    $check_sql = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $check_result = $conn->query($check_sql);

    if($check_result->num_rows > 0) {
        // If the product is already in the cart, you may want to update the quantity or display a message
        header('Location: Order.php');
        exit();
    } else {
        // Product is not in the cart, so add it
        $insert_sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)";
        if($conn->query($insert_sql) === TRUE) {
            // Redirect the user back to the page they were viewing (assuming it's the product list page)
            header('Location: Order.php');
            exit();
        } else {
            // Handle the error accordingly
            echo "Error: " . $conn->error;
        }
    }
} else {
    // Redirect the user to an error page or handle the error accordingly
    header('Location: error_page.php');
    exit();
}
?>