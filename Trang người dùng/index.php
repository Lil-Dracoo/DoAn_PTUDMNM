<?php
session_start();

include "model/pdo.php";
include "model/taikhoan.php";

date_default_timezone_set("Asia/Ho_Chi_Minh");

// CHỈ LOAD HEADER


// CHỈ XỬ LÝ LOGIN
if (isset($_POST['login'])) {
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';

    if ($user == '' || $pass == '') {
        $error = "Vui lòng không để trống";
    } else {
        $check_tk = check_tk($user, $pass);
        if (is_array($check_tk)) {
            $_SESSION['user'] = $check_tk;
            $thongbao = "Đăng nhập thành công (test)";
        } else {
            $error = "Sai tài khoản hoặc mật khẩu";
        }
    }
}

// CHỈ HIỂN THỊ LOGIN
include "view/login/dangnhap.php";

// FOOTER

?>