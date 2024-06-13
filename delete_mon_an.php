<!DOCTYPE html>
<html lang="vi" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Delete Món Ăn</title>
    <link rel="stylesheet" href="delete_mon_an.css">
</head>
<style>
    a:hover{
        font-weight: bold;
    }
</style>
<body>
    <?php
        require "connect.php";
        mysqli_set_charset($conn, 'UTF8');

        // Xử lý xóa món ăn nếu form được gửi
        if (isset($_POST['delete'])) {
            if (isset($_POST['checkbox'])) {
                $chkarr = $_POST['checkbox'];
                foreach ($chkarr as $id_food_drink) {
                    $sql = "DELETE FROM food_drink WHERE id_food_drink = '$id_food_drink'";
                    $result = $conn->query($sql);
                }
                echo "<p>Đã hủy các món được chọn</p>";
            }
        }

        // Hiển thị form và danh sách món ăn
        echo '<form method="post" action="">';
        $sql = "SELECT * FROM food_drink INNER JOIN loai_food_drink ON food_drink.id_loai_food_drink = loai_food_drink.id_loai_food_drink";
        $result = $conn->query($sql); 
        if ($result->num_rows > 0) { 
            echo "<h1>PHỄU FOOD XIN CHÀO </h1>";
            echo "<table>
                    <caption>SHOW MY FOOD</caption>
                    <tr>
                        <th>Select</th>
                        <th>Name Food</th>
                        <th>Price</th>
                        <th>Update</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) { 
                echo "<tr>
                        <td><input type='checkbox' name='checkbox[]' value='" . $row['id_food_drink'] . "' /></td>
                        <td>" . $row['ten_food_drink'] . "</td>
                        <td>" . $row['gia_food_drink'] . " $</td>
                        <td><a style='text-decoration: none;color: #3e503c;margin-left:10px, font-weight:normal; ' href='update_mon_an_1.php?id_food_drink=" . $row['id_food_drink'] . "'>Sửa</a></td>
                    </tr>";
            }
            echo "</table>
                <input type='submit' name='delete' value='CANCEL FOOD'/>
                <a style='color: #7f886a' href='lau.php'>Quay lại</a>
            </form>";
        } else {
            echo "<h1>No food found</h1>";
        }

        $conn->close();
    ?>
</body>
</html>
s