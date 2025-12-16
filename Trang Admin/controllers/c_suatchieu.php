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
}
?>