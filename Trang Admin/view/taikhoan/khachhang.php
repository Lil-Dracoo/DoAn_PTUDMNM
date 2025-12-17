<?php
include "./view/home/sideheader.php";

// 1. LẤY VAI TRÒ CỦA NGƯỜI ĐANG ĐĂNG NHẬP
// Giả sử bạn lưu thông tin đăng nhập trong $_SESSION['user']
// Nếu chưa đăng nhập thì mặc định là 0 (Khách)
$role_hien_tai = isset($_SESSION['user1']['vai_tro']) ? $_SESSION['user1']['vai_tro'] : 0;
?>

<div class="content-body">

    <div class="row justify-content-between align-items-center mb-10">
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Quản Lý Tài Khoản <span>/ Danh sách khách hàng</span></h3>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <?php if (isset($error) && $error != ""): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="zmdi zmdi-block"></i> <?= $error ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (isset($suatc) && $suatc != ""): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="zmdi zmdi-check-circle"></i> <?= $suatc ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-30">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex justify-content-between align-items-center mb-20">
                        <h4 class="card-title m-0">Danh sách người dùng</h4>
                        
                        <?php if($role_hien_tai == 1): ?>
                            <span class="badge badge-warning"><i class="zmdi zmdi-lock"></i> Nhân viên: Chỉ xem</span>
                        <?php endif; ?>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-vertical-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Thông tin cá nhân</th>
                                    <th>Tài khoản</th> 
                                    <th>Địa chỉ</th>
                                    <th class="text-center">Vai Trò</th>
                                    <th class="text-center">Vé đã mua</th> 
                                    <th class="text-right">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($loadall_kh1 as $kh): 
                                    extract($kh);
                                    $linksua = "index.php?act=suatk&idsua=" . $id;
                                    $linkxoa = "index.php?act=xoatk&idxoa=" . $id . "&vai_tro=0";
                                    $so_luong_ve = isset($so_ve) ? $so_ve : '0';
                                ?>
                                <tr>
                                    <td><strong>#<?= $id ?></strong></td>
                                    
                                    <td>
                                        <h6 class="mb-1 text-primary"><?= $name ?></h6>
                                        <div class="d-flex flex-column">
                                            <small class="text-muted mb-1">
                                                <i class="zmdi zmdi-phone mr-1"></i> <?= $phone ?>
                                            </small>
                                            <small class="text-muted">
                                                <i class="zmdi zmdi-email mr-1"></i> <?= $email ?>
                                            </small>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <span class="badge badge-light" style="font-size: 100%;">
                                            <i class="zmdi zmdi-account"></i> <?= $user ?>
                                        </span>
                                    </td>

                                    <td><?= $dia_chi ?></td>

                                    <td class="text-center">
                                        <span class="badge badge-success px-2 py-1">Khách Hàng</span>
                                    </td>

                                    <td class="text-center">
                                        <?php if($so_luong_ve > 0): ?>
                                            <span class="badge badge-warning badge-pill"><?= $so_luong_ve ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary badge-pill">0</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-right">
                                        <div class="table-action-buttons">
                                            <?php 
                                            // 2. LOGIC PHÂN QUYỀN: 
                                            // Chỉ hiển thị nút nếu là Admin (vai_tro == 2)
                                            if ($role_hien_tai == 2): 
                                            ?>
                                                <a class="button button-box button-xs button-info" href="<?= $linksua ?>" title="Sửa">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </a>
                                                <a class="button button-box button-xs button-danger" href="<?= $linkxoa ?>" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa khách hàng <?= $name ?> không?');">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>

                                            <?php else: ?>
                                                <button class="button button-box button-xs button-secondary" disabled title="Bạn không có quyền thao tác">
                                                    <i class="zmdi zmdi-lock"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                                
                                <?php if(empty($loadall_kh1)): ?>
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            Không có dữ liệu khách hàng.
                                        </td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>