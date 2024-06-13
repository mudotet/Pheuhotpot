<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="dang_nhap.css">
    <style>
        a:hover{
            font-weight:bold;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        
        // If already logged in as 'email_khach_hang' or 'tai_khoan', redirect to home page
        if (isset($_SESSION['email_khach_hang']) || isset($_SESSION['tai_khoan'])) {
            header("Location: trang_chu_pheu_hot_pot.php");
            exit();
        }
    ?>

    <div class="container">
        <div class="login-container">
            <h1>Đăng nhập</h1>
            <form action="" method="post">
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Mật khẩu" name="mat_khau" required>
                <button type="submit" name="dang_nhap">Đăng nhập</button>
                <a style="text-decoration: none; color: #f3ecdb;" href="lau.php">Quay về trang chủ</a>
            </form>
        </div>
    </div>

    <?php  
        if (isset($_POST['dang_nhap'])) {
            // Include server file for database connection
            require 'connect.php';
            mysqli_set_charset($conn, 'UTF8'); 
            
            $email = $_POST["email"];
            $mat_khau = $_POST["mat_khau"];
            // Query to check if email and password match for customers
            $sql_khach_hang = "SELECT `mat_khau`, `email_khach_hang`,`ten_khach_hang`,`id_khach_hang`,`sdt_khach_hang` FROM `khach_hang` WHERE `email_khach_hang`='$email' AND `mat_khau`='$mat_khau'";
            $result_khach_hang = $conn->query($sql_khach_hang);
            
            // If customer login is successful
            if ($result_khach_hang->num_rows > 0) {
                $row = $result_khach_hang->fetch_assoc();
                $_SESSION['email_khach_hang'] = $row['email_khach_hang'];
                $_SESSION['mat_khau'] = $row['mat_khau'];
                $_SESSION['ten_khach_hang'] = $row['ten_khach_hang'];
                $_SESSION['id_khach_hang'] = $row['id_khach_hang'];
                $_SESSION['sdt_khach_hang'] = $row['sdt_khach_hang'];
                header("Location: lau.php");
                exit; 
            } else {
                // Query to check if email and password match for employees
                $sql_nhan_vien = "SELECT `mat_khau_nhan_vien`,`tai_khoan`,`ten_nv`,`id_nv` FROM `nhan_vien` WHERE `tai_khoan`='$email' AND `mat_khau_nhan_vien`='$mat_khau'";
                $result_nhan_vien = $conn->query($sql_nhan_vien);
                // If employee login is successful
                if ($result_nhan_vien->num_rows > 0 ) {
                    $row = $result_nhan_vien->fetch_assoc();
                    $_SESSION['tai_khoan'] = $row['tai_khoan'];
                    $_SESSION['mat_khau'] = $row['mat_khau_nhan_vien'];
                    $_SESSION['ten_nv'] = $row['ten_nv'];
                    $_SESSION['id_nv'] = $row['id_nv'];
                    header("Location: lau.php");
                    exit; 
                } else {
                    echo "<span class='ko_ton_tai'>Tài khoản không tồn tại</span>"; // Display error message
                }
            }
            
            $conn->close(); // Close database connection
        }
    ?>
</body>
</html>
