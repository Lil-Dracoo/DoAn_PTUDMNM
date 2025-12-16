<?php
include "./view/home/sideheader.php";
if (is_array($loadphong1)) {
    extract($loadphong1);
}
?>

<div class="content-body">

    <div class="row justify-content-between align-items-center mb-10">
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Quản lý Phòng <span>/ Cập nhật</span></h3>
            </div>
        </div>
        </div>
    <?php if(isset($error) && $error != ""): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-30" role="alert">
            <i class="fa fa-exclamation-triangle"></i> <?= $error ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <form action="index.php?act=updatephong" method="POST">
        <div class="row">
            <div class="col-12">
                <div class="add-edit-product-wrap card">
                    <div class="card-body">
                        <div class="add-edit-product-form">
                            
                            <h4 class="title text-primary">Thông tin phòng chiếu</h4>
                            
                            <input type="hidden" name="id" value="<?= $id ?>">

                            <div class="row">
                                <div class="col-lg-6 col-12 mb-30">
                                    <label for="room_name" class="font-weight-bold">Tên phòng</label>
                                    <input 
                                        id="room_name" 
                                        class="form-control" 
                                        type="text" 
                                        name="name" 
                                        value="<?= $name ?>" 
                                        required
                                    >
                                    <small class="text-muted">Tên hiện tại: <?= $name ?></small>
                                </div>
                            </div>

                            <hr> <h4 class="title">Thao tác</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex flex-wrap justify-content-start">
                                        <button class="button button-outline button-primary mb-10 mr-10" type="submit" name="capnhat">
                                            <i class="fa fa-save"></i> Lưu thay đổi
                                        </button>
                                        
                                        <a href="index.php?act=phong" class="button button-outline button-secondary mb-10">
                                            <i class="fa fa-arrow-left"></i> Hủy bỏ
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>