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
        <div class="find">
            <h2>THÔNG TIN BỆNH NHÂN</h2>
            <p>Vui lòng nhập thông tin bệnh nhân để tìm kiếm nhanh hơn</p> <br>
            <form class="search-form" action="patientSearch.php" method="post">
                <input type = "text" placeholder="Nhập CCCD" name="CCCD">
                <input type = "text" placeholder="Tìm kiếm tên bệnh nhân" name="patientName">
                <input type = "date" name="dateofborn">
                <select name="recipient-name">
                    <option value = "">Khoa điều trị</option>
                    <option value="Khoa ngoại tổng hợp">Khoa ngoại tổng hợp</option>
                    <option value="Khoa nội tổng hợp">Khoa nội tổng hợp</option>
                    <option value="Khoa răng-hàm-mặt">Khoa răng-hàm-mặt</option>
                    <option value="Khoa tai-mũi-họng">Khoa tai-mũi-họng</option>
                    <option value="Khoa da liễu">Khoa da liễu</option>
                    <option value="Khoa thần kinh">Khoa thần kinh</option>
                </select>
                <button type="submit" class="search-button">
                    <img class="search-icon" src="icon/search-replace.png">
                </button>
            </form>
        </div>
        <!-- <br> <br> <br> -->
        <!-- <div class="add-container">
            <button class="add">Thêm</button>
        </div> -->
        <div class="insertMedicine">
        <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#addpatient" data-bs-whatever="Tên thuốc">Thêm bệnh nhân</button>
            <div class="modal fade" id="addpatient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm bệnh nhân mới</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="patientInsert.php" method="post">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Họ và tên:</label>
                        <input type="text" class="form-control" id="recipient-name" name="patientName" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">CCCD:</label>
                        <input type="text" class="form-control" id="recipient-name" name="CCCD" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Ngày sinh:</label>
                        <input type="date" class="form-control" id="recipient-name" name="dateofborn">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Địa chỉ:</label>
                        <input type="text" class="form-control" id="recipient-name" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Khoa điều trị:</label>
                        <select name="recipient-name" class="form-control" id="recipient-name">
                            <option value="Khoa ngoại tổng hợp">Khoa ngoại tổng hợp</option>
                            <option value="Khoa nội tổng hợp">Khoa nội tổng hợp</option>
                            <option value="Khoa răng-hàm-mặt">Khoa răng-hàm-mặt</option>
                            <option value="Khoa tai-mũi-họng">Khoa tai-mũi-họng</option>
                            <option value="Khoa da liễu">Khoa da liễu</option>
                            <option value="Khoa thần kinh">Khoa thần kinh</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div></form>
                </div>
            </div>
            </div>
        </div>

        <div class="box-list">
            <?php
            if(isset($_SESSION['patientList'])){
                if(isset($_SESSION['undefind'])){?>
                <div class="listbox"><h2><?php echo $_SESSION['undefind']; ?></h2></div><?php
            } else{
                foreach($_SESSION['patientList'] as $patient){?>
                <!-- <?php echo $patient; ?> -->
            <div class="listbox">
                <div class="infoPatient">
                    <div class="patient1">
                        <h2><?php echo $patient['patientName']; ?></h2> 
                        <p>CCCD: <?php echo $patient['CCCD']; ?> </p>
                        <p>Năm sinh: <?php echo $patient['dateofborn']?></p>
                        <p>Khoa điều trị: <?php echo $patient['recipient-name'] ?></p>
                    </div>
                </div>
                <div class="buttonFunc">
                    <form action="patientInfo.php" method="post">
                        <button type="submit" class="insert-but" name="CCCD" value ="<?php echo $patient['CCCD'];?>">Thông tin chi tiết</button>
                    </form>
                </div>
            </div>
            <?php
                }
            }
        }
        else{
            $rdb = new firebaseRDB($databaseURL);
            $retrieve = $rdb->retrieve('/vicManager');
            $data = json_decode($retrieve,1);
            if($data == ""){?>
                <div class="listbox"><h2>Undefind</h2></div><?php
            }
            else{
                foreach($data as $patient){?>
                    <div class="listbox">
                        <div class="infoPatient">
                            <div class="patient1">
                                <h2><?php echo $patient['patientName']; ?></h2> 
                                <p>CCCD: <?php echo $patient['CCCD']; ?> </p>
                                <p>Năm sinh: <?php echo $patient['dateofborn']?></p>
                                <p>Khoa điều trị: <?php echo $patient['recipient-name'] ?></p>
                            </div>
                        </div>
                        <div class="buttonFunc">
                            <form action="patientInfo.php" method="post">
                                <button type="submit" class="insert-but" name="CCCD" value ="<?php echo $patient['CCCD'];?>">Thông tin chi tiết</button>
                            </form>
                        </div>
                    </div>
                    <?php
                        }
                    }
                }
                unset($_SESSION['undefind']);
                unset($_SESSION['patientList']);
                ?>
            
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