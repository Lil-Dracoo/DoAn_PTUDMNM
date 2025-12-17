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

    // 4. Xóa tài khoản
    case "xoatk":
        // --- 1. BẢO MẬT: CHẶN QUYỀN TRUY CẬP ---
        if (!isset($_SESSION['user1']) || $_SESSION['user1']['vai_tro'] != 2) {
            
            // Thay vì include file có thể không tồn tại, ta chuyển hướng hoặc báo lỗi
            echo "<script>alert('Cảnh báo: Bạn không có quyền thực hiện chức năng này!'); window.location.href='index.php';</script>";            
            break; 
        }

        $vai_tro_can_xoa = isset($_GET['vai_tro']) ? $_GET['vai_tro'] : 0;
        
        if (isset($_GET['idxoa']) && $_GET['idxoa'] > 0) {
            $id_xoa = $_GET['idxoa'];

            if ($vai_tro_can_xoa == 0) { 
                // --- TRƯỜNG HỢP 1: XÓA KHÁCH HÀNG ---
                $so_ve_quan_trong = check_khach_hang_da_mua_ve($id_xoa); 
                
                if ($so_ve_quan_trong > 0) {
                    $error = "Chặn xóa: Khách hàng này đã mua thành công $so_ve_quan_trong vé. Hãy khóa tài khoản thay vì xóa.";
                } else {
                    // Xóa dữ liệu rác trước
                    pdo_execute("DELETE FROM ve WHERE id_tk = $id_xoa AND trang_thai = 0");
                    // Kiểm tra lại tên cột id_user trong bảng binhluan cho đúng
                    pdo_execute("DELETE FROM binhluan WHERE id_user = $id_xoa"); 
                    
                    xoa_tk($id_xoa);
                    $suatc = "Đã xóa khách hàng thành công!";
                }

            } else {
                // --- TRƯỜNG HỢP 2: XÓA NHÂN VIÊN / ADMIN ---
                if ($_SESSION['user1']['id'] == $id_xoa) {
                    $error = "Lỗi: Bạn không thể tự xóa tài khoản của chính mình!";
                } elseif ($id_xoa == 1) { 
                     $error = "Lỗi: Không thể xóa tài khoản Quản trị viên cấp cao!";
                } else {
                    xoa_tk($id_xoa);
                    $suatc = "Đã xóa nhân viên thành công!";
                }
            }
        }

        // --- ĐIỀU HƯỚNG VỀ VIEW ---
        // QUAN TRỌNG: Hãy kiểm tra kỹ thư mục của bạn là 'taikhoan' hay 'user'
        // Nếu thư mục tên là 'user', hãy đổi 'taikhoan' thành 'user' ở 2 dòng dưới
        
        if ($vai_tro_can_xoa == 1) {
            $loadalltk = loadall_taikhoan_nv(); 
            // Nếu file này nằm trong view/user/QTvien.php thì sửa dòng dưới
            include "./view/taikhoan/QTvien.php"; 
        } else {
            $loadall_kh1 = loadall_taikhoan(); 
            // Nếu file này nằm trong view/user/khachhang.php thì sửa dòng dưới
            include "./view/taikhoan/khachhang.php";
        }
        break;
}
?>