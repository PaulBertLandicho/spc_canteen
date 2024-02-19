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

.icon-bar {
  width: 60px; /* Adjusted width */
  background-color: white;
}

.icon-bar a {
  display: block;
  text-align: center;
  padding: 12px; /* Adjusted padding */
  transition: all 0.3s ease;
  color: white;
  font-size: 24px; /* Adjusted font size */
  border-radius: 50%; /* Make it circular */
}

.icon-bar a:hover {
  background-color: #000;
}

.active {
  background-color: maroon;
}
.circle {
            width: 80px; /* Adjust the width and height as needed */
            height: 80px;
            border-radius: 10%; /* Makes it circular */
            overflow: hidden; /* Ensures the image stays within the circle */
            display: inline-block; /* Allows it to be placed inline with text */
        }

        /* Styling for linked image */
        .circle img {
            width: 100%; /* Ensures the image fills the circle */
            height: auto; /* Maintains aspect ratio */
        }
        .product-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .product-image img {
            width: 100px; /* Adjust size as needed */
            height: auto; /* Maintain aspect ratio */
            margin-right: 20px;
        }
        .product-details {
            flex: 1;
        }

</style>
<header class="" style="width: 1360px; height: 150px; margin-top: 15px;background-color:white" data-bs-theme="dark">
<center><h2><b>MY ORDER</b></center></h2><br><br> 
<div class="order-list">
        <?php
        // Check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve the product details from the form submission
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
            
            // Display the product details in the order list
            echo "<div class='product-container'>";
            echo "<div class='product-image'>";
            echo "<img src='$product_image' alt='Product Image'>";
            echo "</div>";
            echo "<div class='product-details'>";
            echo "<div class='product-name'>$product_name</div>";
            echo "<div class='product-price'>₱$product_price</div>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<p>No items in your cart</p>";
        }
        ?>
    </div>

</ul>       
</header>

<div class="circle-bar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<header class="navbar border-bottom border-2 flex-md-nowrap p-0 shadow" style="width: 1360px; height: 80px; background-color:maroon;" data-bs-theme="dark">
    <ul class="nav">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<li> <a class="navbar-brand col- me-0 px-15 fs-8 text-white" href="user_dashboard.php"> &nbsp;&nbsp;
<i class="fas fa-bars"></i><br>
 Menu</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

 <li> <a class="navbar-brand col- me-0 px-15 fs-8 text-white" href="Myfavorite.php"> &nbsp;&nbsp;
 <i class="	fas fa-heart"></i><br>
 Favorite</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<li> <a class="navbar-brand col- me-0 px-15 fs-8 text-white" href="Order.php"> &nbsp;&nbsp;
 <i class="	fas fa-clipboard-list"></i><br>
 Order</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

 <li> <a class="navbar-brand col- me-0 px-15 fs-8 text-white" href="Orderhistory.php"> &nbsp;&nbsp;
 <i class="fas fa-history"></i><br>
 History</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

&nbsp;&nbsp;&nbsp;&nbsp;<li> <a class="navbar-brand col- me-0 px-15 fs-8 text-white" href="profile.php"> &nbsp;&nbsp;
 <i class="far fa-user-circle"></i><br>
 Profile</a>&nbsp;&nbsp;

</ul>       
</header>
</body>
</html>