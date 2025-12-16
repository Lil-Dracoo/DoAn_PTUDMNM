<?php
switch ($act) {
    case "QLsuatchieu":
        $loadlich = loadall_lichchieu();
        include "./view/suatchieu/lichchieu/QLsuatchieu.php";
        break;
    case "thoigian":
        $loadkgc = loadall_khunggiochieu();
        include "./view/suatchieu/khunggio/thoigian.php";
        break;
    case "themlichchieu":
        $loadphim = loadall_phim();
        if (isset($_POST['them'])) {
            $id_phim   = $_POST['id_phim'];
            $ngay_chieu = $_POST['nc'];
            if ($id_phim == '' || $ngay_chieu == '' ) {
                $error = "Vui lòng không để trống";
            } 
            else {
                them_lichchieu($id_phim, $ngay_chieu);
                $suatc = "Thêm thành công";
            }
        }
        include "./view/suatchieu/lichchieu/them.php";
        break;
    case "sualichchieu":
        if (isset($_GET['idsua'])) {
            $loadone_lc = loadone_lichchieu($_GET['idsua']);
        }
        include "./view/suatchieu/lichchieu/sua.php";
        break;
    case "updatelichchieu":
        $loadphim = loadall_phim();
        $loadphong = load_phong();
        if (isset($_POST['capnhat'])) {
            $id = $_POST['id'];
            $id_phim = $_POST['id_phim'];
            $ngay_chieu = $_POST['nc'];
            if ($id == '' || $id_phim == '' || $ngay_chieu == '') {
                $error = "vui lòng không để trống";
                $loadone_lc = loadone_lichchieu($id);
                include "./view/suatchieu/lichchieu/sua.php";
            } else {
                sua_lichchieu($id, $id_phim,  $ngay_chieu);
                $suatc = "SỬA THÀNH CÔNG";
                $loadlich = loadall_lichchieu();
                include "./view/suatchieu/lichchieu/QLsuatchieu.php";
            }
        } else {
            $loadlich = loadall_lichchieu();
            include "./view/suatchieu/lichchieu/QLsuatchieu.php";
        }
        break;

    case "xoalichchieu":
        if (isset($_GET['idxoa']) && ($_GET['idxoa'] > 0)) {
            $id = (int)$_GET['idxoa'];
            $so_suatchieu = check_lichchieu_co_suatchieu($id);
                if ($so_suatchieu > 0) {
                    $thongbao = "Không thể xóa lịch chiếu vì đã tồn tại suất chiếu!";
                } 
                else {
                    xoa_lc($id);
                    $thongbao = "Xóa lịch chiếu thành công!";
                }
        }
        $loadlich = loadall_lichchieu();
        include "./view/suatchieu/lichchieu/QLsuatchieu.php";
        break;
    case "updatethoigian":
        $loadlc = loadall_lichchieu();
        $loadphong = load_phong();
        if (isset($_POST['capnhat'])) {
            $id = $_POST['id'];
            $id_lc = $_POST['id_lc'];
            $id_phong = $_POST['id_phong'];
            $thoi_gian_chieu = $_POST['tgc'];
            sua_kgc($id, $id_lc, $id_phong, $thoi_gian_chieu);
        }
        $loadkgc = loadall_khunggiochieu();
        include "./view/suatchieu/khunggio/thoigian.php";
        break;

    case "themthoigian":
        $loadlc = loadall_lichchieu();
        $loadphong = load_phong();
        if (isset($_POST['them'])) {
            $id_lc = $_POST['id_lc'];
            $id_phong = $_POST['id_phong'];
            $thoi_gian_chieu = $_POST['tgc'];
            if ($id_lc == '' || $id_phong == '' || $thoi_gian_chieu == '') {
                $error = "Vui lòng không để trống";
            } 
            else {
                $is_trung = check_trung_lich($id_lc, $id_phong, $thoi_gian_chieu);
                if ($is_trung > 0) {
                    $error = "Lỗi: Phòng này đã có lịch chiếu vào khung giờ và ngày đã chọn!";
                } 
                else {
                    them_kgc($id_lc, $id_phong, $thoi_gian_chieu);
                    $suatc = "Thêm thành công";
                }
            }
        }
        $loadkgc = loadall_khunggiochieu();
        include "./view/suatchieu/khunggio/them.php";
        break;

    case "suathoigian":
        $loadlich = loadall_lichchieu();
        $loadphong = load_phong();
        if (isset($_GET['id']) && $_GET['id'] !== '') {
            $kg = loadone_khung_gio_chieu((int)$_GET['id']);
        } else {
            $kg = null;
        }
        include "./view/suatchieu/khunggio/sua.php";
        break;

    case "xoathoigian":
        if (isset($_GET['idxoa']) && ($_GET['idxoa'] > 0)) {
            xoa_kgc($_GET['idxoa']);
        }
        $loadkgc = loadall_khunggiochieu();
        include "./view/suatchieu/khunggio/thoigian.php";
        break;
}
?>