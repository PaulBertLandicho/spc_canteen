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
    <a href="category2.php" style="text-decoration: none;"><img src="data:image/png;base64,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" alt="Home" ><div class="icon-text">&nbsp;&nbsp;&nbsp;Lunch</div></a>&nbsp;&nbsp;
       
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
        $sql = "SELECT * FROM product WHERE category = 2"; // Assuming category number 1 corresponds to category_id in the product table
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