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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
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

<!-- Doctor -->
        <div class="findfirst">
            <h2>TÌM BÁC SĨ</h2>
            <p>Vui lòng chọn chuyên khoa cần khám hoặc tìm kiếm để nhanh hơn</p> <br>
            <form class="search-form" action="doctor-action.php" method="post">
                <input type = "text" placeholder="Tìm kiếm ID" name="ID">
                <input type = "text" placeholder="Tìm kiếm tên bác sĩ" name="doctorName">
                <select name="khoa">
                    <option >Khoa</option>
                    <option value="khoa ngoại tổng hợp">Khoa ngoại tổng hợp</option>
                    <option value="khoa nội tổng hợp">Khoa nội tổng hợp</option>
                    <option value="khoa răng-hàm-mặt">Khoa răng-hàm-mặt</option>
                    <option value="khoa tai-mũi-họng">Khoa tai-mũi-họng</option>
                    <option value="khoa da liễu">Khoa da liễu</option>
                    <option value="khoa thần kinh">Khoa thần kinh</option>
                </select>
                <select name="position">
                    <option>Chức vụ</option>
                    <option value="resident">Viện Trưởng</option>
                    <option value="leader">Trưởng Khoa</option>
                    <option value="doctor">Bác sĩ</option>
                </select>
                <button type="submit" class="search-button" title="Tìm kiếm">
                    <img class="search-icon" src="icon/search-replace.png">
                </button>
            </form>
        </div>
        
        <div class="insertMedicine">
        <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#adddoctor" data-bs-whatever="Tên thuốc">Thêm bác sĩ</button>
            <div class="modal fade" id="adddoctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-xl modal-dialog-scrollable" s>
                <div class="modal-content" style="margin-top: 0;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm bác sĩ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="doctorInsert.php" method="post">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">ID:</label>
                        <input type="text" class="form-control" id="recipient-name" name="ID" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Họ và tên:</label>
                        <input type="text" class="form-control" id="recipient-name" name="doctorName" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">CCCD:</label>
                        <input type="text" class="form-control" id="recipient-name" name="CCCD" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Ngày sinh:</label>
                        <input type="date" class="form-control" id="recipient-name" name="dateofborn" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Địa chỉ:</label>
                        <input type="text" class="form-control" id="recipient-name" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Bằng cấp:</label>
                        <input type="text" class="form-control" id="recipient-name" name="degree" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Khoa điều trị:</label>
                        <select name="khoa" class="form-control" id="recipient-name">
                            <option value="khoa ngoại tổng hợp">Khoa ngoại tổng hợp</option>
                            <option value="khoa nội tổng hợp">Khoa nội tổng hợp</option>
                            <option value="khoa răng-hàm-mặt">Khoa răng-hàm-mặt</option>
                            <option value="khoa tai-mũi-họng">Khoa tai-mũi-họng</option>
                            <option value="khoa da liễu">Khoa da liễu</option>
                            <option value="khoa thần kinh">Khoa thần kinh</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Chức vụ:</label>
                        <select name="position" class="form-control" id="recipient-name">
                            <option value="resident">Viện Trưởng</option>
                            <option value="leader">Trưởng Khoa</option>
                            <option value="doctor">Bác sĩ</option>
                        </select>
                    </div>

                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Lưu</button>
                </div>
            </form>
                </div>
            </div>
            </div>
        </div>


        <div class="box-list">
            <div class="listbox">
                <div class="infoStaff">
                    <div class="staff1">
                        <h2>Nguyễn Phúc Hưng</h2>
                        <p>CCCD: 03845730459384</p>
                        <p>Địa chỉ: Ký túc xá khu B Đại học quốc gia</p>
                    </div>
                </div>
                <div class="buttonFunc">
                    <button type="button" class="insert-but" data-bs-toggle="modal" onclick ="patientInfo()">Thông tin chi tiết</button>
                <script> function patientInfo(){window.location = "doctorInfo.php";} </script>
                
                </div>
            </div>
            <div class="listbox">
                <div class="infoStaff">
                    <div class="staff1">
                        <h2>Nguyễn Phúc Hưng</h2>
                        <p>CCCD: 03845730459384</p>
                        <p>Địa chỉ: Ký túc xá khu B Đại học quốc gia</p>
                    </div>
                </div>
                <div class="buttonFunc">
                    <button type="button" class="insert-but" data-bs-toggle="modal" onclick ="patientInfo()">Thông tin chi tiết</button>
                <script> function patientInfo(){window.location = "patientInfo.php";} </script>
                
                </div>
            </div>
            
        </div>

<!-- Nurse -->
        <div class="find">
            <h2>TÌM Y TÁ</h2>
            <p>Vui lòng chọn chuyên khoa cần khám hoặc tìm kiếm để nhanh hơn</p> <br>
            <form class="search-form" action="doctorNurseSearch.php" method="post">
                <input type = "text" placeholder="Tìm kiếm ID" name="ID">
                <input type = "text" placeholder="Tìm kiếm tên y tá" name="nurseName">
                <button type="submit" class="search-button" title="Tìm kiếm">
                    <img class="search-icon" src="icon/search-replace.png">
                </button>
            </form>
        </div>
        
        <div class="insertMedicine">
        <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#addnurse" data-bs-whatever="Tên thuốc">Thêm y tá</button>
            <div class="modal fade" id="addnurse" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-xl modal-dialog-scrollable" s>
                <div class="modal-content" style="margin-top: 0;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm y tá</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="doctorNurseInsert.php" method="post">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">ID:</label>
                        <input type="text" class="form-control" id="recipient-name" name="ID" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Họ và tên:</label>
                        <input type="text" class="form-control" id="recipient-name" name="doctorName" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">CCCD:</label>
                        <input type="text" class="form-control" id="recipient-name" name="CCCD" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Ngày sinh:</label>
                        <input type="date" class="form-control" id="recipient-name" name="dateofborn" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Địa chỉ:</label>
                        <input type="text" class="form-control" id="recipient-name" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Bằng cấp:</label>
                        <input type="text" class="form-control" id="recipient-name" name="degree" required>
                    </div>             
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Lưu</button>
                </div>
            </form>
                </div>
            </div>
            </div>
        </div>


        <div class="box-list">
            <div class="listbox">
                <div class="infoStaff">
                    <div class="staff1">
                        <h2>Nguyễn Phúc Hưng</h2>
                        <p>CCCD: 03845730459384</p>
                        <p>Địa chỉ: Ký túc xá khu B Đại học quốc gia</p>
                    </div>
                </div>
                <div class="buttonFunc">
                    <button type="button" class="insert-but" data-bs-toggle="modal" onclick ="patientInfo()">Thông tin chi tiết</button>
                <script> function patientInfo(){window.location = "patientInfo.php";} </script>
                
                </div>
            </div>
            <div class="listbox">
                <div class="infoStaff">
                    <div class="staff1">
                        <h2>Nguyễn Phúc Hưng</h2>
                        <p>CCCD: 03845730459384</p>
                        <p>Địa chỉ: Ký túc xá khu B Đại học quốc gia</p>
                    </div>
                </div>
                <div class="buttonFunc">
                    <button type="button" class="insert-but" data-bs-toggle="modal" onclick ="patientInfo()">Thông tin chi tiết</button>
                <script> function patientInfo(){window.location = "patientInfo.php";} </script>
                
                </div>
            </div>
            
        </div>
<!-- Support -->
        <div class="find">
            <h2>TÌM NHÂN VIÊN HỖ TRỢ</h2>
            <p>Vui lòng điền thông tin để tìm kiếm nhanh hơn</p> <br>
            <form class="search-form" action="doctor-action.php" method="post">
                <input type = "text" placeholder="Tìm kiếm ID" name="ID">
                <input type = "text" placeholder="Tìm kiếm tên nhân viên" name="supportName">
                <select name="position">
                    <option>Bộ phận</option>
                    <option value="leader">Nhân viên hỗ trợ kỹ thuật</option>
                    <option value="resident">Nhân viên vệ sinh</option>
                    <option value="doctor">Nhân viên bảo vệ</option>
                </select>
                <button type="submit" class="search-button" title="Tìm kiếm">
                    <img class="search-icon" src="icon/search-replace.png">
                </button>
            </form>
        </div>
        
        <div class="insertMedicine">
        <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#addsupporter" data-bs-whatever="Tên thuốc">Thêm nhân viên hỗ trợ</button>
            <div class="modal fade" id="addsupporter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-xl modal-dialog-scrollable" s>
                <div class="modal-content" style="margin-top: 0;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm nhân viên hỗ trợ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="doctorInsert.php" method="post">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">ID:</label>
                        <input type="text" class="form-control" id="recipient-name" name="ID" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Họ và tên:</label>
                        <input type="text" class="form-control" id="recipient-name" name="doctorName" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">CCCD:</label>
                        <input type="text" class="form-control" id="recipient-name" name="CCCD" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Ngày sinh:</label>
                        <input type="date" class="form-control" id="recipient-name" name="dateofborn" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Địa chỉ:</label>
                        <input type="text" class="form-control" id="recipient-name" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Bằng cấp:</label>
                        <input type="text" class="form-control" id="recipient-name" name="degree" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Bộ phận:</label>
                        <select name="position" class="form-control" id="recipient-name">
                            <option value="leader">Nhân viên hỗ trợ kỹ thuật</option>
                            <option value="resident">Nhân viên vệ sinh</option>
                            <option value="doctor">Nhân viên bảo vệ</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary">Lưu</button>
                </div>
            </form>
                </div>
            </div>
            </div>
        </div>
        <div class="box-list">
            <div class="listbox">
                <div class="infoStaff">
                    <div class="staff1">
                        <h2>Nguyễn Phúc Hưng</h2>
                        <p>CCCD: 03845730459384</p>
                        <p>Địa chỉ: Ký túc xá khu B Đại học quốc gia</p>
                    </div>
                </div>
                <div class="buttonFunc">
                    <button type="button" class="insert-but" data-bs-toggle="modal" onclick ="patientInfo()">Thông tin chi tiết</button>
                <script> function patientInfo(){window.location = "patientInfo.php";} </script>
                
                </div>
            </div>
            <div class="listbox">
                <div class="infoStaff">
                    <div class="staff1">
                        <h2>Nguyễn Phúc Hưng</h2>
                        <p>CCCD: 03845730459384</p>
                        <p>Địa chỉ: Ký túc xá khu B Đại học quốc gia</p>
                    </div>
                </div>
                <div class="buttonFunc">
                    <button type="button" class="insert-but" data-bs-toggle="modal" onclick ="patientInfo()">Thông tin chi tiết</button>
                <script> function patientInfo(){window.location = "patientInfo.php";} </script>
                
                </div>
            </div>
            
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