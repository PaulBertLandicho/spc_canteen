<?php

include 'dbconn.php';


$name = $_POST['Name'];
$price = $_POST['Price'];
$category = $_POST['Category'];



$sql = "INSERT INTO product (Name, Price, Category)
VALUES ( '$name', '$price', '$category')";
if ($conn->query($sql) === TRUE) {
 
    header('Location: Productlist.php');
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
 
  $conn->close();
  ?>
