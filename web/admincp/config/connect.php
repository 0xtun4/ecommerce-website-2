<?php
    $severname="localhost:3306";
    $username="root";
    $password="admin";
    $database="test_db";

    $connect= new mysqli($severname,$username,$password,$database);
    if(mysqli_connect_errno()){
        echo "loi ket noi".mysqli_connect_error();
        exit();
    }
?>