

<?php
session_start(); // Start the session to access session variables

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page or display an error message
    exit();
}

// Include your database connection file
include 'dbconn.php';

// Check if the delete action is triggered and delete_product_id is an array
if(isset($_POST['delete_product_id']) && is_array($_POST['delete_product_id'])) {
    // Get the user ID
    $user_id = $_SESSION['user_id'];
    // Sanitize and implode the array of product IDs for the SQL query
    $delete_product_ids = implode(",", array_map('intval', $_POST['delete_product_id']));
    // Delete the products from the cart
    $delete_sql = "DELETE FROM cart WHERE user_id = $user_id AND product_id IN ($delete_product_ids)";
    if($conn->query($delete_sql) === TRUE) {
        // Redirect back to this page after deletion
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        // Handle the error accordingly
        echo "Error deleting products: " . $conn->error;
    }
}

// Retrieve all unique user IDs and usernames from the cart table
$sql_users = "SELECT DISTINCT cart.user_id, user.username FROM cart INNER JOIN user ON cart.user_id = user.id";
$result_users = $conn->query($sql_users);

?>
<!doctype html>
<html lang="en">

<head>
	<title>Contact Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style.css">

</head>

<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Contact Form</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="wrapper">

						<div class="row">
							<div class="col-md-3">
								<div id="qrcode" class="mt-5 text-center">

								</div>
							</div>
							<div class="col-md-9">
								<div class="row no-gutters">
									<div class="col-lg-12 col-md-12 order-md-last d-flex align-items-stretch">
										<div class="contact-wrap w-100 p-md-5 p-4">
											<h3 class="mb-4">Get in touch</h3>
											<div id="form-message-warning" class="mb-4"></div>
											<div id="form-message-success" class="mb-4">
												Your message was sent, thank you!
											</div>
											<form method="POST" id="contactForm" name="contactForm" class="contactForm">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="label" for="name">Username</label>
															<input type="text" class="form-control" name="name"
																id="name" placeholder="Name">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="label" for="email">Email Address</label>
															<input type="email" class="form-control" name="email"
																id="email" placeholder="Email">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label class="label" for="subject">Subject</label>
															<input type="text" class="form-control" name="subject"
																id="subject" placeholder="Subject">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label class="label" for="#">Message</label>
															<textarea name="message" class="form-control" id="message"
																cols="30" rows="4" placeholder="Message"></textarea>
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<input type="submit" value="Send Message"
																class="btn btn-primary" onclick="generateqr()">
															<div class="submitting"></div>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class="text pl-3">
									<p><span>Website</span> <a href="#">yoursite.com</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		</div>

		</div>
		</div>
		</div>
	</section>


	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/main.js"></script>

	<script>

		function generateqr() {
			var name = document.getElementById('name').value;
			var email = document.getElementById('email').value;
			var subject = document.getElementById('subject').value;
			var message = document.getElementById('message').value;

			console.log('Username: ' + name + " " + email + " " + subject + " " + message);

			var url = "https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl=Username:" +
			name + " Product: " + email + " Subject: " + subject + " Message: " + message;

			var ifr = `<iframe src="${url}" height="200" width="200"></iframe>`;

			document.getElementById('qrcode').innerHTML = ifr;
		}

	</script>

</body>

</html>