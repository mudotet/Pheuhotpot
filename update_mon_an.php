<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Món Ăn</title>
    <link rel="stylesheet" href="update_mon_an.css">
</head>
<body>
    <form action="" method="get">
        <h1>Update Món Ăn</h1>
        <label for="id_food_drink">ID món ăn:</label>
        <input type="text" id="id_food_drink" name="id_food_drink" required>
        
        <label for="ten_food_drink">Tên món ăn:</label>
        <input type="text" id="ten_food_drink" name="ten_food_drink" required>
        
        <label for="gia_food_drink">Giá món ăn:</label>
        <input type="number" id="gia_food_drink" name="gia_food_drink" required>
        
        <label for="id_loai_food_drink">Id_loại_món_ăn:</label>
        <select id="id_loai_food_drink" name="id_loai_food_drink" required>
            <option value="1">1 - Món mặn</option>
            <option value="2">2 - Món rau</option>
            <option value="3">3 - Món ăn đặc sắc</option>
            <option value="4">4 - Đồ uống</option>
            <option value="5">5 - Gia vị</option>
        </select>
        
        <label for="fileInput">Image:</label>
        <input type="file" id="fileInput" name="file" required>
        <input type="hidden" name="image" id="fileNameDisplay" readonly>
        <a style='color: #7f886a' href='lau.php'>Quay lại</a>
        <input type="submit" value="Update">
    </form>
    <?php
        require 'pheu_hot_pot_sever.php';
        mysqli_set_charset($conn,'UTF8');

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_food_drink'])) {
            $id_food_drink = $_GET['id_food_drink'];
            $ten_food_drink = $_GET['ten_food_drink'];
            $gia_food_drink = $_GET['gia_food_drink'];
            $id_loai_food_drink = $_GET['id_loai_food_drink'];
            $image = $_GET['image'];

            $sql = "UPDATE food_drink 
                    SET ten_food_drink='$ten_food_drink', gia_food_drink='$gia_food_drink', id_loai_food_drink='$id_loai_food_drink', image='$image' 
                    WHERE id_food_drink='$id_food_drink'";

            if ($conn->query($sql)) {
                echo "<p>Update food successfully</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
            $conn->close();
        }
    ?>
    <script>
        document.getElementById('fileInput').addEventListener('change', function() {
            var fileName = this.files[0].name;
            document.getElementById('fileNameDisplay').value = fileName;
        });
    </script>
</body>
</html>
