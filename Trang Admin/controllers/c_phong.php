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
}
?>