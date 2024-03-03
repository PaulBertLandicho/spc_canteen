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
      body {margin-top: 17px;}

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
  margin-top:650px;
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


  </style>
<div>
<center><h2><b>MY ORDER</b></center></h2>
<br><br><br><br><b><br><br>
</div>
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