<?php 
include("config.php");
include("firebaseRDB.php");

if(!isset($_SESSION['user'])){
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
    <head></body>
    </html>
        <title>Quản lý bệnh nhân</title>
        <link rel="stylesheet" href="patient.css">
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
            <h2>THÔNG TIN BỆNH NHÂN</h2> <br> <br>
            <p>Vui lòng nhập thông tin cá nhân để tìm kiếm nhanh hơn</p> <br>
            <form action="/patient.php" method="post">
                <input type = "text" placeholder="Nhập CCCD" name="Nhập CCCD">
                <input type = "date" name="Ngày sinh bệnh nhân">
                <input type = "text" placeholder="Tìm kiếm tên bệnh nhân" name="Tìm kiếm tên bệnh nhân">
                <button class="search-button">
                    <img class="search-icon" src="icon/search-replace.png">
                </button>
            </form>
        </div>
        <br> <br> <br>
        <div class="add-container">
            <button class="add">Thêm</button>
        </div>
        <div class="patient-info-container">
            <img class="patient-info" src="imagine/patient1.jpg" >
            <div class="info">
                <br>
                <h3>Thông tin cá nhân</h3> <br>
                <p class="name">Tên: Nguyễn Phúc Hưng</p> <br>
                <p>CCCD: 03845730459384</p> <br>
                <p>Địa chỉ: Ký túc xá khu B Đại học quốc gia</p> <br>
                <p>Lịch sử bệnh án: Chưa từng khám trước đây</p> <br>
                <ol>Kết quả xét nghiệm:</ol> <br>
                <li>Siêu âm:  Kích thước và cấu trúc gan bình thường, 
                    không có dấu hiệu của sỏi hoặc khối u.
                    Túi mật có hình dạng bình thường và không có 
                    dấu hiệu của sỏi hoặc vi khuẩn.
                    Kích thước và hình dạng tụy bình thường, không có dấu hiệu của viêm hoặc khối u. </li> <br>
                <li>Nội soi: Niêm mạc của dạ dày trông khá trơn tru và
                     không có dấu hiệu của viêm loét hoặc polyp.  Niêm mạc ruột non trông mịn và 
                     không có dấu hiệu của viêm loét, sưng tấy hoặc polyp. Niêm mạc ruột già cũng 
                     trông mịn và không có dấu hiệu của viêm loét, sưng tấy hoặc polyp. </li> <br>
                <li>Xét nghiệm máu: Số lượng hồng cầu trong mẫu máu nằm trong phạm vi bình thường, 
                    chỉ ra khả năng vận chuyển oxy đến các mô và cơ quan trong cơ thể. Mức độ hemoglobin
                    trong máu cũng ở mức bình thường, đảm bảo khả năng vận chuyển oxy hiệu quả.
                    Tỷ lệ của thể tích hồng cầu so với tổng thể tích máu cũng ở mức bình thường.</li> <br>
            </div>
        </div>
        <div class="delete-container">
            <button class="delete">xóa</button>
        </div> 
        <br><br><br>
        <div class="patient-info-container">
<a href="patientInfo.php">chuyen</a>
            <img class="patient-info" src="imagine/patient2.jpg" >
            <div class="info">
                <br>
                <h3>Thông tin cá nhân</h3> <br>
                <p class="name">Tên: Nguyễn Thị Kha</p> <br>
                <p>CCCD: 0325984578345</p> <br>
                <p>Địa chỉ: Ký túc xá khu A Đại học quốc gia</p> <br>
                <p>Lịch sử bệnh án: Chưa từng khám trước đây</p> <br>
                <ol>Kết quả xét nghiệm:</ol> <br>
                <li>Siêu âm:  Kích thước và cấu trúc của thận bình thường, 
                    không có sỏi thận hoặc dấu hiệu của các vấn đề khác như 
                    viêm nhiễm. Có thể thấy buồng trứng bình thường mà không có dấu hiệu 
                    của polyp hoặc các vấn đề khác. Kích thước và hình dạng tử cung bình thường, 
                    không có dấu hiệu của polyp, u hoặc các vấn đề khác. </li> <br>
                <li>Nội soi: Niêm mạc của lá lách không có dấu hiệu của viêm loét hoặc khối u. 
                    Niêm mạc trực tràng có thể được đánh giá để xác 
                    định sự hiện diện của các vấn đề như viêm loét, polyp hoặc khối u. </li> <br>
                <li>Xét nghiệm máu: Số lượng bạch cầu trong máu, 
                    bao gồm các loại như bạch cầu cụ thể (neutrophils, eosinophils, basophils), 
                    lymphocytes và monocytes, cũng đều trong phạm vi bình thường,
                    gợi ý về khả năng phòng ngừa nhiễm trùng và bảo vệ cơ thể khỏi các tác nhân gây bệnh.
                    Các chỉ số như MCV (mean corpuscular volume), MCH (mean corpuscular hemoglobin), và MCHC (mean corpuscular hemoglobin concentration) 
                    đều ở mức bình thường, cho thấy các thông số 
                    quan trọng về kích thước và hàm lượng của các tế bào máu.</li> <br>
            </div>
        </div>
        <div class="delete-container">
            <button class="delete">xóa</button>
        </div> 
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