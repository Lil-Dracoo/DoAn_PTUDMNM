<?php
switch ($act) {
    case "DTdh":
        $dt = load_thongke_doanhthu();
        include "./view/doanhthu/DTdh.php";
        break;
}
?>