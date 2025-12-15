<?php
switch ($act) {
    case "DTdh":
        $dt = load_thongke_doanhthu();
        include "./view/doanhthu/DTdh.php";
        break;
    case "DTthang":
        $dtt =  load_doanhthu_thang1();
        $dtt1 =  load_doanhthu_thang();
        include "./view/doanhthu/DTthang.php";
        break;
    case "DTtuan":
        $dtt =  load_doanhthu_tuan1();
        $dtt1 =  load_doanhthu_tuan();
        include "./view/doanhthu/DTtuan.php";
        break;
}
?>