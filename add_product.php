<?php
include 'dbconn.php';

$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];

// Handle image upload
$image = $_FILES['image']['name'];
$image_temp = $_FILES['image']['tmp_name'];
$image_destination = "uploads/" . $image;

// Move uploaded image to destination
move_uploaded_file($image_temp, $image_destination);

// Insert product into database
$sql = "INSERT INTO product (name, price, category, image) VALUES ('$name', '$price', '$category', '$image_destination')";
if ($conn->query($sql) === TRUE) {
    header("Location: productlist.php"); // Redirect to productlist.php after successful insertion
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
