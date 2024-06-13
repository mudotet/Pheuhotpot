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
    <style>
        a{
            text-decoration: none;
            color: white;
        }
        header{
            background-color: #3e503c;
            color: #f3ecdb;
        }
        .link-navbar{

            color: white;
        }
        .navbar{
            padding-right: 80px;
        }
        .logo{
            padding-left: 40px;
        }
        section{
            display: grid;
            grid-template-columns: 10% 90%;
            height: 100vh;
        }
        .list-menu{
            background-color: #3e503c;
            display: block;
        }
        .menu{
            color: #f3ecdb;
            text-align: center;
            align-items: center;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .menu:hover{
            background-color: #7f886a;
        }
        .menu a{
            color: #f3ecdb;
        }
        .list-mon{
            display: grid;
            grid-template-columns: 50% 50%;
            overflow-y: auto;
            height: 100%;
        }
        .test{
            display: grid;
            grid-template-columns:50% 50%;
        }
        .text-mon {
            padding-top: 20px;
            padding-left:20px;
            margin-bottom: 10px;
            position: relative;
            border-bottom: 1px solid black; 
            height:274px
            
        }
        .text-mon + .text-mon {
            border-top: 1px solid black; /* Viền trên xuất hiện từ phần tử thứ hai trở đi */
        }
        .ten_mon{
            font-size: larger;
            font-weight: bold;
        }
        .them i{
            position:absolute ;
            bottom: 20px;
            right:20px;
        }
        .mon_an_dac_sac{
            background-color: #f3ecdb;
            text-align: center;
            padding:10px 0;
            color: #3e503c;
            text-align: center;
            align-items: center;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #mon_an_dac_sac{
            color: #3e503c;
        }
        .fix{
            text-align: center;
            color: #f3ecdb;
            border-top: 1px solid #f3ecdb;
            margin:560px 20px 0 20px;
        }
        .text-lau {
            display: inline;
        }
        .gio-hang h3{
            justify-content: center;
            text-align: center;
        }
        .gio-hang table{
            width: 100%;
        }



        .gio-hang{
            position: fixed;
            height: 100%;
            width: 500px;
            right: -100%;
            top: 0;
            background-color: burlywood;
            padding: 12px 20px;
            overflow-y: scroll;
            transition: 0.3s;
        }
        .gio-hang button{
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #3e503c;
            color: #f3ecdb;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s;

        }
        .button:hover {
            background-color: #7f886a;
        }
        .course_qr_img{
            width:200px;
        }
        /*nav mới */
        body {
            background-color: #f3ecdb;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #3e503c;
            color: #f3ecdb;
            padding: 10px;
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .logo_pheu_hot_pot {
            width: 100px;
            height: auto;
        }

        .search_container {
            display: flex;
        }

        .search_container input[type="text"] {
            padding: 5px;
            border-radius: 5px;
            border: none;
        }

        .search_container button[type="submit"] {
            background-color: #7f886a;
            color: #f3ecdb;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .dangnhap_dangky {
            color: #3e503c;
            font-weight: bold;
        }

        .ten_food_drink {
            color: #3e503c;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .img_food_drink {
            max-width: 100px;
            height: 150px;
        }
        a:hover {
            color: white;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        ul li {
            display: inline;
            margin-right: 10px;
        }
        button[type="submit"] {
            background-color: #3e503c;
            color: #f3ecdb;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #7f886a;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table caption {
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        table th, table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #7f886a; /* Middle color */
        }

        .table th:first-child, .table td:first-child {
            border-left: 1px solid #7f886a; /* Middle color */
        }

        .table th:last-child, .table td:last-child {
            border-right: 1px solid #7f886a; /* Middle color */
        }

        .ten_food_drink{ 
            color: #f3ecdb;
        }
        .menu-ul {
            position:absolute;
            width:200px;
            background-color: aliceblue;
            color:white;
            background-color:#3e503c;
            padding: 0;
            margin: 0;
            list-style-type: none;
        }
        .menu-ul{
            display:none;
            z-index: 999;
        }
        .menu-ul li {
            display: block;
            margin: 0;
            padding: 10px;
        }
        .menu-li{
            position:relative;
            padding-left:100px;
            margin-bottom:-100px;
        }
        .menu-a{
            text-decoration:none;
            color:white;
            margin-right:100px;
        }
    </style>

</head>
<body>
<header>
    <nav class="d-flex justify-content-between align-items-center p-3">
        <div>
            <a href="lau.php"><img class="logo_pheu_hot_pot" src="ảnh/pheu_logo_white.png" alt="Logo"></a>
        </div>
        <div class="search_container">
            <form method="POST" action="">
                <input type="text" id="search" name="tim_food_drink" placeholder="Search...">
                <button type="submit" name="search_food_drink">Search</button>
            </form>
        </div>
        <div class="nav">
                <div id="icon-user">
                    <li class="menu-li" style="list-style: none;"><a class="menu-a" href="#"><i style='margin-right:50px' class="fa-solid fa-bars"></i></a>
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
    <div>
        <?php 
            if (isset($_POST['search_food_drink']) && isset($_POST['tim_food_drink'])) {
                require 'connect.php';
                $tim_food_drink = $_POST['tim_food_drink'];
                $sql = "SELECT * FROM `food_drink` WHERE `ten_food_drink` LIKE '%$tim_food_drink%'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table>
                            <tr>
                                <th>Tên Món ăn</th>
                                <th>Giá Món ăn</th>
                                <th>Mô tả</th>
                            </tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td class='ten_food_drink'>" . htmlspecialchars($row['ten_food_drink']) . "</td>
                                <td>" . htmlspecialchars($row['gia_food_drink']) . "</td>
                                <td><img class='img_food_drink' src='ảnh/" . htmlspecialchars($row["image"]) . "' /></td>
                              </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Không tìm thấy kết quả cho '" . htmlspecialchars($tim_food_drink) . "'";
                }
            }
        ?>
    </div>
</header>
    <section>
        <div class="list-menu">
            <div class="menu">
                <a href="lau.php">Lẩu</a>
            </div>
            <div class="menu">
                <a href="monman.php">Món mặn</a>
            </div>
            <div class="menu">
                <a href="monrau.php">Món rau</a>
            </div>
            <div class="mon_an_dac_sac">
                <a id='mon_an_dac_sac' href="monandacsac.php">Món ăn đặc sắc</a>
            </div>
            <div class="menu">
                <a href="douong.php">Đồ uống</a>
            </div>
            <div class="menu">
                <a href="giavi.php">Gia vị</a>
            </div>
            <p class='fix'>Dự định kéo về</p>
        </div>   
        </div>
            
        <div class="list-mon">
            <?php
            require 'connect.php';
            mysqli_set_charset($conn,'UTF8');
            $sql = "SELECT * FROM food_drink WHERE id_loai_food_drink = 3";
            $result = $conn->query($sql);
            if($result->num_rows > 0){ 
                
                while($row = $result->fetch_assoc()){
                    echo "<div class='test'>";
                   
                    echo  "<img class='anh' src='ảnh/".$row['image']."' style='width:100%;height:30%;'/>";
                    
                    echo "<div class='text-mon'>";
                    if(isset($row['id_food_drink'])) {
                        echo "<span class='product'><input type='hidden' class='id_food_drink' value ='".$row['id_food_drink']."'></span>";
                    }
                    echo "<span class='ten'>".$row['ten_food_drink']."</span><br>";
                    echo "<span class='gia'>".$row['gia_food_drink']."</span><br>";
                    echo '<span class="them"><i class="fa-solid fa-circle-plus"></i></span>';
                    echo "</div>";
                    echo "</div>";
                }}
                     
                     
                     
            ?> 
            
        </div>
    </section>
    <div class="show-kq"></div>
        <div class="gio-hang">
    
    <i class="fa-solid fa-xmark" style="cursor: pointer;"></i>
    <h3>Giỏ Hàng</h3>
    <form action="mon-trong-hoa-don.php" method='get'>
        <?php
        if (isset($_SESSION['id_khach_hang'])){
            echo "<input type='hidden' name='id_khach_hang' value='".htmlspecialchars($_SESSION['id_khach_hang']) ."'>";
        }
        ?>
        <table>
            <thead>
                <tr>
                    <th>Sản Phẩm</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Chọn</th>
                </tr>
            </thead>
            <tbody>
                                
            </tbody>
                            
        </table>
        <p>Tổng tiền:<input type='' class="tong-tien" name='total' value="0"></p>
        <button type="button" id="btn-thanh-toan">Thanh Toán</button>
        <div class="course_qr">
            <img class="course_qr_img" src=""/>
            <!-- <p>Noi dung chuyen khoan: <span class="paid_content">a</span></p>
            <p>So tien:<input type='hidden' class='paid' name='total' value="0"></p> -->
        </div>
        <script  src="thanh-toan.js" ></script>
                        
        </form>
    </div>

    </div>

            
        
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