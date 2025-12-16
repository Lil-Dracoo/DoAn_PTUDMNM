<?php
switch ($act) {
    case "QLphim":
        if (isset($_POST['tk1']) && ($_POST['tk1'])) {
            $searchName1 = $_POST['ten'];
            $searchLoai = $_POST['loai'];
        } else {
            $searchName1 = "";
            $searchLoai = "";
        }
        $loadphim = loadall_phim($searchName1, $searchLoai);
        include "./view/phim/QLphim.php";
        break;
    case "themphim":
        if (isset($_POST['gui'])) {
            $tieu_de = $_POST['tieu_de'];
            $daodien = $_POST['daodien'];
            $dienvien = $_POST['dienvien'];
            $quoc_gia = $_POST['quoc_gia'];
            $gia_han_tuoi = $_POST['gia_han_tuoi'];
            $thoiluong = $_POST['thoiluong'];
            $date = $_POST['date'];
            $link = $_POST['link'];
            $id_loai = $_POST['id_loai'];
            $mo_ta = $_POST['mo_ta'];
            $img = $_FILES['anh']['name'];
            $target_dir = "assets/imgavt/";
            $target_file = $target_dir . basename($_FILES['anh']['name']);
            
            if (move_uploaded_file($_FILES['anh']['tmp_name'], $target_file)) {
                // Upload thành công
            } else {
                // Upload thất bại
            }

            if ($tieu_de == '' || $daodien == '' || $dienvien == '' || $quoc_gia == '' || $gia_han_tuoi == '' || $img == '' || $mo_ta == '' || $thoiluong == '' || $date == '' || $id_loai == '') {
                $error =  "Vui lòng không để trống";
                include "./view/phim/them.php";
            } else {
                them_phim($tieu_de, $daodien, $dienvien, $img, $mo_ta, $thoiluong, $quoc_gia, $gia_han_tuoi, $date, $id_loai, $link);
                $suatc = "Thêm thành công";
                $loadphim = loadall_phim();
                include "./view/phim/them.php";
            }
        } else {
            $loadphim = loadall_phim();
            include "./view/phim/them.php";
        }
        break;

        case "xoaphim":
        if (isset($_GET['idxoa'])) {
            xoa_phim($_GET['idxoa']);
            $loadphim = loadall_phim();
            include "./view/phim/QLphim.php";
        }
        break;
        case "suaphim":
        if (isset($_GET['idsua'])) {
            $loadone_phim = loadone_phim($_GET['idsua']);
        }
        include "./view/phim/sua.php";
        break;

        case "QLcarou":
            include "./view/phim/sua.php";
            break;

        case "updatephim":
    if (isset($_POST['capnhat'])) {
        $id = $_POST['id'];
        $tieu_de = $_POST['tieu_de'];
        $daodien = $_POST['daodien'];
        $dienvien = $_POST['dienvien'];
        $quoc_gia = $_POST['quoc_gia'];
        $gia_han_tuoi = $_POST['gia_han_tuoi'];
        $thoi_luong = $_POST['thoiluong']; 
        $date = $_POST['date']; 
        $id_loai = $_POST['id_loai'];
        $mo_ta = $_POST['mo_ta'];

        // --- XỬ LÝ ẢNH ---
        $img = $_FILES['anh']['name'];
        if ($img != "") {
            // Người dùng chọn ảnh mới
            $target_dir = "assets/imgavt/";
            $target_file = $target_dir . basename($_FILES['anh']['name']);
            move_uploaded_file($_FILES['anh']['tmp_name'], $target_file);
        } else {
            // Người dùng không chọn ảnh -> Lấy tên ảnh cũ từ form
            $img = $_POST['hinh_cu'];
        }

        // --- KIỂM TRA DỮ LIỆU ---
        if ($tieu_de == '' || $daodien == '' || $id_loai == '') {
            $error = "Vui lòng nhập đủ các thông tin bắt buộc!";
            // Load lại thông tin cũ để sửa tiếp
            $loadone_phim = loadone_phim($id);
            include "./view/phim/sua.php";
        } else {
            // --- GỌI MODEL ---
            // Thứ tự tham số PHẢI KHỚP với hàm bên Model
            sua_phim($id, $tieu_de, $daodien, $dienvien, $img, $mo_ta, $thoi_luong, $quoc_gia, $gia_han_tuoi, $date, $id_loai);

            $suatc = "Cập nhật thành công!";
            // Load lại danh sách phim
            $loadphim = loadall_phim();
            include "./view/phim/QLphim.php";
        }
    } else {
        // Nếu truy cập trực tiếp mà không bấm nút cập nhật -> Về danh sách
        $loadphim = loadall_phim();
        include "./view/phim/QLphim.php";
    }
    break;

}
?>