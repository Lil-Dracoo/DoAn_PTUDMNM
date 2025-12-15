<?php
include "./view/home/sideheader.php";
if (is_array($loadve)) {
    extract($loadve);
}
?>

<div class="content-body">
    <div class="row justify-content-between align-items-center mb-10">
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3> Quản Trị Vé Xem Phim<span>/ Chi Tiết Vé</span></h3>
            </div>
        </div>
    </div>

    <div class="add-edit-product-wrap col-12">
        <div class="add-edit-product-form">
            <div class="row">
                <div class="col-lg-6 col-12 mb-30">
                    <label>Tên phim</label>
                    <input class="form-control" type="text" value="<?=$tieu_de?>" disabled>
                </div>
                <div class="col-lg-6 col-12 mb-30">
                    <label>Giá vé</label>
                    <input class="form-control" type="text" value="<?=number_format($price)?> VNĐ" disabled>
                </div>
                <div class="col-lg-6 col-12 mb-30">
                    <label>Ngày chiếu</label>
                    <input class="form-control" type="text" value="<?=$ngay_chieu?>" disabled>
                </div>
                <div class="col-lg-6 col-12 mb-30">
                    <label>Số ghế</label>
                    <input class="form-control" type="text" value="<?=$ghe?>" disabled>
                </div>
                <div class="col-lg-6 col-12 mb-30">
                    <label>Khách hàng</label>
                    <input class="form-control" type="text" value="<?=$name?>" disabled>
                </div>
                <div class="col-lg-6 col-12 mb-30">
                    <label>Trạng thái hiện tại</label>
                    <select class="form-control" name="trang_thai" disabled>
                        <option value="0" <?= ($trang_thai == 0) ? 'selected' : '' ?>>Đang chờ</option>
                        <option value="1" <?= ($trang_thai == 1) ? 'selected' : '' ?>>Xác nhận đã thanh toán</option>
                        <option value="2" <?= ($trang_thai == 2) ? 'selected' : '' ?>>Đã dùng</option>
                        <option value="3" <?= ($trang_thai == 3) ? 'selected' : '' ?>>Hủy</option>
                        <option value="4" <?= ($trang_thai == 4) ? 'selected' : '' ?>>Hết hạn</option>
                    </select>
                </div>
            </div>
        </div>

        <h4 class="title">Thao tác</h4>
        <div class="product-upload-gallery row flex-wrap">
            <div class="row">
                <div class="d-flex flex-wrap justify-content-end col mbn-10">
                    <a href="index.php?act=ve" class="button button-outline button-info mb-10 ml-10 mr-0">Quay lại danh sách</a>
                </div>
            </div>
        </div>
    </div>
</div>