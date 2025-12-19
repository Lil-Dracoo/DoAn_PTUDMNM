<?php
function load_thongke_doanhthu1(){
    if(isset($_GET['trang'])){
        $trang= $_GET['trang'];
    }
    else{
        $trang = 1 ;
    }   
    $bghi=5;
    $vitri = ($trang - 1)* $bghi;
    $sql = "SELECT 
        phim.id as id, 
        phim.tieu_de as tieu_de, 
        loaiphim.name as ten_loaiphim, 
        COUNT(CASE WHEN ve.trang_thai IN (1, 2,4) THEN ve.id END) as so_luong_ve_dat, 
        SUM(CASE WHEN ve.trang_thai IN (1, 2,4) THEN hoa_don.thanh_tien ELSE 0 END) as sum_thanhtien
    FROM phim LEFT JOIN loaiphim ON loaiphim.id = phim.id_loai
            LEFT JOIN lichchieu ON phim.id = lichchieu.id_phim
            LEFT JOIN khung_gio_chieu ON lichchieu.id = khung_gio_chieu.id_lich_chieu
            LEFT JOIN ve ON ve.id_thoi_gian_chieu = khung_gio_chieu.id
            LEFT JOIN hoa_don ON hoa_don.id = ve.id_hd
            GROUP BY phim.id
            ORDER BY phim.id DESC LIMIT $vitri,$bghi;";
    $listtk = pdo_query($sql);
    return $listtk;
}

function load_thongke_doanhthu(){

    $sql = "SELECT 
        phim.id as id, 
        phim.tieu_de as tieu_de, 
        loaiphim.name as ten_loaiphim, 
        COUNT(CASE WHEN ve.trang_thai IN (1, 2,4) THEN ve.id END) as so_luong_ve_dat, 
        SUM(CASE WHEN ve.trang_thai IN (1, 2,4) THEN hoa_don.thanh_tien ELSE 0 END) as sum_thanhtien
    FROM phim LEFT JOIN loaiphim ON loaiphim.id = phim.id_loai
            LEFT JOIN lichchieu ON phim.id = lichchieu.id_phim
            LEFT JOIN khung_gio_chieu ON lichchieu.id = khung_gio_chieu.id_lich_chieu
            LEFT JOIN ve ON ve.id_thoi_gian_chieu = khung_gio_chieu.id
            LEFT JOIN hoa_don ON hoa_don.id = ve.id_hd
            GROUP BY phim.id
            ORDER BY phim.id DESC ;";
    $listtk = pdo_query($sql);
    return $listtk;
}

function load_doanhthu_thang1(){
    if(isset($_GET['trang'])){
        $trang= $_GET['trang'];
    }
    else{
        $trang = 1 ;
    }   
    $bghi=5;
    $vitri = ($trang - 1)* $bghi;
    $sql = "SELECT 
        phim.id AS id, 
        phim.tieu_de AS tieu_de, 
        loaiphim.name AS ten_loaiphim, 
        MONTH(hoa_don.ngay_tt) AS thang,
        COUNT(ve.id) AS so_luong_ve_dat, 
        SUM(hoa_don.thanh_tien) AS sum_thanhtien
    FROM phim LEFT JOIN loaiphim ON loaiphim.id = phim.id_loai
            LEFT JOIN lichchieu ON phim.id = lichchieu.id_phim
            LEFT JOIN khung_gio_chieu ON lichchieu.id = khung_gio_chieu.id_lich_chieu
            LEFT JOIN ve ON ve.id_thoi_gian_chieu = khung_gio_chieu.id AND ve.trang_thai IN (1, 2,4)
            LEFT JOIN hoa_don ON hoa_don.id = ve.id_hd
            GROUP BY phim.id, thang
            ORDER BY thang DESC, phim.id DESC LIMIT $vitri,$bghi;";
    $listtk = pdo_query($sql);
    return $listtk;
}

function load_doanhthu_thang(){
    $sql = "SELECT 
        phim.id AS id, 
        phim.tieu_de AS tieu_de, 
        loaiphim.name AS ten_loaiphim, 
        MONTH(hoa_don.ngay_tt) AS thang,
        COUNT(ve.id) AS so_luong_ve_dat, 
        SUM(hoa_don.thanh_tien) AS sum_thanhtien
    FROM phim LEFT JOIN loaiphim ON loaiphim.id = phim.id_loai
            LEFT JOIN lichchieu ON phim.id = lichchieu.id_phim
            LEFT JOIN khung_gio_chieu ON lichchieu.id = khung_gio_chieu.id_lich_chieu
            LEFT JOIN ve ON ve.id_thoi_gian_chieu = khung_gio_chieu.id AND ve.trang_thai IN (1, 2,4)
            LEFT JOIN hoa_don ON hoa_don.id = ve.id_hd
        WHERE hoa_don.thanh_tien > 0
        GROUP BY phim.id, thang
        ORDER BY thang DESC, phim.id DESC;";
    $listtk = pdo_query($sql);
  return $listtk;
}

function load_doanhthu_tuan1(){
    if(isset($_GET['trang'])){
        $trang= $_GET['trang'];
    }
    else{
        $trang = 1 ;
    }   
    $bghi=5;
    $vitri = ($trang - 1)* $bghi;
    $sql = "SELECT 
        phim.id AS id, 
        phim.tieu_de AS tieu_de, 
        loaiphim.name AS ten_loaiphim, 
        YEARWEEK(hoa_don.ngay_tt) AS tuan,
        COUNT(ve.id) AS so_luong_ve_dat, 
        SUM(hoa_don.thanh_tien) AS sum_thanhtien
    FROM phim INNER JOIN loaiphim ON loaiphim.id = phim.id_loai
            INNER JOIN lichchieu ON phim.id = lichchieu.id_phim
            INNER JOIN khung_gio_chieu ON lichchieu.id = khung_gio_chieu.id_lich_chieu
            INNER JOIN ve ON ve.id_thoi_gian_chieu = khung_gio_chieu.id AND ve.trang_thai IN (1, 2,4)
            INNER JOIN hoa_don ON hoa_don.id = ve.id_hd
            GROUP BY phim.id, phim.tieu_de, loaiphim.name, YEARWEEK(hoa_don.ngay_tt)
            ORDER BY tuan DESC, phim.id DESC LIMIT $vitri,$bghi;";
    $listtk = pdo_query($sql);
    return $listtk;
}

function load_doanhthu_tuan(){
    $sql = "SELECT 
        phim.id AS id, 
        phim.tieu_de AS tieu_de, 
        loaiphim.name AS ten_loaiphim, 
        YEARWEEK(hoa_don.ngay_tt) AS tuan,
        COUNT(ve.id) AS so_luong_ve_dat, 
        SUM(hoa_don.thanh_tien) AS sum_thanhtien
    FROM phim INNER JOIN loaiphim ON loaiphim.id = phim.id_loai
            INNER JOIN lichchieu ON phim.id = lichchieu.id_phim
            INNER JOIN khung_gio_chieu ON lichchieu.id = khung_gio_chieu.id_lich_chieu
            INNER JOIN ve ON ve.id_thoi_gian_chieu = khung_gio_chieu.id AND ve.trang_thai IN (1, 2,4)
            INNER JOIN hoa_don ON hoa_don.id = ve.id_hd
            GROUP BY phim.id, phim.tieu_de, loaiphim.name, YEARWEEK(hoa_don.ngay_tt)
            ORDER BY tuan DESC, phim.id DESC ;";
  $listtk = pdo_query($sql);
  return $listtk;
}

function load_doanhthu_ngay1(){
    if(isset($_GET['trang'])){
        $trang= $_GET['trang'];
    }
    else{
        $trang = 1 ;
    }   
    $bghi=5;
    $vitri = ($trang - 1)* $bghi;
    $sql = "SELECT 
        phim.id AS id, 
        phim.tieu_de AS tieu_de, 
        loaiphim.name AS ten_loaiphim, 
        DATE(hoa_don.ngay_tt) AS ngay,
        COUNT(ve.id) AS so_luong_ve_dat,
        SUM(hoa_don.thanh_tien) AS sum_thanhtien
    FROM 
        phim INNER JOIN loaiphim ON loaiphim.id = phim.id_loai
            INNER JOIN lichchieu ON phim.id = lichchieu.id_phim
            INNER JOIN khung_gio_chieu ON lichchieu.id = khung_gio_chieu.id_lich_chieu
            INNER JOIN ve ON ve.id_thoi_gian_chieu = khung_gio_chieu.id AND ve.trang_thai IN (1, 2,4)
            INNER JOIN hoa_don ON hoa_don.id = ve.id_hd
            GROUP BY phim.id, phim.tieu_de, loaiphim.name, DATE(hoa_don.ngay_tt)
            ORDER BY ngay DESC, phim.id DESC LIMIT $vitri,$bghi;";
    $listtk = pdo_query($sql);
    return $listtk;
}

function load_doanhthu_ngay(){
    $sql = "SELECT 
        phim.id AS id, 
        phim.tieu_de AS tieu_de, 
        loaiphim.name AS ten_loaiphim, 
        DATE(hoa_don.ngay_tt) AS ngay,
        COUNT(ve.id) AS so_luong_ve_dat,
        SUM(hoa_don.thanh_tien) AS sum_thanhtien
    FROM phim INNER JOIN loaiphim ON loaiphim.id = phim.id_loai
            INNER JOIN lichchieu ON phim.id = lichchieu.id_phim
            INNER JOIN khung_gio_chieu ON lichchieu.id = khung_gio_chieu.id_lich_chieu
            INNER JOIN ve ON ve.id_thoi_gian_chieu = khung_gio_chieu.id AND ve.trang_thai IN (1, 2,4)
            INNER JOIN hoa_don ON hoa_don.id = ve.id_hd
            GROUP BY phim.id, phim.tieu_de, loaiphim.name, DATE(hoa_don.ngay_tt)
            ORDER BY ngay DESC, phim.id DESC;";
    $listtk = pdo_query($sql);
    return $listtk;
}