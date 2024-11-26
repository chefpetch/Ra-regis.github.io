<?php

    require_once 'connect.php';

    function display_data(){
        global $conn;
        $query = "select * from register_info";
        $result = mysqli_query($conn,$query);
        return $result;
    }

?>
