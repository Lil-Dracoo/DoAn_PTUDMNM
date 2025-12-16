<?php
switch ($act) {
    case "QLsuatchieu":
        $loadlich = loadall_lichchieu();
        include "./view/suatchieu/lichchieu/QLsuatchieu.php";
        break;
    case "thoigian":
        $loadkgc = loadall_khunggiochieu();
        include "./view/suatchieu/khunggio/thoigian.php";
        break;
}
?>