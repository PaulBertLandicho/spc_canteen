<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Profile</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
body {
    padding: 0;
    margin: 0;
    background-color: lightgray;
    background-repeat: no-repeat;
    background-size: cover;
    font-family: "Poppins", sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
}

.container {
    max-width: 300px;
    margin: 0 auto;
    margin-top: 0px;
    padding: 50px;
}

body {
    margin: 0;
}

.icon-bar {
    width: 220px;
    /* Adjusted width */
    background-color: white;
}

.icon-bar a {
    display: block;
    text-align: left;
    padding: 12px;
    /* Adjusted padding */
    transition: all 0.3s ease;
    color: black;
    font-size: 18px;
    /* Adjusted font size */
}

.icon-bar a:hover {
    background-color: maroon;
    border-radius: 10px;
}

h2 {
    font-size: 48px;
    /* Adjusted font size */
    text-align: top;
}

.profile-img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
}
</style>
</head>
<body>
    <center>
        <div class="container shadow" style="max-width: 320px; height: 850px; background-color: white;">
        <div class="center-icon">
    <img src="https://i.ibb.co/7QLKBSz/423062764-1342544113808335-7405620093325838006-n-removebg-preview.png" alt="423062764-1342544113808335-7405620093325838006-n-removebg-preview" style="width:220px;height:180px;margin-right:10px;">
          <br><br><br>

                <div class="icon-bar">
                    <a class="active" href="superadmin_dashboard.php"><span class="fa fa-dashboard">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Dashboard</span></a><br>
                    <a class="active" href="Productlist.php"><span class="fa fa-tasks">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Product List</span></a><br>
                    <a class="active" href="superadmin_dashboard.php"><span class="far fa-file">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Transaction History</span></a><br>
                    <a class="active" href="Manage_users.php"><span class="far fa-user-circle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Manage Users</span></a><br>
                    <a class="active" href="logout.php"><span class="fa fa-sign-out">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Logout</span></a><br>
                    <br><br>

                    <p style="color: #999; font-size:13px;"><b>SPC CANTEEN</b><br> © 2024 All Rights Reserved</p>
                </div>
            </div>
        </div>
    </center>

    <div class="container shadow" style="max-width: 1200px; margin-top: 0px; height:850px; background-color: lightgray;">
        <br><br>
        <h2><b>Manage Users</b></h2>
        <br><br>

        <!-- Search Bar -->
        <form action="Manage_users.php" method="GET">
            <input type="text" name="search" placeholder="Search User...">
            <button type="submit">Search</button>
        </form>
        <br>

        <table class="table">
            <thead>
                <tr>
                    <th>User Profile</th>
                    <th>Username</th>
                    <th>Student_Id</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
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

                // Check if search query is set
                if (isset($_GET['search'])) {
                    // Get search term
                    $search = $_GET['search'];
                    // SQL query with search term
                    $sql = "SELECT * FROM user WHERE username LIKE '%$search%'";
                } else {
                    // Default SQL query without search term
                    $sql = "SELECT * FROM user";
                }

                // Execute SQL query
                $result = $conn->query($sql);

                // Check if there are results
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='" . $row["pp"] . "' alt='pp' class='profile-img'></td>";
                        echo "<td>" . $row["username"] . "</td>";
                        echo "<td>" . $row["student_id"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td><a href='edit_user.php?id=" . $row["id"] . "' class='btn btn-primary'>Edit</a>&nbsp;<a href='remove_user.php?id=" . $row["id"] . "' class='btn btn-danger'>Remove</a></td>";
                        echo "</tr>";
                    }
                } else {
                    // If no results found
                    echo "<tr><td colspan='5'>No results found.</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
