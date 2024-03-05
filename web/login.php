<?php
session_start();
include("admin/includes/database.php");

if(isset($_POST['login'])) {
    $MyConn = new MyConnect();

$email = mysqli_real_escape_string($MyConn->getConn(), $_POST['email']);
$pass = mysqli_real_escape_string($MyConn->getConn(), $_POST['passwd']);

$query = "SELECT MA_KH, MATKHAU FROM KH WHERE EMAIL='$email'";

$result = $MyConn->query($query);

if ($result) {
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $stored_hashed_password = $row['MATKHAU'];

        if (password_verify($pass, $stored_hashed_password)) {
            $userID = $row['MA_KH'];
            $_SESSION['user_id'] = $userID;
            $_SESSION['user_email'] = $email;
            echo "<script>window.history.back();</script>";
        } else {
            echo "<script>alert('Địa Chỉ Email Hoặc Mật Khẩu Không Đúng')</script>";
            echo "<script>window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Địa Chỉ Email Hoặc Mật Khẩu Không Đúng')</script>";
        echo "<script>window.history.back();</script>";
    }
} else {
    // Xử lý lỗi khi thực hiện truy vấn
    echo "Lỗi khi thực hiện truy vấn: " . mysqli_error($MyConn->getConn());
}
}
?>
