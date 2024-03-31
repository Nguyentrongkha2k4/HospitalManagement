<!DOCTYPE html>
<html lang="en">
<head>
    <title>detail-patient</title>
    <link rel="stylesheet" href="general.css">
    <link rel="stylesheet" href="detail-patient.css">
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
<div class="patient1">
    <div class="general-info">
        <div>
            <img src="/imagine/patient1.jpg" class="imag">  
        </div>
        <div class="basic-info">
            <br>
            <p class="gen name" contenteditable="false">Tên: Nguyễn Phúc Hưng</p> <br>
            <p class="gen date" contenteditable="false">Ngày sinh: 11/01/2004</p> <br>
            <p class="gen identidy" contenteditable="false">CCCD: 03845730459384</p> <br>
            <p class="gen address" contenteditable="false">Địa chỉ: Ký túc xá khu B Đại học quốc gia</p> <br>
            <div class="primary-container" style="height: 300px ;">
                <button class="primary" onclick="editGeneral('.gen')">Chỉnh sửa</button>
            </div>
        </div>
    </div>
    <div class="detail-info" >
        <p class="det history" contenteditable="false">Lịch sử bệnh án: Chưa từng khám trước đây</p> <br>
            <ol class="det result" contenteditable="false">Kết quả xét nghiệm:</ol> <br>
            <li class="det result" contenteditable="false">Siêu âm:  Kích thước và cấu trúc gan bình thường, 
                không có dấu hiệu của sỏi hoặc khối u.
                Túi mật có hình dạng bình thường và không có 
                dấu hiệu của sỏi hoặc vi khuẩn.
                Kích thước và hình dạng tụy bình thường, không có dấu hiệu của viêm hoặc khối u. </li> <br>
            <li class="det result" contenteditable="false">Nội soi: Niêm mạc của dạ dày trông khá trơn tru và
                không có dấu hiệu của viêm loét hoặc polyp.  Niêm mạc ruột non trông mịn và 
                không có dấu hiệu của viêm loét, sưng tấy hoặc polyp. Niêm mạc ruột già cũng 
                trông mịn và không có dấu hiệu của viêm loét, sưng tấy hoặc polyp. </li> <br>
            <li class="det result" contenteditable="false">Xét nghiệm máu: Số lượng hồng cầu trong mẫu máu nằm trong phạm vi bình thường, 
                chỉ ra khả năng vận chuyển oxy đến các mô và cơ quan trong cơ thể. Mức độ hemoglobin
                trong máu cũng ở mức bình thường, đảm bảo khả năng vận chuyển oxy hiệu quả.
                Tỷ lệ của thể tích hồng cầu so với tổng thể tích máu cũng ở mức bình thường.</li> <br>
                <select class="select" name="specialty-doctor-select">
                    <option value="All" class="doctor">Bác sĩ đang khám</option>
                    <option value="ád" class="doctor">ád</option>
                    <option value="ád" class="doctor">ád</option>
                    <option value="ád" class="doctor">ád</option>
                    <option value="ád" class="doctor">ád</option>
                    <option value="ád" class="doctor">ads</option>
                    <option value="ád" class="doctor">ád</option>
                    <option value="ád" class="doctor">ád</option>
                    <option value="ád" class="doctor">ád</option>
                    <option value="ád" class="doctor">dá</option>
                    <option value="ád" class="doctor">dá</option>
                    <option value="ads" class="doctor">đá</option>
                </select>
                <br> <br> <br>
                <div class="primary-container">
                    <button class="primary" onclick="editDetail('.det')">Chỉnh sửa</button>
                </div>
    </div>
</div>
<br><br>
<div class="save-container">
    <button class="save" onclick="saveButton()">Lưu</button>
</div>
<br> <br>
<script>
    // var editG = false;
    // var editD = false;
    // var i = 0;
    // var j = 0;
    function editGeneral(classSelector) {
        // i++;
        var gen = document.querySelectorAll(classSelector);
        // editG = !editG;
        gen.forEach(function(element){
            element.contentEditable = true;
        });
    }
    function editDetail(classSelector) {
        // j++;
        var det = document.querySelectorAll(classSelector);
        // editD = !editD;
        det.forEach(function(element){
            element.contentEditable = true;
        });
    }
    function saveButton(){
        var saveG = document.querySelectorAll('.gen');
        var saveD = document.querySelectorAll('.det');
        var content1 = "";
        var content2 = "";
        saveG.forEach(function(element){
            element.contentEditable = false;
            content1 += element.innerHTML + "\n";
        });
        saveD.forEach(function(element){
            element.contentEditable = false;
            content2 += element.innerHTML + "\n";
        });
        console.log("Nội dung đã lưu: ", content1);
        console.log("Nội dung đã lưu: ", content2);
        alert("Nội dung đã được lưu!");
    }
</script>
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