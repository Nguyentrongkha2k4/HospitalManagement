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
        <title>general</title>
        <link rel="stylesheet" href="generalPage.css">
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
                    <div>QUẢN LÝ BÁC SĨ</div>
                </button>
                <button onclick="patient()" class="patient">
                    <div>QUẢN LÝ NGƯỜI BỆNH</div>
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
                <div class="login"><span><?php  echo $_SESSION['user']['Username']?></span> <a class="logout" href="logout.php">Thoát</a></div>
            </div>
        </div>
        <div class="Title">
            <h1 >Tận tâm chăm sóc sức khỏe cùng Bệnh viện Đại học Bách Khoa: 
                Nâng cao chất lượng sống, đồng hành cùng bạn mỗi ngày</h1>
            <p>
                Bệnh viện Đại học Bách Khoa, với hơn một thập kỷ hoạt động, 
                đã khẳng định vị thế của mình là một trong những cơ sở y tế hàng đầu tại thành phố 
                Hồ Chí Minh và cả nước Việt Nam. Với tầm nhìn và sứ mệnh "Chăm sóc sức khỏe - Nâng cao chất lượng sống", 
                chúng tôi cam kết mang lại các dịch vụ y tế chất lượng, an toàn và hiệu quả nhất cho cộng đồng.
            </p>
            <img class="img-container" src="imagine/general.jpg">
            <p>Bệnh viện Đại học Bách Khoa không chỉ là nơi cung cấp các dịch vụ y tế tiên tiến mà 
                còn là một trung tâm nghiên cứu y học hàng đầu. Với đội ngũ y bác sĩ, nhân viên y tế 
                và các chuyên gia hàng đầu, chúng tôi không ngừng tìm kiếm và 
                áp dụng những phương pháp điều trị mới nhất và hiệu quả nhất cho bệnh nhân.</p>
            <p>Bệnh viện Đại học Bách Khoa tự hào về cơ sở vật chất hiện đại và trang thiết bị y 
                tế tiên tiến. Tại đây, mỗi bệnh nhân được đặt vào trung tâm của 
                quy trình điều trị, với sự chăm sóc và tư vấn tận tình từ đội ngũ y bác sĩ và nhân viên y tế.</p>
            <p>Chúng tôi luôn đặc biệt coi trọng tinh thần đoàn kết và sự tin cậy từ phía bệnh nhân. Từ những ca phẫu thuật phức tạp đến các dịch vụ y tế cơ bản, chúng tôi cam kết mang 
                lại sự an tâm và tin cậy tuyệt đối cho mọi người 
                khi đặt niềm tin vào Bệnh viện Đại học Bách Khoa.</p>
            <p>Với đội ngũ y bác sĩ giàu kinh nghiệm và trình độ chuyên môn cao, 
                cùng với sự hỗ trợ từ các chuyên gia hàng đầu trong lĩnh vực y tế, Bệnh viện Đại học Bách Khoa sẽ 
                tiếp tục nỗ lực không ngừng để mang lại sự hài lòng và đáng tin cậy nhất cho mọi bệnh nhân.</p>
        </div>
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
                <p class="adver">0385484729</p>
                <p class="adver-detail">Kết nối chăm sóc sức khỏe mọi lúc, mọi nơi: Bệnh viện luôn sẵn lòng lắng nghe và hỗ trợ.</p>
            </div>
        </div>  
    </body>
    </html>