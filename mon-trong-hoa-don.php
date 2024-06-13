<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
        require 'connect.php';
        
        $id_food_drink1 = $_GET['id_food_drink1'];
        $quantity = $_GET['quantity'];
       
        $sql = "SELECT MAX(id_hoa_don) AS max_id FROM mon_trong_hoa_don";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // Fetch the highest id_hoa_don and increment it by 1
            $row = $result->fetch_assoc();
            $id_hoa_don = $row['max_id'] + 1;
        } else {
            // If there are no records, start with 1
            $id_hoa_don = 1;
        }
        foreach($id_food_drink1 as $index => $id_food_drink2 )
        {
           
            $s_id_food_drink1 = $id_food_drink2;
            $s_quantity = $quantity[$index];

            $sql ="INSERT INTO mon_trong_hoa_don (`id_hoa_don`,`id_food_drink`,`so_luong`) VALUES ('$id_hoa_don','$s_id_food_drink1','$s_quantity')";
            if ($conn->multi_query($sql) === TRUE)
            {
                echo "Thêm máy thành công";
                
            }
            else
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            

        }
        $id_lau = $_GET['id_lau1'];
        $id_khach_hang = $_GET['id_khach_hang'];
        $total = $_GET['total'];
        $sql_hoa_don = "INSERT INTO hoa_don (id_hoa_don,id_lau,id_khach_hang,total) VALUES ('$id_hoa_don','$id_lau','$id_khach_hang','$total')";
        if ($conn->multi_query($sql_hoa_don) === TRUE)
            {
                echo "Thêm hoa don thành công";
                
            }
            else
            {
                echo "Error: " . $sql_hoa_don . "<br>" . $conn->error;
            }
    ?>
    
</body>
</html>