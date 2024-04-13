<?php 
include("config.php");
include("firebaseRDB.php");

if(!isset($_SESSION['user'])){
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Thông tin liên lạc</title>
        <link rel="stylesheet" href="contact.css">
        <link rel="stylesheet" href="general.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    </head>
    <body>
        <div class="header"> 
            <div onclick="home()" class="left">Hospital</div>
            <script>
                function home(){
                    window.location = "home.php";
                }
            </script>
            <div class="middle">
                <div></div>
                <button onclick="general()" class="general">
                    <div>TỔNG QUAN</div>
                </button>
                <button onclick="contact()" class="contact">
                    <div>THÔNG TIN LIÊN HỆ</div>
                </button>
                <button onclick="treatment()" class="treatment">
                    <div>QUẢN LÝ NHÂN VIÊN</div>
                </button>
                <button onclick="patient()" class="patient">
                    <div>QUẢN LÝ BỆNH NHÂN</div>
                </button>
                <button onclick="medicine()" class="medicine">
                    <div>QUẢN LÝ THUỐC</div>
                </button> 
                <button onclick="device()" class="device">
                    <div>THIẾT BỊ Y TẾ</div>
                </button>
                <script>
                    function general(){
                        window.location = "generalPage.php";
                    }
                    function contact(){
                        window.location = "contact.php";
                    }
                    function treatment(){
                        window.location = "doctor.php";
                    }
                    function patient(){
                        window.location = "patient.php";
                    }
                    function medicine(){
                        window.location = "medicine.php";
                    }
                    function device(){
                        window.location = "device.php";
                    }
                </script>
            </div>
            <div class="right">
                <div class="login"><span><?php  echo $_SESSION['user']['Username']?>,</span> <a class="logout" href="logout.php">Thoát</a></div>
            </div>
        </div>
        <div class="contactTitle">
            <h1>Thông tin liên hệ</h1>
            <div class="main">
                <img class="main-picture" src="imagine/general.jpg">
                <div>
                    <h2>Bệnh viện Đại học Bách Khoa - cơ sở 1</h2>
                    <p class="address">268 Lý Thường Kiệt, Q.10, Tp.HCM</p>
                    <p>
                        <span>SĐT: </span>
                        <span class="phone-contact">19001213</span>
                    </p>
                    <p>
                        <span>Email: </span>
                        <span class="email">hotro1.bkhospital@bk.com.vn</span>
                    </p>
                </div>
            </div>
            <p>&nbsp;</p> 
            <p>&nbsp;</p> 
            <p>&nbsp;</p> 
            <div class="sub">
                <img class="main-picture" src="imagine/contact.jpg">
                <div>
                    <h2>Bệnh viện Đại học Bách Khoa - cơ sở 2</h2>
                    <p class="address">268 Lý Thường Kiệt, phường 14, Quận 10, TP. HCM</p>
                    <p>
                        <span>SĐT: </span>
                        <span class="phone-contact">19001214</span>
                    </p>
                    <p>
                        <span>Email: </span>
                        <span class="email">hotro2.bkhospital@bk.com.vn</span>
                    </p>
                </div>
            </div>
        </div>
        <p>&nbsp;</p> 
        <p>&nbsp;</p> 
        <p>&nbsp;</p> 
        <p>&nbsp;</p> 

        <div class="end-of-page">
            <div class="modern">
                <i class='bx bxs-devices'></i>
                <p class="adver">Thiết bị y tế hiện đại</p>
                <p class="adver-detail">Đường dẫn tới sức khỏe bền vững: Kết nối công nghệ, chăm sóc y tế tận tâm.</p>
            </div>
            <div class="qualification">
                <i class='bx bxs-shopping-bag-alt'></i>
                <p class="adver">Bác sĩ có chuyên môn cao</p>
                <p class="adver-detail">Chất lượng dịch vụ y tế vượt trội với đội ngũ bác sĩ có trình độ cao và tâm huyết.</p>
            </div>
            <div class="heart">
                <i class='bx bxs-donate-heart'></i>
                <p class="adver">Nhân viên y tế tận tình</p>
                <p class="adver-detail">Chăm sóc từ trái tim: Đội ngũ y tế với tâm hồn của người chăm sóc.</p>
            </div>
            <div class="phone">
                <i class='bx bxs-phone'></i>
                <p class="adver">19001214</p>
                <p class="adver-detail">Kết nối chăm sóc sức khỏe mọi lúc, mọi nơi: Bệnh viện luôn sẵn lòng lắng nghe và hỗ trợ.</p>
            </div>
        </div>
    </body>
</html>