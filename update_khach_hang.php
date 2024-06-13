<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/cda46a0e1c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="update_khach_hang.css">
</head>
<body>
    <header>
        <nav>
            <div>
                <a href="lau.php"><img class="logo_pheu_hot_pot" src="ảnh/pheu_logo_white.png" alt="Logo"></a>
            </div>
            <div class="search_container">
                <form class="d-flex search-container" method="POST" action="search.php">
                    <input type="text" id="search" name="tim_food_drink" placeholder="Search...">
                    <button type="submit" name="search_food_drink">Search</button>
                    <div id="suggestions" class="suggestions"></div>
                </form>
            </div>
            <div class="nav">
                <div id="icon-user">
                    <li class="menu-li" style="list-style: none;"><a class="menu-a" href="#"><i style='margin-right:50px;z-index: 999'class="fa-solid fa-bars"></i></a>
                        <ul class="menu-ul">
                            <?php 
                                if (isset($_SESSION['ten_khach_hang'])){
                                    echo "<li style='color:white'>Xin chào " . $_SESSION['ten_khach_hang'] . "</li>
                                          <li style='color:white;padding-left:-100px;' ><a href='#' class='link-navbar cua-toi'>Giỏ hàng</a></li>
                                          <li><a href='logout.php'>Đăng xuất</a></li>";
                                }
                                 elseif (isset($_SESSION['tai_khoan']) && $_SESSION['tai_khoan'] == 'admin@gmail.com') {
                                    echo "<li style='color:white'>Xin chào " . $_SESSION['tai_khoan'] . "</li>
                                          <li style='color:white'><a href='phan_quyen_nhan_vien.php'>Tài khoản nhân viên</a></li>
                                          <li style='color:white'><a href='phan_quyen_khach_hang.php'>Tài khoản khách hàng</a></li>
                                          <li style='color:white'><a href='add_mon_an.html'>Thêm món ăn</a></li>
                                          <li style='color:white'><a href='update_mon_an.php'>Chỉnh sửa món ăn</a></li>
                                          <li style='color:white'><a href='delete_mon_an.php'>Xóa món ăn</a></li>
                                          <li style='color:white'><a href='logout.php'>Đăng xuất</a></li>"; 
                                } elseif (isset($_SESSION['tai_khoan'])) {
                                    echo "<form method='post' action='logout.php'>";
                                    echo "<span class='link-navbar span_hello'>Xin chào " . htmlspecialchars($_SESSION['tai_khoan']) . "</span>";
                                    echo "<button type='submit' name='logout'>Đăng xuất</button>";
                                    echo "</form>";
                                } else {
                                    
                                    echo "<div class='dangnhap_dangky'>";
                                    echo "<div><a href='dang_nhap.php'>Đăng nhập</a><span></span></div>";
                                    echo "<div><a href='dang_ky.php'>Đăng ký</a></div>";
                                    echo "</div>";
                                }
                            ?>
                        </ul>
                    </li>
                </div>
            </div>
        </nav></br>
    </header>
    <?php
        require "connect.php";
        mysqli_set_charset($conn, 'UTF8');

        if(isset($_SESSION['email_khach_hang'])) {
            if(isset($_POST['submit'])) {
                $email_khach_hang = $_SESSION['email_khach_hang'];
                $ten_khach_hang = $_POST['ten_khach_hang'];
                $mk_khach_hang = $_POST['mk_khach_hang'];
                $sdt_khach_hang = $_POST['sdt_khach_hang'];

                $sql = "UPDATE `khach_hang` SET `ten_khach_hang`='$ten_khach_hang',`mat_khau`='$mk_khach_hang',`sdt_khach_hang`='$sdt_khach_hang' WHERE `email_khach_hang`='$email_khach_hang'";
                
                if(mysqli_query($conn, $sql)) {
                    echo "<div class='success-message'>Thông tin đã được cập nhật thành công! Vui lòng <a href='user_in4.php'>trở về</a></div>";
                } else {
                    echo "Lỗi: " . mysqli_error($conn);
                }
            } else {
                $email_khach_hang = $_SESSION['email_khach_hang'];
                $sql = "SELECT * FROM `khach_hang` WHERE `email_khach_hang`='$email_khach_hang'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
    ?>
        <div class="form-container">
            <h3>Thông tin Khách hàng</h3>
            <form method="post" action="">
                <input type="text" name="ten_khach_hang" value="<?php echo htmlspecialchars($row['ten_khach_hang']); ?>"><br>
                <input type="text" name="mk_khach_hang" value="<?php echo htmlspecialchars($row['mat_khau']); ?>"><br>
                <input type="text" name="email_khach_hang" value="<?php echo htmlspecialchars($row['email_khach_hang']); ?>" readonly><br>
                <input type="text" name="sdt_khach_hang" value="<?php echo htmlspecialchars($row['sdt_khach_hang']); ?>"><br>
                <input type="submit" name="submit" value="Cập nhật">
                <a href="lau.php">Quay lại màn hình chính</a>
            </form>
        </div>

    <?php
                }
            }
        } else {
            echo "Vui lòng đăng nhập để cập nhật thông tin.";
        }
        $conn->close();
    ?>
    <script>
            document.addEventListener("DOMContentLoaded", function() {
                const menu = document.querySelector('.menu-a');
                const menu_1 = document.querySelector('.menu-ul');
                const cart = document.querySelector('.gio-hang');
                const cartButton = document.querySelector('.cua-toi');
                let menu_visible = false;

                menu.addEventListener("click", function(event) {
                    event.stopPropagation();  // Ngăn không cho sự kiện click lan tỏa ra ngoài
                    menu_1.style.display = menu_visible ? "none" : "block";
                    menu_visible = !menu_visible;
                });

                cartButton.addEventListener("click", function(event) {
                    event.stopPropagation();  // Ngăn không cho sự kiện click lan tỏa ra ngoài
                    menu_1.style.display = "none";
                    menu_visible = false;
                    cart.style.right = "0";  // Hiện giỏ hàng
                });

                document.addEventListener("click", function() {
                    menu_1.style.display = "none";
                    menu_visible = false;
                    cart.style.right = "-100%";  // Ẩn giỏ hàng
                });

                cart.addEventListener("click", function(event) {
                    event.stopPropagation();  // Ngăn không cho sự kiện click lan tỏa ra ngoài
                });

                const closeCartButton = document.querySelector('.fa-xmark');
                closeCartButton.addEventListener("click", function() {
                    cart.style.right = "-100%";  // Ẩn giỏ hàng
                });
                
                        var cartTable = sessionStorage.getItem("cartTable")
                        var totalC = sessionStorage.getItem("totalC")
                        var QR = sessionStorage.getItem("QR")
                        console.log("Cart Table:", cartTable);
                    console.log("Total Cost:", totalC);
                    console.log("QR Code:", QR);
                        document.querySelector("tbody").innerHTML = cartTable
                        document.querySelector(".tong-tien").value = totalC
                        document.querySelector(".course_qr_img").src = QR
                        
            });
    </script>
</body>
</html>

