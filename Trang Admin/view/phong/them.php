<?php
include "./view/home/sideheader.php";
?>

<div class="content-body">

    <div class="row justify-content-between align-items-center mb-10">
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Quản lý Phòng <span>/ Thêm mới</span></h3>
            </div>
        </div>
        </div>
    <div class="row">
        <div class="col-12">
            <?php if (isset($suatc) && $suatc != ""): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle"></i> <?= $suatc ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (isset($error) && $error != ""): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle"></i> <?= $error ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <form action="index.php?act=themphong" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12">
                <div class="add-edit-product-wrap card">
                    <div class="card-body">
                        <div class="add-edit-product-form">
                            
                            <h4 class="title text-primary">Thông tin phòng chiếu</h4>
                            <div class="row">
                                <div class="col-lg-6 col-12 mb-30">
                                    <label for="room_name" class="font-weight-bold">Tên phòng / Số phòng</label>
                                    <input 
                                        id="room_name" 
                                        class="form-control" 
                                        type="text" 
                                        placeholder="Ví dụ: Phòng 01, Phòng IMAX..." 
                                        name="name" 
                                        required
                                    >
                                    <small class="text-muted">Nhập tên hiển thị của phòng chiếu phim.</small>
                                </div>
                            </div>

                            <hr> <h4 class="title">Thao tác</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex flex-wrap justify-content-start">
                                        <button class="button button-outline button-primary mb-10 mr-10" type="submit" name="len">
                                            <i class="fa fa-plus"></i> Thêm mới
                                        </button>
                                        
                                        <a href="index.php?act=phong" class="button button-outline button-secondary mb-10">
                                            <i class="fa fa-arrow-left"></i> Danh sách
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