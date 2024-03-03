<?php
include 'dbconn.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: user_login_page.php?error=Please login first");
    exit();
}

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE id='$user_id'";
$result = $conn->query($sql);
$users = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Check if the new password matches the confirmation
    if ($new_password === $confirm_password) {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        // Update user's password in the database
        $update_sql = "UPDATE user SET password='$hashed_password' WHERE id='$user_id'";

        if ($conn->query($update_sql) === TRUE) {
            // Redirect user to profile page after updating
            header("Location: profile.php");
            exit();
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "New password and confirmation password do not match.";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <style>
        /* CSS styles for form elements */
        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            font-size:40px;
        }

        input[type="text"],
        input[type="password"] {
            width: 500px;
            height:50px;
            padding: 10px;
            font-size:35px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
        h2{
            font-size:55px;
        }
    </style>
</head>
<body>

<!-- Header and navigation (if any) -->

<div class="container">
    <h2>Change Password</h2><br><br><br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="current_password">Current Password:</label>
            <input type="password" class="form-control" id="current_password" name="current_password">
        </div><br>
        <div class="form-group">
            <label for="new_password">New Password:</label>
            <input type="password" class="form-control" id="new_password" name="new_password">
        </div><br>
        <div class="form-group">
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
        </div><br>
        <button type="submit" class="btn btn-primary"style="font-size:40px;">Save Changes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="profile.php" class="btn btn-secondary" style="font-size:40px;  padding: 10px 20px;border: none; border-radius: 5px; background-color: red;color: #fff;
 cursor: pointer;">Cancel</a>
    </form>
</div>

</body>
</html>

