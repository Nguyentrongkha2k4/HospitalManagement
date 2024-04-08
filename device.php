<?php 
include("config.php");
include("firebaseRDB.php");

if(!isset($_SESSION['user'])){
    header("location: login.php");
}
function locdautiengviet($str){
    $str = strtolower($str); //chuyển chữ hoa thành chữ thường
    $unicode = array(
    'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
    'd'=>'đ',
    'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
    'i'=>'í|ì|ỉ|ĩ|ị',
    'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
    'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
    'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
    'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
    'D'=>'Đ',
    'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
    'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
    'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
    'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
     'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
     );
     foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
     }
     $str = str_replace(' ','_',$str);
     return $str;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Quản lý thiết bị</title>
        <link rel="stylesheet" href="device.css">
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
<!-- find device -->
        <div class="find">
            <h2>TÌM THIẾT BỊ Y TẾ</h2>
            <p>Vui lòng chọn loại thiết bị y tế cần tìm, viết ra tên thiết bị để tìm nhanh hơn</p> <br>
            <form class="search-form" action="deviceSearch.php" method="post">
                <input type = "text" placeholder="Tìm kiếm tên thiết bị" name = "deviceName">
                <select name="devicePurpose">
                    <option value = "">Theo mục đích sử dụng</option>
                    <option value="Chẩn đoán" >Chẩn đoán</option>
                    <option value="Điều trị" >Điều trị</option>
                    <option value="Hỗ trợ" >Hỗ trợ</option>
                </select>
                <button type="submit" class="search-button" title="Tìm kiếm">
                    <img class="search-icon" src="icon/search-replace.png">
                </button>
            </form>
        </div>
<!-- insert device -->
        <div class="insertMedicine">
        <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#adddoctor" data-bs-whatever="Tên thuốc">Thêm thiết bị</button>
            <div class="modal fade" id="adddoctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-xl modal-dialog-scrollable" s>
                <div class="modal-content" style="margin-top: 0;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm thiết bị</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="deviceInsert.php" method="post">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tên thiết bị:</label>
                        <input type="text" class="form-control" id="recipient-name" name="deviceName" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Mục đích sử dụng:</label>
                        <select name="purpose" class="form-control" id="recipient-name">
                            <option value="Chẩn đoán" >Chẩn đoán</option>
                            <option value="Điều trị" >Điều trị</option>
                            <option value="Hỗ trợ" >Hỗ trợ</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Ngày nhập thiết bị:</label>
                        <input type="date" class="form-control" id="recipient-name" name="inputdate" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Số lượng:</label>
                        <input type="number" class="form-control" id="recipient-name" name="amount" required autocomplete="off" min="0">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Công dụng:</label>
                        <textarea type="text" class="form-control" id="recipient-name" name="uses" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
                </div>
            </div>
            </div>
        </div>
<!-- device list -->
        <div class="box-list">
                <?php
                if(isset($_SESSION['deviceList'])){
                    if(isset($_SESSION['undefind'])){?>
                        <div class="listbox"><h2>Undefind</h2></div><?php
                    }else{
                        foreach($_SESSION['deviceList'] as $device){ ?>
                            <div class="listbox">
                                <div class="infoStaff">
                                    <div class="staff1">
                                        <h2><?php echo $device['deviceName'];?></h2>
                                        <p>Số lượng: <?php if(isset($device['amount'])){echo $device['amount'];}else{echo 0;}?></p>
                                        <p>Mục đích sử dụng: <?php echo $device['uses'];?></p>
                                        <p>Công dụng: <?php echo $device['purpose'];?></p>
                                    </div> 
                                </div>
                                <div class="buttonFunc">
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#<?php echo md5($device['deviceName'])."change";?>">Nhập/xuất kho</button>
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#<?php echo md5($device['deviceName'])."delete"; ?>">Xóa</button>
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#<?php echo md5($device['deviceName'])."info"; ?>">Thông tin chi tiết</button>
                                </div>
                            </div>
<!-- modal                   -->
                            <div class="modal fade" id="<?php echo md5($device['deviceName'])."change";?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <button type="submit" class="btn btn-primary" value="<?php echo $device['deviceName']; ?>" name="medicineName">Lưu thay đổi</button>
                                                </div>
                                        
                                           </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="<?php echo md5($device['deviceName'])."delete"; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa thuốc <?php echo $device['deviceName']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                                <form action="medicineDelete.php" method="post">
                                                    <button type="submit" class="btn btn-primary" value="<?php echo $device['deviceName']; ?>" name="medicineName">Xác nhận</button>
                                                </form>      
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="<?php echo md5($device['deviceName'])."info"; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Thông tin <?php echo $device['deviceName']; ?></h1>
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
                            <?php
                        }
                    }
                    
                }else{
                    $rdb = new firebaseRDB($databaseURL);
                    $retrieve = $rdb->retrieve("/deviceManager");
                    $data = json_decode($retrieve, 1);
                    if($data == ""){ ?>
                        <div class="listbox"><h2>Undefind</h2></div><?php
                    }else{
                        foreach($data as $device){ ?>
                            <div class="listbox">
                                <div class="infoStaff">
                                    <div class="staff1">
                                        <h2><?php echo $device['deviceName'];?></h2>
                                        <p>Số lượng: <?php if(isset($device['amount'])){echo $device['amount'];}else{echo 0;}?></p>
                                        <p>Mục đích sử dụng: <?php echo $device['uses'];?></p>
                                        <p>Công dụng: <?php echo $device['purpose'];?></p>
                                    </div> 
                                </div>
                                <div class="buttonFunc">
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#<?php echo md5($device['deviceName'])."change";?>">Nhập/xuất kho</button>
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#<?php echo md5($device['deviceName'])."delete"; ?>">Xóa</button>
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#<?php echo md5($device['deviceName'])."info"; ?>">Thông tin chi tiết</button>
                                </div>
                            </div>
<!-- modal                   -->
                            <div class="modal fade" id="<?php echo md5($device['deviceName'])."change";?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Nhập xuất kho <?php echo $device['deviceName'];?></h1>
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
                                                    <button type="submit" class="btn btn-primary" value="<?php echo $device['deviceName']; ?>" name="deviceName">Lưu thay đổi</button>
                                                </div>
                                        
                                           </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="<?php echo md5($device['deviceName'])."delete"; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa thuốc <?php echo $device['deviceName']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                                <form action="medicineDelete.php" method="post">
                                                    <button type="submit" class="btn btn-primary" value="<?php echo $device['deviceName']; ?>" name="deviceName">Xác nhận</button>
                                                </form>      
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="<?php echo md5($device['deviceName'])."info"; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Thông tin <?php echo $device['deviceName']; ?></h1>
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
                        <?php
                        }
                    }
                }
                unset($_SESSION['undefind']);
                unset($_SESSION['deviceList']);
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