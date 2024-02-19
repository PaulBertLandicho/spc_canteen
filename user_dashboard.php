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


.circle {
            width: 78px; /* Adjust the width and height as needed */
            height: 78px;
            border-radius: 10%; /* Makes it circular */
            overflow: hidden; /* Ensures the image stays within the circle */
            display: inline-block; /* Allows it to be placed inline with text */

        }

        /* Styling for linked image */
        .circle img {
            width: 100%; /* Ensures the image fills the circle */
            height: auto; /* Maintains aspect ratio */
        }
        .search-box {
    position: relative;
    width: 900px; /* Adjust as needed */
    border-radius: 30px;
    background-color: white;

  }

  /* Style for the search icon */
  .search-box .fas.fa-search {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    color: #aaa;
  }

  /* Style for the input field */
  .search-box input[type="search"] {
    padding-left: 30px; /* Adjust to accommodate the icon */
    border-radius: 30px;
    height: 50px;
    background-color: lightgray;

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
    color: white;

}

.search-form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px; /* Add some space between the input and button */

}

.product-container {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    max-width: 300px;
    height: 290px

}

.product-image {
    flex: 0 0 100px;
    margin-right: 20px;
    
}

.product-details {
    flex: 1;
    
}

.product-name {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 5px;
}

.product-price {
    font-size: 27px;
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
    padding: 8px 12px;
    border-radius: 5px;
    color: #fff;
}

.product-actions a.update-btn {
    background-color: #00bcd4;
}

.product-actions a.delete-btn {
    background-color: #f44336;
}

.navbar-fixed-bottom {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000; /* Adjust as needed */
}
#product-list-container {
    max-height: 500px; /* Adjust the maximum height as needed */
    overflow-y: auto; /* Enable vertical scrollbar */
}

.product-container {
    margin-bottom: 20px; /* Adjust spacing between products */
}

</style>
<header class="navbar " style="width: 1360px; height: 150px; background-color:lightgray" data-bs-theme="dark">
&nbsp;<h2> Hello! <?php echo $users['username']; ?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<button class="btn"><i class="fa fa-bell-o" style="font-size: 23px; color: black; ">
&nbsp;&nbsp;

</i><span class="picture"></span><img class="profile" src="<?php echo $users['pp']; ?>"style="width: 50px; height: 50px;  border-radius: 50%;">
</ul>       
</header><br>
<div class="circle-bar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<a href="user_dashboard.php" class="circle">
    <img src="https://www.mydynamics.co.za/wp-content/uploads/2022/08/Screenshot-2022-08-05-at-12.59.27.png" alt="Description of Image">
</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<a href="link_to_your_page.php" target="_blank" class="circle">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS547iT3nZcvgoD6RBCnkdwoulSs3Ltrz-TFw&usqp=CAU" alt="Description of Image">
</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



<a href="link_to_your_page.php"  class="circle">
    <img src="data:image/png;base64,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" alt="Description of Image">
</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



<a href="link_to_your_page.php"  class="circle">
    <img src="data:image/png;base64,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" alt="Description of Image">
</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



<a href="link_to_your_page.php" target="_blank" class="circle">
    <img src="data:image/png;base64,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" alt="Description of Image">
</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



<a href="link_to_your_page.php" target="_blank" class="circle">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTmaI8Vuo4uR6NIEr0mDk1g8WY77ibt_-UKsw&usqp=CAU" alt="Description of Image">
</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



<a href="link_to_your_page.php" target="_blank" class="circle">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR2tcJst1RWd-hDrGzAz6JBsJNXIy1P2P8jkQ&usqp=CAU" alt="Description of Image">
</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



<a href="link_to_your_page.php" target="_blank" class="circle">
    <img src="https://cdn5.vectorstock.com/i/1000x1000/86/24/nutrition-healthy-food-icon-vector-12208624.jpg" alt="Description of Image">
</a>&nbsp;&nbsp;

<p style="color:gray">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Breakfast&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lunch&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Snack&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Beverage&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dinner&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dessert&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Healthy</p>
<br>
<center><div class="container mt-4">
  <div class="search-box">
    <form class="d-flex ms-auto" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
      <input class="form-control me-2" type="search" name="search" placeholder="Search product . . . ." aria-label="Search">
      <i class="fas fa-search"></i></button>
    </form>
</div></center><br>

</div><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recommended</h3>
<center><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;All</p></center>

</div><br>

<center><div id="product-list-container">
    <div id="product-list">
        <?php while($product = $result->fetch_assoc()): ?>
        <div class="product-container">
            <div class="product-image">
                <img src="<?php echo $product['image']; ?>" alt="Product Image" style="width: 250px;"><br>
                <br><div class="product-details">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" class="cart-btn" style="color: maroon;"><i class="fas fa-shopping-cart"></i></a>
                    ₱<?php echo $product['price']; ?>
                    <div class="product-actions"><br>
                        <div class="product-name"><?php echo $product['name']; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div></center>

</div>


</div>

<header class="navbar navbar-fixed-top border-bottom border-2 flex-md-nowrap p-0 shadow" style="width: 1360px; height: 80px; background-color:maroon;" data-bs-theme="dark">
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

<script>
    window.addEventListener('scroll', function() {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
            // Load more products here
            // You can make an AJAX request to fetch more products and append them to the product list
            // Example:
            // fetch('load_more_products.php')
            //    .then(response => response.text())
            //    .then(data => {
            //        document.getElementById('product-list').insertAdjacentHTML('beforeend', data);
            //    })
            //    .catch(error => console.error('Error fetching more products:', error));
        }
    });
</script>
</body>
</html>