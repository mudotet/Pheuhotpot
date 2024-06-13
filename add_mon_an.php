<?php
    require 'connect.php';
    $id_food_drink=$_GET['id_food_drink'];
    $ten_food_drink=$_GET['ten_food_drink'];
    $gia_food_drink=$_GET['gia_food_drink'];
    $id_loai_food_drink=$_GET['id_loai_food_drink'];
    $image=$_GET['image'];
    $sql = "INSERT INTO food_drink(id_food_drink, ten_food_drink, gia_food_drink,id_loai_food_drink,`image`) 
    VALUES ('$id_food_drink','$ten_food_drink','$gia_food_drink','$id_loai_food_drink','$image')";
    if($conn->query($sql))
    {
        echo "New created successfully";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
        $conn -> close();
        header('Location:lau.php');
    ?>