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
        <title>Quản lý thiết bị</title>
        <link rel="stylesheet" href="device.css">
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
        <div class="find">
            <h2>TÌM THIẾT BỊ Y TẾ</h2> <br> <br>
            <p>Vui lòng loại thiết bị y tế cần tìm, viết ra tên thiết bị để tìm nhanh hơn</p> <br>
            <form action="/device.php" method="get">
                <select class="select" name="purpose-device-select">
                    <option value="All" class="doctor">Theo mục đích sử dụng</option>
                    <option value="Chẩn đoán" class="doctor">Chẩn đoán</option>
                    <option value="Điều trị" class="doctor">Điều trị</option>
                    <option value="Hỗ trợ" class="doctor">Hỗ trợ</option>
                </select>
                <select class="select" name="kind-device-select">
                    <option value="All" class="doctor">Theo loại thiết bị</option>
                    <option value="Thiết bị điện" class="doctor">Thiết bị điện</option>
                    <option value="Thiết bị cơ học" class="doctor">Thiết bị cơ học</option>
                    <option value="Thiết bị điện tử" class="doctor">Thiết bị điện tử</option>
                </select>
                <select class="select" name="toxic-device-select">
                    <option value="All" class="doctor">Nguy cơ và quản lý</option>
                    <option value="An toàn loại I" class="doctor">Loại I</option>
                    <option value="An toàn loại II" class="doctor">Loại II</option>
                    <option value="An toàn loại III" class="doctor">Loại III</option>
                    <option value="Đơn giản" class="doctor">Đơn giản</option>
                    <option value="Phức tạp" class="doctor">Phức tạp</option>Phức tạp</option>
                </select>
                <input type = "text" placeholder="Tìm kiếm tên thiết bị">
                <button class="search-button">
                    <img class="search-icon" src="icon/search-replace.png">
                </button>
            </form>
        </div>
        <div class="device1">
            <h2>Máy Siêu Âm (Ultrasound Machine)</h2>
            <p>Công dụng:  Máy siêu âm được sử dụng để tạo ra 
            hình ảnh của cơ thể bằng cách sử dụng sóng siêu âm. 
            Nó được sử dụng để chẩn đoán và theo dõi các tình trạng bệnh 
            lý trong nhiều lĩnh vực
            y tế như sản phụ khoa, nội soi, tim mạch, và da liễu.</p>
            <p>Hoạt động: Máy siêu âm tạo ra sóng siêu âm và phát 
            chúng vào cơ thể thông qua một đầu dò. Sóng siêu âm sẽ phản xạ lại từ cấu trúc bên 
            trong cơ thể và được máy ghi nhận để tạo ra hình ảnh.</p>
            <p>Lịch sử bảo dưỡng: gần đầy nhất vào 11/11/2023</p>
            <p>Sự sẵn có: không</p>
        </div>
        <div class="device1">
            <h2>Máy X-quang (X-ray Machine)</h2>
            <p>Công dụng:  Máy X-quang được sử dụng để tạo ra 
            hình ảnh của cơ thể bằng cách sử dụng tia X. Nó được sử 
            dụng rộng rãi trong chẩn đoán và theo dõi các tình trạng bệnh lý như gãy xương, 
            nhiễm trùng, bệnh phổi, và nhiều bệnh lý khác.</p>
            <p>Hoạt động: Máy X-quang tạo ra tia X từ một 
            nguồn tia X và hướng chúng vào cơ thể thông qua 
            một máy phát tia X. Tia X sẽ đi qua cơ thể và được máy ghi nhận trên một tấm phim hoặc bảng cảm biến, 
            tạo ra hình ảnh phản xạ cấu trúc bên trong cơ thể.</p>
            <p>Lịch sử bảo dưỡng: gần đầy nhất vào 10/10/2023</p>
            <p>Sự sẵn có: có</p>
        </div>
        <div class="order-container">
            <button class="order">&lt</button>
            <button class="number">1</button>
            <button class="order">&gt</button>
        </div> <br> <br>
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