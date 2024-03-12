<?php
session_start(); // Start the session to access session variables

// Include your database connection file
include 'dbconn.php';


// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Retrieve all canceled products for the user from the database
$canceled_products_sql = "SELECT product.*, cart.order_date FROM product INNER JOIN cart ON product.id = cart.product_id WHERE cart.user_id = $user_id AND cart.canceled = 1";
$canceled_products_result = $conn->query($canceled_products_sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cancel Product List</title>
    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="your_styles.css">
</head>
<body>

<div class="canceled-products">
    <h2>Cancel Product List</h2>
    <?php
    // Check if canceled products are found
    if ($canceled_products_result->num_rows > 0) {
        // Display the canceled products
        while ($row = $canceled_products_result->fetch_assoc()) {
            echo '<div class="canceled-product">';
            echo '<h3>' . $row['name'] . '</h3>';
            echo '<p>Price: ₱' . $row['price'] . '</p>';
            echo '<p>Order Date: ' . $row['order_date'] . '</p>';
            // Add more details or formatting as needed
            echo '</div>';
        }
    } else {
        // If no canceled products are found, display a message
        echo "<p>No canceled products.</p>";
    }
    ?>
</div>

</body>
</html>
