<?php
include "./view/home/sideheader.php";
?>

<div class="content-body">
    <div class="row justify-content-between align-items-center mb-10">
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Quản Lý Nhân Sự <span>/ Thêm Nhân Viên Mới</span></h3>
            </div>
        </div>
    </div>

    <?php if(isset($suatc) && ($suatc) != ""): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle"></i> <?= $suatc ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    <?php endif; ?>

    <?php if(isset($error) && $error != ""): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-triangle"></i> <?= $error ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    <?php endif; ?>

    <form action="index.php?act=themuser" method="POST">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="d-flex justify-content-between align-items-center mb-30">
                            <h4 class="card-title text-primary m-0">Thông tin nhân viên</h4>
                            <small class="text-danger font-italic">(* Các trường bắt buộc phải nhập)</small>
                        </div>

                        <input type="hidden" name="vai_tro" value="1">

                        <div class="row">
                            <div class="col-lg-6 col-12 border-right-lg">
                                <h5 class="sub-title text-dark font-weight-bold">1. Tài khoản cấp phát</h5>
                                
                                <div class="form-group mb-20">
                                    <label for="user" class="font-weight-bold">Tên đăng nhập <span class="text-danger">*</span></label>
                                    <input id="user" class="form-control" type="text" placeholder="Ví dụ: nv_banve01" name="user" required>
                                </div>

                                <div class="form-group mb-20">
                                    <label for="pass" class="font-weight-bold">Mật khẩu <span class="text-danger">*</span></label>
                                    <input id="pass" class="form-control" type="password" placeholder="Nhập mật khẩu..." name="pass" required>
                                </div>
                                
                                <div class="alert alert-info mt-30">
                                    <i class="fa fa-info-circle"></i> Tài khoản này sẽ dùng để truy cập hệ thống quản trị.
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <h5 class="sub-title text-dark font-weight-bold">2. Hồ sơ nhân viên</h5>

                                <div class="form-group mb-20">
                                    <label for="name" class="font-weight-bold">Họ và Tên <span class="text-danger">*</span></label>
                                    <input id="name" class="form-control" type="text" placeholder="Nhập họ tên nhân viên..." name="name" required>
                                </div>

                                <div class="form-group mb-20">
                                    <label for="email" class="font-weight-bold">Email <span class="text-danger">*</span></label>
                                    <input id="email" class="form-control" type="email" 
                                        placeholder="email@rapchieuphim.com" name="email" required 
                                        title="Vui lòng nhập đúng định dạng email">
                                </div>

                                <div class="form-group mb-20">
                                    <label for="phone" class="font-weight-bold">Số điện thoại <span class="text-danger">*</span></label>
                                    <input id="phone" class="form-control" type="text" 
                                    placeholder="Nhập số điện thoại (10 số)..." name="phone" required 
                                    pattern="(03|05|07|08|09)+([0-9]{8})"
                                    title="Số điện thoại phải bắt đầu bằng 03, 05, 07, 08, 09 và có 10 chữ số">
                                </div>

                                <div class="form-group mb-20">
                                    <label for="address" class="font-weight-bold">Địa chỉ <span class="text-danger">*</span></label>
                                    <input id="address" class="form-control" type="text" placeholder="Nhập địa chỉ thường trú..." name="dia_chi" required>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-20 mb-20">

                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex flex-wrap justify-content-start">
                                    <button class="button button-outline button-primary mb-10 mr-10" type="submit" name="them">
                                        <i class="fa fa-user-plus"></i> Tạo nhân viên
                                    </button>
                                    
                                    <a href="index.php?act=QTvien" class="button button-outline button-secondary mb-10">
                                        <i class="fa fa-arrow-left"></i> Quay lại
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
</div>