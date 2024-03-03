<?php
include 'dbconn.php';

// Check if product ID is provided
if(isset($_GET['Id'])) {
    $product_id = $_GET['Id'];

    // Retrieve product details from the database
    $sql = "SELECT * FROM product WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "Product ID not provided.";
    exit();
}

// Update product details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $time_to_cook = $_POST['time_to_cook'];


    // Check if a new image is uploaded
    if($_FILES['image']['size'] > 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        // Update product with the new image
        $sql = "UPDATE product SET name='$name', price='$price', category='$category', time_to_cook='$time_to_cook'; image='$target_file' WHERE id=$product_id";
    } else {
        // Update product without changing the image
        $sql = "UPDATE product SET name='$name', price='$price', category='$category', time_to_cook='$time_to_cook' WHERE id=$product_id";
    }

    if ($conn->query($sql) === TRUE) {
        // Redirect to product list page
        header("Location: Productlist.php");
        exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <!-- Add your CSS links here -->
</head>
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
    max-width: 300px;
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
h2{
  font-size: 48px; /* Adjusted font size */
  text-align: top;

}
.search-box {
        width: 300px; /* Adjust width as needed */
        height: 50px; /* Adjust height as needed */
    }

    .form-control {
        width: 70%; /* Adjust input width as needed */
        height: 100%; /* Set input height to match parent */
    }

    .btn {
        height: 100%; /* Set button height to match parent */
    }


	</style>
<center><div class="container shadow" style="max-width: 320px; height: 850px; background-color: white;">


<div class="center-icon">
        <img src="https://i.ibb.co/jbv4DFH/Capture.png" alt="Capture" style="width:150px;height:150px;">
        <p class="canteen-text" style="font-family: inknut antiqua; font-size:30px;"><b>SPC CANTEEN</b></p><br><br><br>

<div class="icon-bar">
<a class="active" href="admin_dashboard.php"><span class="fa fa-dashboard ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Dashboard</span></a><br> 
<a class="active" href="#"><span class="fa fa-history">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Order List</span></a><br></span></a>
<a class="active" href="#"><span class="far fa-file">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Transaction  History</span></a><br></span></a>
<a class="active" href="orderscanner.php"><span class="fa fa-qrcode">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Order Scanner</span></a><br></span></a>
<a class="active" href="logout.php"><span class="fa fa-sign-out">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Logout</span></a><br></span></a><br>  
<br><br>

<p style="color: #999; font-size:13px;"><b>SPC CANTEEN</b><br> © 2024 All Rights Reserved</p>
    </form>
</div>
</center>
<div class="container shadow" style="max-width: 1000px; margin-top: 150px; height:500px; background-color: lightblue;">

    <center><h2>Update Product</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?Id=" . $product_id; ?>" method="post" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" required><br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required><br><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php echo $product['category']; ?>" required><br><br>

        <label for="time_to_cook">time_to_cook:</label>
        <input type="text" id="time_to_cook" name="time_to_cook" value="<?php echo $product['time_to_cook']; ?>" required><br><br>

        <label for="image">Product Image:</label>
        <input type="file" id="image" name="image"><br><br>

        <input type="submit" value="Update Product">
        <a href="Productlist.php"><button type="button">Cancel</button></a>

    </form>
</body>
</html>
 