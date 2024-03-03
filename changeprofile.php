<?php
include 'dbconn.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login_page.php?error=Please login first");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle image upload
    $target_dir = "profileuploads/"; // Directory where uploaded images will be stored
    $image = $_FILES['pp']['name']; // Get the name of the uploaded image
    $image_temp = $_FILES['pp']['tmp_name']; // Get the temporary path of the uploaded image
    $image_destination = $target_dir . basename($image); // Set the destination path for the uploaded image

    // Move the uploaded image to the destination directory
    if (move_uploaded_file($image_temp, $image_destination)) {
        // Update the database with the path to the uploaded image
        $sql = "UPDATE user SET pp='$image_destination' WHERE id='$user_id'";
        if ($conn->query($sql) === TRUE) {
            // Redirect to the setupProfile.php page after successful upload
            header("Location: profile.php");
            exit();
        } else {
            echo "Error updating profile picture in the database: " . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change Profile</title>
</head>
<body>
<style>
    body {
        font-family: 'Comic Sans MS', cursive;
        background-color: #D6EEEE;
        padding: 50px;
    }

    .container {
        text-align: center;
    }
</style>

<center>
    <div class="container">
        <h2>Change Profile</h2>
        <form method="post" enctype="multipart/form-data">
            <label for="pp">Profile Picture:</label>
            <input type="file" name="pp">
            <br>

            <input type="submit" value="Save">
        </form>

     
        <br>
        <a href="profile.php">Back to Profile</a>
    </div>
</center>

</body>
</html>