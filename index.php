<?php
session_start();
include('inc/conf.php');

//////////// Begin Google Auth ///////////////////////////////////////////////////////////////////////////

if(isset($_GET["code"])){

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if(!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        $google_service = new Google\Service\Oauth2($google_client);

        $data = $google_service->userinfo->get();

        if(!empty($data['given_name'])){
            $_SESSION['user_fname'] = $data['given_name'];
        }

        if(!empty($data['family_name'])){
            $_SESSION['user_lname'] = $data['family_name'];
        }

        if(!empty($data['email'])){
            $_SESSION['user_email'] = $data['email'];
        }

        if(!empty($data['gender'])){
            $_SESSION['user_gender'] = $data['gender'];
        }

        if(!empty($data['picture'])){
            $_SESSION['user_image'] = $data['picture'];
        }
    }
}



if (!isset($_SESSION['access_token'])) {
    // Create a URL to obtain user authorization
    $authUrl = $google_client->createAuthUrl();
    ?>

    <div class="button-wrapper">
        <button class="gsi-material-button" onclick="window.location.href='<?php echo $authUrl; ?>'">
            <div class="gsi-material-button-content-wrapper">
                <div class="gsi-material-button-icon">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;">
                        <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                        <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                        <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                        <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                        <path fill="none" d="M0 0h48v48H0z"></path>
                    </svg>
                </div>
                <span class="gsi-material-button-contents">Sign up with Google</span>
            </div>
        </button>
    </div>

    <?php

}else {
//////////// End Google Auth ///////////////////////////////////////////////////////////////////////////
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "regis";
$conn = new mysqli($servername, $username, $password, $dbname);
$st = mysqli_query($conn, "SELECT email FROM student WHERE email = '" . $_SESSION['user_email'] . "'");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($st) {
    if (mysqli_num_rows($st) == 1) {

  } else {
    $email = $_SESSION['user_email'];
    echo "User email: " . $email . "<br>";

    $emailParts = explode('@', $email);
    $domain = $emailParts[1];
    echo "Email domain: " . $domain . "<br>";

    

    if (strpos($email, 'st') === 0) {
        $_SESSION['loggedin'] = true;
        header('Location: newdip.php');
        exit;
    } else {
        // Redirect to teachmain.php if 'st' is not found in the email
        header('Location: teachmain.php');
        $_SESSION['loggedin1'] = true;
        exit;
    }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <img class = "img2" src = "ellipse17.png">
    <img class = "img1" src = "ra.png">
    <img class = "img3" src = "ellipse18.png">
    <img class = "img4" src = "ellipse20.png">
    <link rel="stylesheet" href="style7.css">
</head>
<body>
    <h1 class = "center">Login</h1>
</html>
<style>
/* Ensure the button's container does not limit its size */
.button-wrapper {
    display: flex;
    justify-content: center; /* Center the button horizontally */
    align-items: center;     /* Center the button vertically */
    height: 100vh;           /* Full viewport height to center vertically */
    width: 100%;             /* Full width to center horizontally */
}


/* Ensure the button's clickable area is correct */
.gsi-material-button {
    display: flex; /* Align icon and text horizontally */
    align-items: center;  /* Center content vertically */
    justify-content: center; /* Center content horizontally */
    background-color: #f2f2f2;
    border: none;
    border-radius: 25px;
    box-sizing: border-box; /* Ensure padding does not affect width */
    color: #1f1f1f;
    cursor: pointer;
    font-family: 'Roboto', arial, sans-serif;
    font-size: 18px; /* Adjust text size */
    height: 50px; /* Adjust button height */
    letter-spacing: 0.25px;
    outline: none;
    overflow: hidden;
    padding: 0 20px; /* Adjust padding */
    position: relative;
    text-align: center;
    transition: background-color .218s, border-color .218s, box-shadow .218s;
    vertical-align: middle;
    white-space: nowrap;
    width: auto; /* Adjust width to fit content */
    max-width: 400px; /* Maximum width */
    min-width: 200px; /* Minimum width */
    z-index: 9999; /* Ensure button is on the top layer */
}

/* Ensure icon and content fit properly */
.gsi-material-button .gsi-material-button-content-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    width: 100%;
}

/* Ensure the button is fully clickable */
.gsi-material-button:active, .gsi-material-button:hover {
    background-color: #e0e0e0; /* Lighter color on hover or active */
}

/* Icon sizing */
.gsi-material-button .gsi-material-button-icon {
    height: 24px;    /* Increase icon size */
    width: 24px;     /* Increase icon size */
    margin-right: 12px; /* Space between icon and text */
}

/* Text styling */
.gsi-material-button .gsi-material-button-contents {
    font-size: 18px; /* Increase text size */
}


.gsi-material-button .gsi-material-button-state {
  -webkit-transition: opacity .218s;
  transition: opacity .218s;
  bottom: 0;
  left: 0;
  opacity: 0;
  position: absolute;
  right: 0;
  top: 0;
}

.gsi-material-button:disabled {
  cursor: default;
  background-color: #ffffff61;
}

.gsi-material-button:disabled .gsi-material-button-state {
  background-color: #1f1f1f1f;
}

.gsi-material-button:disabled .gsi-material-button-contents {
  opacity: 38%;
}

.gsi-material-button:disabled .gsi-material-button-icon {
  opacity: 38%;
}

.gsi-material-button:not(:disabled):active .gsi-material-button-state, 
.gsi-material-button:not(:disabled):focus .gsi-material-button-state {
  background-color: #001d35;
  opacity: 12%;
}

.gsi-material-button:not(:disabled):hover {
  -webkit-box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .30), 0 1px 3px 1px rgba(60, 64, 67, .15);
  box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .30), 0 1px 3px 1px rgba(60, 64, 67, .15);
}

.gsi-material-button:not(:disabled):hover .gsi-material-button-state {
  background-color: #001d35;
  opacity: 8%;
}
</style>
