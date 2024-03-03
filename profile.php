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

  @media (min-width: 768px) {
          .container {
              margin: auto;
          }
          .navbar  {
                  height: auto;
                  width:auto;
                  flex-direction: column;
                  align-items: center;
              }
              
              .nav {
                  flex-direction: column;
                  align-items: center;
              }
          } 

  </style>
  <header class="navbar border-bottom border-2 flex-md-nowrap p-0 shadow" style="height: 200px; background-color:maroon;" data-bs-theme="dark">
      <ul class="nav">
  <br><br><center><p style="color: white;font-size: 30px;margin-top: none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PROFILE</p>

  <center><div class="container shadow" style="margin-left:43px; width: 350px; max-height: 175px; background-color:white; margin-top: 0px; border-radius: 10px;">  
  <div class="container">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="profileEdit.php"><i class="fa fa-edit" style="color: maroon;"></i></a><br>
  <a href="changeprofile.php" style="text-decoration: none;">
    <img src="<?php echo $users['pp']; ?>" style="width: 70px; height: 70px; border-radius: 50%;">

      <center>
          <b><p style="color:black; font-size: 25px;"><?php echo $users['username']; ?></p></b>
          <h1 style="color: gray; font-size: 15px;"><?php echo $users['status']; ?></h1><br>
  </div>
    </ul>       
  </header><br><br><br><br>

  <div class="icon-bar">
  <a class="active" href="user_dashboard.php"><span class="fa fa-dashboard ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Dashboard</span></a><br><br> 
    <a class="active" href="#"><span class="fa fa-history">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Order&nbsp;History</span></a><br></span></a><br> 
    <a class="active" href="#"><span class="fa fa-bell-o">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Notification</span></a><br></span></a><br>
    <a class="active" href="about.php"><span class="fa fa-info-circle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">About</span></a><br></span></a><br> 
    <a class="active" href="logout.php"><span class="fa fa-sign-out">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Logout</span></a><br></span></a><br>  
  </div><br>

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