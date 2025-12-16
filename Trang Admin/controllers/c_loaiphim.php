<?php
switch ($act) {
    case "QLloaiphim":
        include "./view/loaiphim/QLloaiphim.php";
        break;
    case "themloai":
        if (isset($_POST['gui'])) {
            if (!isset($_POST['name']) || empty($_POST['name'])) {
                $error = "Tên thể loại không được để trống";
            }
            if (!isset($error)) {
                $name = $_POST['name'];
                them_loaiphim($name);
                $suatc = "THÊM THÀNH CÔNG";
            }
        }
        include "./view/loaiphim/them.php";
        break;
    case "xoaloai":
    if (isset($_GET['idxoa']) && ($_GET['idxoa'] > 0)) {
        $id = $_GET['idxoa'];

        // 1. Gọi hàm đếm số lượng phim đang có
        $so_luong_phim = check_so_luong_phim_trong_loai($id);

        // 2. Logic kiểm tra
        if ($so_luong_phim > 0) {
            // Nếu > 0 tức là còn phim -> Báo lỗi và KHÔNG thực hiện lệnh xóa
            $error = "Không thể xóa! Loại này đang chứa " . $so_luong_phim . " phim.";
        } else {
            // Nếu = 0 tức là loại rỗng -> Cho phép xóa
            xoa_loaiphim($id);
            $suatc = "XÓA THÀNH CÔNG";
        }
    }
    
    // Load lại danh sách
    $loadloai = loadall_loaiphim();
    include "./view/loaiphim/QLloaiphim.php";
    break;
    case "sualoai":
        if (isset($_GET['idsua'])) {
            $loadone_loai = loadone_loaiphim($_GET['idsua']);
        }
        include "./view/loaiphim/sua.php";
        break;
    case "updateloai":
        if (isset($_POST['capnhat'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            if ($name == '') {
                $error = "vui lòng điền đầy đủ thông tin";
                $loadone_loai = loadone_loaiphim($id);
                include "./view/loaiphim/sua.php";
            } else {
                update_loaiphim($id, $name);
                $suatc = "SỬA THÀNH CÔNG";
                $loadloai = loadall_loaiphim();
                include "./view/loaiphim/QLloaiphim.php";
            }
        } else {
            $loadloai = loadall_loaiphim();
            include "./view/loaiphim/QLloaiphim.php";
        }
        break;
}
?>