<?php
session_start(); // Start the session to access session variables

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page or display an error message
    exit();
}

// Include your database connection file
include 'dbconn.php';

// Check if the delete action is triggered and delete_product_id is an array
if(isset($_POST['delete_product_id']) && is_array($_POST['delete_product_id'])) {
    // Get the user ID
    $user_id = $_SESSION['user_id'];
    // Sanitize and implode the array of product IDs for the SQL query
    $delete_product_ids = implode(",", array_map('intval', $_POST['delete_product_id']));
    // Delete the products from the cart
    $delete_sql = "DELETE FROM cart WHERE user_id = $user_id AND product_id IN ($delete_product_ids)";
    if($conn->query($delete_sql) === TRUE) {
        // Redirect back to this page after deletion
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // Handle the error accordingly
        echo "Error deleting products: " . $conn->error;
    }
}

// Check if the order readiness is submitted
if(isset($_POST['order_ready'])) {
    // Loop through submitted readiness status
    foreach($_POST['order_ready'] as $product_id => $ready_status) {
        // Update readiness status in the database
        $ready_sql = "UPDATE cart SET ready = $ready_status WHERE product_id = $product_id";
        $conn->query($ready_sql);
    }
}

// Retrieve all unique user IDs and usernames from the cart table
$sql_users = "SELECT DISTINCT cart.user_id, user.username FROM cart INNER JOIN user ON cart.user_id = user.id";
$result_users = $conn->query($sql_users);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order List</title>
    <!-- Add your CSS links here -->
    <link rel="stylesheet" href="orderlist.php">
</head>
<body>
    <h1>Order List</h1>
    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php
        // Check if there are any users with items in their cart
        if ($result_users->num_rows > 0) {
            // Loop through each user and their cart
            while ($row_user = $result_users->fetch_assoc()) {
                // Get the user ID and username
                $user_id = $row_user['user_id'];
                $username = $row_user['username'];
                // Retrieve all products in the user's cart based on their user_id
                $sql_cart = "SELECT product.*, cart.quantity, cart.ready FROM product INNER JOIN cart ON product.id = cart.product_id WHERE cart.user_id = $user_id";
                $result_cart = $conn->query($sql_cart);
                // Initialize total price variable
                $total_price = 0;
                // Display the user's cart
                echo '<h2 style="font-text:bold;"> Order By: ' . $username . '</h2>';
                echo '<div class="user-cart">';
                // Check if products are found in the user's cart
                if ($result_cart->num_rows > 0) {
                    // Display the products in the cart
                    while ($row = $result_cart->fetch_assoc()) {
                        // Display product details
                        echo '<div class="product">';
                        echo '<h3 style="color:maroon;">' . $row['name'] . '</h3>';
                        echo '<p>Price: ₱' . $row['price'] . '</p>';
                        echo '<p>Quantity: ' . $row['quantity'] . '</p>';
                        // Calculate and display the total price for this product
                        $product_price = $row['price'] * $row['quantity'];
                        $total_price += $product_price; // Add to total price
                        echo '<p>Total: ₱' . $product_price . '</p>';
                        // Add radio buttons for order readiness
                        echo '<label><input type="radio" name="order_ready[' . $row['id'] . ']" value="1" ' . ($row['ready'] == 1 ? 'checked' : '') . '> Ready</label>';
                        echo '<label><input type="radio" name="order_ready[' . $row['id'] . ']" value="0" ' . ($row['ready'] == 0 ? 'checked' : '') . '> Not Ready</label>';
                        // Add checkbox for delete action
                        echo '<input type="checkbox" name="delete_product_id[]" value="' . $row['id'] . '"> Done';

                        echo '</div>';
                    }
                    // Display total price for the user's cart
                    echo '<div>Total Payment: ₱' . $total_price . '</div><br>';
                } else {
                    // If the user's cart is empty, display a message to the user
                    echo "<p>This user's cart is empty.</p>";
                }
                echo '</div>'; // Close user-cart div
            }
            // Add delete button
            echo '<input type="submit" name="submit" value="Delete Selected">';
            echo '<input type="submit" name="submit" value="Update Order">';
        } else {
            // If no users have items in their cart, display a message
            echo "<p>No users have items in their cart.</p>";
        }
        ?>
    </form>
</body>
</html>
