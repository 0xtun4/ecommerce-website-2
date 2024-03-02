<?php
session_start();

include("admin/includes/database.php");
$MyConn = new MyConnect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>eCommerce</title>
    <meta charset="utf-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .nav-link {
            color: white !important;
        }
        .nav-link:hover {
            color: #ffc108 !important;
        }
        .cart-amount {
            top: -13px;
            right: -10px;
            min-width: 20px;
            min-height: 20px;
            border-width: 2px;
            border-radius: 50%;
            font-size: 12px;
        }
        .p:hover {
            box-shadow: 0 0 11px rgba(33,33,33,.2);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-gradient bg-dark sticky-top shadow-lg py-2">
    <div class="container">
        <a class="navbar-brand" href="index.php"><span class="text-warning">e</span>Commerce</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Trang Chủ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.php">Sản Phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Giới Thiệu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Liên Hệ</a>
                </li>
            </ul>
            <form class="form-inline" method="get" action="search.php">
                <input class="form-control-sm mr-sm-2 border-0" type="search" name="keyword"  placeholder="Tìm kiếm sản phẩm" aria-label="Search">
                <button class="btn my-sm-0 "><a class="text-light"><i class="fas fa-search"></i></i></a></button>
                <a href="cart.php" class="btn my-sm-0 border-0 bg-transparent text-light">
                    <i class="fas fa-shopping-cart position-relative">
                        <?php
                        $total_price = 0;
                        $total_qty = 0;
                        if(isset($_SESSION['cart'])) {
                            foreach($_SESSION['cart'] as $value) {
                                $total_qty += $value["quantity"];
                                $total_price += (int)$value["price"]*$value["quantity"];
                            }
                        }
                        ?>
                        <div class="cart-amount bg-info position-absolute text-white d-flex justify-content-center align-items-center font-weight-bold">
                            <span id="cart_amount"><?php echo $total_qty ?></span>
                        </div>
                    </i>
                </a>
                <?php
                if (!isset($_SESSION['user_email'])) {
                    echo "<a class='btn my-sm-0 border-0' data-toggle='modal' data-target='#loginModal'><i class='fas fa-user text-light'></i></a>";
                } else {
                    include("usernav.php");
                    $user_id = $_SESSION['user_id'];
                    $query = "SELECT TEN_KH, EMAIL, DIACHI, DIENTHOAI, AVATAR FROM KH WHERE MA_KH='$user_id'";
                    $run_query = $MyConn->query($query);
                    if ($run_query) {
                        $getCurUser = mysqli_fetch_array($run_query);
                        if ($getCurUser) {
                            $user_name = $getCurUser['TEN_KH'];
                            $user_email = $getCurUser['EMAIL'];
                            $user_avatar = $getCurUser['AVATAR'];
                            $user_dienthoai = $getCurUser['DIENTHOAI'];
                            $user_diachi = $getCurUser['DIACHI'];
                        }
                    }else{
                        die("MySQL Error: " . mysqli_error($MyConn));
                    }

                ?>

            </form>
        </div>
    </div>
</nav>
<div class="row">
    <div class="col-lg-12">
        <div class="card text-dark mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-user-edit"></i> Sửa Thông Hồ Sơ Cá Nhân</h6>
            </div>
            <div class="card-body">
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Tên user*:</label>
                            <div class="col-sm-6">
<!--                                <input type="text" class="form-control" name="admin_name" required pattern="^[A-Za-zÀ-Ỹà-ỹ\s]+$" title="Tên thành viên chỉ chấp nhận chữ cái và không được để trống" value="--><!--">-->
                                <input type="text" class="form-control" name="admin_name" value="<?php echo$user_name?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Email*:</label>
                            <div class="col-sm-6">
<!--                                <input type="email" class="form-control" name="admin_email" required value="--><!--">-->
                                <input type="text" class="form-control" name="admin_email" value="<?php echo $user_email ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Địa Chỉ*:</label>
                            <div class="col-sm-6">
<!--                                <input type="text" class="form-control" name="admin_address" required value="--><!--">-->
                                <input type="text" class="form-control" name="admin_address" value="<?php echo $user_diachi ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Số Điện Thoại*:</label>
                            <div class="col-sm-6">
<!--                                <input type="text" class="form-control" name="admin_contact" required pattern="0[0-9]{9}" title="Phải nhập số bắt đầu bằng số 0 và có 10 số" value="--><!--">-->
                                <input type="text" class="form-control" name="admin_contact" value="<?php echo $user_dienthoai ?>" >

                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Ảnh Đại Diện:</label>
                            <div class="col-sm-6">
                                <input type="file" name="admin_image" class="form-control-file" accept="image/*">
                                <br>
                                <img src="admin/customer_images/<?php echo $user_avatar ?>" width="70" height="70" class="rounded" alt="user avatar">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2"></label>
                            <div class="col-sm-6">
                                <input type="submit" name="update" value="Cập Nhật Thông Tin" class="btn btn-primary form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<footer class="bg-dark">
    <div class="container-fuild text-light">
        <div class="row card-deck pt-3">
            <div class="col-md-5 pr-0">
                <div class="card border-0 bg-dark ml-4">
                    <div class="card-header bg-dark border-0"><h4>HỆ THỐNG CỬA HÀNG</h4></div>
                    <div class="card-body border-0">
                        <p>Chi nhánh 1: 273, An Dương Vương, Quận 5, Tp.HCM</p>
                        <p>Chi nhánh 2: 105, Bà Huyện Thanh Quan, Quận 3, Tp.HCM</p>
                        <p>Chi nhánh 3: 4, Tôn Đức Thắng, Quận 1, Tp.HCM</p>
                    </div>
                </div>
            </div>
            <div class="col-md pl-0">
                <div class="card border-0 bg-dark ml-4">
                    <div class="card-header bg-dark border-0"><h4>CHÍNH SÁCH & DỊCH VỤ</h4></div>
                    <div class="card-body border-0">
                        <a href="#" class="text-light text-decoration-none pb-3"><i class="fas fa-shipping-fast mr-2"></i>Vận chuyển</a><br>
                        <a href="#" class="text-light text-decoration-none pb-3"><i class="fas fa-money-check-alt mr-2"></i>Thanh toán</a><br>
                        <a href="#" class="text-light text-decoration-none pb-3"><i class="fas fa-exchange-alt mr-2"></i>Đổi trả</a>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card border-0 bg-dark mx-0 ml-4">
                    <div class="card-header bg-dark border-0"><h4>LIÊN HỆ</h4></div>
                    <div class="card-body border-0">
                        <p><i class="fas fa-phone-alt mr-2"></i> 0123456789 <br>
                            <i class="fas fa-envelope-open-text mr-2"></i> hotro@hotro.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr style="background-color: white; height: 1px; margin: 0; padding: 0;">
    <div class="container-fluid text-center text-light p-1">
        <h7>Copyright © 2021. Powered by eCommerce</h7>
    </div>
</footer>
<?php include("login_registry_modal.php"); ?>
<script type="text/javascript" src="js/addCart.js"></script>
<?php
if (isset($_POST['update'])) {
    $user_name = $_POST['admin_name'];
    $user_email = $_POST['admin_email'];
    $user_address = $_POST['admin_address'];
    $user_contact = $_POST['admin_contact'];
    $user_image = $_FILES['admin_image']['name'];
    $tmp_img = $_FILES['admin_image']['tmp_name'];

    // Default image name in case no image is uploaded
    $default_image = "default_avt.png";

    // Check if the 'admin_image' field is empty, if it is, set it to the default image
    if (empty($user_image)) {
        $user_image = $default_image;
    }

    // Perform validation checks
    $validation_errors = [];

    if (empty($user_name)) {
        $validation_errors[] = "Tên không được để trống";
    } elseif (!preg_match('/^[A-Za-zÀ-Ỹà-ỹ ]+$/', $user_name)) {
        $validation_errors[] = "Tên không hợp lệ. Hãy chỉ sử dụng chữ cái";
    }

    if (empty($user_email)) {
        $validation_errors[] = "Email không được để trống";
    } elseif (!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/', $user_email)) {
        $validation_errors[] = "Email không hợp lệ";
    }

    if (empty($user_address)) {
        $validation_errors[] = "Địa chỉ không được để trống";
    } elseif (!preg_match('/^[a-zA-Z0-9À-Ỹà-ỹ ]+$/', $user_address)) {
        $validation_errors[] = "Địa chỉ không hợp lệ. Hãy chỉ sử dụng chữ cái và số";
    }

    if (empty($user_contact)) {
        $validation_errors[] = "Số điện thoại không được để trống";
    } elseif (!preg_match('/^\d{10}$/', $user_contact)) {
        $validation_errors[] = "Số điện thoại không hợp lệ. Hãy sử dụng 10 chữ số";
    }
    if (empty($admin_image)) {
        $admin_image = $user_avatar; // Set it to the current image if no new image is provided
    } else {
        $image_extension = pathinfo($admin_image, PATHINFO_EXTENSION);
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");

        if (!in_array($image_extension, $allowed_extensions)) {
            // The image extension is in the list of allowed extensions.
            $unique_filename = uniqid(). '.' .$image_extension;
            $image_destination = "/admin/customer_images/$unique_filename";

            if (move_uploaded_file($tmp_img, $image_destination)) {
                // Image upload was successful
                $admin_image = $unique_filename; // Update the $admin_image variable with the new filename
            } else {
                // Failed to move the uploaded image
                $errorMessages[] = 'Lỗi khi tải lên ảnh. Vui lòng thử lại.';
            }
        } else {
            $errorMessages[] = 'Chỉ chấp nhận ảnh có định dạng JPG, JPEG, PNG & GIF';
        }
    }


    if (!empty($validation_errors)) {
        // Display validation error messages
        foreach ($validation_errors as $error) {
            echo "<script>alert('$error')</script>";
        }
    } else {
        $query = "UPDATE KH SET TEN_KH='$user_name', EMAIL='$user_email', AVATAR='$user_image', DIENTHOAI='$user_contact', DIACHI='$user_address' WHERE MA_KH='$user_id'";
        $executeQry = $MyConn->query($query);
        if ($executeQry) {
            echo "<script>alert('Cập Nhật Thông Tin Thành Công')</script>";
            echo "<script>window.open('view_user.php','_self')</script>";
            include("usernav.php");
        } else {
            echo "<script>alert('Cập Nhật Thông Tin Thất Bại')</script>";
        }

        $executeQry->close();
    }
}

?>
<?php } ?>
</body>
</html>
