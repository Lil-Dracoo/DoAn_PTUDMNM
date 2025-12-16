<?php
switch ($act) {
    case "phong":
        $loadphong = load_phong();
        include "./view/phong/phong.php";
        break;
    case "themphong":
        $loadphong = load_phong();
        if (isset($_POST['len'])) {
            $name = $_POST['name'];
            if ($name == '') {
                $error = "vui lòng không để trống";
            } else {
                them_phong($name);
                $suatc = "Thêm thành công";
            }
        }
        $loadphong = load_phong();
        include "./view/phong/them.php";
        break;
    case "xoaphong":
        if (isset($_GET['idxoa'])) {
            xoa_phong($_GET['idxoa']);
            $loadphong = load_phong();
            include "./view/phong/phong.php";
        }
        break;
    case "suaphong":
        if (isset($_GET['ids'])) {
            $loadphong1 = loadone_phong($_GET['ids']);
        }
        include "./view/phong/sua.php";
        break;
    case "updatephong":
        $loadphong = load_phong();
        if (isset($_POST['capnhat'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            if ($id == '' || $name == '') {
                $error = "vui lòng không để trống";
                $loadphong1 = load_phong($id);
                include "./view/phong/sua.php";
            } else {
                update_phong($id, $name);
                $suatc = "sửa thành công";
                $loadphong = load_phong();
                include "./view/phong/phong.php";
            }
        } else {
            $loadphong = load_phong();
            include "./view/phong/phong.php";
        }
        break;
}
?>