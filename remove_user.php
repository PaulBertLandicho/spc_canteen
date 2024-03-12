<?php
if(isset($_GET['id'])) {
    // Fetch the user ID from the URL parameter
    $user_id = $_GET['id'];
    
    // Proceed with removing the user from the database
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "spc_canteen";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to delete related cart records
    $delete_cart_sql = "DELETE FROM cart WHERE user_id = $user_id";
    if ($conn->query($delete_cart_sql) === TRUE) {
        // Proceed with deleting the user
        $delete_user_sql = "DELETE FROM user WHERE id = $user_id";
        if ($conn->query($delete_user_sql) === TRUE) {
            // User deleted successfully, redirect back to Manage_users.php
            header("Location: Manage_users.php");
            exit(); // Ensure script execution stops after redirection
        } else {
            echo "Error deleting user: " . $conn->error;
        }
    } else {
        echo "Error deleting cart records: " . $conn->error;
    }

    // Close connection
    $conn->close();
} else {
    // Handle case where user ID is not provided
    echo "User ID not provided.";
}
?>
