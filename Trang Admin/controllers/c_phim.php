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

}
?>