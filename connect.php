<?php
    $severname = "localhost";
    $username = "root";
    $password = "";
    $db = "pheu_hot_pot";   
    $conn =new mysqli($severname,$username,$password,$db);
    if ($conn -> connect_error){
        dia("Connection failed:".$conn -> connect_error);
    }
    
?>