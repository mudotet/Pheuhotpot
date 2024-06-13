<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <link rel="stylesheet" href="trang_chu_pheu_hot_pot.css">
</head>
<body>
    
    <nav>
        <div>
            <img class="logo_pheu_hot_pot" src="pheu_logo_white.png" alt="">
        </div>
        <div class="search_container">
            <form method="POST" action="">
                <input type="text" id="search" name="tim_food_drink" placeholder="Search...">
                <button type="submit" name="search_food_drink">Search</button>
            </form>
        </div>
        <?php
            session_start(); 
            if (isset($_SESSION['email_khach_hang'])) {
                
                echo "<form method='post' action='logout.php'>";
                echo "<span class='link-navbar span_hello'>Xin chào " . htmlspecialchars($_SESSION['email_khach_hang']) . "</span>"; 
                echo "<button type='submit' name='logout'>Đăng xuất</button>";
                echo "</form>";
            } elseif (isset($_SESSION['tai_khoan']) && $_SESSION['tai_khoan'] == 'admin@gmail.com') {
                
                echo "<form method='post' action='logout.php'>";
                echo "<span class='link-navbar span_hello'>Xin chào " . htmlspecialchars($_SESSION['tai_khoan']) . "</span>";
                echo "<ul>Phân Quyền </br>
                        <li><a href='phan_quyen_nhan_vien.php'>Tài khoản nhân viên |</a></li>
                        <li><a href='phan_quyen_khach_hang.php'>Tài khoản khách hàng</a></li>
                    </ul>";
                echo "<button type='submit' name='logout'>Đăng xuất</button>";
                echo "</form>";
            } elseif (isset($_SESSION['tai_khoan'])) {
                
                echo "<form method='post' action='logout.php'>";
                echo "<span class='link-navbar span_hello'>Xin chào " . htmlspecialchars($_SESSION['tai_khoan']) . "</span>";
                echo "<button type='submit' name='logout'>Đăng xuất</button>";
                echo "</form>";
            } else {
                
                echo "<div class='dangnhap_dangky'>";
                echo "<div><a href='dang_nhap.php'>Đăng nhập</a> <span> | </span></div>";
                echo "<div><a href='dang_ky.php'>Đăng ký</a></div>";
                echo "</div>";
            }
        ?>
    </nav></br>
    <div>
        <?php 
            // Check if the search form is submitted and perform the search
            if (isset($_POST['search_food_drink']) && isset($_POST['tim_food_drink'])) {
                require 'pheu_hot_pot_sever.php';
                $tim_food_drink = $_POST['tim_food_drink'];
                $sql = "SELECT * FROM `food_drink` WHERE `ten_food_drink` LIKE '%$tim_food_drink%'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Display search results
                    while ($row = $result->fetch_assoc()) {
                        echo "<table>
                                <caption>Món ăn</caption>
                                <tr>
                                    <th>Tên Món ăn</th>
                                    <th>Giá Món ăn</th>
                                    <th>Mô tả</th>
                                </tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td class='ten_food_drink'>" . $row['ten_food_drink'] . "</td>
                                    <td>" . $row['gia_food_drink'] . "</td>
                                    <td><img class='img_food_drink' src='ảnh/" . $row["image"] . "' /></td>
                                </tr>"; // Fixed syntax error here
                        }
                        echo "</table>";
                    }
                } else {
                    echo "Không tìm thấy kết quả cho '" . htmlspecialchars($tim_food_drink) . "'";
                }
            }
        ?>
    </div>

</body>
</html>
