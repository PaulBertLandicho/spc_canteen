<?php
include 'dbconn.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login_page.php?error=Please login first");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $target_dir = "pp";
    $target_file = $target_dir . basename($_FILES["pp"]["name"]);
    move_uploaded_file($_FILES["pp"]["tmp_name"], $target_file);

    $sql = "UPDATE user SET pp='$target_file' WHERE id='$user_id'";
    $conn->query($sql);

    header("Location: setupProfile.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
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
        <h2>Edit Profile</h2>
        <form method="post" enctype="multipart/form-data">
            <label for="pp">Profile Picture:</label>
            <input type="file" name="pp">
            <br>

            <input type="submit" value="Save">
        </form>

     
        <br>
        <a href="setupProfile.php">Back to Profile</a>
    </div>
</center>

</body>
</html>