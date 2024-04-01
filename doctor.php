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
        <title>Quản lý bác sĩ</title>
        <link rel="stylesheet" href="doctor.css">
        <link rel="stylesheet" href="general.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
                //     $(document).ready(function(){
                //     // Bắt sự kiện click vào nút chỉnh sửa
                //     $("#editButton").click(function(){
                //         // Lấy nội dung hiện tại của phần tử bạn muốn chỉnh sửa
                //         var doctor_name = $(".doctor_name_modal").text().trim();
                //         var subject = $(".subject_modal").text().trim()
                //         var schedul = $(".time_modal").text().trim()
                //         // Hiển thị input để người dùng chỉnh sửa
                //         $(".doctor_name_modal").html("<input type='text' id='editDocterName' class='form-control' value='" + doctor_name + "'>");
                //         $(".subject_modal").html("<input type='text' id='editSubject' class='form-control' value='" + subject + "'>");
                //         $(".time_modal").html("<input type='text' id='editSchedul' class='form-control' value='" + schedul + "'>");
                //         // Ẩn nút chỉnh sửa và hiển thị nút lưu
                //         $("#editButton").hide();
                //         $("#saveButton").show();
                //     });

                //     // Bắt sự kiện click vào nút lưu
                //     $("#saveButton").click(function(){
                //         // Lấy giá trị mới từ input
                //         var newName = $("#editDocterName").val();
                //         var newSubject = $("#editSubject").val();
                //         var newSchedule = $("#editSchedul").val();
                //         // Hiển thị giá trị mới trong phần tử
                //         $(".doctor_name_modal").html("<h2>" + newName + "</h2>");
                //         $("#doctor_name").html("<h2>" + newName + "</h2>");
                //         $(".subject_modal").html("<p>" +newSubject+ "<\p>")
                //         $(".subject").html("<p>" +newSubject+ "<\p>")
                //         $(".time_modal").html("<p>" +newSchedule+ "<\p>")
                //         $(".time").html("<p>" +newSchedule+ "<\p>")
                //         // Ẩn nút lưu và hiển thị nút chỉnh sửa
                //         $("#editButton").show();
                //         $("#saveButton").hide();
                //     });
                // });
                </script>
            </div>
            <div class="right">
                <div class="login"><span><?php  echo $_SESSION['user']['Username']?>,</span> <a class="logout" href="logout.php">Thoát</a></div>
            </div>
        </div>
        <div class="find">
            <h2>TÌM BÁC SĨ</h2> <br> <br>
            <p>Vui lòng chọn chuyên khoa cần khám hoặc tìm kiếm để nhanh hơn</p> <br>
            <form action="doctor-action.php" method="post">
<!-- need input ID doctor -->
                <select class="select" name="specialty-doctor-select">
                    <option value="All" class="doctor">Tìm kiếm chuyên ngành</option>
                    <option value="Nội khoa" class="doctor">Nội khoa</option>
                    <option value="Ngoại khoa" class="doctor">Ngoại khoa</option>
                    <option value="Nhi khoa" class="doctor">Nhi khoa</option>
                    <option value="Y học gia đình" class="doctor">Y học gia đình</option>
                    <option value="Y học khẩn cấp" class="doctor">Y học khẩn cấp</option>
                    <option value="Nhiễm" class="doctor">Nhiễm</option>
                    <option value="Nội tiết" class="doctor">Nội tiết</option>
                    <option value="Tim mạch" class="doctor">Tim mạch</option>
                    <option value="Hô hấp" class="doctor">Hô hấp</option>
                    <option value="Da liễu" class="doctor">Da liễu</option>
                    <option value="Nội soi" class="doctor">Nội soi</option>
                </select>
                <select class="select" name="day-doctor-select">
                    <option value="All" class="doctor">Tìm kiếm ngày khám</option>
                    <option value="Thứ hai" class="doctor">Thứ hai</option>
                    <option value="Thứ ba" class="doctor">Thứ ba</option>
                    <option value="Thứ tư" class="doctor">Thứ tư</option>
                    <option value="Thứ năm" class="doctor">Thứ năm</option>
                    <option value="Thứ sáu" class="doctor">Thứ sáu</option>
                    <option value="Thứ bảy" class="doctor">Thứ bảy</option>
                </select>
                <select class="select" name="qualification-doctor-select">
                    <option value="All" class="doctor">Tìm kiếm bằng cấp</option>
                    <option value="GS TS BS" class="doctor">GS TS BS</option>
                    <option value="PGS TS BS" class="doctor">PGS TS BS</option>
                    <option value="TS BS" class="doctor">TS BS</option>
                    <option value="BS CKII" class="doctor">BS CKII</option>
                    <option value="THS BS" class="doctor">THS BS</option>
                    <option value="BS CKI" class="doctor">BS CKI</option>
                    <option value="BS" class="doctor">BS</option>
                </select>
                <input type = "text" placeholder="Tìm kiếm tên bác sĩ">
                <input type = "text" placeholder="Tìm kiếm ID">
                <button class="search-button">
                    <img class="search-icon" src="icon/search-replace.png">
                </button>
            </form>
        </div>
        <br> <br>
        <div class="info-container">
            <div class="info">
            <a class="detail-info" href="#" data-toggle="modal" data-target="#myModal" id = "doctor_name">GS TS BS. Nguyễn Phúc Hưng</a>  <br>
            </div>
            <br> <br>
            <div class="info">
           <a class="detail-info" href="#" data-toggle="modal" data-target="#myModal" id = "doctor_name">GS TS BS. Nguyễn Phúc Hưng</a>  <br>
            </div>
            <br> <br>
            <div class="info">
           <a class="detail-info" href="#" data-toggle="modal" data-target="#myModal" id = "doctor_name">GS TS BS. Nguyễn Phúc Hưng</a>  <br>
            </div>
            <br> <br>
            <div class="info">
           <a class="detail-info" href="#" data-toggle="modal" data-target="#myModal" id = "doctor_name">GS TS BS. Nguyễn Phúc Hưng</a>  <br>
            </div>
        </div> 
        <br> <br>
        <div class="related-data-container">
            <button class="add-data">Thêm</button>
            <button class="delete-data">Xóa</button>
        </div>
        <br> <br>
        <div class="find">
            <h2>TÌM Y TÁ</h2> <br> <br>
            <p>Vui lòng chọn chuyên khoa cần khám hoặc tìm kiếm để nhanh hơn</p> <br>
            <form class="search-form" action="/doctor.php" method="get">
                <select class="select" name="specialty-nurse-select">
                    <option value="All" class="nurse">Tìm kiếm chuyên ngành</option>
                    <option value="Y tá phẫu thuật" class="nurse">Y tá phẫu thuật</option>
                    <option value="Ngoại khoa" class="nurse">Y tá cấp cứu</option>
                    <option value="Y tá cấp cứu" class="nurse">Y tá nội khoa</option>
                    <option value="Y học trẻ em" class="nurse">Y học trẻ em</option>
                    <option value="Y học khẩn cấp" class="nurse">Y học cộng đồng</option>
                    <option value="Y học cộng đồng" class="nurse">Y tá tâm thần</option>
                    <option value="Y tá chăm sóc đặc biệt" class="nurse">Y tá chăm sóc đặc biệt</option>
                    <option value="Y tá khó khăn" class="nurse">Y tá khó khăn</option>
                </select>
                <select class="select" name="day-nurse-select">
                    <option value="All" class="nurse">Tìm kiếm ngày khám</option>
                    <option value="Thứ hai" class="nurse">Thứ hai</option>
                    <option value="Thứ ba" class="nurse">Thứ ba</option>
                    <option value="Thứ tư" class="nurse">Thứ tư</option>
                    <option value="Thứ năm" class="nurse">Thứ năm</option>
                    <option value="Thứ sáu" class="nurse">Thứ sáu</option>
                    <option value="Thứ bảy" class="nurse">Thứ bảy</option>
                </select>
                <select class="select" name="qualification-nurse-select">
                    <option value="All" class="nurse">Tìm kiếm bằng cấp</option>
                    <option value="Tiến sĩ Y học" class="nurse">Tiến sĩ Y học</option>
                    <option value="Thạc sĩ y tá" class="nurse">Thạc sĩ y tá</option>
                    <option value="Y tá thực hành" class="nurse">Y tá thực hành</option>
                    <option value="Cử nhân y tá" class="nurse">Cử nhân y tá</option>
                    <option value="Bằng y tế phổ thông" class="nurse">Bằng y tế phổ thông</option>
                </select>
                <input type = "text" placeholder="Tìm kiếm tên y tá">
                <input type = "text" placeholder="Tìm kiếm ID">
                <button class="search-button">
                    <img class="search-icon" src="icon/search-replace.png">
                </button>
            </form>
        </div>
        <br> <br>
        <div class="info-container">
            <div class="info">
           <a class="detail-info" href="#" data-toggle="modal" data-target="#myModal" id = "doctor_name">GS TS BS. Nguyễn Phúc Hưng</a>  <br>
            </div>
            <br> <br>
            <div class="info">
           <a class="detail-info" href="#" data-toggle="modal" data-target="#myModal" id = "doctor_name">GS TS BS. Nguyễn Phúc Hưng</a>  <br>
            </div>
            <br> <br>
            <div class="info">
           <a class="detail-info" href="#" data-toggle="modal" data-target="#myModal" id = "doctor_name">GS TS BS. Nguyễn Phúc Hưng</a>  <br>
            </div>
            <br> <br>
            <div class="info">
           <a class="detail-info" href="#" data-toggle="modal" data-target="#myModal" id = "doctor_name">GS TS BS. Nguyễn Phúc Hưng</a>  <br>
            </div>
        </div>
        <br> <br>
        <div class="related-data-container">
            <button class="add-data">Thêm</button>
            <button class="delete-data">Xóa</button>
        </div>
            
        </div>
        <div class="find">
            <h2>TÌM NHÂN VIÊN HỖ TRỢ</h2> <br> <br>
            <p>Vui lòng chọn chuyên khoa cần khám hoặc tìm kiếm để nhanh hơn</p> <br>
            <form action="/doctor.php" method="get">
                <select class="select" name="specialty-assistant-select">
                    <option value="All" class="assistant">Tìm kiếm chuyên ngành</option>
                    <option value="Kĩ thuật viên" class="assistant">Kĩ thuật viên</option>
                    <option value="Nhân viên y tế" class="assistant">Nhân viên y tế</option>
                    <option value="Nhân viên vệ sinh" class="assistant">Nhân viên vệ sinh</option>
                    <option value="Lễ tân" class="assistant">Lễ tân</option>
                    <option value="Chuyên viên tài chính" class="assistant">Chuyên viên tài chính</option>
                </select>
                <select class="select" name="day-assistant-select">
                    <option value="All" class="assistant">Ngày làm việc</option>
                    <option value="Thứ hai" class="assistant">Thứ hai</option>
                    <option value="Thứ ba" class="assistant">Thứ ba</option>
                    <option value="Thứ tư" class="assistant">Thứ tư</option>
                    <option value="Thứ năm" class="assistant">Thứ năm</option>
                    <option value="Thứ sáu" class="assistant">Thứ sáu</option>
                    <option value="Thứ bảy" class="assistant">Thứ bảy</option>
                </select>
                <select class="select" name="qualification-assistant-select">
                    <option value="All" class="assistant">Tìm kiếm bằng cấp</option>
                    <option value="Đã học đại học" class="assistant">Đã học đại học</option>
                    <option value="Chưa học đại học" class="assistant">Chưa học đại học</option>
                </select>
                <input type = "text" placeholder="Tìm kiếm tên nhân viên">
                <input type = "text" placeholder="Tìm kiếm ID">
                <button class="search-button">
                    <img class="search-icon" src="icon/search-replace.png">
                </button>
            </form>
        </div>
        <br> <br>
        <div class="info-container">
            <div class="info">
           <a class="detail-info" href="#" data-toggle="modal" data-target="#myModal" id = "doctor_name">GS TS BS. Nguyễn Phúc Hưng</a>  <br>
            </div>
            <br> <br>
            <div class="info">
            <a class="detail-info"   href="#" data-toggle="modal" data-target="#myModal" id = "doctor_name">GS TS BS. Nguyễn Phúc Hưng</a>  <br>
            </div>
            <br> <br>
            <div class="info">
           <a class="detail-info" href="#" data-toggle="modal" data-target="#myModal" id = "doctor_name">GS TS BS. Nguyễn Phúc Hưng</a>  <br>
            </div>
            <br> <br>
            <div class="info">
           <a class="detail-info" href="#" data-toggle="modal" data-target="#myModal" id = "doctor_name">GS TS BS. Nguyễn Phúc Hưng</a>  <br>
            </div>
            <br><br><br><br><br><br><br><br><br>
        </div>
        <br> <br>
        <div class="related-data-container">
            <button class="add-data">Thêm</button>
            <button class="delete-data">Xóa</button>
        </div>
        </div>
        <br><br><br><br><br>
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
        <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Thông tin bác sĩ</h2>
                </div>
                <br>
                <br>
            <div class="modal-body">
                <div class="doctor-image">
                    <img src="/imagine/doctor.jpg" alt="Ảnh bác sĩ" style="width: 100%; height: auto;">
                </div>
                <div class="doctor-info">
                        <h2 class="doctor_name_modal">GS TS BS. Nguyễn Phúc Hưng</h2> 
                        <p class="subject_modal">Tổng giám đốc của công ti</p>
                        <div class="scheduling-container">
                            <p class="scheduling">Lịch khám</p>
                            <p class="time_modal">Sáng thứ 2, sáng thứ 5, sáng thứ 7</p>
                        </div>
                        <p class="scheduling-patient">Bệnh nhân đang khám: </p>
                        <p class="detail-patient">Nguyễn Trọng Kha, ...</p>
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editButton">Chỉnh sửa</button> <!-- Thêm button chỉnh sửa -->
                    <button type="button" class="btn btn-success" id="saveButton" style="display: none;">Lưu</button> <!-- Thêm button lưu -->
                </div>
            </div>
        </div>
    </div>
</div>
    </body>
    </html>