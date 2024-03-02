<?php
include("admin/includes/database.php");

if(isset($_POST['registry'])) {
    $MyConn = new MyConnect();
    $C_name = $_POST['Name'];
    $C_email = $_POST['Email'];
    $C_passwd = $_POST['password'];
    $C_addr = $_POST['address'];
    $C_cont = $_POST['contact'];
    $C_image = "default_avt.png";
    // Băm mật khẩu bằng bcrypt trước khi lưu trữ vào cơ sở dữ liệu
    $hashed_password = password_hash($C_passwd, PASSWORD_BCRYPT);

    // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu hay chưa
    $email_check_query = "SELECT * FROM KH WHERE EMAIL = '$C_email'";
    $result = $MyConn->query($email_check_query);

    if(mysqli_num_rows($result) > 0) {
        // Email đã tồn tại, hiển thị thông báo lỗi
        echo "<script>alert('Email đã tồn tại. Vui lòng sử dụng một email khác.')</script>";
        echo "<script>window.history.back();</script>";
    } else {
        // Email không tồn tại, thực hiện việc đăng ký
        $query = "INSERT INTO KH(TEN_KH, EMAIL, MATKHAU, DIACHI, DIENTHOAI, AVATAR) VALUES ('$C_name','$C_email','$hashed_password','$C_addr','$C_cont','$C_image')";
        $execute = $MyConn->query($query);

        if($execute) {
            echo "<script>alert('Đăng Ký Thành Công')</script>";
        } else {
            echo "<script>alert('Đăng Ký Thất Bại')</script>";
        }
        echo "<script>window.history.back();</script>";
    }
}
?>
