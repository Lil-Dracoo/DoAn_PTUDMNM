<?php
include "./view/home/sideheader.php";
if (is_array($loadone_phim)) {
    extract($loadone_phim);
}
// Xử lý hiển thị ảnh preview
$hinhpath = "assets/imgavt/" . $img;
$hinh_tag = (is_file($hinhpath)) ? "<img src='$hinhpath' height='100' style='margin-top:10px; border-radius:5px;'>" : "No Img";
?>

<div class="content-body">
    <div class="page-heading mb-20">
        <h3>Phim <span>/ Sửa Phim</span></h3>
    </div>

    <form action="index.php?act=updatephim" method="POST" enctype="multipart/form-data">
        <div class="add-edit-product-wrap col-12">
            <div class="add-edit-product-form">
                <h4 class="title">Thông tin phim</h4>
                <div class="row">
                    
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="hinh_cu" value="<?= $img ?>">

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Tên Phim</span><br>
                        <input class="form-control" type="text" name="tieu_de" value="<?= $tieu_de ?>">
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Đạo Diễn</span><br>
                        <input class="form-control" type="text" name="daodien" value="<?= $daodien ?>">
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Diễn Viên</span><br>
                        <input class="form-control" type="text" name="dienvien" value="<?= $dienvien ?>">
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Quốc Gia</span><br>
                        <input class="form-control" type="text" name="quoc_gia" value="<?= $quoc_gia ?>">
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Giới Hạn tuổi</span><br>
                        <input class="form-control" type="number" name="gia_han_tuoi" value="<?= $gia_han_tuoi ?>">
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Ngày Phát Hành</span><br>
                        <input class="form-control" type="date" name="date" 
                               value="<?= ($date_phat_hanh != '0000-00-00') ? $date_phat_hanh : '' ?>">
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Thời lượng (phút)</span><br>
                        <input class="form-control" type="text" name="thoiluong" value="<?= $thoi_luong_phim ?>">
                    </div>

                    <div class="col-lg-6 col-12 mb-10">
                        <span class="title">Danh Mục Phim</span><br>
                        <select name="id_loai" class="form-control">
                            <?php 
                            foreach ($loadloai as $loai) {
                                $selected = ($loai['id'] == $id_loai) ? "selected" : "";
                                echo '<option value="' . $loai['id'] . '" ' . $selected . '>' . $loai['name'] . '</option>';
                            } 
                            ?>
                        </select>
                    </div>

                    <div class="col-lg-12 col-12 mb-30">
                        <span class="title">Mô tả</span><br>
                        <textarea class="form-control" name="mo_ta" rows="5"><?= $mo_ta ?></textarea>
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Hình Ảnh</span><br>
                        <input class="form-control" type="file" name="anh">
                        <?= $hinh_tag ?>
                    </div>
                </div>

                <div class="row mt-20">
                    <div class="col-12 d-flex justify-content-end">
                        <button class="button button-primary mr-10" type="submit" name="capnhat">Cập Nhật</button>
                        <a href="index.php?act=QLphim" class="button button-info">Danh sách</a>
                    </div>
                </div>
            </div>
            
            <?php if(isset($error) && $error != "") echo '<p style="color:red; text-align:center; margin-top:10px;">'.$error.'</p>'; ?>
        </div>
    </form>
</div>