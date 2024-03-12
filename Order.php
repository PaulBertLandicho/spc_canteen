<?php
session_start(); // Start the session to access session variables

// Include your database connection file
include 'dbconn.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If user is not logged in, redirect to login page or handle the error accordingly
    header('Location: login.php');
    exit();
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Check if the product ID is provided in the URL for deletion
if(isset($_GET['delete_product_id'])) {
    $delete_product_id = $_GET['delete_product_id'];

    // Delete the product from the cart
    $delete_sql = "DELETE FROM cart WHERE user_id = $user_id AND product_id = $delete_product_id";
    if($conn->query($delete_sql) === TRUE) {
        // Redirect back to this page after deletion
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // Handle the error accordingly
        echo "Error deleting product: " . $conn->error;
    }
}

// Check if the product ID and quantity are provided in the URL for updating quantity
if(isset($_GET['update_quantity_id']) && isset($_GET['new_quantity'])) {
    $update_product_id = $_GET['update_quantity_id'];
    $new_quantity = $_GET['new_quantity'];

    // Update the quantity of the product in the cart
    $update_sql = "UPDATE cart SET quantity = $new_quantity WHERE user_id = $user_id AND product_id = $update_product_id";
    if($conn->query($update_sql) === TRUE) {
        // Redirect back to this page after updating quantity
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // Handle the error accordingly
        echo "Error updating quantity: " . $conn->error;
    }
}

// Retrieve all products in the user's cart based on their user_id
$sql = "SELECT product.*, cart.quantity, cart.ready FROM product INNER JOIN cart ON product.id = cart.product_id WHERE cart.user_id = $user_id";
$result = $conn->query($sql);

// Initialize total price variable
$total_price = 0;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="user_dashboard.css">

</head>
<body>
<style>
    body { margin-top: 10px; }

    /* Media query for responsiveness */
    @media screen and (max-width: 768px) {
        .iconbar {
            display: show; /* Hide the icon bar on smaller screens */
        }
    }

    .iconbar {
        width: 100%;
        background-color: maroon;
        overflow: auto;
        margin-top: 650px;
    }

    .iconbar a {
        float: left;
        width: 20%;
        text-align: center;
        padding: 12px 0;
        transition: all 0.3s ease;
        color: white;
        font-size: 25px;
    }

    .product-container {
        display: flex;
        margin-bottom: 20px;
        margin-left:17px;
        width:590px;
        padding:10px;
        height:164px;
    }

    .product-image {
        margin-right: 20px;
    }

    .product-details {
        flex-grow: 1;
    }

    .product-details form {
        display: flex;
        align-items: center;
    }

    .quantity-input {
        width: 50px;
        height:20px;
        text-align: center;
        margin: 0 10px;
    }
    .button-maroon {
      background-color: maroon;
    border-radius: 50px;
}
.container {
    display: flex;
    justify-content: flex-end; /* Align items to the right side */
}

</style>

<div><br><br>
    <center><h2><b>MY ORDER</b></center></h2><br>
    <div class="form-group">
    <a class="btn btn-primary" href="Payment.php" style="margin-bottom:5px;background-color: maroon; width: 150px; margin-left:240px; color: white; border-color:maroon; border-radius:10px; height:45px; font-size:20px;" role="button">Place Order</a>
</div>
    <?php
    // Check if products are found in the cart
    if ($result->num_rows > 0) {
        // Display the products
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product-container">';
            echo '<div class="product-image">';
            echo '<img src="' . $row['image'] . '" alt="Product Image" style="width: 150px; height: 100px; border-radius: 15px;"><br>';
            echo '</div>';
            echo '<div class="product-details">';
            echo '<span class="product-name" style="font-size: 20px; font-weight: none;">' . $row['name'] . '</span><br>';
            echo '<span class="product-total-price" style="font-size:20px;">₱' . $row['price'] . '</span>';
            // Display the readiness status
            echo '<p style="font-size: 10px; color: ' . ($row['ready'] ? 'green' : 'red') . ';">';
            if ($row['ready']) {
                echo '<i class="fas fa-check-circle"></i>';
            } else {
                echo '<i class="fas fa-times-circle"></i>';
            }
            echo ($row['ready'] ? ' Your Order is Ready' : ' Pending') . '</p>';
                        // Create a form for updating quantity
            echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="GET">';
            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" name="update_quantity_id" value="' . $row['id'] . '">';
            echo '<button type="submit" name="new_quantity" value="' . ($row['quantity'] - 1) . '" class="button-maroon"><i class="fas fa-minus"style="color: white;"></i></button>';
            echo '<input type="number" name="new_quantity" value="' . $row['quantity'] . '" class="quantity-input">';
            echo '<button type="submit" name="new_quantity" value="' . ($row['quantity'] + 1) . '" class="button-maroon"><i class="fas fa-plus"style="color: white;"></i></button>';
            echo '</form>';
            // Calculate and display the total price for this product
            $product_price = $row['price'] * $row['quantity'];
            $total_price += $product_price; // Add to total price
            echo '<span class="product-total-price" style="font-size:10px; font-weight: bold;">Total Price: ₱' . $product_price . '</span><br>';
            // Add delete button with link to delete the product
            echo '<a href="' . $_SERVER['PHP_SELF'] . '?delete_product_id=' . $row['id'] . '"><i class="fas fa-trash" style="margin-left:170px; color: maroon; font-size:15px;"></i></a>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        // If the cart is empty, display a message to the user
        echo "Your cart is empty.";
    }
    ?>
</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<div class="icon-bar">
 <a class="active" href="user_dashboard.php">
 <i class="fas fa-bars" style="font-size: 24px;"><br>
<span style="font-size: 16px;">Home</span>
</a></i>
<a class="active" href="Myfavorite.php">
  <i class="fas fa-heart"><br>
  <span style="font-size: 16px;">Favorite</span>
</a></i>
<a class="active" href="Order.php">
  <i class="fas fa-clipboard-list"style="font-size: 24px;"><br>
  <span style="font-size: 16px;">Order</span>
</a></i>
<a class="active" href="Orderhistory.php">
  <i class="fas fa-history"style="font-size: 24px;"><br>
  <span style="font-size: 16px;">History</span>
</a></i>
<a class="active" href="profile.php">
  <i class="far fa-user-circle"style="font-size: 24px;"><br>
  <span style="font-size: 16px;">Profile</span>
</a></i>

</body>
</html>