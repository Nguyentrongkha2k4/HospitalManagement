<?php 
include("config.php");
include("firebaseRDB.php");

if(!isset($_SESSION['user'])){
    header("location: login.php");
}

$ID = $_POST['ID'];
$rdb = new firebaseRDB($databaseURL);
$retrieve = $rdb->retrieve("/staffManager/support", "ID", "EQUAL", $ID);
$data = json_decode($retrieve, 1);

$id = array_keys($data)[0];

$support = $data[$id];
$schedule = $support['schedule'];
$st2 = false;
$st3 = false;
$st4 = false;
$st5 = false;
$st6 = false;
$st7 = false;
$st8 = false;
$ct2 = false;
$ct3 = false;
$ct4 = false;
$ct5 = false;
$ct6 = false;
$ct7 = false;
$ct8 = false;
foreach($schedule as $day){
    switch($day){
        case "Sáng thứ hai":
            $st2 = true;
            break;
        case "Chiều thứ hai":
            $ct2 = true;
            break;
        case "Sáng thứ ba":
            $st3 = true;
            break;
        case "Chiều thứ ba":
            $ct3 = true;
            break;
        case "Sáng thứ tư":
            $st4 = true;
            break;
        case "Chiều thứ tư":
            $ct4 = true;
            break;
        case "Sáng thứ năm":
            $st5 = true;
            break;
        case "Chiều thứ năm":
            $ct5 = true;
            break;
        case "Sáng thứ sáu":
            $st6 = true;
            break;
        case "Chiều thứ sáu":
            $ct6 = true;
            break;
        case "Sáng thứ bảy":
            $st7 = true;
            break;
        case "Chiều thứ bảy":
            $ct7 = true;
            break;
        case "Sáng chủ nhật":
            $st8 = true;
            break;
        case "Chiều chủ nhật":
            $ct8 = true;
            break;
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Quản lý nhân viên y tế | <?php echo $support['supportName']; ?></title>
    <link rel="stylesheet" href="general.css">
    <link rel="stylesheet" href="doctorInfo.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use -->
    <script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-storage.js"></script>

    <!-- TODO: Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyA-EGv-5uIaxHyp9wOJOnlZY76PvsQ_880",
        authDomain: "btl-advanceprogram.firebaseapp.com",
        databaseURL: "https://btl-advanceprogram-default-rtdb.asia-southeast1.firebasedatabase.app",
        projectId: "btl-advanceprogram",
        storageBucket: "btl-advanceprogram.appspot.com",
        messagingSenderId: "396274368225",
        appId: "1:396274368225:web:22bdb7c28c6371ffad01a0",
        measurementId: "G-TGVYSSWNHB"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    const storage = firebase.storage();
    </script>
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
    <div class="bodyPage">
        <div class="info">
            <div class="info basic">
                <div><img src="<?php echo $support['image_url']; ?>" alt="none" width="120px" height="120px" style="border-radius: 100%; border:1px solid;"></div>
                <div>ID: <?php echo $support['ID']; ?></div>
                <div>Họ và tên: <?php echo $support['supportName']; ?></div>
                <div>CCCD: <?php echo $support['CCCD']; ?></div>
                <div>Năm sinh: <?php echo $support['dateofborn']; ?></div>
                <div>Địa chỉ: <?php echo $support['address']; ?></div>
                <div>Bằng cấp: <?php echo $support['degree']; ?></div>
            </div>
            <div class="info button">
                <button type="button" data-bs-toggle="modal" data-bs-target="#change-info">Chỉnh sửa</button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#dele">Xóa</button>
            </div>
        </div>
        <div class="detail">
            
            <div class="detail test">
                <h5>Lịch làm việc:</h5>
                <div class="schedule">
                    <table class="table" style="height: 100%;">
                        <thead>
                            <tr>
                                <th>Thời gian</th>
                                <th>Thứ hai</th>
                                <th>Thứ ba</th>
                                <th>Thứ tư</th>
                                <th>Thứ năm</th>
                                <th>Thứ sáu</th>
                                <th>Thứ bảy</th>
                                <th>Chủ nhật</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr style="height:40%;">
                                <td scope="row">07:00 - 10:50</td>
                                <td><?php if($st2){ ?><div style="background-color:rgb(59, 169, 181);height:100%; width:50%;"></div><?php } ?></td>
                                <td><?php if($st3){ ?><div style="background-color:rgb(59, 169, 181);height:100%; width:50%;"></div><?php } ?></td>
                                <td><?php if($st4){ ?><div style="background-color:rgb(59, 169, 181);height:100%; width:50%;"></div><?php } ?></td>
                                <td><?php if($st5){ ?><div style="background-color:rgb(59, 169, 181);height:100%; width:50%;"></div><?php } ?></td>
                                <td><?php if($st6){ ?><div style="background-color:rgb(59, 169, 181);height:100%; width:50%;"></div><?php } ?></td>
                                <td><?php if($st7){ ?><div style="background-color:rgb(59, 169, 181);height:100%; width:50%;"></div><?php } ?></td>
                                <td><?php if($st8){ ?><div style="background-color:rgb(59, 169, 181);height:100%; width:50%;"></div><?php } ?></td>
                            </tr>
                            <tr style="height:10%;">
                                <td scope="row">11:00 - 13:00</td>
                                <td></td>
                                <td></td>
                                <td>N   g   h   ỉ</td>
                                <td>t   r   ư   a</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr style="height:40%;">
                                <td scope="row">13:00 - 17:00</td>
                                <td><?php if($ct2){ ?><div style="background-color:rgb(59, 169, 181);height:100%; width:50%;"></div><?php } ?></td>
                                <td><?php if($ct3){ ?><div style="background-color:rgb(59, 169, 181);height:100%; width:50%;"></div><?php } ?></td>
                                <td><?php if($ct4){ ?><div style="background-color:rgb(59, 169, 181);height:100%; width:50%;"></div><?php } ?></td>
                                <td><?php if($ct5){ ?><div style="background-color:rgb(59, 169, 181);height:100%; width:50%;"></div><?php } ?></td>
                                <td><?php if($ct6){ ?><div style="background-color:rgb(59, 169, 181);height:100%; width:50%;"></div><?php } ?></td>
                                <td><?php if($ct7){ ?><div style="background-color:rgb(59, 169, 181);height:100%; width:50%;"></div><?php } ?></td>
                                <td><?php if($ct8){ ?><div style="background-color:rgb(59, 169, 181);height:100%; width:50%;"></div><?php } ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
        <p class="adver">19001214</p>
        <p class="adver-detail">Kết nối chăm sóc sức khỏe mọi lúc, mọi nơi: Bệnh viện luôn sẵn lòng lắng nghe và hỗ trợ.</p>
    </div>
</div>
<!-- modal -->
            <div class="modal fade" id="dele" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa bác sĩ</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">Xác nhận xóa</div>
                            <div class="modal-footer">
                                <form action="supportDelete.php" method="post">
                                    <button type="submit" class="btn btn-primary" value="<?php echo $support['CCCD']; ?>" name="CCCD" id="delete">Xóa</button>
                                </form>   
                                <script>
                                document.getElementById("delete").addEventListener("click", function(event){
                                    var deleteSubmit = event.target;
                                    var deleteImage = deleteSubmit.value + ".png";
                                    const fileRef = storage.ref().child(deleteImage);
                                    //Delete the file
                                    fileRef.delete().then(() =>{
                                        //File deleted successfully
                                        console.log("done!");
                                        // document.getElementById('delete').submit();
                                    }).catch((error) =>{
                                        //Handling
                                        console.log("delete failed!");
                                    })
                                })
                            </script>      
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="modal fade" id="change-info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Chỉnh sửa thông tin y tá</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="supportChange.php" method="post">
                                <div class="mb-3">
                                    <label class="col-form-label">ID:</label>
                                    <div style="padding:5px 0 5px 10px; border: 0.5px solid; border-radius: 5px;"><?php echo $support['ID']; ?></div>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Họ và tên:</label>
                                    <div style="padding:5px 0 5px 10px; border: 0.5px solid; border-radius: 5px;"> <?php echo $support['supportName']; ?></div>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">CCCD:</label>
                                    <div style="padding:5px 0 5px 10px; border: 0.5px solid; border-radius: 5px;"><?php echo $support['CCCD']; ?></div>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Năm sinh: </label><?php echo $support['dateofborn']; ?>
                                    <input type="date" class="form-control" id="recipient-name" name="dateofborn" value="<?php echo $support['dateofborn']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Địa chỉ:</label>
                                    <input type="text" class="form-control" id="recipient-name" name="address" value="<?php echo $support['address']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Bộ phận:</label>
                                    <select name="position" class="form-control" id="recipient-name">
                                        <option value="<?php echo $support['position']; ?>"><?php echo $support['position']; ?></option>
                                        <?php if($support['position'] != "Nhân viên hỗ trợ kỹ thuật"){ ?><option value="Nhân viên hỗ trợ kỹ thuật">Nhân viên hỗ trợ kỹ thuật</option><?php }?>
                                        <?php if($support['position'] != "Nhân viên vệ sinh"){ ?><option value="Nhân viên vệ sinh">Nhân viên vệ sinh</option><?php }?>
                                        <?php if($support['position'] != "Nhân viên bảo vệ"){ ?><option value="Nhân viên bảo vệ">Nhân viên bảo vệ</option><?php }?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Bằng cấp:</label>
                                    <input type="text" class="form-control" id="recipient-name" name="degree" value="<?php echo $support['degree']; ?>" required>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" value="<?php echo $id; ?>" name="id">Lưu thay đổi</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</body>
</html>