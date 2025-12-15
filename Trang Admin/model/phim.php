<?php

function loadall_phim($searchName1 = "", $searchLoai = "")
{
    $sql = "SELECT p.id, p.tieu_de, p.daodien, p.dienvien, p.img, p.mo_ta, p.date_phat_hanh, p.thoi_luong_phim, loaiphim.name, p.quoc_gia, p.gia_han_tuoi
            FROM phim p
            INNER JOIN loaiphim ON loaiphim.id = p.id_loai
            WHERE 1 ";

    // Thêm điều kiện tìm kiếm theo tên phim
    if (!empty($searchName1)) {
        $sql .= " AND p.tieu_de LIKE '%" . $searchName1 . "%' ";
    }

    // Thêm điều kiện tìm kiếm theo loại phim
    if (!empty($searchLoai)) {
        $sql .= " AND loaiphim.name LIKE '%" . $searchLoai . "%' ";
    }

    $sql .= " ORDER BY p.id DESC";

    $re = pdo_query($sql);
    return $re;
}

function loadone_phim($id)
{
    $sql = "select * from phim where id =" . $id;
    $re = pdo_query_one($sql);
    return $re;
}
