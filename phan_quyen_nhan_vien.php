<!DOCTYPE html>
<html lang="vi" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Phân Quyền</title>
    <link rel="stylesheet" href="phan_quyen_nhan_vien.css">
</head>
<body>
<?php
        require "connect.php";
        mysqli_set_charset($conn, 'UTF8');

        $sql = "SELECT * FROM `nhan_vien`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<form method='post' action=''>";
            echo "<table>
                    <caption>Tài khoản của nhân viên</caption>
                    <tr>
                        <th>Chọn</th>
                        <th>Id nhân viên</th>
                        <th>Tên Nhân viên</th>
                        <th>Tài khoản</th>
                        <th>Mật khẩu</th>
                        <th>Chức vụ</th>
                        <th>Update</th>
                    </tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td><input type='checkbox' name='checkbox[]' value='" . $row['id_nv'] . "' /></td>
                        <td name='id_nv'>" . $row['id_nv'] . "</td>
                        <td name='ten_nv'>" . $row['ten_nv'] . "</td>
                        <td name='tai_khoan'>" . $row['tai_khoan'] . "</td>
                        <td name='mk_nv'>" . $row['mat_khau_nhan_vien'] . "</td>
                        <td>" . $row['chuc_vu'] . "</td>
                        <td><a name='id_nv' style='text-decoration: none;' href='update_nhan_vien.php?id=" . $row['id_nv'] . "'>Sửa</a></td>
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['update']) && isset($_POST['checkbox'])) {
                $chkarr = $_POST['checkbox'];
                foreach ($chkarr as $id_nv) {
                    $sql = "UPDATE `nhan_vien` SET `chuc_vu`='Quản lý' WHERE id_nv=$id_nv";
                    $result = $conn->query($sql);
                }
                echo "Đã cấp quyền admin";
                header("Location: phan_quyen_nhan_vien.php");
                exit();
            } elseif (isset($_POST['revoke']) && isset($_POST['checkbox'])) {
                $chkarr = $_POST['checkbox'];
                foreach ($chkarr as $id_nv) {
                    $sql = "UPDATE `nhan_vien` SET `chuc_vu`='Nhân viên' WHERE id_nv=$id_nv";
                    $result = $conn->query($sql);
                }
                echo "Đã thu hồi quyền admin";
                header("Location: phan_quyen_nhan_vien.php");
                exit();
            } elseif (isset($_POST['delete']) && isset($_POST['checkbox'])) {
                $chkarr = $_POST['checkbox'];
                foreach ($chkarr as $id_nv) {
                    $sql = "DELETE FROM nhan_vien WHERE id_nv = '$id_nv'";
                    $result = $conn->query($sql);
                }
                header("Location: phan_quyen_nhan_vien.php");
                exit();
            } else {
                echo " ";
            }
    }

    $conn->close();
?>


</body>
</html>
