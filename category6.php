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
    <script src="function.js"></script>
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
        <a href="user_dashboard.php" style="text-decoration: none;"><img src="https://cdn-icons-png.flaticon.com/512/5562/5562062.png" alt="Home"><div class="icon-text">&nbsp;&nbsp;&nbsp;All</div></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="category1.php" style="text-decoration: none;"><img src="https://cdn-icons-png.freepik.com/256/3480/3480823.png" alt="Home"><div class="icon-text">Breakfast</div></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="category2.php" style="text-decoration: none;"><img src="https://cdn-icons-png.flaticon.com/512/5787/5787212.png" alt="Home" ><div class="icon-text">&nbsp;&nbsp;Lunch</div></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="category3.php" style="text-decoration: none;"><img src="https://cdn-icons-png.freepik.com/512/2497/2497904.png" alt="Home"><div class="icon-text">&nbsp;&nbsp;Snack</div></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="category4.php" style="text-decoration: none;"><img src="https://cdn2.iconfinder.com/data/icons/food-72/192/.svg-12-512.png" alt="Home"><div class="icon-text">Beverage</div></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="category5.php" style="text-decoration: none;"><img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSFf5pWRMd8tjnW9HrVQLO2Ir2yTQ2hQJCAvrUlxIdCGIbCRCTh" alt="Home"><div class="icon-text">&nbsp;Dinner</div></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="category6.php" style="text-decoration: none;"><img src="https://cdn-icons-png.flaticon.com/256/6030/6030105.png" alt="Home"><div class="icon-text" style="color: black;">&nbsp;Dessert</div></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="category7.php" style="text-decoration: none;"><img src="https://cdn.icon-icons.com/icons2/3277/PNG/512/salad_bowl_food_vegetables_vegan_healthy_food_icon_208011.png" alt="Home"><div class="icon-text">Healthy</div></a>&nbsp;&nbsp;
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
    <span style="font-size: 15px; font-weight: normal;">Dessert</span>
</h3></center>
<br>

<center><div id="product-list-container">
    <div id="product-list">
        <?php
        // Modify the SQL query to fetch products from category number 1
        $sql = "SELECT * FROM product WHERE category = 6"; // Assuming category number 1 corresponds to category_id in the product table
        $result = $conn->query($sql);

        $foundProduct = false; // Initialize flag
        while($product = $result->fetch_assoc()):
            $foundProduct = true; // Set flag to true if a product is found
        ?>
                <div class="product-container">
                    <div class="product-image">
                        <img src="<?php echo $product['image']; ?>" alt="Product Image" style="width: 340px; height:190px; border-radius: 15px;"><br>
                        <div class="product-details">
                           
                            <!-- Display other product details -->
                            <a href="user_dashboard.php" class="cart-btn" style=" right:10px; color: green; font-size: 18px;"><i class="fas fa-clock"></i></a>
                            <span style="font-size: 14px; margin-right:50px;"><?php echo $product['time_to_cook']; ?></span>
                             <!-- Display readiness status -->
                             <?php if ($product['available'] == 1): ?>
                                <span style="color: green; margin-right:30px;"><i class="fas fa-check-circle"></i>Available</span>
                            <?php else: ?>
                                <span style="color: red; margin-right:20px;"><i class="fas fa-times-circle"></i> Not Available</span>
                            <?php endif; ?> 
                            <a href="add_to_cart.php?product_id=<?php echo $product['id']; ?>" class="cart-btn" style="color: maroon; font-size: 22px;"><i class="fas fa-shopping-cart"></i></a>
                            <span style="font-size: 24px;">₱<?php echo $product['price']; ?></span>
                            <div class="product-actions">
                                <div class="product-name"><?php echo $product['name']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
        <?php if (!$foundProduct): ?>
            <div class="no-product-found">
                <h3 style="color: maroon; opacity: 0.7; margin-top: 5em;">Product not found</h3>
            </div>
        <?php endif; ?>
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