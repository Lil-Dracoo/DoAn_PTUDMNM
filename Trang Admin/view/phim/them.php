<?php include "./view/home/sideheader.php"; ?>

<div class="content-body">

    <div class="row justify-content-between align-items-center mb-10">
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Phim <span>/ Thêm Phim</span></h3>
            </div>
        </div>
    </div>

    <?php if(isset($suatc) && ($suatc) != ""){
        echo '<p style="color: green; text-align: center; font-weight: bold;">' .$suatc. '</p>';
    } ?> 

    <form action="index.php?act=themphim" method="post" enctype="multipart/form-data">
        <div class="add-edit-product-wrap col-12">
            <div class="add-edit-product-form">
                <h4 class="title">Thêm phim mới</h4>
                <div class="row">
                    
                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Tên Phim</span><br>
                        <input class="form-control" type="text" placeholder="Nhập tên phim..." name="tieu_de">
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Đạo Diễn</span><br>
                        <input class="form-control" type="text" placeholder="Nhập tên đạo diễn..." name="daodien">
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Diễn Viên</span><br>
                        <input class="form-control" type="text" placeholder="Nhập tên diễn viên..." name="dienvien">
                    </div>
                    
                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Quốc Gia</span><br>
                        <input class="form-control" type="text" placeholder="Nhập quốc gia..." name="quoc_gia">
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Giới Hạn Tuổi</span><br>
                        <input class="form-control" type="number" placeholder="Nhập tuổi giới hạn (VD: 18)..." name="gia_han_tuoi">
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Ngày Phát Hành</span><br>
                        <input class="form-control" type="date" name="date">
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Thời Lượng (Phút)</span><br>
                        <input class="form-control" type="number" placeholder="Nhập thời lượng..." name="thoiluong">
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Hình Ảnh Poster</span><br>
                        <input class="form-control" type="file" name="anh">
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Thể Loại Phim</span><br>
                        <select name="id_loai" class="form-control">
                            <option value="">-- Chọn Thể Loại --</option>
                            <?php foreach ($loadloai as $loai){
                                extract($loai);
                                // SỬA LỖI Ở ĐÂY: Dùng nháy đơn bao chuỗi HTML, biến PHP nối vào giữa
                                echo '<option value="'.$id.'">'.$name.'</option>';
                            } ?>
                        </select>
                    </div>

                    <div class="col-lg-6 col-12 mb-30">
                        <span class="title">Link Trailer</span><br>
                        <input class="form-control" type="text" placeholder="Nhập link Youtube..." name="link">
                    </div>

                    <div class="col-lg-12 col-12 mb-30">
                        <span class="title">Mô Tả Phim</span><br>
                        <textarea class="form-control" rows="5" placeholder="Nhập nội dung mô tả phim..." name="mo_ta"></textarea>
                    </div>

                </div>

                <h4 class="title">Thao tác</h4>
                <div class="product-upload-gallery row flex-wrap">
                    <div class="row">
                        <div class="d-flex flex-wrap justify-content-end col mbn-10">
                            <button class="button button-outline button-primary mb-10 ml-10 mr-0" type="submit" name="gui">Thêm Mới</button>
                            <a href="index.php?act=QLphim" class="button button-outline button-info mb-10 ml-10 mr-0">Danh sách</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if(isset($error) && $error != ""){
                echo '<p style="color: red; text-align: center;"> '.$error.' </p>';
            } ?>
        </div>
    </form>
</div>```