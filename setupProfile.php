<?php
	include 'dbconn.php';
	session_start();

	if ( !isset($_SESSION['user_id'])) {
		header("Location: Profilesetup.php?error=Please login first");
		exit();
	}	

	$user_id = $_SESSION['user_id'];
	$sql = "SELECT * FROM user WHERE id='$user_id'";
	$result = $conn->query($sql);
	$users = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<style>
     body{
        padding: 0;
        margin-top: 1%;
        background-color: white;
    }

    /* Style for rounded profile picture */
    .avatar {
        border-radius: 50%;
    }

</style>

<div class="container text-center"> <!-- Wrap the content in a Bootstrap container -->
    <h1 style="color: black;"><b>WELCOME</b></h1>
    <center> <b><p style="color:Darkblue; font-size: 25px; "><?php echo $users['username']; ?></h1></b>
    <br><br>
    <center>
    <div class="container">
        <img src="<?php echo $users['pp']; ?>" style="width: 200px; height: 200px; border-radius: 50%;">
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="edit_profile.php"><i class="fas fa-camera"></i></a></p>
    
    <h1 style="color: maroon; font-size: 25px;"><b>Upload Your Profile </b></h1> <br>

    <form action="update_status.php" method="POST">
    <input type="radio" id="status" name="status" value="Student">
    <label for="status_student"><b>Student</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" id="status" name="status" value="Faculty">
    <label for="status_faculty"><b>Faculty</b></label><br><br> 

    <p>If done setting up your account,<br>
    please click the button below to continue.</p>

    <button type="submit" class="btn btn-primary" style="background-color: maroon; width: 150px; color: white; text-decoration: none; display: inline-block;">Done</button>
</form>    <!-- Form ends here -->

    <script>
        // Function to preview the selected image
        function previewAvatar(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById('avatarImage').src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</div>
</body>
</html>
