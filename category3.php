<?php
	include 'dbconn.php';
	session_start();

	if ( !isset($_SESSION['user_id'])) {
		header("Location: user_login_page.php?error=Please login first");
		exit();
	}	

	$user_id = $_SESSION['user_id'];
	$sql = "SELECT * FROM user WHERE id='$user_id'";
	$result = $conn->query($sql);
	$users = $result->fetch_assoc();

  // Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 10;
$offset = ($page - 1) * $records_per_page;

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query with pagination and search
$sql = "SELECT * FROM product WHERE Name LIKE '%$search%' LIMIT $offset, $records_per_page";
$result = $conn->query($sql);

// Total records
$total_records = mysqli_num_rows($conn->query("SELECT * FROM product"));+

// Total pages
$total_pages = ceil($total_records / $records_per_page);
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

<header class="navbar " style=" width: auto; height: 100px;" data-bs-theme="dark">
<h2>&nbsp; Hello! <?php echo $users['username']; ?></h2><br>
<button class="btn"><i class="fa fa-bell-o" style="font-size: 23px; color: black; ">
&nbsp;&nbsp;

</i><span class="picture"></span><img class="profile" src="<?php echo $users['pp']; ?>"style="width: 50px; height: 50px;  border-radius: 50%;">
</ul>       
</header>
<div class="icon-container">
<div class="iconbar">
        <a href="user_dashboard.php" style="text-decoration: none;"><img src="https://www.mydynamics.co.za/wp-content/uploads/2022/08/Screenshot-2022-08-05-at-12.59.27.png" alt="Home"><div class="icon-text">&nbsp;&nbsp;&nbsp;All</div></a>&nbsp;&nbsp;&nbsp;
           <a href="category3.php" style="text-decoration: none;"><img src="data:image/png;base64,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" alt="Home"><div class="icon-text">&nbsp;&nbsp;&nbsp;Snack</div></a>&nbsp;&nbsp;&nbsp;

       
    </div>
</div>
<br>

<center><div class="search-box">
    <form class="d-flex ms-auto" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <input class="form-control me-2" type="search" name="search" placeholder="Search product . . . ." aria-label="Search">
      <i class="fas fa-search"></i></button>
    
</div></center><br>

<center><h3 style="font-size: 20px; font-weight: bold;">
    Recommended&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span style="font-size: 15px; font-weight: normal;">All</span>
</h3></center>
<br>

<center><div id="product-list-container">
    <div id="product-list">
        <?php
        // Modify the SQL query to fetch products from category number 1
        $sql = "SELECT * FROM product WHERE category = 3"; // Assuming category number 1 corresponds to category_id in the product table
        $result = $conn->query($sql);

        while($product = $result->fetch_assoc()): ?>
        <div class="product-container">
            <div class="product-image">
                <img src="<?php echo $product['image']; ?>" alt="Product Image" style="width: 340px; height:190px; border-radius: 15px;"><br>
                <div class="product-details">
                <a href="user_dashboard.php" class="cart-btn" style=" right:500px; color: green; font-size: 18px;"><i class="fas fa-clock"></i></a>
                <span style="font-size: 14px;"><?php echo $product['time_to_cook']; ?></span>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="user_dashboard.php" class="cart-btn" style="color: maroon; font-size: 22px;"><i class="fas fa-shopping-cart"></i></a>
                <span style="font-size: 24px;">₱<?php echo $product['price']; ?></span>
                    <div class="product-actions">
                        <div class="product-name"><?php echo $product['name']; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

</div></center>

</div>


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
let iconContainer = document.getElementById('icon-container');
let isDown = false;
let startX;
let scrollLeft;

iconContainer.addEventListener('mousedown', (e) => {
    isDown = true;
    startX = e.pageX - iconContainer.offsetLeft;
    scrollLeft = iconContainer.scrollLeft;
});

iconContainer.addEventListener('mouseleave', () => {
    isDown = false;
});

iconContainer.addEventListener('mouseup', () => {
    isDown = false;
});

iconContainer.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - iconContainer.offsetLeft;
    const walk = (x - startX) * 3; // Adjust scroll speed here
    iconContainer.scrollLeft = scrollLeft - walk;
});
</script>
</body>
</html>