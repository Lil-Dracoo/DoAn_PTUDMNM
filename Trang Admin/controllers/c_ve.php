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

    case "chitiethoadon":
        include "./view/vephim/chitiethoadon.php";
        break;

    case "ctve":
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            $loadone_ve =  loadone_vephim($_GET['id']);
        }
        include "view/vephim/ct_ve.php";
        break;
}
?>