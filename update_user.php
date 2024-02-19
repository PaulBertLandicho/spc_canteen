<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user ID and other required fields are set
    if(isset($_POST['user_id']) && isset($_POST['username']) && isset($_POST['email'])) {
        // Get the user ID and other form data
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        
        // Proceed with updating the user details in the database
        // Connect to the database
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "spc_canteen";

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL statement to update user details
        $sql = "UPDATE user SET username = '$username', email = '$email' WHERE id = $user_id";

        if ($conn->query($sql) === TRUE) {
            // User details updated successfully, redirect back to Manage_users.php
            header("Location: Manage_users.php");
            exit(); // Ensure script execution stops after redirection
        } else {
            echo "Error updating user details: " . $conn->error;
        }

        // Close connection
        $conn->close();
    } else {
        // Handle case where required fields are not set
        echo "User ID, username, and email are required.";
    }
} else {
    // Handle case where form is not submitted via POST method
    echo "Form not submitted.";
}
?>
