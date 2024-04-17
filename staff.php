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
        <title>Quản lý nhân viên y tế</title>
        <link rel="stylesheet" href="doctor.css">
        <link rel="stylesheet" href="general.css">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
        <!-- The core Firebase JS SDK is always required and must be listed first -->
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

            function getFileUrl(filename) {
            //create a storage reference
            var storage = firebase.storage().ref(filename);
            //get file url
            storage
                .getDownloadURL()
                .then(function(url) {
                console.log(url);
                document.getElementById('hiddenText').value = url;
                document.getElementById('formInsert').submit();
                
                });
                // .catch(function(error) {
                //   console.log("error encountered");
                // });
            }
            // firebase.app().delete();
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
                <div class="login"><span><?php echo $_SESSION['user']['Username']?>,</span> <a class="logout" href="logout.php">Thoát</a></div>
            </div>
        </div>
        

<!-- Doctor -->
        <div class="findfirst">
            <h2>TÌM BÁC SĨ</h2>
            <p>Vui lòng chọn chuyên khoa cần khám hoặc tìm kiếm để nhanh hơn</p> <br>
            <form class="search-form" action="doctorSearch.php" method="post">
                <input type = "text" placeholder="Tìm kiếm ID" name="ID">
                <input type = "text" placeholder="Tìm kiếm tên bác sĩ" name="doctorName">
                <select name="khoa">
                    <option value = "">Khoa</option>
                    <option value="Khoa ngoại tổng hợp">Khoa ngoại tổng hợp</option>
                    <option value="Khoa nội tổng hợp">Khoa nội tổng hợp</option>
                    <option value="Khoa răng-hàm-mặt">Khoa răng-hàm-mặt</option>
                    <option value="Khoa tai-mũi-họng">Khoa tai-mũi-họng</option>
                    <option value="Khoa da liễu">Khoa da liễu</option>
                    <option value="Khoa thần kinh">Khoa thần kinh</option>
                </select>
                <select name="position">
                    <option value = "">Chức vụ</option>
                    <option value="Viện trưởng">Viện Trưởng</option>
                    <option value="Trưởng khoa">Trưởng Khoa</option>
                    <option value="Bác sĩ">Bác sĩ</option>
                </select>
                <button type="submit" class="search-button" title="Tìm kiếm">
                    <img class="search-icon" src="icon/search-replace.png">
                </button>
            </form>
        </div>
        
        <div class="insertMedicine">
        <button type="button" class="insert-but" data-bs-toggle="modal" data-bs-target="#adddoctor" data-bs-whatever="Tên thuốc">Thêm bác sĩ</button>
            <div class="modal fade" id="adddoctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
            <div class="modal-dialog modal-xl modal-dialog-scrollable " s>
                <div class="modal-content" style="margin-top: 0;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm bác sĩ</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="height: 90%;">
                    <form action="doctorInsert.php" method="post" id = "formInsert" enctype= "multipart/form-data">
                    <div class = "mb-3">
                        <label for="">Vui lòng chọn ảnh bác sĩ:</label>
                        <input type ="file" name = "image" class="form-control" accept="image/png, image/jpeg" id = 'files' required>
                        <input type = "hidden" name = "image" id = "hiddenText" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">ID:</label>
                        <div style="display:flex; flex-direction:row;">
                            <div class="form-control" style="width: 40px; border-top-right-radius: 0; border-bottom-right-radius: 0;">BS</div>
                            <input style="border-top-left-radius: 0; border-bottom-left-radius: 0;" type="text" class="form-control" id="recipient-name" name="ID" required>
                        </div>
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
                            <option value="Khoa ngoại tổng hợp">Khoa ngoại tổng hợp</option>
                            <option value="Khoa nội tổng hợp">Khoa nội tổng hợp</option>
                            <option value="Khoa răng-hàm-mặt">Khoa răng-hàm-mặt</option>
                            <option value="Khoa tai-mũi-họng">Khoa tai-mũi-họng</option>
                            <option value="Khoa da liễu">Khoa da liễu</option>
                            <option value="Khoa thần kinh">Khoa thần kinh</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Chức vụ:</label>
                        <select name="position" class="form-control" id="recipient-name">
                            <option value="Viện trưởng">Viện Trưởng</option>
                            <option value="Trưởng khoa">Trưởng Khoa</option>
                            <option value="Bác sĩ">Bác sĩ</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" name="obj" value="doctor">Lưu</button>
                    </div>
                </form>
                <script type="text/javascript">
                var files = [];
                var CCCD;
                var filename;

                document.getElementById("files").addEventListener("change", function(e) {
                files = e.target.files;
                for (let i = 0; i < files.length; i++) {
                    console.log(files[i]);
                }
                });

                document.getElementById('formInsert').addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent default form submission

                // Get the form data
                var form = event.target;
                var formData = new FormData(form);

                // Convert form data to an object
                var postData = {};
                for (var pair of formData.entries()) {
                    postData[pair[0]] = pair[1];
                }

                // Access the form data
                var doctorName = postData.doctorName;
                CCCD = postData.CCCD;
                var dateofborn = postData.dateofborn;
                var address = postData.address;

                if (files.length != 0) {
                //Loops through all the selected files
                for (let i = 0; i < files.length; i++) {
                    //create a storage reference
                    filename = CCCD + ".png";
                    var storage = firebase.storage().ref(filename);

                    // upload file
                    var upload = storage.put(files[i]);

                    // Monitor upload progress
                    upload.on(
                    "state_changed",
                    function(snapshot) {
                        // Track upload progress here if needed
                        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                        console.log("Upload progress: " + progress + "%");
                    },
                    function(error) {
                        // Handle upload error here
                        console.log("Upload error:", error);
                    },
                    function() {
                        // Upload complete, get file URL
                        getFileUrl(filename);
                    }
                    );
                }
                } else {
                alert("Chưa có ảnh");
                }
                });

                </script>
            </div>
                </div>
            </div>
            </div>
        </div>


        <div class="box-list">
            <?php
            if(isset($_SESSION['doctorList'])){
                if(isset($_SESSION['undefind'])){?>
                <div class="listbox"><h2><?php echo $_SESSION['undefind']; ?></h2></div><?php
            } else{
                foreach($_SESSION['doctorList'] as $doctor){?>
                <!-- <?php echo $doctor; ?> -->
            <div class="listbox">
                <div class="infoStaff">
                    <div class="staff1">
                        <h2>Tên: <?php echo $doctor['doctorName']; ?></h2> 
                        <p>ID: <?php echo $doctor['ID']; ?> </p>
                        <p>Khoa điều trị: <?php echo $doctor['khoa'] ?></p>
                        <p>Chức vụ: <?php echo $doctor['position']?></p>
                    </div>
                </div>
                <div class="buttonFunc">
                    <form action="doctorInfo.php" method="post">
                        <button type="submit" class="insert-but" name="ID" value ="<?php echo $doctor['ID'];?>">Thông tin chi tiết</button>
                    </form>
                </div>
            </div>
            <?php
                }
            }
        }
        else{
            $rdb = new firebaseRDB($databaseURL);
            $retrieve = $rdb->retrieve('/staffManager/doctor');
            $data = json_decode($retrieve,1);
            if($data == ""){?>
                <div class="listbox"><h2>Undefind</h2></div><?php
            }
            else{
                foreach($data as $doctor){?>
                    <div class="listbox">
                        <div class="infoStaff">
                            <div class="staff1">
                                <h2>Tên: <?php echo $doctor['doctorName']; ?></h2> 
                                <p>ID: <?php echo $doctor['ID']; ?> </p>
                                <p>Khoa điều trị: <?php echo $doctor['khoa'] ?></p>
                                <p>Chức vụ: <?php echo $doctor['position']?></p>
                            </div>
                        </div>
                        <div class="buttonFunc">
                            <form action="doctorInfo.php" method="post">
                                <button type="submit" class="insert-but" name="ID" value ="<?php echo $doctor['ID'];?>">Thông tin chi tiết</button>
                            </form>
                        </div>
                    </div>
                    <?php
                        }
                    }
                }
                unset($_SESSION['undefind']);
                unset($_SESSION['doctorList']);
                ?>
            
        </div>

<!-- Nurse -->
        <div class="find">
            <h2>TÌM Y TÁ</h2>
            <p>Vui lòng chọn chuyên khoa cần khám hoặc tìm kiếm để nhanh hơn</p> <br>
            <form class="search-form" action="nurseSearch.php" method="post">
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
                    <form action="doctorInsert.php" method="post" id = "formInsert" enctype= "multipart/form-data">
                        <div class = "mb-3">
                            <label for="">Vui lòng chọn ảnh y tá:</label>
                            <input type ="file" name = "image" class="form-control" accept="image/png, image/jpeg" id = 'files' required>
                            <input type = "hidden" name = "image" id = "hiddenText" required>
                        </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">ID:</label>
                        <div style="display:flex; flex-direction:row;">
                            <div class="form-control" style="width: 40px; border-top-right-radius: 0; border-bottom-right-radius: 0;">YT</div>
                            <input style="border-top-left-radius: 0; border-bottom-left-radius: 0;" type="text" class="form-control" id="recipient-name" name="ID" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Họ và tên:</label>
                        <input type="text" class="form-control" id="recipient-name" name="nurseName" required>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" name="obj" value="nurse">Lưu</button>
                    </div>
                </form>
                <script type="text/javascript">
                var files = [];
                var CCCD;
                var filename;

                document.getElementById("files").addEventListener("change", function(e) {
                files = e.target.files;
                for (let i = 0; i < files.length; i++) {
                    console.log(files[i]);
                }
                });

                document.getElementById('formInsert').addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent default form submission

                // Get the form data
                var form = event.target;
                var formData = new FormData(form);

                // Convert form data to an object
                var postData = {};
                for (var pair of formData.entries()) {
                    postData[pair[0]] = pair[1];
                }

                // Access the form data
                var doctorName = postData.doctorName;
                CCCD = postData.CCCD;
                var dateofborn = postData.dateofborn;
                var address = postData.address;

                if (files.length != 0) {
                //Loops through all the selected files
                for (let i = 0; i < files.length; i++) {
                    //create a storage reference
                    filename = CCCD + ".png";
                    var storage = firebase.storage().ref(filename);

                    // upload file
                    var upload = storage.put(files[i]);

                    // Monitor upload progress
                    upload.on(
                    "state_changed",
                    function(snapshot) {
                        // Track upload progress here if needed
                        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                        console.log("Upload progress: " + progress + "%");
                    },
                    function(error) {
                        // Handle upload error here
                        console.log("Upload error:", error);
                    },
                    function() {
                        // Upload complete, get file URL
                        getFileUrl(filename);
                    }
                    );
                }
                } else {
                alert("Chưa có ảnh");
                }
                });

                </script>
            </div>
                </div>
            </div>
            </div>
        </div>


        <div class="box-list">
            <?php
            if(isset($_SESSION['nurseList'])){
                if(isset($_SESSION['undefind2'])){?>
                <div class="listbox"><h2><?php echo $_SESSION['undefind2']; ?></h2></div><?php
            } else{
                foreach($_SESSION['nurseList'] as $nurse){?>
                <!-- <?php echo $doctor; ?> -->
            <div class="listbox">
                <div class="infoStaff">
                    <div class="staff1">
                        <h2>Tên: <?php echo $nurse['nurseName']; ?></h2> 
                        <p>ID: <?php echo $nurse['ID']; ?> </p>
                    </div>
                </div>
                <div class="buttonFunc">
                    <form action="nurseInfo.php" method="post">
                        <button type="submit" class="insert-but" name="ID" value ="<?php echo $nurse['ID'];?>">Thông tin chi tiết</button>
                    </form>
                </div>
            </div>
            <?php
                }
            }
        }
        else{
            $rdb = new firebaseRDB($databaseURL);
            $retrieve = $rdb->retrieve('/staffManager/nurse');
            $data = json_decode($retrieve,1);
            if($data == ""){?>
                <div class="listbox"><h2>Undefind</h2></div><?php
            }
            else{
                foreach($data as $nurse){?>
                    <div class="listbox">
                        <div class="infoStaff">
                            <div class="staff1">
                                <h2>Tên: <?php echo $nurse['nurseName']; ?></h2> 
                                <p>ID: <?php echo $nurse['ID']; ?> </p>
                            </div>
                        </div>
                        <div class="buttonFunc">
                            <form action="nurseInfo.php" method="post">
                                <button type="submit" class="insert-but" name="ID" value ="<?php echo $nurse['ID'];?>">Thông tin chi tiết</button>
                            </form>
                        </div>
                    </div>
                    <?php
                        }
                    }
                }
                unset($_SESSION['undefind2']);
                unset($_SESSION['doctorList']);
                ?>
            
        </div>
<!-- Support -->
        <div class="find">
            <h2>TÌM NHÂN VIÊN HỖ TRỢ</h2>
            <p>Vui lòng điền thông tin để tìm kiếm nhanh hơn</p> <br>
            <form class="search-form" action="supportSearch.php" method="post">
                <input type = "text" placeholder="Tìm kiếm ID" name="ID">
                <input type = "text" placeholder="Tìm kiếm tên nhân viên" name="supportName">
                <select name="position">
                    <option value = "">Bộ phận</option>
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
                    <form action="doctorInsert.php" method="post" id = "formInsert" enctype= "multipart/form-data">
                        <div class = "mb-3">
                            <label for="">Vui lòng chọn ảnh nhân viên hỗ trợ:</label>
                            <input type ="file" name = "image" class="form-control" accept="image/png, image/jpeg" id = 'files' required>
                            <input type = "hidden" name = "image" id = "hiddenText" required>
                        </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">ID:</label><br>
                        <div style="display:flex; flex-direction:row;">
                            <div class="form-control" style="width: 40px; border-top-right-radius: 0; border-bottom-right-radius: 0;">SP</div>
                            <input style="border-top-left-radius: 0; border-bottom-left-radius: 0;" type="text" class="form-control" id="recipient-name" name="ID" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Họ và tên:</label>
                        <input type="text" class="form-control" id="recipient-name" name="supportName" required>
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
                            <option value="Nhân viên hỗ trợ kỹ thuật">Nhân viên hỗ trợ kỹ thuật</option>
                            <option value="Nhân viên vệ sinh">Nhân viên vệ sinh</option>
                            <option value="Nhân viên bảo vệ">Nhân viên bảo vệ</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" name="obj" value="support">Lưu</button>
                    </div>
                </form>
                <script type="text/javascript">
                var files = [];
                var CCCD;
                var filename;

                document.getElementById("files").addEventListener("change", function(e) {
                files = e.target.files;
                for (let i = 0; i < files.length; i++) {
                    console.log(files[i]);
                }
                });

                document.getElementById('formInsert').addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent default form submission

                // Get the form data
                var form = event.target;
                var formData = new FormData(form);

                // Convert form data to an object
                var postData = {};
                for (var pair of formData.entries()) {
                    postData[pair[0]] = pair[1];
                }

                // Access the form data
                var doctorName = postData.doctorName;
                CCCD = postData.CCCD;
                var dateofborn = postData.dateofborn;
                var address = postData.address;

                if (files.length != 0) {
                //Loops through all the selected files
                for (let i = 0; i < files.length; i++) {
                    //create a storage reference
                    filename = CCCD + ".png";
                    var storage = firebase.storage().ref(filename);

                    // upload file
                    var upload = storage.put(files[i]);

                    // Monitor upload progress
                    upload.on(
                    "state_changed",
                    function(snapshot) {
                        // Track upload progress here if needed
                        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                        console.log("Upload progress: " + progress + "%");
                    },
                    function(error) {
                        // Handle upload error here
                        console.log("Upload error:", error);
                    },
                    function() {
                        // Upload complete, get file URL
                        getFileUrl(filename);
                    }
                    );
                }
                } else {
                alert("Chưa có ảnh");
                }
                });

                </script>
            </div>
                </div>
            </div>
            </div>
        </div>
        <div class="box-list">
            <?php
            if(isset($_SESSION['supportList'])){
                if(isset($_SESSION['undefind3'])){?>
                <div class="listbox"><h2><?php echo $_SESSION['undefind3']; ?></h2></div><?php
            } else{
                foreach($_SESSION['supportList'] as $support){?>
            <div class="listbox">
                <div class="infoStaff">
                    <div class="staff1">
                        <h2>Tên: <?php echo $support['supportName']; ?></h2> 
                        <p>ID: <?php echo $support['ID']; ?> </p>
                        <p>Bộ phận: <?php echo $support['position']?></p>
                    </div>
                </div>
                <div class="buttonFunc">
                    <form action="supportInfo.php" method="post">
                        <button type="submit" class="insert-but" name="ID" value ="<?php echo $support['ID'];?>">Thông tin chi tiết</button>
                    </form>
                </div>
            </div>
            <?php
                }
            }
        }
        else{
            $rdb = new firebaseRDB($databaseURL);
            $retrieve = $rdb->retrieve('/staffManager/support');
            $data = json_decode($retrieve,1);
            if($data == ""){?>
                <div class="listbox"><h2>Undefind</h2></div><?php
            }
            else{
                foreach($data as $support){?>
                    <div class="listbox">
                        <div class="infoStaff">
                            <div class="staff1">
                                <h2>Tên: <?php echo $support['supportName']; ?></h2> 
                                <p>ID: <?php echo $support['ID']; ?> </p>
                                <p>Bộ phận: <?php echo $support['position']?></p>
                            </div>
                        </div>
                        <div class="buttonFunc">
                            <form action="supportInfo.php" method="post">
                                <button type="submit" class="insert-but" name="ID" value ="<?php echo $support['ID'];?>">Thông tin chi tiết</button>
                            </form>
                        </div>
                    </div>
                    <?php
                        }
                    }
                }
                unset($_SESSION['undefind3']);
                unset($_SESSION['doctorList']);
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