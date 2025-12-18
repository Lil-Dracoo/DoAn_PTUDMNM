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
        // 1. Vé đã dùng
        if ($trangThaiCu == 2 && $trangThaiMoi != $trangThaiCu) {
            $thongBao = "Vé đã dùng, không thể thay đổi trạng thái";
        }
        // 2. Vé đã hủy
        if ($trangThaiCu == 3 && $trangThaiMoi != $trangThaiCu) {
            $thongBao = "Vé đã hủy, không thể thay đổi trạng thái";
        }
        // 3. Đang chờ → Đã dùng
        if ($trangThaiCu == 0 && $trangThaiMoi == 2) {
            $thongBao = "Vé chưa được thanh toán";
        }
        // 4. Chưa tới ngày chiếu → Đã dùng
        if ($trangThaiMoi == 2 && $homNay < $ngayChieu) {
            $thongBao = "Chưa đến thời gian sử dụng vé";
        }
        // 5. Đã thanh toán → Hủy
        if ($trangThaiCu == 1 && $trangThaiMoi == 3) {
            $thongBao = "Vé đã thanh toán, không hủy được";
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