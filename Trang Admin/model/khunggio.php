<?php
function loadall_khunggiochieu() {
    $sql = "
        SELECT 
            kgc.id,
            kgc.thoi_gian_chieu,
            phim.tieu_de,
            phongchieu.name,
            lichchieu.ngay_chieu
        FROM khung_gio_chieu kgc
            JOIN lichchieu ON lichchieu.id = kgc.id_lich_chieu
            JOIN phim ON phim.id = lichchieu.id_phim
            JOIN phongchieu ON phongchieu.id = kgc.id_phong
        ORDER BY kgc.id DESC";
    return pdo_query($sql);
}

function loadone_khung_gio_chieu($id){
    if (empty($id)) return null;
    $sql = "SELECT * FROM khung_gio_chieu WHERE id = ?";
    return pdo_query_one($sql, (int)$id);
}