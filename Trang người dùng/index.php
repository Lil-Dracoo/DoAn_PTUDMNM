<?php
session_start();
include "model/pdo.php";
include "model/loai_phim.php";
include "model/phim.php";
include "model/taikhoan.php";
include "model/lichchieu.php";
include "model/ve.php";
include "model/hoadon.php";
date_default_timezone_set("Asia/Ho_Chi_Minh");
$loadloai = loadall_loaiphim();
$loadphim = loadall_phim();
$loadphimhot = loadall_phim_hot();
$loadphimhome = loadall_phim_home();
include "view/header.php";

if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    switch ($act) {

        case "dangnhap":
            if (isset($_POST['login'])) {
                $user = htmlspecialchars($_POST['user'], ENT_QUOTES, 'UTF-8');
                $pass = htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8');
                $check_tk = check_tk($user, $pass);

                if ($user == '' || $pass == '') {
                    $error = "Vui lòng không để trống";
                    include "view/login/dangnhap.php";
                    break;
                } else {
                    if (is_array($check_tk) && $check_tk['vai_tro'] == 0) {
                        $_SESSION['user'] = $check_tk;
                    } else {
                        $thongbao = "Đăng nhập không thành công. Vui lòng kiểm tra tài khoản của bạn.";
                    }
                }
            }
    } 
    
    
    } else {
    unset($_SESSION['id_hd']);
    unset($_SESSION['id_ve']);
    unset($_SESSION['mv']);
    unset($_SESSION['tong']);
    include "view/home.php";
}
include "view/footer.php";
?>