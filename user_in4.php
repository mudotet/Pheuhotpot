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
    <link rel="stylesheet" href="user_in4.css">
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
                    <li class="menu-li" style="list-style: none;"><a class="menu-a" href="#"><i style='margin-right:50px;'class="fa-solid fa-bars"></i></a>
                        <ul class="menu-ul">
                            <?php 
                                if (isset($_SESSION['ten_khach_hang'])){
                                    echo "<li style='color:white'>Xin chào " . $_SESSION['ten_khach_hang'] . "</li>
                                          <li style='color:white;padding-left:-100px;' ><a id='fix' href='#' class='link-navbar cua-toi'>Giỏ hàng</a></li>
                                          <li><a  id='fix' href='logout.php'>Đăng xuất</a></li>";
                                }
                                 elseif (isset($_SESSION['tai_khoan']) && $_SESSION['tai_khoan'] == 'admin@gmail.com') {
                                    echo "<li style='color:white'>Xin chào " . $_SESSION['tai_khoan'] . "</li>
                                          <li style='color:white'><a id='fix' href='phan_quyen_nhan_vien.php'>Tài khoản nhân viên</a></li>
                                          <li style='color:white'><a  id='fix' href='phan_quyen_khach_hang.php'>Tài khoản khách hàng</a></li>
                                          <li style='color:white'><a id='fix' href='add_mon_an.html'>Thêm món ăn</a></li>
                                          <li style='color:white'><a id='fix' href='update_mon_an.php'>Chỉnh sửa món ăn</a></li>
                                          <li style='color:white'><a id='fix' href='delete_mon_an.php'>Xóa món ăn</a></li>
                                          <li style='color:white'><a id='fix' href='logout.php'>Đăng xuất</a></li>"; 
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
    <section>
    <?php
        if (isset($_SESSION['email_khach_hang'])) {
            $email_khach_hang = $_SESSION['email_khach_hang'];
            require "connect.php";
            mysqli_set_charset($conn, 'UTF8');

            // Escape the email to prevent SQL injection
            $email_khach_hang = mysqli_real_escape_string($conn, htmlspecialchars($email_khach_hang));
            $sql = "SELECT * FROM `khach_hang` WHERE `email_khach_hang` = '$email_khach_hang'";

            $result = $conn->query($sql);
            if ($result->num_rows > 0) { 
                while ($row = $result->fetch_assoc()) {
                    echo "<form class='form_in4' method='post'>";
                    echo "<h3>Thông tin Khách hàng</h3><br>";
                    echo "<span>" . htmlspecialchars($row['ten_khach_hang']) . "</span><br>";
                    echo "<span>" . htmlspecialchars($row['sdt_khach_hang']) . "</span><br>";
                    echo "<span>" . htmlspecialchars($row['email_khach_hang']) . "</span><br>";
                    echo "<span>" . htmlspecialchars($row['mat_khau']) . "</span><br>";
                    echo "<a href='update_khach_hang.php'>Cập nhật thông tin khách hàng</a><br><br>";
                    echo "<a href='lau.php'>Quay lại màn hình chính</a>";
                    echo "</form>";
                }
            }
        }
    ?>

    </section>    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menu = document.querySelector('.menu-a');
            const menu_1 = document.querySelector('.menu-ul');
            const cart = document.querySelector('.gio-hang');
            const cartButton = document.querySelector('.cua-toi');
            let menuVisible = false;

            menu.addEventListener("click", function(event) {
                event.stopPropagation();
                menu_1.style.display = menuVisible ? "none" : "block";
                menuVisible = !menuVisible;
            });

            cartButton.addEventListener("click", function(event) {
                event.stopPropagation();
                menu_1.style.display = "none";
                menuVisible = false;
                cart.style.right = "0";
            });

            document.addEventListener("click", function() {
                menu_1.style.display = "none";
                menuVisible = false;
                cart.style.right = "-100%";
            });

            cart.addEventListener("click", function(event) {
                event.stopPropagation();
            });

            const closeCartButton = document.querySelector('.fa-xmark');
            if (closeCartButton) {  // Ensure closeCartButton is not null
                closeCartButton.addEventListener("click", function() {
                    cart.style.right = "-100%";
                });
            }

            // Retrieve items from sessionStorage and update DOM
            const cartTable = sessionStorage.getItem("cartTable");
            const totalCost = sessionStorage.getItem("totalC");
            const qrCode = sessionStorage.getItem("QR");

            console.log("Cart Table:", cartTable);
            console.log("Total Cost:", totalCost);
            console.log("QR Code:", qrCode);

            if (cartTable) {
                document.querySelector("tbody").innerHTML = cartTable;
            }
            if (totalCost) {
                document.querySelector(".tong-tien").textContent = totalCost;
                // document.querySelector(".paid").innerHTML = totalCost; // Consider using textContent if it's just plain text
            }
            if (qrCode) {
                document.querySelector(".course_qr_img").src = qrCode;
            }

            // Handle form submission
            document.getElementById("btn-thanh-toan").addEventListener("click", function(event) {
                event.preventDefault();

                // Clear sessionStorage
                sessionStorage.removeItem("cartTable");
                sessionStorage.removeItem("totalC");
                sessionStorage.removeItem("QR");

                // Clear HTML content
                document.querySelector("tbody").innerHTML = "";
                document.querySelector(".tong-tien").value = "0";
                // document.querySelector(".paid").textContent = "0"; // Use textContent instead of innerHTML for plain text

                document.querySelector(".course_qr_img").src = "";

                // Optionally, provide feedback to the user
                alert("Xác nhận đã kiểm tra chuyển khoản của khách hàng.");
            });
        });
    </script>
</body>
</html>