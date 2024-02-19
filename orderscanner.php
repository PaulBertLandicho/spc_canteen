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
</head>
<body>
	<style>
 body{
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
body {margin:0}

.icon-bar {
  width: 220px; /* Adjusted width */
  background-color: white;
}

.icon-bar a {
  display: block;
  text-align: left;
  padding: 12px; /* Adjusted padding */
  transition: all 0.3s ease;
  color: black;
  font-size: 18px; /* Adjusted font size */
}

.icon-bar a:hover {
  background-color: maroon;
  border-radius: 10px;
}
h2{
  font-size: 48px; /* Adjusted font size */
  text-align: top;

}
.search-box {
        width: 300px; /* Adjust width as needed */
        height: 50px; /* Adjust height as needed */
    }

    .form-control {
        width: 70%; /* Adjust input width as needed */
        height: 100%; /* Set input height to match parent */
    }

    .btn {
        height: 100%; /* Set button height to match parent */
    }


	</style>

	<center><div class="container shadow" style="max-width: 320px; height: 850px; background-color: white;">


    <div class="center-icon">
            <img src="https://i.ibb.co/jbv4DFH/Capture.png" alt="Capture" style="width:150px;height:150px;">
            <p class="canteen-text" style="font-family: inknut antiqua; font-size:30px;"><b>SPC CANTEEN</b></p><br><br><br>

<div class="icon-bar">
<a class="active" href="admin_dashboard.php"><span class="fa fa-dashboard ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Dashboard</span></a><br> 
  <a class="active" href="#"><span class="fa fa-history">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Order List</span></a><br></span></a>
  <a class="active" href="#"><span class="far fa-file">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Transaction  History</span></a><br></span></a>
  <a class="active" href="#"><span class="fa fa-qrcode">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Order Scanner</span></a><br></span></a>
  <a class="active" href="logout.php"><span class="fa fa-sign-out">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<class style="color: black;">Logout</span></a><br></span></a><br>  
<br><br>

<p style="color: #999; font-size:13px;"><b>SPC CANTEEN</b><br> © 2024 All Rights Reserved</p>
		</form>
	</div>
 </center>

 <div class="container shadow" style="max-width: 1200px; margin-top: 0px; height:850px; background-color: lightgray;">
        <h1><b>QR Code Scanner</b></h1><br><br><br><br><br>
            <script src="qrScript.js"></script>
            <div style="text-align: center;">
            <center><div id="reader" style="width: 500px;"></div>
                <div id="show" style="display: none;">
                <div class="container">
                    <h4>Scanned Result</h4>
                    <p style="color: blue;" id="result"></p>
                </div>
            </div>
            <br><br>
            <center>
                <button id="scanButton" class="submit" style="width: 150px;font-size:17px; height: 50px; background-color: maroon; color: #fff; border: none; border-radius: 3px;">SCAN</button>
                <!-- Restart button -->
                <button id="restartButton" class="submit" style="width: 150px;font-size:17px; height: 50px; background-color: gray; color: #fff; border: none; border-radius: 3px;">RESTART</button>
            </center>
    </div>

    <script>
        // JavaScript code to handle QR code scanning and restart functionality
        const html5Qrcode = new Html5Qrcode('reader');
        const qrCodeSuccessCallback = (decodedText, decodedResult)=>{
            if(decodedText){
                document.getElementById('show').style.display = 'block';
                document.getElementById('result').textContent = decodedText;
                html5Qrcode.stop();
            }
        }
        const config = {fps:10, qrbox:{width:250, height:250}}
        const scanButton = document.getElementById('scanButton');
        const restartButton = document.getElementById('restartButton');

        // Start scanning when the scan button is clicked
        scanButton.addEventListener('click', () => {
            html5Qrcode.start({facingMode:"environment"}, config, qrCodeSuccessCallback);
        });

        // Restart scanning when the restart button is clicked
        restartButton.addEventListener('click', () => {
            document.getElementById('show').style.display = 'none';
            document.getElementById('result').textContent = '';
            html5Qrcode.start({facingMode:"environment"}, config, qrCodeSuccessCallback);
        });
    </script>
  

</body>
</html>
