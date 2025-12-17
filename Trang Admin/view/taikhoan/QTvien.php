<?php
include "./view/home/sideheader.php";
?>

<div class="content-body">

    <div class="row justify-content-between align-items-center mb-10">
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Quản Lý Tài Khoản <span>/ Nhân Viên</span></h3>
            </div>
        </div>
        <div class="col-12 col-lg-auto mb-20">
            <a href="index.php?act=themuser" class="button button-primary button-outline">
                <i class="zmdi zmdi-account-add"></i> Thêm Nhân Viên Mới
            </a>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
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
                    
                    <h4 class="card-title mb-20">Danh sách nhân sự</h4>

                    <div class="table-responsive">
                        <table class="table table-hover table-vertical-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Thông tin cá nhân</th>
                                    <th>Tài khoản</th> 
                                    <th>Địa chỉ</th>
                                    <th class="text-center">Vai Trò</th>
                                    <th class="text-right">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($loadalltk as $kh): 
                                    extract($kh);
                                    $linksua = "index.php?act=suatk&idsua=" . $id;
                                    
                                    // --- SỬA DÒNG NÀY ---
                                    // Thêm &vai_tro=1 để Controller biết sau khi xóa xong thì quay về trang Nhân viên
                                    $linkxoa = "index.php?act=xoatk&idxoa=" . $id . "&vai_tro=1";
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
                                        <?php if ($vai_tro == '1'): ?>
                                            <span class="badge badge-danger px-2 py-1">Nhân Viên</span>
                                        <?php elseif ($vai_tro == '2'): ?>
                                            <span class="badge badge-primary px-2 py-1">Quản Trị Viên (Admin)</span>
                                        <?php else: ?>
                                            <span class="badge badge-success px-2 py-1">Khách Hàng</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-right">
                                        <div class="table-action-buttons">
                                            <a class="button button-box button-xs button-info" href="<?= $linksua ?>" title="Sửa thông tin">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            
                                            <?php if($vai_tro != '2'): ?>
                                                <a class="button button-box button-xs button-danger" href="<?= $linkxoa ?>" title="Xóa nhân viên" onclick="return confirm('Cảnh báo: Bạn có chắc chắn muốn xóa nhân viên <?= $name ?>?');">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </a>
                                            <?php else: ?>
                                                <button class="button button-box button-xs button-secondary" disabled title="Không thể xóa tài khoản Quản trị cấp cao">
                                                    <i class="zmdi zmdi-lock"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach ?>

                                <?php if(empty($loadalltk)): ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5">
                                            Chưa có nhân viên nào trong danh sách.
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