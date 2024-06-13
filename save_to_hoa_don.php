<?php
require 'connect.php';
mysqli_set_charset($conn, 'UTF8');

// Lấy dữ liệu từ yêu cầu AJAX
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    foreach ($data as $item) {
        $img = $item['img'];
        $name = $item['name'];
        $price = $item['price'];
        $quantity = $item['quantity'];

        // Lưu sản phẩm vào bảng hoa_don
        $sql = "INSERT INTO mon_trong_hoa_don (id_hoa_don, id_food_drink, so_luong) VALUES (, '$name','$quantity')";
        if ($conn->query($sql) === TRUE) {
            echo "Đơn hàng đã được lưu thành công!";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
?>