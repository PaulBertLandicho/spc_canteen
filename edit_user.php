<?php
// Assuming you're receiving the user ID through the URL parameter 'id'
if(isset($_GET['id'])) {
    // Fetch the user details from the database based on the provided user ID
    $user_id = $_GET['id'];
    
    // Proceed with fetching the user details and displaying the edit form
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "spc_canteen";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch user details from the database
    $sql = "SELECT * FROM user WHERE id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, display the edit form
        $user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form action="update_user.php" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>"><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>

<?php
    } else {
        // User not found
        echo "User not found.";
    }

    // Close connection
    $conn->close();
} else {
    // Handle case where user ID is not provided
    echo "User ID not provided.";
}
?>
