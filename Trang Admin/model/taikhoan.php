<?php
function loadall_taikhoan() {
    $sql = "SELECT 
                t.id, 
                t.name, 
                t.user, 
                t.pass, 
                t.email, 
                t.phone, 
                t.dia_chi, 
                t.vai_tro,
                
                -- ĐẾM SỐ DÒNG (SỐ LẦN ĐẶT) --
                -- Chỉ đếm các vé nối được theo điều kiện bên dưới --
                COUNT(ve.id) as so_ve
            FROM 
                taikhoan t
            LEFT JOIN 
                -- Chỉ nối bảng vé nếu trạng thái là 1 (Đã thanh toán) hoặc 2 (Đã dùng)
                -- Các vé trạng thái 0 (Chưa thanh toán) sẽ bị bỏ qua, không tính vào số lượng
                ve ON ve.id_tk = t.id AND ve.trang_thai IN (1, 2)
            WHERE 
                t.vai_tro = 0
            GROUP BY 
                t.id
            ORDER BY 
                t.id DESC";

    $listtaikhoan = pdo_query($sql);
    return $listtaikhoan;
}

function loadone_taikhoan($id){
    $sql = "select * from taikhoan where id =".$id;
    $result = pdo_query_one($sql);
    return $result;
}

function loadall_taikhoan_nv() {
    $sql = "SELECT t.id, t.name, t.user, t.pass, t.email, t.phone, t.dia_chi, t.vai_tro
FROM taikhoan t
LEFT JOIN ve ON ve.id_tk = t.id
WHERE t.vai_tro = 1
GROUP BY t.id
ORDER BY t.id DESC;
";

    $re = pdo_query($sql);
    return $re;
}

function check_tk($user,$pass){
    $sql = "select * from taikhoan where user = '$user' and pass='$pass'";
    $result = pdo_query_one($sql);
    return $result;

}
function dang_xuat(){
    unset($_SESSION['user']);
}

function insert_taikhoan($email,$user,$pass,$name,$sdt,$dc){
    $sql="INSERT INTO `taikhoan` ( `email`, `user`, `pass`,`dia_chi`,`phone`,`name`,`vai_tro`) VALUES ( '$email', '$user','$pass','$dc','$sdt','$name','1'); ";
    pdo_execute($sql);
}
function check_user($user){
    $sql = "SELECT * FROM taikhoan WHERE user='".$user."'";
    return pdo_query_one($sql);
}
function xoa_tk($id)
{
    $sql = "delete from taikhoan where id=" . $id;
    pdo_execute($sql);
}
function check_khach_hang_da_mua_ve($id_user) {
    $sql = "SELECT SUM(LENGTH(ghe) - LENGTH(REPLACE(ghe, ',', '')) + 1) as tong_ve 
            FROM ve 
            WHERE id_tk = $id_user AND trang_thai IN (1, 2)";
            
    $ketqua = pdo_query_one($sql);
    
    // Nếu kết quả là NULL (chưa mua gì) thì trả về 0, ngược lại trả về số lượng
    return isset($ketqua['tong_ve']) && $ketqua['tong_ve'] > 0 ? $ketqua['tong_ve'] : 0;
}



