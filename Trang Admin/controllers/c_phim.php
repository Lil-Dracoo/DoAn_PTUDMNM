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
}
?>