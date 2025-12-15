<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login - Admin CinePass</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/vendor/themify-icons.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.css">
    <link rel="stylesheet" href="assets/css/helper.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link id="cus-style" rel="stylesheet" href="assets/css/style-primary.css">
</head>

<body>
    <div class="tong" style="margin-left:550px;margin-top:100px">
        <div class="main-wrapper">

            <div class="content-body m-0 p-0">

                <div class="login-register-wrap">
                    <div class="row">

                        <div class="d-flex align-self-center justify-content-center order-2 order-lg-1 col-lg-5 col-12">
                            <div class="login-register-form-wrap">

                                <div class="content">
                                    <h1>Đăng nhập</h1>
                                </div>

                                <div class="login-register-form">
                                    <form action="index.php?act=login" method="post">
                                        <div class="row">
                                            <div class="col-12 mb-20">
                                                <input class="form-control" type="text" name="user" placeholder="Tài khoản đăng nhập">
                                            </div>
                                            
                                            <div class="col-12 mb-20">
                                                <input class="form-control" name="pass" type="password" placeholder="Mật khẩu">
                                            </div>
                                            
                                            <div class="col-12">
                                                <?php if (isset($loi) && ($loi) != "") {
                                                    echo "<h5 style='color:red; text-align:center; font-weight:bold;'>" . $loi . "</h5>";
                                                } ?>
                                            </div>

                                            <div class="col-12 mt-10">
                                                <input class="button button-primary button-outline" name="dangnhap" type="submit" value="Đăng Nhập">
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div></div>
    </div>

    <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>