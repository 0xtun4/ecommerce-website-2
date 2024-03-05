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
</head>
<body>
    <?php include ("userheader.php")?>
    <div class="jumbotron py-4" style="background-color: #d1e2e9;">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h2 class="font-weight-bold" style="color: #b888ff">
                        SALE OFF
                        <span style="color: #fbb419;">70%</span>
                    </h2>
                    <h1 class="font-weight-bold" style="color: #253b70;  text-shadow: 4px 4px #f1f1f1; font-size: 500%;">
                        <span>Mùa </span><br>
                        <span>Năng Động</span>
                    </h1>
                    <a class="btn btn-primary rounded-0 border-0 p-2 px-4 mt-3" style="background-color: #fc7c7c;" href="#" role="button">Xem Ngay</a>
                </div>
                <div class="col-md-7">
                    <img src="img/hero.png" style=" height: auto" class="text-right w-50 d-block m-auto">
                </div>
            </div>
            
        </div>
    </div>

    <div aria-live="polite" aria-atomic="true" style="bottom: 0; right: 0; z-index: 1200;" class="position-fixed">
            <div class="toast bg-success font-weight-bold p-2 text-light">
                <div class="toast-body">
                        Sản Phẩm Đã Được Thêm Vào Giỏ Hàng
                </div>
            </div>
    </div>
    <!-- Sản phẩm mới -->
    <div class="container-fluid hpproduct text-center">
        <div class="row mt-4 mb-4">
            <div class="col-md-12 ">
                <h2 class="font-weight-bolder" style="color: #2f3640;">Sản Phẩm Mới</h2>
                <div class="row mt-0 mx-4 card-deck">
                <?php
                    $i = 0;
                    $queryP = "SELECT * FROM SP LIMIT 4";
                    $resultP = $MyConn->query($queryP);
                    while($getP = mysqli_fetch_array($resultP)) {
                        if($i%3 == 0 && $i != 0) {
                            echo "</div><div class='row mt-3 ml-4 card-deck'>";
                        }                        
                ?>
                    <div class="col-md-3 p-1 mt-3">
                            <div class="card card-link h-100 p-0 p">
                                <div class="card-header p-0 border-bottom-0 h-100">
                                <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>" class="text-decoration-none text-dark">
                                    <img src="<?php echo $getP['HINHANH_SP']; ?>" class="card-img-top h-100 img-responsive">
                                </a>
                                </div> <!-- close card header -->
                                <div class="card-body p-0">
                                <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>" class="text-decoration-none text-dark">
                                    <div class="card-title text-center mt-4">
                                        <h6 class="font-weight-bold"><?php echo $getP['TEN_SP'] ?></h6>
                                        <div class="font-weight-bold text-danger"><?php echo number_format($getP['GIA'],0,",","."); ?><sup>đ</sup></div>
                                    </div>
                                </a>
                                </div> 
                                <div class="card-footer border-top-0 bg-transparent mt-3">
                                    <button id="myBtn" onclick="addCart('<?php echo $getP['MA_SP'] ?>')" class="btn btn-warning w-100 mt-auto text-white"><i class="fas fa-cart-plus"></i> Thêm Vào Giỏ</button>

                                </div>
                                <!-- close card body -->
                            </div> <!-- close card -->
                    </div> <!-- close col -->
                    <?php } ?>
                </div> <!-- close row -->
            </div>
        </div>
        <div id="newProduct" class="row mb-3 ml-4 mr-4">
        </div>
    </div>
    <!-- Sản phẩm bán chạy -->
    <div class="container-fluid hpproduct text-center">
            <div class="row mt-5 mb-4">
                <div class="col-md-12">
                    <h2 class="font-weight-bolder d-block" style="color: #2f3640;">Sản Phẩm Bán Chạy</h2>
                    <div class="row mt-0 mx-4 card-deck">
                <?php
                    $i = 0;
                    $queryP = "SELECT SP.MA_SP, SP.TEN_SP, SP.HINHANH_SP, SP.GIA, SUM(CT_HOADON.SOLUONG) FROM SP, CT_HOADON WHERE SP.MA_SP = CT_HOADON.MA_SP GROUP BY MA_SP LIMIT 4";
                    $resultP = $MyConn->query($queryP);
                    while($getP = mysqli_fetch_array($resultP)) {
                        if($i%3 == 0 && $i != 0) {
                            echo "</div><div class='row mt-3 ml-4 card-deck'>";
                        }                        
                ?>
                    <div class="col-md-3 p-1 mt-3">
                            <div class="card card-link h-100 p-0 p">
                                <div class="card-header p-0 border-bottom-0 h-100">
                                <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>" class="text-decoration-none text-dark">
                                    <img src="<?php echo $getP['HINHANH_SP']; ?>" class="card-img-top h-100 img-responsive">
                                </a>
                                </div> <!-- close card header -->
                                <div class="card-body p-0">
                                <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>" class="text-decoration-none text-dark">
                                    <div class="card-title text-center mt-4">
                                        <h6 class="font-weight-bold"><?php echo $getP['TEN_SP'] ?></h6>
                                        <div class="font-weight-bold text-danger"><?php echo number_format($getP['GIA'],0,",","."); ?><sup>đ</sup></div>
                                    </div>
                                </a>
                                </div> 
                                <div class="card-footer border-top-0 bg-transparent mt-3">
                                    <button id="myBtn" onclick="addCart('<?php echo $getP['MA_SP'] ?>')" class="btn btn-warning w-100 mt-auto text-white"><i class="fas fa-cart-plus"></i> Thêm Vào Giỏ</button>
                                </div>
                                <!-- close card body -->
                            </div> <!-- close card -->
                    </div> <!-- close col -->
                    <?php } ?>
                </div> <!-- close row -->
                </div>
            </div>
        <div id="bestSeller" class="row mb-3 ml-4 mr-4">
        </div>
    </div>
    <!-- Maybe you like this-->
    <div class="container-fluid hpproduct text-center">
            <div class="row mt-5 mb-4">
                <div class="col-md-12 ">
                    <h2 class="font-weight-bolder" style="color: #2f3640;">Có Thể Bạn Sẽ Thích</h2>
                    <div class="row mt-0 mx-4 card-deck">
                <?php
                    $i = 0;
                    $queryP = "SELECT * FROM SP ORDER BY RAND() LIMIT 4";

                    $resultP = $MyConn->query($queryP);
                    while($getP = mysqli_fetch_array($resultP)) {
                        
                        if($i%3 == 0 && $i != 0) {
                            echo "</div><div class='row mt-3 ml-4 card-deck'>";
                        }                        
                ?>
                    <div class="col-md-3 p-1 mt-3">
                            <div class="card card-link h-100 p-0 p">
                                <div class="card-header p-0 border-bottom-0 h-100">
                                <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>" class="text-decoration-none text-dark">
                                    <img src="<?php echo $getP['HINHANH_SP']; ?>" class="card-img-top h-100 img-responsive">
                                </a>
                                </div> <!-- close card header -->
                                <div class="card-body p-0">
                                <a href="detail.php?productID=<?php echo $getP['MA_SP'] ?>" class="text-decoration-none text-dark">
                                    <div class="card-title text-center mt-4">
                                        <h6 class="font-weight-bold"><?php echo $getP['TEN_SP'] ?></h6>
                                        <div class="font-weight-bold text-danger"><?php echo number_format($getP['GIA'],0,",","."); ?><sup>đ</sup></div>
                                    </div>
                                </a>
                                </div> 
                                <div class="card-footer border-top-0 bg-transparent mt-3">
                                    <button id="myBtn" onclick="addCart('<?php echo $getP['MA_SP'] ?>')" class="btn btn-warning w-100 mt-auto text-white"><i class="fas fa-cart-plus"></i> Thêm Vào Giỏ</button>
                                </div>
                                <!-- close card body -->
                            </div> <!-- close card -->
                    </div> <!-- close col -->
                    <?php } ?>
                </div> <!-- close row -->
                </div>
            </div>
        <div id="recommend" class="row mb-3 ml-4 mr-4">
        </div>
    </div>
    <?php include("login_registry_modal.php");
    include("userfooter.php");?>
    <script type="text/javascript" src="js/addCart.js"></script>
</body>
</html>