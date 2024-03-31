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
        <title>Quản lý thuốc</title>
        <link rel="stylesheet" href="medicine.css">
        <link rel="stylesheet" href="general.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="snippets.js">
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
                <div class="login"><?php echo $_SESSION['user']['Username'];?>, <a class="login logout" href="logout.php">Thoát</a></div>
            </div>
        </div>
        <div class="find">
            <h2>TÌM THUỐC</h2>
            <p>Vui lòng loại thuốc cần tìm, viết ra tên thuốc để tìm nhanh hơn</p> <br>
            <form class="search-form" action="medicineSearch.php" method="post">
                <!-- <select class="select" name="purpose-medicine-select">
                    <option value="All" class="doctor">Theo mục đích sử dụng</option>
                    <option value="Thuốc giảm đau" class="doctor">Thuốc giảm đau</option>
                    <option value="Thuốc để phòng ngừa bệnh" class="doctor">Thuốc để phòng ngừa bệnh</option>
                    <option value="Thuốc để tránh lo âu" class="doctor">Thuốc để tránh lo âu</option>
                    <option value="Thuốc chẩn đoán" class="doctor">Thuốc chẩn đoán</option>
                    <option value="Thuốc điều trị" class="doctor">Thuốc điều trị</option>
                    <option value="Thuốc phòng ngừa" class="doctor">Thuốc phòng ngừa</option>
                </select>
                <select class="select" name="func-medicine-select">
                    <option value="All" class="doctor">Theo cơ chế hoạt động</option>
                    <option value="Chất giảm đau" class="doctor">Chất giảm đau</option>
                    <option value="Chất chống vi khuẩn" class="doctor">Chất chống vi khuẩn</option>
                    <option value="Chất chống cơ thắt cơ" class="doctor">Chất chống cơ thắt cơ</option>
                    <option value="Chất chống vi rút" class="doctor">Chất chống vi rút</option>
                    <option value="Chất chống viêm" class="doctor">Chất chống viêm</option>
                    <option value="Chất gây mê, gây tê" class="doctor">Chất gây mê, gây tê</option>
                </select>
                <select class="select" name="toxic-medicine-select">
                    <option value="All" class="doctor">Tìm kiếm theo độc tính</option>
                    <option value="An toàn" class="doctor">An toàn</option>
                    <option value="Nguy hiểm" class="doctor">Nguy hiểm</option>
                </select> -->
                <input type = "text" placeholder="Tìm kiếm tên thuốc" name="medicineName">
                <button type="submit" class="search-button">
                    <img class="search-icon" src="icon/search-replace.png">
                </button>
            </form>
        </div>
        <div class="insertMedicine">
        <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="Tên thuốc">Thêm thuốc</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm thuốc mới</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="medicineInsert.php" method="post">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tên thuốc:</label>
                        <input type="text" class="form-control" id="recipient-name" name="medicineName" required>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Công dụng:</label>
                        <textarea type="text" class="form-control" id="message-text" name="uses" required></textarea>
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
                if(isset($_SESSION['medicineList'])){
                    if(isset($_SESSION['undefind'])){?>
                        <div class="listbox"><h2>Undefind</h2></div><?php
                    }else{
                        foreach($_SESSION['medicineList'] as $medicine){ ?>
                            <div class="listbox">
                                <div class="infoMedicine">
                                    <div class="medicine1">
                                        <h2><?php echo $medicine['medicineName']; ?></h2>
                                        <p>Công dụng: <?php echo $medicine['uses']; ?></p>
                                        <p>Số lượng: <?php if(isset($medicine['amount'])){echo $medicine['amount'];}else{echo 0;}?></p>
                                    </div> 
                                </div>
                                <div class="buttonFunc">
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#change" data-bs-whatever="@mdo">Nhập/xuất kho</button>
                                    <form action="medicineDelete.php" method="post"><button type="submit" class="insert-but" value="<?php echo $medicine ?>" name="medicineName">Xóa</button></form>
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#info" data-bs-whatever="@getbootstrap">Thông tin chi tiết</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    
                }else{
                    $rdb = new firebaseRDB($databaseURL);
                    $retrieve = $rdb->retrieve("/medicineManager");
                    $data = json_decode($retrieve, 1);
                    if($data == ""){ ?>
                        <div class="listbox"><h2>Undefind</h2></div><?php
                    }else{
                        foreach($data as $medicine){ ?>
                            <div class="listbox">
                                <div class="infoMedicine">
                                    <div class="medicine1">
                                        <h2><?php echo $medicine['medicineName']; ?></h2>
                                        <p>Công dụng: <?php echo $medicine['uses']; ?></p>
                                        <p>Số lượng: <?php if(isset($medicine['amount'])){echo $medicine['amount'];}else{echo 0;}?></p>
                                    </div> 
                                </div>
                                <div class="buttonFunc">
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#change" data-bs-whatever="@mdo">Nhập/xuất kho</button>
                                    <form action="medicineDelete.php" method="post"><button type="submit" class="insert-but" value="<?php echo $medicine['medicineName'] ?>" name="medicineName">Xóa</button></form>
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#info" data-bs-whatever="@getbootstrap">Thông tin chi tiết</button>

                                    
                                </div>
                            </div>
                        <?php
                        }
                    }
                }
                unset($_SESSION['undefind']);
                unset($_SESSION['medicineList']);
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
                <p class="adver">00991910</p>
                <p class="adver-detail">Kết nối chăm sóc sức khỏe mọi lúc, mọi nơi: Bệnh viện luôn sẵn lòng lắng nghe và hỗ trợ.</p>
            </div>
        </div>
<!-- button nhap xuat kho -->
            <div class="modal fade" id="change" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Nhập xuất kho</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="medicineChange.php" method="post">
                                <div class="mb-3">
                                    <select class="mb-3" name="choice">
                                        <option value=1>Nhập kho</option>
                                        <option value=2>Xuất kho</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Số lượng:</label>
                                    <input type="text" class="form-control" id="recipient-name" name="amount" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Ngày nhập/xuất kho:</label>
                                    <input type="date" class="form-control" id="message-text" name="date" required></input>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary" value="<?php echo $medicine['medicineName']; ?>" name="medicineName">Lưu thay đổi</button>
                                </div>
                        
                           </form>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Thông tin</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
    </body>
    </html>