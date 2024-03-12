  <?php
session_start(); // Start the session to access session variables

// Include your database connection file
include 'dbconn.php';

if ( !isset($_SESSION['user_id'])) {
  header("Location: user_login_page.php?error=Please login first");
  exit();
}	

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE id='$user_id'";
$result = $conn->query($sql);
$users = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Handle form data here
  // Update user profile data in the database
  // Redirect user to profile page after updating
  $username = $_POST['username'];
  // Update other profile attributes similarly

  // Perform validation, database update, and redirection here
}



$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE id='$user_id'";
$result = $conn->query($sql);
$users = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Handle form data here
  // Update user profile data in the database
  // Redirect user to profile page after updating
  $username = $_POST['username'];
  // Update other profile attributes similarly

  // Perform validation, database update, and redirection here
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

// Initialize an empty variable for QR code data
$qrData = '';

// Initialize total price variable
$total_price = 0;

// Generate QR code data based on cart data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Append product details to the QR code data
        $qrData .= "Product: " . $row['name'] . ", Quantity: " . $row['quantity'] . ", Price: " . $row['price'] . "\n";
        
        // Calculate the total price for this product and add it to the total price variable
        $product_price = $row['price'] * $row['quantity'];
        $total_price += $product_price;
    }
    
    // Append total payment information to the QR code data
    $qrData .= "Total Payment: ₱" . $total_price . "\n";
}

// Generate the QR code URL
$qrURL = "https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=" . urlencode($qrData);

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
  </head>
  <body>
  <style>
      body {margin:0}

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
.iconbar{
  margin-top:380px;

}
  </style>
  <div class="container">
    <a href="Order.php" class="left-arrow"><i class="fas fa-arrow-left"style="color:black; margin-top:15px; margin-left:10px;"></i></a>
</div>
      <ul class="nav"> 
  <br><br><center><p style="color: black;font-size: 30px;margin-left:39px;"><b>MY QR CODE</p>

  <center><div class="container shadow" style="margin-left:36px; width: 350px; max-height: 150px; background-color:white; margin-top: 0px; border-radius: 10px;">  
  
    <img src="<?php echo $users['pp']; ?>" style="width: 70px; height: 70px; border-radius: 50%;">
          <b><p style="color:black; font-size: 25px;"><?php echo $users['username']; ?></p></b>
          <h1 style="color: gray; font-size: 15px;"><?php echo $users['status']; ?></h1><br>
  </div>
    </ul>       
    <center><div class="form-group">
        <button class="btn btn-primary" onclick="generateQR()" style="background-color: maroon; width: 150px; color: white; border-color:maroon; border-radius:10px; height:45px; font-size:20px;">View QRCode</button>
    </div></center><br>

<!-- Display the QR code inside a border with adjusted width -->
<div id="qrcode-container" style="text-align: center; border: 1px solid black; margin-left:65px;margin-right:65px;">
    <img src="<?php echo $qrURL; ?>" alt="QR Code" style="width: 250px; height: 250px;">
</div>
<script>
    // Function to generate the QR code and display it
    function generateQR() {
        // Show the QR code
        document.getElementById('qrcode').style.display = 'block';
    }
</script>

  <div class="iconbar">
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