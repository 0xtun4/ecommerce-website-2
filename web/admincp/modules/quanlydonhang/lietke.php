<?php
    $sql_lietke_dh="SELECT * FROM tbl_giohang ,tbl_dangky  WHERE tbl_giohang.id_khachhang=tbl_dangky.id_khachhang ORDER BY id_cart DESC";
    $result_lietke_dh= mysqli_query($connect,$sql_lietke_dh);
?>
<p>Danh sách đơn hàng của người dùng</p>
 <table style="width: 100%;" border="1" style="border-collapse:collapse;"> 
     <tr>
         <td>ID</td>
         <td>Mã đơn hàng</td>
         <td>Tên khách hàng</td>
         <td>Địa chỉ</td>
         <td>Tài khoản</td>
         <td>Hình thức thanh toán</td>
         <td>Điện thoại</td>
         <td>Tinh Trạng </td>
         <td colspan="2">Quản lý </td>
     </tr>
     <?php
    $i=0;
    while($row=mysqli_fetch_array($result_lietke_dh)){
        $i++;
    
     ?>
     <tr>
         <td><?php echo $i ?></td>
         <td><?php echo $row['code_cart'] ?></td>
         <td><?php echo $row['hovaten']?></td>
         <td><?php echo $row['diachi']?></td>
         <td><?php echo $row['taikhoan']?></td>
         <td><?php echo $row['cart_payment']?></td>
         <td><?php echo $row['sodienthoai']?></td>
         <td>
    	<?php if($row['cart_status']==1){
    		echo '<a href="modules/quanlydonhang/xuly.php?code='.$row['code_cart'].'">Đơn hàng mới</a>';
    	}else{
    		echo 'Đã xem';
    	}
    	?>
    </td>
         <td>
            <a href="index.php?action=quanlydonhang&query=xemdonhang&code=<?php echo $row['code_cart']?>">Xem đơn hàng</a>|
            <th><a href="modules/quanlydonhang/xuly.php?iddonhang=<?php echo $row['code_cart']?>">Xóa</a></th>
         </td>
     </tr>
     
     <?php
    }
    ?>
 </table>