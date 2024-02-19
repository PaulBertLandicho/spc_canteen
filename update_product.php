<?php
include 'dbconn.php';


$id = $_POST['Id'];
$name = $_POST['Name'];
$price = $_POST['Price'];
$quantity = $_POST['Quantity'];


$sql = "UPDATE product SET Name='$name', Price='$price', Quantity='$quantity' WHERE Id=$id";


if ($conn->query($sql) === TRUE) {
  header("Location: Productlist.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
