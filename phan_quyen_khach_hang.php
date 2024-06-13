<!DOCTYPE html>
<html lang="vi" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Phân Quyền</title>
    <link rel="stylesheet" href="phan_quyen_khach_hang.css">
</head>
<body>
    <?php
    require "connect.php";
    mysqli_set_charset($conn, 'UTF8');
    $sql = "SELECT * FROM `khach_hang` INNER JOIN `role` ON `role`.`id_role`=`khach_hang`.`id_role`";
    $result = $conn->query($sql); 
    if ($result->num_rows > 0) { 
        echo "<form method='post' action=''>";
        echo "<table>
                <caption>Tài khoản của khách hàng</caption>
                <tr>
                    <th>Chọn</th>
                    <th>Id khách hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Tài khoản</th>
                    <th>Role</th>
                </tr>";
        while ($row = $result->fetch_assoc()) { 
            echo "<tr>
                    <td><input type='checkbox' name='checkbox[]' value='" . $row['id_khach_hang'] . "' /></td>
                    <td>" . $row['id_khach_hang'] . "</td>
                    <td>" . $row['ten_khach_hang'] . "</td>
                    <td>" . $row['sdt_khach_hang'] . "</td>
                    <td>" . $row['email_khach_hang'] . "</td> <!-- Added concatenation operator -->
                    <td>" . $row['role'] . "</td>
                </tr>";
        }
        echo "</table>
            <input type='submit' name='update' value='Cấp quyền' />
            <input type='submit' name='revoke' value='Thu hồi quyền' />
            <input type='submit' name='delete' value='Xóa tài khoản' />
            <a href='lau.php'>Quay về trang chủ</a> 
        </form>";
    } else {
        echo "Không có nhân viên nào.";
    }

    if (isset($_POST['update']) && isset($_POST['checkbox'])) {
        $chkarr = $_POST['checkbox'];
        foreach ($chkarr as $id_kh) { 
            $sql = "UPDATE `khach_hang` SET `id_role`='1' WHERE id_khach_hang=$id_kh";
            $result = $conn->query($sql); 
        }
        echo "Đã cấp quyền nhân viên";
    }

    if (isset($_POST['revoke']) && isset($_POST['checkbox'])) {
        $chkarr = $_POST['checkbox'];
        foreach ($chkarr as $id_kh) { 
            $sql = "UPDATE `khach_hang` SET `id_role`='2' WHERE id_khach_hang=$id_kh";
            $result = $conn->query($sql); 
        }
        echo "Đã thu hồi quyền nhân viên";
    }
    if (isset($_POST['delete'])) {
        if (isset ($_POST['checkbox'])) {
            $chkarr = $_POST['checkbox'];
            foreach ($chkarr as $id_khach_hang) { 
                $sql = "DELETE FROM khach_hang WHERE id_khach_hang = '$id_khach_hang'";
                $result = $conn->query($sql); 
            }
            header("location: phan_quyen_khach_hang.php");
            echo "Đã xóa tài khoản";
        }
    }

    else {
    echo " ";
    }
    ?>
</body>
</html>
