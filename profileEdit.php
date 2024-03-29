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
    $username = $_POST['username'];
    $student_id = $_POST['student_id'];
    $email = $_POST['email'];
    
    // Update user profile data in the database
    $update_sql = "UPDATE user SET username='$username', student_id='$student_id', email='$email' WHERE id='$user_id'";
    // Update other profile attributes similarly

    if ($conn->query($update_sql) === TRUE) {
        // Redirect user to profile page after updating
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
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
    <h2>Edit Profile</h2><br><br><br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $users['username']; ?>">
        </div><br>
        <!-- Add more input fields for other profile attributes here -->
        <div class="form-group">
            <label for="student_id">Student ID:</label>
            <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo isset($users['student_id']) ? $users['student_id'] : ''; ?>">
        </div><br>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo isset($users['email']) ? $users['email'] : ''; ?>">
        </div><br>
        <button type="submit" class="btn btn-primary"style="font-size:40px;">Save Changes</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="profile.php" class="btn btn-secondary" style="font-size:40px;  padding: 10px 20px;border: none; border-radius: 5px; background-color: red;color: #fff;
 cursor: pointer;">Cancel</a><br><br>
         <a href="changepassword.php" class="btn btn-secondary" style="font-size:40px;  padding: 10px 20px;border: none; border-radius: 5px; cursor: pointer;">Change Password</a><br><br>

    </form>
</div>

</body>
</html>

