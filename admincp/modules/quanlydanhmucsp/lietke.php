<?php
    $sql_lietke="SELECT * FROM tbl_danhmuc ORDER BY thutu DESC";
    $result_lietke= mysqli_query($connect,$sql_lietke);
?>
<p>Liệt kê danh mục sản phẩm</p>
 <table style="width: 100%;" border="1" style="border-collapse:collapse;"> 
     <tr>
         <td>ID</td>
         <td>Tên danh mục</td>
         <td>Thứ tự</td>
     </tr>
     <?php
    $i=0;
    while($row=mysqli_fetch_array($result_lietke)){
        $i++;
    
     ?>
     <tr>
         <td><?php echo $i ?></td>
         <td><?php echo $row['tendanhmuc'] ?></td>
         <td><?php echo $row['thutu']?></td>
         <td>
            <a href="modules/quanlydanhmucsp/xuly.php?iddanhmuc=<?php echo $row['id_danhmuc']?>">Xóa</a>|
             <a href="?action=quanlydanhmucsanpham&query=sua&iddanhmuc=<?php echo $row['id_danhmuc']?>">Sửa</a>
         </td>
     </tr>

     <?php
    }
    ?>
 </table>