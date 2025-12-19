<?php
include "./view/home/sideheader.php";
if (is_array($loadtk)) {
    extract($loadtk);
}
?>

<div class="content-body">

    <div class="row justify-content-between align-items-center mb-10">
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Quản Lý Tài Khoản <span>/ Cập nhật thông tin</span></h3>
            </div>
        </div>
    </div>
    
    <?php if(isset($error) && $error != ""): ?>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-triangle"></i> <?= $error ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <form action="index.php?act=updateuser" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        
                        <h4 class="card-title text-primary mb-30">Thông tin người dùng</h4>
                        
                        <input type="hidden" name="id" value="<?=$id?>">
                        <input type="hidden" name="vai_tro" value="<?=$vai_tro?>"> 

                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-30">
                                    <label for="user" class="font-weight-bold">Tên đăng nhập (Username)</label>
                                    
                                    <input id="user" class="form-control" type="text" value="<?=$user?>" name="user" readonly style="background-color: #e9ecef; cursor: not-allowed;">
                                    
                                    <small class="text-muted">Tên đăng nhập không được phép thay đổi.</small>
                                </div>

                                <div class="form-group mb-30">
                                    <label for="pass" class="font-weight-bold">Mật khẩu</label>
                                    <input id="pass" class="form-control" type="text" value="<?=$pass?>" name="pass" required>
                                    <small class="text-danger"><i class="fa fa-info-circle"></i> Hãy cẩn thận khi thay đổi mật khẩu.</small>
                                </div>
                                
                                <div class="form-group mb-30">
                                    <label for="name" class="font-weight-bold">Họ và Tên hiển thị</label>
                                    <input id="name" class="form-control" type="text" value="<?=$name?>" name="name">
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-30">
                                    <label for="email" class="font-weight-bold">Email</label>
                                    <input id="email" class="form-control" type="email" value="<?=$email?>" name="email">
                                </div>

                                <div class="form-group mb-30">
                                    <label for="phone" class="font-weight-bold">Số điện thoại</label>
                                    <input id="phone" class="form-control" type="text" value="<?=$phone?>" name="phone">
                                </div>

                                <div class="form-group mb-30">
                                    <label for="address" class="font-weight-bold">Địa chỉ</label>
                                    <input id="address" class="form-control" type="text" value="<?=$dia_chi?>" name="dia_chi">
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h4 class="title mt-20">Thao tác</h4>
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex flex-wrap justify-content-start">
                                    <button class="button button-outline button-primary mb-10 mr-10" type="submit" name="capnhat">
                                        <i class="fa fa-save"></i> Cập Nhật
                                    </button>
                                    
                                    <button type="button" onclick="history.back()" class="button button-outline button-secondary mb-10">
                                        <i class="fa fa-arrow-left"></i> Quay lại
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>