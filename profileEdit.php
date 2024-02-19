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
        $school_id = $_POST['school_id']; // Adding school_id
        
        // Update user profile data in the database
        $update_sql = "UPDATE user SET username='$username', student_id='$student_id' WHERE id='$user_id'";
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
    <!-- Include meta tags, title, CSS links, etc. -->
</head>
<body>

<!-- Header and navigation (if any) -->

<div class="container">
    <h2>Edit Profile</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $users['username']; ?>">
        </div><br>
        <!-- Add more input fields for other profile attributes here -->
        <div class="form-group">
            <label for="student_id">Student ID:</label>
            <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo isset($users['student_id']) ? $users['student_id'] : ''; ?>">
        </div><br>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

<!-- Footer or additional content -->

</body>
</html>
