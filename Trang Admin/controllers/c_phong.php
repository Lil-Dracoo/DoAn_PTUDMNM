<?php
switch ($act) {
    case "phong":
        $loadphong = load_phong();
        include "./view/phong/phong.php";
        break;
}
?>