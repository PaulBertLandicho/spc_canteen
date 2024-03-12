<?php
session_start(); // Start the session to access session variables

// Include your database connection file
include 'dbconn.php';

// Check if the product ID is provided in the URL
if(isset($_GET['cancel_product_id'])) {
    $cancel_product_id = $_GET['cancel_product_id'];

    // Check if the user is logged in
    if(!isset($_SESSION['user_id'])) {
       // Redirect the user to the cancel product list page
header('Location: cancelproductlist.php');
exit();

        exit();
    }

    // Get the user ID from the session
    $user_id = $_SESSION['user_id'];

    // Check if the product is in the cart
    $check_sql = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $cancel_product_id";
    $check_result = $conn->query($check_sql);

    if($check_result->num_rows > 0) {
        // Product is in the cart, so delete it
        $delete_sql = "DELETE FROM cart WHERE user_id = $user_id AND product_id = $cancel_product_id";
        if($conn->query($delete_sql) === TRUE) {
            // Redirect the user back to the page they were viewing (assuming it's the order page)
            header('Location: Orderhistory.php');
            exit();
        } else {
            // Handle the error accordingly
            echo "Error: " . $conn->error;
        }
    } else {
        // Product is not in the cart, display a message or redirect as needed
        echo "Product is not in the cart.";
    }
} else {
    // Redirect the user to an error page or handle the error accordingly
    header('Location: error_page.php');
    exit();
}
?>
