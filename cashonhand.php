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
$sql = "SELECT product.*, cart.quantity FROM product INNER JOIN cart ON product.id = cart.product_id WHERE cart.user_id = $user_id";
$result = $conn->query($sql);

// Initialize total price variable
$total_price = 0;
// Initialize total items variable
$total_items = 0;

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
      body {margin-top: 17px; background-color:lightgray;}

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
  margin-top:650px;
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
.container {
    display: flex;
}
.radio-container {
        border: 2px solid white; /* Border style */
        background-color:white;
        padding: 10px; /* Padding to create space between the border and content */
        border-radius: 10px;;
        width:350px;
        box-shadow: 0 15px 4px rgba(0, 0, 0, 0.1); /* Add box-shadow */
    }
    .radio{
        border: 2px solid white; /* Border style */
        background-color:white;
        padding: 21px; /* Padding to create space between the border and content */
        border-radius: 10px;;
        width:350px;
        height:125px;
    }
    .h2{
        margin-top:500px;
    }
    .fa-dot-circle{ 
        font-size: 15px; /* Adjust size as needed */
        text-decoration: none; /* Remove underline */
        color: blue; /* Set color */
        display: inline-block; /* Display as inline block */
        margin-right:5px;
    }
  </style>
<div><br>
<center><h2 style="margin-top:15px;"><b>CASH ON HAND PAYMENT</b></h2></center>
    <div class="container">
    <a href="Order.php" class="left-arrow"><i class="fas fa-arrow-left"style="color:black;"></i></a>
</div>
<br><br><center>
<form action="update_status.php" method="POST">
<div class="radio-container">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSj-EaNUX7Xl0MvpH9sX9_ptLkN2lv76t7v3n4SxRIlIg&s" alt="Your Image" width="50" height="50" style="border-radius: 50%;">
        <label for="status_student"><b>G-CASH</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" id="status" name="status" value="Student" onclick="navigateToGcash()">
    </div><br>
    <div class="radio-container">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0aNkoR9NYk75SeOo-Qu0hHF5HD0mEWppH74MKaUloTg&s" alt="Your Image" width="50" height="50">
        <label for="status_faculty"><b>School Fee</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" id="status" name="status" value="Student" onclick="navigateToschoolfee()">
    </div><br>
    <div class="radio-container"style="padding:15px; width:375px;">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcShl6fu0z5vqJWKZYIA12KxYdcenv-JwFcUTtdyzVo2Jw&s" alt="Your Image" width="50" height="50">
        <label for="status_student"><b>Cash On Hand</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" id="status_cash" name="status" value="cash" checked>
    </div>
</form>
</center><br><br><br><br>
<center><p style="font-size:20px;color:red;">Note: Failure to pay will result in automatic addition to your school fee.</p>

<center><div class="radio">
<center><?php
    // Check if products are found in the cart
    if ($result->num_rows > 0) {
        // Display the products
        while ($row = $result->fetch_assoc()) { 
          // Calculate and display the total price for this product
$product_price = $row['price'] * $row['quantity'];
$total_price += $product_price; // Add to total price
$total_items += $row['quantity']; // Add to total items
echo '<div class="product-total-price" style="font-size:10px; font-weight: bold; display: none;">Total Price: ₱' . $product_price . '</div>';
        }
       // Display total items
       echo '<div style="margin-right: 18px;">Selected Items: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $total_items . '</div>';

// Insert line above total payment
echo '<hr>';

// Display total price
echo '<div style="margin-right:10px;"><strong>Total Payment: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ₱' . $total_price . '</strong></div>';

    } else {
        // If the cart is empty, display a message to the user
        echo "Your cart is empty.";
    }
    
    ?>
    <div class="form-group">
    <a class="btn btn-primary" href="myqrcode.php" style="background-color: maroon; width: 300px; color: white; border-color:maroon; border-radius:10px; height:45px; font-size:20px;" role="button"><b>PAY NOW</a>
</div>
    </div><br><br><br><br><br><br><br>



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
<script>
function navigateToGcash() {
    window.location.href = "gcashpay.php";
}
function navigateToschoolfee() {
    window.location.href = "payschoolfee.php";
}
</script>
</body>
</html>