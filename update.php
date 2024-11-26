<?php
    include 'connect.php';
    isset($_POST['reg_id']) ? $reg_id = $_POST['reg_id'] : $reg_id ="";
    echo $reg_id;
    if(!empty($_POST['subject'])){
        $subject_name=$_POST['subject'];
        $subject_matter=$_POST['category'];
        $section=$_POST['section'];


        $sql = "UPDATE register_info SET subject_name='$subject_name', subject_matter='$subject_matter', section='$section' WHERE reg_id = '$reg_id'";
        echo $sql;
        $result = mysqli_query($conn,$sql);
        if($result){
            header('location:display.php');
        }else{
            echo "Error";
            die(mysqli_error($conn));
        }
    }

?>         