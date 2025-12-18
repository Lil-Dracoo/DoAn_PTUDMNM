<?php
switch ($act) {
    case "ve":
        if (isset($_POST['tk']) && ($_POST['tk'])) {
            $searchName = $_POST['ten'];
            $searchTieuDe = $_POST['tieude'];
            $searchid = $_POST['id_ve'];
        } else {
            $searchName = "";
            $searchTieuDe = "";
            $searchid = "";
        }
        $loadvephim = loadall_vephim1($searchName, $searchTieuDe, $searchid);
        include "./view/vephim/ve.php";
        break;

    case "suavephim":
        if (isset($_GET['idsua'])) {
            $loadve = loadone_vephim($_GET['idsua']);
        }
        include "./view/vephim/sua.php";
        break;

    case "updatevephim":
    if (isset($_POST['capnhat'])) {
        $id = $_POST['id'];
        $trangThaiMoi = $_POST['trang_thai'];
        // Lấy trạng thái cũ + ngày chiếu từ DB
        $loadve = loadone_vephim($id);
        $trangThaiCu = $loadve['trang_thai'];
        $ngayChieu = strtotime($loadve['ngay_chieu']);
        $homNay = strtotime(date('Y-m-d'));
        $thongBao = "";
        // 1. Kiểm tra trạng thái đóng (Đã dùng hoặc Đã hủy thì không cho làm gì nữa)
        if ($trangThaiCu == 2) {
            $thongBao = "Vé đã sử dụng, không thể chỉnh sửa.";
        } 
        elseif ($trangThaiCu == 3) {
            $thongBao = "Vé đã bị hủy, không thể chỉnh sửa.";
        } 
        // 2. Kiểm tra trùng trạng thái
        elseif ($trangThaiCu == $trangThaiMoi) {
            $thongBao = "Trạng thái mới không được trùng với trạng thái cũ.";
        }
        // 3. Kiểm tra các ràng buộc logic khác
            else {
                // Đang chờ (0) muốn đổi sang trạng thái khác (giả sử 2 là dùng) mà chưa thanh toán
                if ($trangThaiCu == 0 && $trangThaiMoi == 2) {
                    $thongBao = "Vé chưa thanh toán, không thể chuyển sang Đã dùng.";
                }
                // Muốn đổi sang Đã dùng (2) nhưng chưa tới giờ chiếu
                if ($trangThaiMoi == 2 && $homNay < $ngayChieu) {
                    $thongBao = "Chưa đến giờ chiếu phim, không thể dùng vé.";
                }
                // Đã thanh toán (1) không cho phép hủy (3) - Tùy chính sách của bạn
                if ($trangThaiCu == 1 && $trangThaiMoi == 3) {
                    $thongBao = "Vé đã thanh toán thành công, không được phép hủy.";
                }
            }
        }

        // Có lỗi → quay lại trang sửa
        if ($thongBao != "") {
            include "./view/vephim/sua.php";
            break;
        }

        //  Hợp lệ → cập nhật
        update_vephim($id, $trangThaiMoi);
    }

    // Load lại danh sách vé
    if (isset($_POST['tk']) && ($_POST['tk'])) {
        $searchName = $_POST['ten'];
        $searchTieuDe = $_POST['tieude'];
        $searchid = $_POST['id_ve'];
    } else {
        $searchName = "";
        $searchTieuDe = "";
        $searchid = "";
    }

    $loadvephim = loadall_vephim1($searchName, $searchTieuDe, $searchid);
    include "./view/vephim/ve.php";
    break;


    case "chitiethoadon":
        include "./view/vephim/chitiethoadon.php";
        break;

    case "ctve":
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            $loadone_ve =  loadone_vephim($_GET['id']);
        }
        include "view/vephim/ct_ve.php";
        break;

    case "capnhat_tt_ve":
        capnhat_tt_ve();

    if (isset($_POST['tk']) && ($_POST['tk'])) {
        $searchName = $_POST['ten'];
        $searchTieuDe = $_POST['tieude'];
    } else {
        $searchName = "";
        $searchTieuDe = "";
    }

    $searchid = "";
    $loadvephim = loadall_vephim1($searchName, $searchTieuDe, $searchid);

    include "./view/vephim/ve.php";
    break;
}
?>