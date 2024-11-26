<!DOCTYPE html>
<html lang="en">
<head>
  <title>sub-regis</title>
  <meta charset="utf-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style5.css"> 
  <script src='plusminus.js'></script> <!--"JavaScript สำหรับเพิ่ม-ลบจำนวน"--->
  <script src='fileinput.js'></script> <!--"JavaScript สำหรับเพิ่มไฟล์รูป"--->
</head>
<body>
  <form action="insert.php" method="post">
  <div class="row g-2">
    <div class="col-md">
      <div class="form-floating">
        <input type="subname" class="form-control" name="subname" id="floatingInputGrid" placeholder="name@example.com" value="" autocomplete="off">
        <label for="floatingInputGrid">ชื่อวิชา</label>
      </div>
    </div>
  <div class="col-md">
    <div class="form-floating">
      <select class="form-select" id="floatingSelectGrid" name="subgroup" aria-label="Floating label select example">
        <option value="ศิลปะ">ศิลปะ</option>
        <option value="พละศึกษา">พละศึกษา</option>
        <option value="ดนตรีสากล">ดนตรีสากล</option>
        <option value="ดนตรีไทย">ดนตรีไทย</option>
      </select>
        <label for="floatingSelectGrid">หมวดวิชา</label>
      </div>
    </div>
  <div class="col-md">
    <div class="form-floating">
      <select class="form-select" id="floatingSelectGrid" name="submatt" aria-label="Floating label select example">
        <option value="1">ศิลปะ/ดนตรี</option>
        <option value="2">พละ</option>
      </select>
        <label for="floatingSelectGrid">สาระวิชา</label>
      </div>
    </div>
  </div>
  <div class="teachinfo"></div>
  <div class="upload-btn-wrapper">
  <div class="btn">ลงรูปวิชา</div>
  <input type='file' name="subimage" onchange="readURL(this);" />
  </div>
  <img id="blah" class="boxpic" alt="your image" />
  <div class="amountbox">
    <h2 class="style1">จำนวนที่รับ</h2>
    <div class="number">
      <button id="minus" class="minus">-</button>
      <input type="number" name="amount" class="number2"  value="1" min="1"/>
      <button id="plus"class="plus">+</button>
    </div>
  </div>
  <div class="infobox">
    <h2 class="style2">ข้อมูลวิชา</h2>
    <input type="text" class="addition" name="addition" value="" placeholder="หมายเหตุเพิ่มเติม..." autocomplete="off">
    <div class="reqinstru">
    <input type="checkbox" id="reqinstru" name="reqinstru" value="1">
    <label for="reqinstru"> ต้องใช้เครื่อง</label><br></div>
  </div>
  <div class="Sec one">
    <label>
       <input type="checkbox" name="section_1" value="มี"><span>Section 1</span>
    </label>
  </div>
  <div class="Tion Two">
    <label>
       <input type="checkbox" name="section_2" value="มี"><span>Section 2</span>
    </label>
  </div>
  <div class="Section Three">
    <label>
       <input type="checkbox" name="section_3" value="มี"><span>Section 3</span>
    </label>
  </div>
  <h1 class="style1">Section ที่เปิดสอน</h1>
  <input type="submit" class="submit" value="ต่อไป →">
</form>
</body>

<?php
session_start();
include 'inc/conf.php';

echo '<div class=img><img src="' . $_SESSION["user_image"] . '" width="50" /></div>';
echo '<div class=name>' . $_SESSION['user_fname'] . ' ' . ($_SESSION['user_lname'] ?? '');
echo '<br><b>Email :</b> ' . $_SESSION['user_email'];
echo '<br><a href="signout.php"><b>Sign out</b></a></div>';
?>