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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <script>
            function showSuccessToast(mess) {
                toast({
                title: "Thành công!",
                message: mess,
                type: "success",
                duration: 5000
                });
            }
            function showErrorToast(mess) {
                toast({
                title: "Thất bại!",
                message: mess,
                type: "error",
                duration: 5000
                });
            }
            function toast({ title = "", message = "", type = "info", duration = 3000 }) {
                const main = document.getElementById("toast1");
                if (main) {
                    const toast = document.createElement("div");

                    // Auto remove toast
                    const autoRemoveId = setTimeout(function () {
                    main.removeChild(toast);
                    }, duration + 1000);

                    // Remove toast when clicked
                    toast.onclick = function (e) {
                    if (e.target.closest(".toast1__close")) {
                        main.removeChild(toast);
                        clearTimeout(autoRemoveId);
                    }
                    };

                    const icons = {
                    success: "fas fa-check-circle",
                    info: "fas fa-info-circle",
                    warning: "fas fa-exclamation-circle",
                    error: "fas fa-exclamation-circle"
                    };
                    const icon = icons[type];
                    const delay = (duration / 1000).toFixed(2);

                    toast.classList.add("toast1", `toast1--${type}`);
                    toast.style.animation = `slideInLeft ease .3s, fadeOut linear 1s ${delay}s forwards`;

                    toast.innerHTML = `
                                    <div class="toast1__icon">
                                        <i class="${icon}"></i>
                                    </div>
                                    <div class="toast1__body">
                                        <h3 class="toast1__title">${title}</h3>
                                        <p class="toast1__msg">${message}</p>
                                    </div>
                                    <div class="toast1__close">
                                        <i class="fas fa-times"></i>
                                    </div>
                                `;
                    main.appendChild(toast);
                }
            }
        </script>
    </head>
    <div id="toast1"></div>
    <body onload="<?php
                if(isset($_SESSION['wrong'])){
                    $mess = "showErrorToast('".$_SESSION['wrong']."');";
                    echo $mess;
                }
                unset($_SESSION['wrong']);
                if(isset($_SESSION['success'])){
                    $mess = "showSuccessToast('".$_SESSION['success']."');";
                    echo $mess;
                }
                unset($_SESSION['success']);
                ?>">
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
                    <ul class="sub-menu">
                        <li><a href="doctor.php">QUẢN LÝ BÁC SĨ</a></li>
                        <li><a href="nurse.php">QUẢN LÝ Y TÁ</a></li>
                        <li><a href="support.php">QUẢN LÝ NHÂN VIÊN HỖ TRỢ</a></li>
                    </ul>
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
                        window.location = "staff.php";
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
            <h2>TÌM THUỐC</h2>
            <p>Vui lòng loại thuốc cần tìm, viết ra tên thuốc để tìm nhanh hơn</p> <br>
            <form class="search-form" action="medicineSearch.php" method="post">
                <input type = "text" placeholder="Tìm kiếm tên thuốc" name="medicineName" autocomplete="off">
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
                        <label class="col-form-label">Tên thuốc:</label>
                        <input type="text" class="form-control" id="recipient-name" name="medicineName" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Công dụng:</label>
                        <textarea type="text" class="form-control" id="message-text" name="uses" required></textarea>
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
                                        <h2>Tên: <?php echo $medicine['medicineName']; ?></h2>
                                        <p>Công dụng: <?php echo $medicine['uses']; ?></p>
                                        <p>Số lượng: <?php if(isset($medicine['amount'])){echo $medicine['amount'];}else{echo 0;}?></p>
                                    </div> 
                                </div>
                                <div class="buttonFunc">
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#<?php echo md5($medicine['medicineName'])."change"; ?>">Nhập/xuất kho</button>
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#<?php echo md5($medicine['medicineName'])."delete"; ?>">Xóa</button>
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#<?php echo md5($medicine['medicineName'])."info"; ?>">Thông tin chi tiết</button>
                                </div>
                            </div>
<!-- modal                   -->
                            <div class="modal fade" id="<?php echo md5($medicine['medicineName'])."change";?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <option value="Nhập kho">Nhập kho</option>
                                                        <option value="Xuất kho">Xuất kho</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label">Số lượng:</label>
                                                    <input type="text" class="form-control" id="recipient-name" name="amount" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label">Ngày nhập/xuất kho:</label>
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
                            <div class="modal fade" id="<?php echo md5($medicine['medicineName'])."delete"; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa thuốc <?php echo $medicine['medicineName']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                                <form action="medicineDelete.php" method="post">
                                                    <button type="submit" class="btn btn-primary" value="<?php echo $medicine['medicineName']; ?>" name="medicineName">Xác nhận</button>
                                                </form>      
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="<?php echo md5($medicine['medicineName'])."info"; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Thông tin <?php echo $medicine['medicineName']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="overflow-x:hidden;overflow-y:scroll;">
                                            <?php 
                                                $rdb = new firebaseRDB($databaseURL);
                                                $retrieve = $rdb->retrieve("/medicineManager/storehouse", "medicineName", "EQUAL", $medicine['medicineName']);
                                                $data = json_decode($retrieve, 1);?>
                            <table>
                                <tr>
                                    <td>
                                        <table class="set-border">
                                            <th style="width: 10%;">Ngày nhập/ xuất kho</th>
                                            <th style="width: 5%;">Số lượng</th>
                                            <th style="width: 10%;">Hạn sử dụng</th>
                                            <th style="width: 10%;">Ghi chú</th>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="scroll-table">  
                                            <table ><?php
                                                foreach($data as $kho){?>
                                                    <tr class="align-tr">
                                                        <td style="width: 10%;"><?php echo $kho['date']; ?></td>
                                                        <td style="width: 5%;"><?php echo $kho['amount']; ?></td>
                                                        <td style="width: 10%;"><?php if(isset($kho['hsd'])) echo date('j-m-Y', strtotime($kho['hsd'])); ?></td>
                                                        <td style="width: 10%;"><?php echo $kho['act']; ?></td>
                                                    </tr><?php
                                                }?>
                                            </table>    
                                        </div>
                                    </td>
                                </tr>
                            </table>
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
                    $retrieve = $rdb->retrieve("/medicineManager/medicine");
                    $data = json_decode($retrieve, 1);
                    if($data == ""){ ?>
                        <div class="listbox"><h2>Undefind</h2></div><?php
                    }else{
                        foreach($data as $medicine){ ?>
                            <div class="listbox">
                                <div class="infoMedicine">
                                    <div class="medicine1">
                                        <h2>Tên: <?php echo $medicine['medicineName']; ?></h2>
                                        <p>Công dụng: <?php echo $medicine['uses']; ?></p>
                                        <p>Số lượng: <?php if(isset($medicine['amount'])){echo $medicine['amount'];}else{echo 0;}?></p>
                                    </div> 
                                </div>
                                <div class="buttonFunc">
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#<?php echo md5($medicine['medicineName'])."change"; ?>">Nhập/xuất kho</button>
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#<?php echo md5($medicine['medicineName'])."delete"; ?>">Xóa</button>
                                    <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#<?php echo md5($medicine['medicineName'])."info"; ?>">Thông tin chi tiết</button>
                                </div>
                            </div>
<!-- modal                             -->
                            <div class="modal fade" id="<?php echo md5($medicine['medicineName'])."change"; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Nhập xuất kho <?php echo $medicine['medicineName']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="medicineChange.php" method="post">
                                                <div class="mb-3">
                                                    <select class="mb-3" name="choice">
                                                        <option value="Nhập kho">Nhập kho</option>
                                                        <option value="Xuất kho">Xuất kho</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label">Số lượng:</label>
                                                    <input type="text" class="form-control" id="recipient-name" name="amount" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="col-form-label">Ngày nhập/xuất kho:</label>
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
                            <div class="modal fade" id="<?php echo md5($medicine['medicineName'])."delete"; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa thuốc <?php echo $medicine['medicineName']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                                <form action="medicineDelete.php" method="post">
                                                    <button type="submit" class="btn btn-primary" value="<?php echo $medicine['medicineName']; ?>" name="medicineName">Xác nhận</button>
                                                </form>      
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="<?php echo md5($medicine['medicineName'])."info"; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Thông tin <?php echo $medicine['medicineName']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <?php 
                                                $rdb = new firebaseRDB($databaseURL);
                                                $retrieve = $rdb->retrieve("/medicineManager/storehouse", "medicineName", "EQUAL", $medicine['medicineName']);
                                                $data = json_decode($retrieve, 1);?>
                            <table>
                                <tr>
                                    <td>
                                        <table class="set-border">
                                            <th style="width: 10%;">Ngày nhập/ xuất kho</th>
                                            <th style="width: 5%;">Số lượng</th>
                                            <th style="width: 10%;">Hạn sử dụng</th>
                                            <th style="width: 10%;">Ghi chú</th>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="scroll-table">  
                                            <table ><?php
                                                foreach($data as $kho){?>
                                                    <tr class="align-tr">
                                                        <td style="width: 10%;"><?php echo $kho['date']; ?></td>
                                                        <td style="width: 5%;"><?php echo $kho['amount']; ?></td>
                                                        <td style="width: 10%;"><?php if(isset($kho['hsd'])) echo date('j-m-Y', strtotime($kho['hsd'])); ?></td>
                                                        <td style="width: 10%;"><?php echo $kho['act']; ?></td>
                                                    </tr><?php
                                                }?>
                                            </table>    
                                        </div>
                                    </td>
                                </tr>
                            </table>
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
                <p class="adver">19001214</p>
                <p class="adver-detail">Kết nối chăm sóc sức khỏe mọi lúc, mọi nơi: Bệnh viện luôn sẵn lòng lắng nghe và hỗ trợ.</p>
            </div>
        </div>
    </body>
    </html>