<!DOCTYPE html>
    <head>
        <title>sub-regis</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <link rel="stylesheet" href="style3.css">
        <img class = "img2" src = "Ellipse17.png">
        <img class = "img1" src = "ra.png">
        <img class = "img3" src = "Ellipse18.png">
        <img class = "img4" src = "Ellipse16.png">
        <img class = "img5" src = "logo.png">
    </head>
    <body>
            <h1>ฐานข้อมูลวิชาเลือก</h1>
            <h2>สำหรับครู</h2>
            <div class="teachinfo"></div>
            <div class="box">
            <a href="subject-form3.php">
            <input type="submit" class="button-3" value="ลงวิชาเลือก">
            </a>
            <a href="searchsub.php">
            <input type="submit" class="button-2" value="ดูนักเรียน">
            </a>
        </div>
    </body>
</html>

<?php
session_start();
include 'inc/conf.php';

if (!isset($_SESSION['loggedin1']) || $_SESSION['loggedin1'] !== true) {
    header('Location: index.php');
    exit();
}


echo '<div class=img><img src="' . $_SESSION["user_image"] . '" width="50" /></div>';
echo '<div class=name>' . $_SESSION['user_fname'] . ' ' . ($_SESSION['user_lname'] ?? '');
echo '<br><b>Email :</b> ' . $_SESSION['user_email'];
echo '<br><a href="signout.php"><b>Sign out</b></a></div>';
?>