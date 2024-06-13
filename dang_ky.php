<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="dang_ky.css">
</head>
<body>
    <div class="container">
        <div class="register-container">
            <h1>Đăng ký</h1>
            <form action="#" method="post">
                <input type="text" placeholder="Sdt" name="sdt" required>
                <input type="text" placeholder="Tên" name="name" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Mật khẩu" name="mat_khau" required>
                <button type="submit" name="dang_ky">Đăng ký</button>
                <a href="trang_chu_pheu_hot_pot.php">Quay về trang chủ</a>
            </form>
        </div>
    </div>

    <?php  
        if(isset($_POST['dang_ky'])){
            require 'connect.php';
            mysqli_set_charset($conn, 'UTF8');
            $sdt= $_POST['sdt'];
            $name=$_POST['name']; 
            $email = $_POST["email"];
            $mat_khau = $_POST["mat_khau"];
            $sql = "INSERT INTO `khach_hang`(`sdt_khach_hang`, `ten_khach_hang`, `email_khach_hang`, `mat_khau`) VALUES ('$sdt','$name','$email','$mat_khau')";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                echo "<div class='message'>Chào mừng bạn đến với quán lẩu Phễu. Vui lòng <a style='color:red' href='dang_nhap.php'>đăng nhập</a> lại.</div>";
            } else {
                echo "<div class='message'>Thất bại</div>";
            }
            $conn->close();            
        }
    ?>
</body>
</html>
