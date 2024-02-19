<?php
include 'dbconn.php';

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;
$offset = ($page - 1) * $records_per_page;

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query with pagination and search
$sql = "SELECT * FROM product WHERE Name LIKE '%$search%' LIMIT $offset, $records_per_page";
$result = $conn->query($sql);

// Total records
$total_records = mysqli_num_rows($conn->query("SELECT * FROM product"));

// Total pages
$total_pages = ceil($total_records / $records_per_page);
?>

<!DOCTYPE html>
<html lang="en">
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
 body{
            padding: 0;
            margin: 0;
            background-color: lightgray;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Poppins", sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
.container {
    max-width: 100px;
    margin: 0 auto;
    margin-top: 0px;
    padding: 50px;
}
body {margin:0}

.icon-bar {
  width: 220px; /* Adjusted width */
  background-color: white;
}

.icon-bar a {
  display: block;
  text-align: left;
  padding: 12px; /* Adjusted padding */
  transition: all 0.3s ease;
  color: black;
  font-size: 18px; /* Adjusted font size */
}

.icon-bar a:hover {
  background-color: maroon;
  border-radius: 10px;
}

.container-shadow {
            position: absolute;
            background-color: rgba(246, 241, 247, 0.5);
            border-radius: 25px;
            text-align: center;
            left: 50%;
            top: 70%;
            transform: translate(-50%, -50%);
            width: 400px;
            height: 90px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.page-title {
    font-size: 45px;
    font-weight: 600;
    margin-bottom: 180px;
    color: #333;
}
.search-form {
    margin-bottom: 20px;
    display: flex; /* Use flexbox to align items */
    justify-content: flex-end; /* Align items to the end (right side) */
}

.search-form input[type="text"] {
    width: 200px; /* Adjust the width as needed */
    padding: 10px;
    border: none;
    border-radius: 5px;

}

.search-form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 55px; /* Add some space between the input and button */
}

.add-product-btn {
    background-color: #333;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.add-product-btn:hover {
    background-color: #555;
}

.product-container {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    margin-left:50px;
    padding: 0px;
    background-color: maroon;
    border-radius: 25px;
    box-shadow: 0 4px 70px rgba(0, 0, 0, 0.1);
    max-width: 190px;
    height: 257px

}

.product-image {
    flex:200px;
    margin-right: -0px;
    align-items: center;
    border-radius: 75px;

}
.product-details {
    flex: 1;
    
}

.product-name {
    font-size: 18px;
    font-weight: bold;
    margin-top: 10px;
    color: white;

}

.product-price {
    font-size: 16px;
    color: #333;
}

.product-quantity {
    font-size: 16px;
    color: #333;
}

.product-actions {
    display: flex;
}

.product-actions a {
    display: inline-block;
    margin-right: 10px;
    text-decoration: none;
    padding: 4px 8px;
    border-radius: 5px;
    color: #fff;
}

.product-actions a.update-btn {
    background-color:white;
    color: maroon;
    height:33px;
    margin-top:5px;
}

.product-actions a.delete-btn {
    background-color:white;
    color: maroon;
    height:33px;
    margin-top:5px;
}
</style>

    <center><div class="container shadow" style="max-width: 320px; height: 850px; background-color: white;">
    <div class="center-icon">
            <img src="https://i.ibb.co/jbv4DFH/Capture.png" alt="Capture" style="width:150px;height:150px;">
            <p class="canteen-text" style="font-family: inknut antiqua; font-size:30px;"><b>SPC CANTEEN</b></p><br><br>

            <div class="icon-bar">
<a class="active" href="admin_dashboard.php"><span class="fa fa-dashboard ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Dashboard</span></a><br> 
  <a class="active" href="adminorderlist.php"><span class="fa fa-history">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Order List</span></a><br></span></a>
  <a class="active" href="transactionhistory.php"><span class="far fa-file">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Transaction  History</span></a><br></span></a>
  <a class="active" href="orderscanner.php"><span class="fa fa-qrcode">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Order Scanner</span></a><br></span></a>
  <a class="active" href="logout.php"><span class="fa fa-sign-out">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Logout</span></a><br></span></a><br>  
<br>
<p style="color: #999; font-size:13px;"><b>SPC CANTEEN</b><br> © 2024 All Rights Reserved</p>
        </form>
        </center>
    </div>

    <div class="container">
    <h2 class="page-title">Order List</h2>
    <div class="search-form">
        <form action="" method="GET">
            <input type="text" name="search" placeholder="Search...">
            <input type="submit" value="Search">
        </form><br>
    </div>
    <a href="addproduct.php" class="add-product-btn"><i class="far fa-plus-square"></i> Add Product</a>
<br><br><br>
&nbsp;&nbsp;&nbsp;&nbsp;<?php while($product = $result->fetch_assoc()): ?>
&nbsp;&nbsp;&nbsp;&nbsp;<div class="product-container">
    <div class="product-image">
        <img src="<?php echo $product['image']; ?>" alt="Product Image" style="border-radius: 15px;
width: 190px; height:178px; margin-bottom:0px;"><br>
    <div class="product-details">
        <div class="product-name">&nbsp;<?php echo $product['name']; ?></div>
        <div class="product-actions">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="update_product_form.php?Id=<?= $product['id']; ?>" class="update-btn"><i class="far fa-edit"style="font-size: 18px;"></i></a>
        <a href="delete.php?Id=<?= $product['id']; ?>" class="delete-btn"><i class="fas fa-trash-alt" style="font-size: 17px;"></i></a>

        </div>
    </div>
</div>
<?php endwhile; ?>

</div>
</body>
</html>

