<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Món Ăn</title>
    <link rel="stylesheet" href="update_mon_an.css">
</head>
<body>
<?php
    require 'connect.php';
    mysqli_set_charset($conn, 'UTF8');

    if (isset($_GET['id_food_drink'])) {
        $id_food_drink = $_GET['id_food_drink'];
        $sql = "SELECT * FROM food_drink WHERE id_food_drink = '$id_food_drink'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "<p>Không tìm thấy món ăn với ID: $id_food_drink</p>";
            exit;
        }
    } else {
        echo "<p>Không có ID món ăn được cung cấp.</p>";
        exit;
    }
    $conn->close();
?>
    <form action="" method="post" enctype="multipart/form-data">
        <h1>Update Món Ăn</h1>
        <label for="id_food_drink">ID món ăn:</label>
        <input type="text" id="id_food_drink" name="id_food_drink" value="<?php echo htmlspecialchars($row['id_food_drink']); ?>" readonly required>
        
        <label for="ten_food_drink">Tên món ăn:</label>
        <input type="text" id="ten_food_drink" name="ten_food_drink" value="<?php echo htmlspecialchars($row['ten_food_drink']); ?>" required>
        
        <label for="gia_food_drink">Giá món ăn:</label>
        <input type="number" id="gia_food_drink" name="gia_food_drink" value="<?php echo htmlspecialchars($row['gia_food_drink']); ?>" required>
        
        <label for="id_loai_food_drink">Id_loại_món_ăn:</label>
        <select id="id_loai_food_drink" name="id_loai_food_drink" required>
            <option value="1" <?php if ($row['id_loai_food_drink'] == 1) echo 'selected'; ?>>1 - Món mặn</option>
            <option value="2" <?php if ($row['id_loai_food_drink'] == 2) echo 'selected'; ?>>2 - Món rau</option>
            <option value="3" <?php if ($row['id_loai_food_drink'] == 3) echo 'selected'; ?>>3 - Món ăn đặc sắc</option>
            <option value="4" <?php if ($row['id_loai_food_drink'] == 4) echo 'selected'; ?>>4 - Đồ uống</option>
            <option value="5" <?php if ($row['id_loai_food_drink'] == 5) echo 'selected'; ?>>5 - Gia vị</option>
        </select>
        
        <label for="fileInput">Hình ảnh:</label>
        <input type="file" id="fileInput" name="file">
        <input type="hidden" name="image" id="fileNameDisplay" value="<?php echo htmlspecialchars($row['image']); ?>">
        <input type="submit" value="Update">
        <a style="color: #7f886a" href="lau.php">Quay lại</a><br><br>
        <a style="color: #7f886a" href="delete_mon_an.php">Quay lại xóa món ăn</a>
    </form>
<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_food_drink'])) {
        require 'connect.php';
        mysqli_set_charset($conn, 'UTF8');

        $id_food_drink = $_POST['id_food_drink'];
        $ten_food_drink = $_POST['ten_food_drink'];
        $gia_food_drink = $_POST['gia_food_drink'];
        $id_loai_food_drink = $_POST['id_loai_food_drink'];
        $image = $_POST['image'];

        if (!empty($_FILES['file']['name'])) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $image = $target_file;
            } else {
                echo "<p>Lỗi tải lên tệp.</p>";
            }
        }

        $sql = "UPDATE food_drink SET 
                ten_food_drink='$ten_food_drink', 
                gia_food_drink='$gia_food_drink', 
                id_loai_food_drink='$id_loai_food_drink', 
                image='$image' 
                WHERE id_food_drink='$id_food_drink'";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Cập nhật món ăn thành công</p>";
        } else {
            echo "<p>Lỗi: " . $sql . "<br>" . $conn->error . "</p>";
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
