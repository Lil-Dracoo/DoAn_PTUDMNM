<?php
include "./view/home/sideheader.php";
$tong = !empty($dtt1) ? count($dtt1) : 0;
$trang = ($tong > 0) ? ceil($tong/5) : 1;
?>

<!-- Content Body Start -->
<div class="content-body">

    <!-- Page Headings Start -->
    <div class="row justify-content-between align-items-center mb-10">

        <!-- Page Heading Start -->
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3 class="title">Theo Dõi Danh Thu <span>/ Danh Thu Theo Ngày</span></h3>
            </div>
        </div><!-- Page Heading End -->

    </div><!-- Page Headings End -->

    <div class="row">

        <!--Default Data Table Start-->
        <div class="col-12 mb-30">
            <div class="box">
                <div class="box-body">
                    <table class="table table-bordered data-table data-table-default">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Phim</th>
                            <th>Thể loại</th>
                            <th>Ngày</th>
                            <th>Số lượng vé đặt</th>
                            <th>Doanh thu</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($dtt as $list){
                            extract($list);

                            if ($so_luong_ve_dat > 0) {
                                echo '<tr>
                                         <td>'.$id.'</td>
                                         <td>'.$tieu_de.'</td>
                                         <td>'.$ten_loaiphim.'</td>
                                         <td>'.$ngay.'</td>
                                         <td>'.$so_luong_ve_dat.'</td>
                                         <td>'.$sum_thanhtien.'</td>
                                         </tr>';
                            }
                        } ?>


                        </tbody>
                    </table>
                    <?php if ($trang > 1): ?>
                    <ul class="pagination">
                        <?php 
                        $current_page = isset($_GET['trang']) ? (int)$_GET['trang'] : 1;
                        for($i=1 ; $i<=$trang ; $i++):
                            if($current_page == $i){
                                echo'<li class="page-item active" >
                                <a class="page-link" href="index.php?act=DTngay&&trang='.$i.'">'.$i.'</a>
                                </li>';
                            }else{
                                echo' <li class="page-item"><a class="page-link" href="index.php?act=DTngay&&trang='.$i.'">'.$i.'</a></li>';
                            }
                        endfor;
                        ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div><!-- Content Body End -->



