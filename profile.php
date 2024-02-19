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
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form data here
    // Update user profile data in the database
    // Redirect user to profile page after updating
    $username = $_POST['username'];
    // Update other profile attributes similarly

    // Perform validation, database update, and redirection here
}

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
  background-color: red;
}

.active {
  background-color: maroon;
}

</style>
<header class="navbar border-bottom border-2 flex-md-nowrap p-0 shadow" style="width: 1360px; height: 200px; background-color:maroon;" data-bs-theme="dark">
    <ul class="nav">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        
<br><br><center><p style="color: white;font-size: 30px;margin-top: 80px;">PROFILE</p> 

<center><div class="container shadow" style="width: 400px; max-height: 171px; background-color:white; margin-top: 30px; border-radius: 10px;">  
<div class="container">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="profileEdit.php"><i class="fa fa-edit" style="color: maroon;"></i></a><br>
<img src="<?php echo $users['pp']; ?>" style="width: 70px; height: 70px; border-radius: 50%;">
    <center>
        <b><p style="color:black; font-size: 25px;"><?php echo $users['username']; ?></p></b>
        <h1 style="color: gray; font-size: 15px;"><?php echo $users['status']; ?></h1><br>
</div>
  </ul>       
</header><br><br><br><br><br><br>

<div class="icon-bar">
<a class="active" href="user_dashboard.php"><span class="fa fa-dashboard ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Dashboard</span></a><br><br> 
  <a class="active" href="#"><span class="fa fa-history">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Order&nbsp;History</span></a><br></span></a><br> 
  <a class="active" href="#"><span class="fa fa-bell-o">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Notification</span></a><br></span></a><br>
  <a class="active" href="#"><span class="fa fa-info-circle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">About</span></a><br></span></a><br> 
  <a class="active" href="logout.php"><span class="fa fa-sign-out">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Logout</span></a><br></span></a><br>  
</div><br><br><br>

<header class="navbar border-bottom border-2 flex-md-nowrap p-0 shadow" style="width: 1360px; height: 80px; background-color:maroon;" data-bs-theme="dark">
<ul class="nav">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<li> <a class="navbar-brand col- me-0 px-15 fs-8 text-white" href="user_dashboard.php"> &nbsp;&nbsp;
<i class="fas fa-bars"></i><br>
 Menu</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

 <li> <a class="navbar-brand col- me-0 px-15 fs-8 text-white" href="Myfavorite.php"> &nbsp;&nbsp;
 <i class="	fas fa-heart"></i><br>
 Favorite</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

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