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
                <h6 class="m-0 font-weight-bold"><i class="fas fa-user-plus"></i> Thêm Quản Trị Viên</h6>
            </div>
            <div class="card-body">
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Tên Thành Viên*:</label>
                            <div class="col-sm-6">
<!--                            <input type="text" class="form-control" name="admin_name" required pattern="^[A-Za-zÀ-Ỹà-ỹ\s]+$" title="Tên thành viên chỉ chấp nhận chữ cái và không được để trống">-->
                                <input type="text" class="form-control" name="admin_name">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Email*:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_email">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Mật Khẩu*:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_passwd" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Địa Chỉ*:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_address" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Số Điện Thoại*:</label>
                            <div class="col-sm-6">
<!--                            <input type="text" class="form-control" name="admin_contact" required pattern="0[0-9]{9}">-->
                                <input type="text" class="form-control" name="admin_contact" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Chức Vụ*:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_pos" >
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Ảnh Đại Diện*:</label>
                            <div class="col-sm-6">
                            <input type="file" name="admin_image" class="form-control-file" accept="image/*">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Giới Thiệu:</label>
                            <div class="col-sm-6">
                            <textarea name="admin_about" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2"></label>
                            <div class="col-sm-6">
                                <input type="submit" name="submit" value="Thêm Thành Viên" class="btn btn-primary form-control">
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
        $admin_name = $_POST['admin_name'];
        $admin_email = $_POST['admin_email'];
        $admin_pass = $_POST['admin_passwd'];
        $admin_address = $_POST['admin_address'];
        $admin_contact = $_POST['admin_contact'];
        $admin_about = $_POST['admin_about'];
        $admin_pos = $_POST['admin_pos'];
        $admin_image = $_FILES['admin_image']['name'];
        $tmp_img = $_FILES['admin_image']['tmp_name'];
        // Create an array to store validation error messages
        $errorMessages = array();

        // Validate name
        if (empty($admin_name)) {
            $errorMessages[] = 'Tên không được để trống';
        } elseif (!preg_match('/^[A-Za-zÀ-Ỹà-ỹ ]+$/', $admin_name)) {
            $errorMessages[] = 'Tên không hợp lệ. Hãy chỉ sử dụng chữ cái';
        }

        // Validate email
        if (empty($admin_email)) {
            $errorMessages[] = 'Email không được để trống';
        } elseif (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
            $errorMessages[] = 'Email không hợp lệ';
        }

        // Validate password
        if (empty($admin_pass)) {
            $errorMessages[] = 'Mật khẩu không được để trống';
        }

        // Validate address
        if (empty($admin_address)) {
            $errorMessages[] = 'Địa chỉ không được để trống';
        } elseif (!preg_match('/^[a-zA-Z0-9À-Ỹà-ỹ ]+$/', $admin_address)) {
            $errorMessages[] = 'Địa chỉ không hợp lệ. Hãy chỉ sử dụng chữ cái và số';
        }

        // Validate contact (phone number)
        if (empty($admin_contact)) {
            $errorMessages[] = 'Số điện thoại không được để trống';
        } elseif (!preg_match('/^\d{10}$/', $admin_contact)) {
            $errorMessages[] = 'Số điện thoại không hợp lệ. Hãy sử dụng 10 chữ số';
        }

        // Validate position
        if (empty($admin_pos)) {
            $errorMessages[] = 'Chức vụ không được để trống';
        } elseif (!preg_match('/^[A-Za-zÀ-Ỹà-ỹ ]+$/', $admin_pos)) {
            $errorMessages[] = 'Chức vụ không hợp lệ. Hãy chỉ sử dụng chữ cái';
        }
        if (empty($admin_image)) {
            $errorMessages[] = 'Ảnh đại diện không được để trống';
        } else{
            $image_extension = pathinfo($admin_image, PATHINFO_EXTENSION);
            $allowed_extensions = array("jpg", "jpeg", "png", "gif");
            if (in_array($image_extension, $allowed_extensions)) {
                // The image extension is not in the list of allowed extensions.
                $unique_filename = uniqid(). '.' .$image_extension;
                $image_destination = "admin_images/$unique_filename";

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

        // Check if there are any validation errors
        if (!empty($errorMessages)) {
            foreach ($errorMessages as $error) {
                echo "<script>alert('$error')</script>";
            }
        } else {
//            move_uploaded_file($tmp_img, "admin_images/$admin_image");

            $n = 10;
            function getRandomString($n) {
                $regexPattern = '/^[A-Za-z0-9]+$/';
                $randomString = '';
                while (strlen($randomString) < $n) {
                    $char = chr(rand(33, 126));
                    if (preg_match($regexPattern, $char)) {
                        $randomString .= $char;
                    }
                }
                return $randomString;
            }

            $ranD = getRandomString($n);
            $admin_id = $ranD;

            $insertQry = "INSERT INTO `admin` (`ID`, `Name`, `Email`, `Passwd`, `Image`, `Contact`, `Address`, `Position`, `About`) VALUES ('$admin_id', '$admin_name', '$admin_email', '$admin_pass', '$admin_image', '$admin_contact', '$admin_address', '$admin_pos', '$admin_about');";

            $executeQry = $MyConn->query($insertQry);

            if ($executeQry) {
                echo "<script>alert('Thêm Thành Viên Thành Công')</script>";
                echo "<script>window.open('index.php?view_admin','_self')</script>";
            }
        }
    }

    ?>

<?php } ?>