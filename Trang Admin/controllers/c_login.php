<?php
// Kiểm tra nếu người dùng bấm nút Đăng nhập
if (isset($_POST['dangnhap']) && ($_POST['dangnhap'])) {
    $user = trim($_POST['user']);
    $pass = trim($_POST['pass']);

    // Validate cơ bản
    if ($user == "" || $pass == "") {
        $loi = "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu!";
    } else {
        // Hàm check_tk đã được include ở index.php nên dùng được luôn
        $user_info = check_tk($user, $pass);

        if ($user_info && is_array($user_info)) {
            if ($user_info['vai_tro'] == 1 || $user_info['vai_tro'] == 2) {
                $_SESSION['user1'] = $user_info;
                // Đăng nhập thành công -> Load lại trang chủ
                header('location: index.php');
                exit;
            } else {
                $loi = "Tài khoản không có quyền truy cập!";
            }
        } else {
            $loi = "Sai tên đăng nhập hoặc mật khẩu!";
        }
    }
}

// Gọi giao diện đăng nhập (đường dẫn tính từ index.php)
include "./view/login.php";
?>