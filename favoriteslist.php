<?php
session_start();

// Include your database connection code here

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Query to retrieve favorite products for the current user
    $sql = "SELECT p.* FROM favorites f
            INNER JOIN products p ON f.product_id = p.id
            WHERE f.user_id = $user_id";
    
    // Execute the query
    $result = $conn->query($sql);
} else {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Products</title>
    <!-- Include your CSS stylesheets and any other necessary scripts -->
</head>
<body>
    <h1>Favorite Products</h1>
    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while($product = $result->fetch_assoc()): ?>
                <li><?php echo $product['name']; ?></li>
                <!-- Display other product details as needed -->
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No favorite products found.</p>
    <?php endif; ?>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
