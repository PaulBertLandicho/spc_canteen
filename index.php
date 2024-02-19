<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>| Mainpage |</title>
</head>
<body>
    <style>
        #splash-screen {
    background-color: maroon;
    color: #fff;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 9999;
    transition: opacity 1s ease;
}

#content {
    display: none;
}
#splash-screen {
    /* Existing styles */
    transition: opacity 3s ease; /* Increase the duration to 3 seconds */
}
    </style>
    <div id="splash-screen">
<h1 class="futuristic-heading">Welcome to SPC CANTEEN</h1>
    </div>
    <div class="banner">
        <div class="navbar">
            <img src="data:image/jpeg;base64,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" class="logo" height="50vh">
        </div>
    
    <div class="content">
        <h1>Food is Always<br>a good idea.</h1>
        <p>Nothing brings people - Together like Good food <br>Choose the best food for you.</p>
        <div>
            <button type="button" onclick="switchPage()" id="start"><span></span>Start to taste</button>
        </div>
    </div>
    <script>document.addEventListener("DOMContentLoaded", function() {
    // Simulate loading time
    setTimeout(function() {
        // Hide the splash screen gradually
        document.getElementById("splash-screen").style.opacity = 0;

        // Show the content after the splash screen fades out
        setTimeout(function() {
            document.getElementById("content").style.display = "block";
        }, 2000); // Wait for 3 seconds before showing the content

        // After fading out, remove the splash screen from the DOM
        setTimeout(function() {
            document.getElementById("splash-screen").remove();
        }, 3000); // Remove the splash screen after 6 seconds
    }, 1000); // Adjust the timeout as needed (3000ms = 3s)
});
</script>
    <script>
        function switchPage(){
            // Fade out the content
            document.querySelector('.content').classList.add('fade-out');
            // Delay the redirection to see the transition effect
            setTimeout(function() {
                window.location.href = 'loginpage.php';
            }, 100); // Adjust the timeout as needed (500ms = 0.5s)
        }
    </script>
</body>
</html>
