<head>
    <link rel="stylesheet" href="styles.css">
</head>
    <p id="demo"></p>
</svg>

<div>
<script>

var countDownDate = new Date("mar 21, 2024 11:20:50 ").getTime();


var x = setInterval(function() {


  var now = new Date().getTime();

  var distance = countDownDate - now;

  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);


  document.getElementById("demo").innerHTML = "<div class = box><p1 class = kareeshayen>   ยังไม่ถึงเวลา</p1> "+ days + "d " + hours + "h "
  + minutes + "m " + seconds + "s</div> "
  ;

  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = '<div class = box><form action="https://www.youtube.com/watch?v=Y5KV0axPgog" method="post"> <input type="submit" value=" click this " class = inpot><p1 class = kareeshayen>ลงทะเบียนวิชาเลือก </p1> </form></div>';
  }
}, 1000);

</script>
</div>

<div class="teachinfo"></div>

<?php
session_start();
include 'inc/conf.php';

echo '<div class=img><img src="' . $_SESSION["user_image"] . '" width="50" /></div>';
echo '<div class=name>' . $_SESSION['user_fname'] . ' ' . $_SESSION['user_lname'];
echo '<br><b>Email :</b> ' . $_SESSION['user_email'];
echo '<br><a href="signout.php"><b>Sign out</b></a></div>';
echo "</div>";
?>
