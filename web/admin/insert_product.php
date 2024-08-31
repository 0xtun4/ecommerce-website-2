<?php

if(!isset($_SESSION['admin_email'])){

    echo "<script>window.open('login.php','_self')</script>";

}
else {
    ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card text-dark mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold"><i class="fas fa-folder-plus"></i> Thêm Sản Phẩm</h6>
            </div>
            <div class="card-body">
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Tên Sản Phẩm*:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="product_name" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Nhà Sản Xuất*:</label>
                            <div class="col-sm-6">
                            <select name="manufacturer" class="form-control" >
                                <option value="" disabled selected>Lựa chọn Nhà Sản Xuất</option>
                                <?php 
                                    $getManQry = "select * from HANGSX";

                                    $result = $MyConn->query($getManQry);
                                    
                                ?>
                                
                                <?php 
                                    while($row = mysqli_fetch_array($result)) {
                                        $man_id = $row['MA_HANGSX'];
                                        $man_name = $row['TEN_HANGSX'];

                                        echo "<option value='$man_id'>$man_name</option>";
                                    }
                                ?>
                            </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Loại Sản Phẩm*:</label>
                            <div class="col-sm-6">
                            <select name="catalog" class="form-control" >
                                <option value="" disabled selected>Lựa Chọn Loại Sản Phẩm</option>
                                <?php
                                    $getCatQry = "select * from LOAISP";

                                    $result = $MyConn->query($getCatQry);

                                ?>

                                <?php
                                    while($row = mysqli_fetch_array($result)) {
                                        $cat_id = $row['MA_LOAISP'];
                                        $cat_name = $row['TEN_LOAISP'];

                                        echo "<option value='$cat_id'>$cat_name</option>";
                                    }
                                ?>
                            </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Hình Ảnh Sản Phẩm*:</label>
                            <div class="col-sm-6">
<!--                            <input type="file" name="product_image" class="form-control-file" required accept="image/*">-->
                                <input type="file" name="product_image" class="form-control-file" accept="image/*" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Giá Thành:</label>
                            <div class="col-sm-6">
<!--                            <input type="number" name="product_price" class="form-control" required pattern="^\d+(\.\d{1,2})?$" title="Giá phải là số không âm ">-->
                                <input type="number" name="product_price" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Miêu Tả Sản Phẩm:</label>
                            <div class="col-sm-6">
                            <textarea name="product_desc" class="form-control" rows="10"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2"></label>
                            <div class="col-sm-6">
                                <input type="submit" name="submit" value="Thêm Sản Phẩm" class="btn btn-primary form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

    if (isset($_POST['submit'])) {
        $pattern_name = '/^[a-zA-Z0-9_À-Ỹà-ỹ -]+$/';
        $p_id = rand(1, 10000);
        $p_name = $_POST['product_name'];
        $p_cat = $_POST['catalog'];
        $p_man = $_POST['manufacturer'];
        $p_price = $_POST['product_price'];
        $p_about = $_POST['product_desc'];
        $p_image = $_FILES['product_image']['name'];
        $tmp_img = $_FILES['product_image']['tmp_name'];
//        move_uploaded_file($tmp_img, "product_images/$p_image");

        if (empty($p_cat)) {
            echo "<script>alert('Vui lòng chọn loại sản phẩm')</script>";
            exit();
        }

        if (empty($p_man)) {
            echo "<script>alert('Vui lòng chọn nhà sản xuất')</script>";
            exit();
        }

        if (empty($p_name)) {
            echo "<script>alert('Tên sản phẩm không được bỏ trống')</script>";
            exit();
        }

        if (!preg_match($pattern_name, $p_name)) {
            echo "<script>alert('Tên sản phẩm không hợp lệ. Hãy chỉ sử dụng chữ cái và số')</script>";
            exit();
        }

        if (empty($p_price)) {
            echo "<script>alert('Giá sản phẩm không được bỏ trống')</script>";
            exit();
        }

        if (!is_numeric($p_price) || $p_price <= 0) {
            echo "<script>alert('Giá sản phẩm không hợp lệ. Chỉ sử dụng số và giá trị lớn hơn 0')</script>";
            exit();
        }

// Kiểm tra hình ảnh sản phẩm

        $upload_directory = "product_images/";
        $image_destination = $upload_directory . $p_image;

        if (move_uploaded_file($tmp_img, $image_destination)) {
            // Hình ảnh đã được tải lên thành công
        } else {
            echo "<script>alert('Chỉ chấp nhận ảnh có định dạng JPG, JPEG, PNG & GIF')</script>";
            exit();
        }



        $check_product = "SELECT * FROM SP WHERE TEN_SP = '$p_name'";
        $run_check = $MyConn->query($check_product);

        if (mysqli_num_rows($run_check) > 0) {
            echo "<script>alert('Sản phẩm đã tồn tại')</script>";
            exit();
        }

        $insert_product = "INSERT INTO SP (MA_SP, TEN_SP, MA_LOAISP, MA_HANGSX, MIEUTA_SP, HINHANH_SP, GIA) VALUES ('$p_id', '$p_name', '$p_cat', '$p_man', '$p_about', '$p_image', '$p_price')";
        $executeUpdate = $MyConn->query($insert_product);

        if ($executeUpdate) {
            echo "<script>alert('Thêm Sản Phẩm Mới Thành Công')</script>";
            echo "<script>window.open('index.php?view_product','_self')</script>";
        } else {
            echo "<script>alert('Thêm Sản Phẩm Mới Thất Bại')</script>";
            echo "<script>window.open('index.php?view_product','_self')</script>";
        }
    }


    ?>

<?php } ?>