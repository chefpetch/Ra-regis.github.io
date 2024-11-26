<?php

$subject_name = $_POST["subname"];
$subject_group = $_POST["subgroup"];
$addition = $_POST["addition"];
$amount = $_POST["amount"];
$subimage = $_POST["subimage"];
$section_1 = (isset($_POST['section_1']));
$section_2 = (isset($_POST['section_2']));
$section_3 = (isset($_POST['section_3']));
$reqinstru = (isset($_POST["reqinstru"]));
$subject_matter = $_POST["submatt"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "regis";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql2 = "INSERT INTO subject (subject_group, subject_name, addition, amount, section_1, section_2, section_3, subimage, reqinstru, subject_matter) 
VALUES ('$subject_group','$subject_name','$addition','$amount','$section_1','$section_2','$section_3','$subimage','$reqinstru', '$subject_matter')";
?>

<?php
if ((($conn->query($sql2)) === TRUE))  {
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
    @import url('https://fonts.googleapis.com/css?family=Kanit');

body, html {
  height: 100%;
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

.bg-image {
  background-image: url("rabg.jpg");
  filter: blur(8px);
  -webkit-filter: blur(8px);
  height: 100%; 
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.bg-text {
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0, 0.4);
  color: white;
  font-weight: bold;
  border-radius: 8px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
  width: 30%;
  height: 60%;
  padding: 20px;
  text-align: center;
  font-family: 'Kanit', sans-serif;
}
.button-3 {
	appearance: none;
	background-color: #F5B971;
	border: 1px solid rgba(27, 31, 35, .15);
	border-radius: 6px;
	box-shadow: rgba(27, 31, 35, .1) 0 1px 0;
	box-sizing: border-box;
	color: #fff;
	cursor: pointer;
	display: inline-block;
	font-family: -apple-system,system-ui,"Segoe UI",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji";
	font-size: 14px;
	font-weight: 600;
	line-height: 20px;
	padding: 10px 26px;
	position: relative;
	text-align: center;
	text-decoration: none;
	user-select: none;
	-webkit-user-select: none;
	touch-action: manipulation;
	vertical-align: middle;
	white-space: nowrap;
  }
  
  .button-3:focus:not(:focus-visible):not(.focus-visible) {
	box-shadow: none;
	outline: none;
  }
  
  .button-3:hover {
	background-color: #eab26d;
  }
  
  .button-3:focus {
	box-shadow: rgba(46, 164, 79, .4) 0 0 0 3px;
	outline: none;
  }
  
  .button-3:disabled {
	background-color: #eab26d;
	border-color: rgba(27, 31, 35, .1);
	color: rgba(255, 255, 255, .8);
	cursor: default;
  }
  
  .button-3:active {
	background-color: #eab26d;
	box-shadow: rgba(20, 70, 32, .2) 0 1px 0 inset;
  }
</style>
</head>
<body>

<div class="bg-image"></div>
<div class="bg-text">
    <h1></h1><br>
    <center><img class = "img1" src = "check (2).png" width = "120" height = "120"></center>
    <h1 style="font-size:50px">ลงวิชาสำเร็จ</h1>
    <a href="main.html">
    <center><br><input type="submit" class="button-3" value="กลับหน้าหลัก"></br></center>
</div>

</body>
</html>

<?php
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

?>

