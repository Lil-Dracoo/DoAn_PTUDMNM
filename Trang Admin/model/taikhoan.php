<?php
function loadall_taikhoan() {
    $sql = "SELECT 
    t.id, 
    t.name, 
    IFNULL(COUNT(ve.id), 0) AS so_ve, 
    t.user, 
    t.pass, 
    t.email, 
    t.phone, 
    t.dia_chi, 
    t.vai_tro
FROM 
    taikhoan t
LEFT JOIN 
    ve ON ve.id_tk = t.id AND ve.trang_thai IN (1, 2, 4)
WHERE 
    t.vai_tro = 0
GROUP BY 
    t.id, t.name, t.user, t.pass, t.email, t.phone, t.dia_chi, t.vai_tro
ORDER BY 
    t.id DESC;

;
";

    $re = pdo_query($sql);
    return $re;
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





