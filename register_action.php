<?php
include 'dbconn.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_DEFAULT);

$check_query = "SELECT * FROM user WHERE username='$username' OR email='$email'";
    $result = $conn->query($check_query);
    if ($result->num_rows > 0) {
        echo "<p style='font-size: 24px; color: #D5DEEF; position:absolute; top:50%; left:50%;transform: translate(-50%,50%);'>Error: Username or email already exists. <b><a href ='reglog.php'>Click here to register again.</a></b></p>";
        exit();
    }

$sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password_hash')";

if ($conn->query($sql) === TRUE){
    header('location: register_success.php');
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>