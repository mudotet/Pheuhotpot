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
    <link rel="stylesheet" href="update_nhan_vien.css">
</head>
<body>
    <header>
        <nav>
            <div>
                <a href="lau.php"><img class="logo_pheu_hot_pot" src="ảnh/pheu_logo_white.png" alt="Logo"></a>
            </div>
            <div class="search_container">
                <form class="d-flex search-container" method="POST" action="search.php">
                    <input  type="text" id="search" name="tim_food_drink" placeholder="Search...">
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

        // Check if ID is set in the URL and get the employee details
        if (isset($_GET['id'])) {
            $id_nv = $_GET['id'];
            $sql = "SELECT * FROM `nhan_vien` WHERE `id_nv` = $id_nv";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "Không tìm thấy nhân viên.";
                exit();
            }
        } else {
            echo "Không có ID nhân viên.";
            exit();
        }

        // Handle the form submission to update employee details
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ten_nv = $_POST['ten_nv'];
            $tai_khoan = $_POST['tai_khoan'];
            $mat_khau_nhan_vien = $_POST['mat_khau_nhan_vien'];
            $chuc_vu = $_POST['chuc_vu'];

            $sql = "UPDATE `nhan_vien` 
                    SET `ten_nv` = '$ten_nv', 
                        `tai_khoan` = '$tai_khoan', 
                        `mat_khau_nhan_vien` = '$mat_khau_nhan_vien', 
                        `chuc_vu` = '$chuc_vu' 
                    WHERE `id_nv` = $id_nv";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='success-message'>Thông tin đã được cập nhật thành công! Vui lòng <a href='phan_quyen_nhan_vien.php'>trở về</a></div>";
                exit();
            } else {
                echo "Lỗi: " . $conn->error;
            }
        }

        $conn->close();
    ?>
    <div class="form-container-nv">
        <h3>Cập nhật thông tin nhân viên</h3>
        <form method="post" action="">
            <label for="ten_nv">Tên Nhân viên:</label>
            <input type="text" id="ten_nv" name="ten_nv" value="<?php echo $row['ten_nv']; ?>" required><br><br>
            <label for="tai_khoan">Tài khoản:</label>
            <input type="text" id="tai_khoan" name="tai_khoan" value="<?php echo $row['tai_khoan']; ?>" required><br><br>
            <label for="mat_khau_nhan_vien">Mật khẩu:</label>
            <input type="text" id="mat_khau_nhan_vien" name="mat_khau_nhan_vien" value="<?php echo $row['mat_khau_nhan_vien']; ?>" required><br><br>
            <label for="chuc_vu">Chức vụ:</label>
            <input type="text" id="chuc_vu" name="chuc_vu" value="<?php echo $row['chuc_vu']; ?>" required><br><br>
            <input type="submit" value="Cập nhật">
            <a href="phan_quyen_nhan_vien.php">Quay về trang trước</a>
        </form>
    </div>
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

