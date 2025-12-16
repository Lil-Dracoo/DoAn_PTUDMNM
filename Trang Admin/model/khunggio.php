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

function them_kgc($id_lc, $id_phong, $thoi_gian_chieu){
    $sql = "
        INSERT INTO khung_gio_chieu (id_lich_chieu, id_phong, thoi_gian_chieu)
        VALUES (?, ?, ?)";
    pdo_execute($sql, (int)$id_lc, (int)$id_phong, $thoi_gian_chieu);
}

function sua_kgc($id, $id_lc, $id_phong, $thoi_gian_chieu){
    $sql = "
        UPDATE khung_gio_chieu
        SET id_lich_chieu = ?, id_phong = ?, thoi_gian_chieu = ?
        WHERE id = ?";
    pdo_execute($sql, (int)$id_lc, (int)$id_phong, $thoi_gian_chieu, (int)$id);
}

function xoa_kgc($id){
    $sql = "DELETE FROM khung_gio_chieu WHERE id = ?";
    pdo_execute($sql, (int)$id);
}
function check_trung_lich($id_lc, $id_phong, $thoi_gian_chieu, $id_ignore = 0) {
    // Chúng ta kiểm tra dựa trên id_lich_chieu (để lấy ngày) kết hợp với phòng và giờ
    $sql = "SELECT count(*) FROM khung_gio_chieu kgc
            JOIN lichchieu lc ON kgc.id_lich_chieu = lc.id
            WHERE kgc.id_phong = ? 
            AND kgc.thoi_gian_chieu = ? 
            AND lc.ngay_chieu = (SELECT ngay_chieu FROM lichchieu WHERE id = ?)
            AND kgc.id <> ?"; // id_ignore dùng khi sửa để không tự trùng với chính nó
    
    // Trả về số lượng bản ghi trùng
    return pdo_query_value($sql, $id_phong, $thoi_gian_chieu, $id_lc, $id_ignore);
}
function pdo_query_value($sql){
    $sql_args = array_slice(func_get_args(), 1);
    try{
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return array_values($row)[0];
    }
    catch(PDOException $e){
        throw $e;
    }
    finally{
        unset($conn);
    }
}