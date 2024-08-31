<?php

session_start();

include("admin/includes/database.php");

if(!isset($_SESSION['cart']) || !isset($_SESSION['user_id'])) {
    echo "<script>window.open('cart.php','_self')</script>";
}
else 
$MyConn = new MyConnect();
$userID = $_SESSION['user_id'];
$getUser = "SELECT * FROM KH WHERE MA_KH='$userID'";
$execute = $MyConn->query($getUser);

$result = mysqli_fetch_array($execute);

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
    enav:disabled {
        color: black;
    }
    .nav-tabs {
        border-bottom: 1px solid #dee2e6;
    }
    button:focus {outline:0;}

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
            if(!isset($_SESSION['user_id'])) {

               echo  "<a class='btn my-sm-0 border-0' data-toggle='modal' data-target='#loginModal'><i class='fas fa-user text-light'></i></a>";

            }
            else {

                include("usernav.php");
            }
            ?>
          </form>
        </div>        
    </nav>

    
    <div class="container pb-5 position-relative pt-2">
            <div class="mt-5 d-block ">
                <ul class="nav nav-pills nav-fill border-0 rounded-0">
                    <li class="flex-grow-1 text-center nav-item">
                        <a href="" class="m-0 px-0 py-3 bg-secondary text-muted nav-link disabled font-weight-bold rounded-0 nav-link border-right">Giỏ Hàng</a>
                    </li>
                    <li class="flex-grow-1 text-center nav-item">
                        <a class="m-0 px-0 py-3 bg-warning text-light nav-link disabled active  font-weight-bold rounded-0 nav-link border-right">Vận Chuyển</a>
                    </li>
                    <li class="flex-grow-1 text-center nav-item">
                        <a class="m-0 px-0 py-3 bg-secondary text-muted nav-link disabled  font-weight-bold rounded-0 nav-link border-right">Thanh Toán</a>
                    </li>
                    <li class="flex-grow-1 text-center nav-item">
                        <a class="m-0 px-0 py-3 bg-secondary text-muted nav-link disabled  font-weight-bold rounded-0 nav-link">Xác Nhận Đơn Hàng</a>
                    </li>
                </ul>
            </div>


        <div class="my-5 d-block">
            <form id="myForm" method="post" action="payment.php">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="form-group">
                            <label for="customerName">Họ và tên*:</label>
                            <input type="text" class="form-control"   name="customerName" value="<?php echo $result['TEN_KH']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="customerEmail">Email*:</label>
                            <input type="text" class="form-control"  name="customerEmail" value="<?php echo $result['EMAIL']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="customerContact">Số Điện Thoại*:</label>
                            <input type="text" class="form-control"   name="customerContact" value="<?php echo $result['DIENTHOAI']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="customerAddress">Địa Chỉ*:</label>
                            <input type="text" class="form-control"  name="customerAddress" value="<?php echo $result['DIACHI']; ?>">
                        </div>
                        <button type="submit" class="mt-4 btn btn-block btn-info btn-lg font-weight-bold" name="post">Tiếp Tục</button>
                    </div>
                </div>
            </form>
        </div>

        <script>
            document.getElementById("myForm").addEventListener("submit", function(event) {
                const customerName = document.querySelector('[name="customerName"]').value.trim();
                const customerEmail = document.querySelector('[name="customerEmail"]').value.trim();
                const customerContact = document.querySelector('[name="customerContact"]').value.trim();
                const customerAddress = document.querySelector('[name="customerAddress"]').value.trim();

                let errorMessages = [];

                if (customerName === "") {
                    errorMessages.push("Tên không được để trống.");
                }
                    else if (!/^[A-Za-zÀ-Ỹà-ỹ\s]+$/.test(customerName)) {
                    errorMessages.push("Tên chỉ chấp nhận chữ cái.");
                }

                if (customerAddress === "") {
                    errorMessages.push("Địa chỉ không được để trống.");
                }
                else if (!/^[A-Za-zÀ-Ỹà-ỹ0-9\s]+$/.test(customerAddress)) {
                    errorMessages.push("Địa chỉ chỉ chấp nhận chữ cái và số.");
                }

                if (customerEmail === "") {
                    errorMessages.push("Email không được để trống");
                } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(customerEmail)) {
                    errorMessages.push("Email không hợp lệ.");
                }

                if (customerContact === "") {
                    errorMessages.push("Số điện thoại không được để trống.");
                } else if (!/^0[0-9]{9}$/.test(customerContact)) {
                    errorMessages.push("Số điện thoại không hợp lệ.");
                }

                if (errorMessages.length > 0) {
                    alert(errorMessages.join("\n"));
                    event.preventDefault();
                }
            });


        </script>




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

</body>










    <?php include("login_registry_modal.php");
    ?>
</html>