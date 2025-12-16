<?php
function loadall_lichchieu(){
    $sql = "select l.id,phim.tieu_de,l.ngay_chieu from lichchieu l 
            left join phim on phim.id= l.id_phim
            where 1 order by id desc";
    $re = pdo_query($sql);
    return $re;
}

function loadone_lichchieu($id){
    $sql = "select * from lichchieu where id =" . $id;
    $re = pdo_query_one($sql);
    return $re;
}

function them_lichchieu($id_phim, $ngay_chieu){
    $sql = "
        INSERT INTO lichchieu (id_phim, ngay_chieu)
        VALUES (?, ?)
    ";
    pdo_execute($sql, (int)$id_phim, $ngay_chieu);
}

function sua_lichchieu($id,$id_phim,$ngay_chieu){
    $sql = "update lichchieu set `id_phim`='{$id_phim}',`ngay_chieu`='{$ngay_chieu}'where `lichchieu`.`id`=" . $id;
    pdo_execute($sql);
}

function xoa_lc($id){
    $sql = "DELETE FROM lichchieu WHERE id=" . $id;
    pdo_execute($sql);
}

function check_lichchieu_co_suatchieu($id_lich_chieu){
    $sql = "SELECT COUNT(*) AS total 
            FROM khung_gio_chieu 
            WHERE id_lich_chieu = ?";
    $row = pdo_query_one($sql, (int)$id_lich_chieu);
    return $row['total'];
}
?>