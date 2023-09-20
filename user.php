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
    <nav class="navbar navbar-expand-lg navbar-dark  bg-gradient bg-dark sticky-top shadow-lg py-2">
        <div class="container">
            <a class="navbar-brand" href="index.php"><span class="text-warning">e</span class="sr-only">Commerce</a>
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
                </div></i>
            </a>
            <?php
            if(!isset($_SESSION['user_email'])) {

               echo  "<a class='btn my-sm-0 border-0' data-toggle='modal' data-target='#loginModal'><i class='fas fa-user text-light'></i></a>";

            }
            else {

                include("usernav.php");
            }
            ?>
          </form>
        </div>        
    </nav>
    <div class="row">
    <div class="col-lg-12">
        <div class="card text-dark mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-user-edit"></i> Sửa Thông Hồ Sơ Cá Nhân</h6>
            </div>
            <div class="card-body">
            <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Mã Thành Viên:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_id" required value="<?php echo $cur_id; ?>">
                            </div>
                        </div>
                    </div>
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Tên user:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_name" required value="<?php echo $cur_name; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Email:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_email" required value="<?php echo $cur_email; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Mật Khẩu:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_passwd" required value="<?php echo $cur_pass; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Địa Chỉ:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_address" required value="<?php echo $cur_address; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Số Điện Thoại:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_contact" required value="<?php echo $cur_contact; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Ảnh Đại Diện:</label>
                            <div class="col-sm-6">
                            <input type="file" name="admin_image" class="form-control-file">
                            <br>
                            <img src=" <?php echo "admin_images/$cur_image" ?>" width="70" height="70" class="rounded">
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
                            <p>Chi nhánh 1:     273, An Dương Vương, Quận 5, Tp.HCM</p>
                            <p>Chi nhánh 2:     105, Bà Huyện Thanh Quan, Quận 3, Tp.HCM</p>
                            <p>Chi nhánh 3:     4, Tôn Đức Thắng, Quận 1, Tp.HCM</p>
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

    
</body>
</html>