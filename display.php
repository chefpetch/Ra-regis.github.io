<?php
    require_once 'connect.php';
    require_once 'function.php';
    if(isset($_POST['submit'])){
        $reg_id =$_POST['reg_id'];
    }

    $query ="select * from register_info";
    $result = mysqli_query($conn,$query);


    $result = display_data();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/bootstrap.min.css">
    <title>table</title>
</head>
<body class = "bg-dark">
    <div class = "container">  
        <div class = "row mt-5">
        <div class ="col">
            <div class = "card mt-5">
        <div class = "card-body">
            <table class ="table table-bordered text-centor">
             <tr class = "bg-dark text-white">
                <td> student_id </td>
                <td> subject_name </td>
                <td> section </td>
                <td> subject_matter </td>
                <td>Change</td>

             </tr>
             <?php
        if($result){
            while($row = mysqli_fetch_assoc($result)){
            $reg_id =$row['reg_id'];
            $student_id = $row['student_id'];
            $subject_name = $row['subject_name'];
            $subject_matter = $row['subject_matter'];
            $section = $row['section'];
             echo ' <tr>
                <td>'.$student_id.'</td>
                <td>'.$subject_name.'</td>
                <td>'.$subject_matter.'</td>
                <td>'.$section.'</td>
                <td><a href="Edit.php?reg_id='.$reg_id.'" class = "btn btn-primary">Change</a></td>
             </tr>';
                }
             }
             ?>
            
             </tr>
            </table>
            
         </div>
        </div>
    </div>
    </div>
    <script src="js/bootstrap.bundle.min.js">
