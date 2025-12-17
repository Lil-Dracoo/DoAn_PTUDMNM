<?php
// Khởi tạo biến thông báo rỗng để tránh lỗi Warning ở View
$error = "";
$suatc = "";

switch ($act) {
    // 1. Quản lý Khách hàng (Role = 0)
    case "QTkh":
        $loadall_kh1 = loadall_taikhoan(); // Hàm load danh sách khách hàng
        include "./view/taikhoan/khachhang.php";
        break;

    // 2. Quản lý Quản trị viên (Role = 1)
    case "QTvien":
        $loadalltk = loadall_taikhoan_nv(); // Hàm load danh sách nhân viên
        include "./view/taikhoan/QTvien.php";
        break;

}
?>