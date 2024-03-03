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
    <img src="https://i.ibb.co/7QLKBSz/423062764-1342544113808335-7405620093325838006-n-removebg-preview.png" alt="423062764-1342544113808335-7405620093325838006-n-removebg-preview" style="width:220px;height:180px;margin-right:10px;">
            <br><br><br>

<div class="icon-bar">
<a class="active" href="admin_dashboard.php"><span class="fa fa-dashboard ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Dashboard</span></a><br> 
  <a class="active" href="adminorderlist.php"><span class="fa fa-history">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Order List</span></a><br></span></a>
  <a class="active" href="transactionhistory.php"><span class="far fa-file">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Transaction  History</span></a><br></span></a>
  <a class="active" href="orderscanner.php"><span class="fa fa-qrcode">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Order Scanner</span></a><br></span></a>
  <a class="active" href="logout.php"><span class="fa fa-sign-out">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Logout</span></a><br></span></a><br>  
<br><br>

<p style="color: #999; font-size:13px;"><b>SPC CANTEEN</b><br> © 2024 All Rights Reserved</p>
		</form>
	</div>
 </center>

 <div class="container shadow" style="max-width: 1200px; margin-top: 0px; height:850px; background-color: lightgray;">
<h2><b>Transaction History</b></h2>
<h3>Febuary 9, 2024</h3><br><br<br><br><br<br><br><br><br><br>
                  <div class="search-box" id="search">
        <form class="d-flex ms-auto" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
   		<input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
           <button class="btn btn-outline-success" type="submit">
                <i class="fas fa-search"></i></form>
</div>
<div class="container shadow" style="max-width: 1200px; margin-top: 0px; height:50px; background-color: white; border-radius: 17px;">
  </div><br>            
<div class="container shadow" style="max-width: 1200px; margin-top: 0px; height:50px; background-color: white; border-radius: 17px;">
</div><br>
<div class="container shadow" style="max-width: 1200px; margin-top: 0px; height:50px; background-color: white; border-radius: 17px;">
</div><br>                                                                 
<div class="container shadow" style="max-width: 1200px; margin-top: 0px; height:50px; background-color: white; border-radius: 17px;">
</div>
		</form>
	</div>

</body>
</html>