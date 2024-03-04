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
        <?php
        $t=time();
        $time =date("Y",$t);
        echo "<h7>Copyright © $time. Powered by eCommerce</h7>"
        ?>
    </div>
</footer>