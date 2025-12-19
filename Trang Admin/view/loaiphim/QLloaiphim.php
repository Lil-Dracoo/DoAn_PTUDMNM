<?php
include "./view/home/sideheader.php";
?>

<div class="content-body">

    <div class="row justify-content-between align-items-center mb-10">

        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Quản Lý Loại Phim</h3>
            </div>
        </div></div><div class="row mbn-30">

        <div class="col-12 mb-30">
            <div class="news-item">
                <div class="content">
                    <div class="categories"><a href="index.php?act=themloai" class="product">Thêm Loại Phim</a></div>
                </div>
            </div>

            <?php if(isset($error) && ($error) != ""){ ?>
                <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin-bottom: 15px; text-align: center; border-radius: 5px;">
                    ⚠️ <?php echo $error; ?>
                </div>
            <?php } ?>
            <?php if(isset($suatc) && ($suatc)!= ""){
                // Mình đổi màu thành xanh lá (green) để phân biệt với lỗi nhé
                echo '<p style="color: green; font-weight: bold; text-align: center; margin-bottom: 15px;">✅ ' .$suatc. '</p>';
            } ?> 

            <div class="table-responsive">
                <table class="table table-bordered mb-0">

                    <thead>
                    <tr>
                        <th>Mã Loại Phim</th>
                        <th>Tên Loại</th>
                        <th>Quản Lý</th>
                    </tr>
                    </thead><tbody>
                        <?php foreach ($loadloai as $loai){
                            extract($loai);
                            $linksua = "index.php?act=sualoai&idsua=".$id;
                            $linkxoa = "index.php?act=xoaloai&idxoa=".$id;
                            echo '<tr>
                            <td>#'.$id.'</td>
                            <td>'.$name.'</td>
                            <td>
                                <div class="table-action-buttons">
                                    <a class="edit button button-box button-xs button-info" href="'.$linksua.'"><i class="zmdi zmdi-edit"></i></a>
                                    <a class="delete button button-box button-xs button-danger" href="'.$linkxoa.'" onclick="return confirm(\'Bạn có chắc chắn muốn xóa loại này không?\')"><i class="zmdi zmdi-delete"></i></a>
                                </div>
                            </td>
                            </tr>';
                        } ?>
                    </tbody></table>
            </div>
        </div></div>
    </div>

</div>