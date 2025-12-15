<?php
session_start();

// 1. INCLUDE MODELS (Load trước để dùng chung cho mọi trường hợp)
include "./model/pdo.php";
include "./model/taikhoan.php";
include "./model/thongke.php";

// 2. XỬ LÝ ĐĂNG XUẤT (Ưu tiên xử lý đầu tiên)
if (isset($_GET['act']) && $_GET['act'] == "dangxuat") {
    // Xóa session
    unset($_SESSION['user1']);
    // Chuyển hướng về trang login (thông qua controller)
    header('location: index.php?act=login');
    exit;
}

// 3. KIỂM TRA TRẠNG THÁI ĐĂNG NHẬP
if (isset($_SESSION['user1'])) {
    
    // ========================================================================
    // NHÁNH A: ĐÃ ĐĂNG NHẬP (Vào trang quản trị)
    // ========================================================================

    // Load dữ liệu cho Header
    $loadtk = loadall_taikhoan();

    // Include Header
    include "./view/home/header.php";

    // Điều hướng Controller
    if (isset($_GET['act'])) {
        $act = $_GET['act'];
        switch ($act) {
            case "DTdh":
                include "./controllers/c_thongke.php";
                break;
            // Nếu đã đăng nhập mà cố vào login -> Đẩy về home
            case "login":
                header('location: index.php?act=home');
                break;

            // Trang chủ
            case "home":
            default:
                
                include "./view/home.php";
                break;
        }
    } else {
        // Mặc định vào trang chủ
       
        include "./view/home.php";
    }

    include "./view/home/footer.php";

} else {
    
    // ========================================================================
    // NHÁNH B: CHƯA ĐĂNG NHẬP (Khách)
    // ========================================================================
    
    // Nếu URL là ?act=login thì gọi Controller Login
    if (isset($_GET['act']) && $_GET['act'] == 'login') {
        include "./controllers/c_login.php";
    } else {
        // Vào bất cứ trang nào khác -> Đều bị đá về trang login
        header('location: index.php?act=login');
        exit;
    }
}
?>