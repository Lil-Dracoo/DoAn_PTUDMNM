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

        // 3. Xử lý Thêm tài khoản mới
    case "themuser":
        if (isset($_POST['them'])) {
            // Lấy dữ liệu và cắt khoảng trắng thừa
            $name = trim($_POST['name']);
            $user = trim($_POST['user']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $dia_chi = trim($_POST['dia_chi']);
            $pass = trim($_POST['pass']); // Không hash mật khẩu
            $vai_tro = isset($_POST['vai_tro']) ? $_POST['vai_tro'] : 0; // Mặc định là khách nếu không chọn
            
            $errors = []; // Mảng chứa lỗi

            // --- A. KIỂM TRA RỖNG ---
            if (empty($name)) $errors[] = "Họ tên không được để trống.";
            if (empty($user)) $errors[] = "Tên đăng nhập không được để trống.";
            if (empty($pass)) $errors[] = "Mật khẩu không được để trống.";
            if (empty($dia_chi)) $errors[] = "Địa chỉ không được để trống.";

            // --- B. KIỂM TRA TRÙNG USER (Quan trọng) ---
            // Cần có hàm check_user() trong model trả về true/false hoặc dữ liệu
            if (!empty($user) && check_user($user)) {
                $errors[] = "Tên đăng nhập '$user' đã tồn tại. Vui lòng chọn tên khác.";
            }

            // --- C. VALIDATE EMAIL ---
            if (empty($email)) {
                $errors[] = "Email không được để trống.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Email không đúng định dạng.";
            }

            // --- D. VALIDATE SỐ ĐIỆN THOẠI (VN Regex) ---
            if (empty($phone)) {
                $errors[] = "Số điện thoại không được để trống.";
            } elseif (!preg_match('/^(03|05|07|08|09)+([0-9]{8})$/', $phone)) {
                $errors[] = "SĐT không hợp lệ (Phải là 10 số, đầu số VN).";
            }

            // --- XỬ LÝ KẾT QUẢ ---
            if (empty($errors)) {
                // Không lỗi -> Insert vào DB
                // Lưu ý: Hàm insert cần nhận tham số vai_tro nếu bạn muốn tạo Admin từ đây
                insert_taikhoan($email, $user, $pass, $name, $phone, $dia_chi, $vai_tro);
                $suatc = "Thêm mới thành công!";
            } else {
                // Có lỗi -> Gộp mảng lỗi thành chuỗi HTML
                $error = implode("<br>", $errors);
            }
        }
        
        // Load lại view thêm mới
        // (Tùy logic mà load danh sách user cũ hay không, ở đây giữ nguyên code của bạn)
        $loadall_kh = loadall_taikhoan(); 
        include "./view/taikhoan/them.php";
        break;

}
?>