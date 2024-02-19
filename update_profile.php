<?php
    include 'dbconn.php';
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: Profilesetup.php?error=Please login first");
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
        $school_id = $_POST['school_id'];

        // Update the database with the school ID
        $update_sql = "UPDATE user SET school_id='$school_id' WHERE id='$user_id'";
        if ($conn->query($update_sql) === TRUE) {
            // Redirect user to profile page
            header("Location: user_dashboard.php");
            exit();
        } else {
            // Handle error
            echo "Error: " . $update_sql . "<br>" . $conn->error;
        }
    }
?>
