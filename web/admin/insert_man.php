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
                <h6 class="m-0 font-weight-bold"><i class="fas fa-folder-plus"></i> Thêm Hãng Sản Xuất</h6>
            </div>
            <div class="card-body">
                <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Tên Hãng*:</label>
                            <div class="col-sm-6">
                            <input type="text" class="form-control" name="man_name" >
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2">Nơi xuất xứ*:</label>
                            <div class="col-sm-6">
                                <select class="form-control" name="man_made" >
                                    <option value="0"  selected>Lựa chọn nơi xuất xứ</option>
                                    <option value="1" >Việt Nam</option>
                                    <option value="2">Nước ngoài</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-sm-3 text-right mt-2"></label>
                            <div class="col-sm-6">
                                <input type="submit" name="submit" value="Thêm Hãng" class="btn btn-primary form-control">
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
        $man_name = $_POST['man_name'];
        $man_made = $_POST['man_made'];

        // Trim leading and trailing spaces
        $man_name = trim($man_name);

        if (empty($man_name)) {
            echo "<script>alert('Tên Hãng Sản Xuất không được bỏ trống. Vui lòng nhập lại.')</script>";
        } elseif (!preg_match('/^[A-Za-zÀ-Ỹà-ỹ0-9\s]+$/', $man_name)) {
            echo "<script>alert('Tên Hãng Sản Xuất không hợp lệ (Không chứa các kí tự đặc biệt). Vui lòng nhập lại.')</script>";
        } elseif (empty($man_made)) {
            echo "<script>alert('Nơi xuất xứ không được bỏ trống. Vui lòng chọn lại.')</script>";
        } else {
            $man_id = rand(1, 1000);

            // Check if the manufacturer name already exists
            $check_query = "SELECT MA_HANGSX FROM HANGSX WHERE TEN_HANGSX = '$man_name'";
            $check_result = $MyConn->query($check_query);

            if ($check_result->num_rows > 0) {
                echo "<script>alert('Tên Hãng Sản Xuất đã tồn tại trong cơ sở dữ liệu. Vui lòng nhập lại.')</script>";
            } else {
                // Name is valid and not empty, proceed with the insertion
                $insert_man = "INSERT INTO HANGSX (MA_HANGSX, TEN_HANGSX) VALUES ('$man_id', '$man_name')";
                $executeUpdate = $MyConn->query($insert_man);

                if ($executeUpdate) {
                    echo "<script>alert('Thêm Hãng Sản Xuất Mới Thành Công')</script>";
                    echo "<script>window.open('index.php?view_man', '_self')</script>";
                }
            }
        }
    }



    ?>

<?php } ?>