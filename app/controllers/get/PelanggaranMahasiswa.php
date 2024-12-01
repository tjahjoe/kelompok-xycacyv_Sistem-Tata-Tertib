<?php
session_start();
function filterDaftarPelaporan(){
    if ($_SERVER['REQUEST_METHOD'] == 'GET' ) {
    
        $_SESSION['filter']['nim'] = isset($_GET['searchNim']) ? $_GET['searchNim'] : '' ;
        $_SESSION['filter']['tanggalAwal'] = isset($_GET['startTanggalPelaporan']) ? $_GET['startTanggalPelaporan'] : '';
        $_SESSION['filter']['tanggalAkhir'] = isset($_GET['endTanggalPelaporan']) ? $_GET['endTanggalPelaporan'] : '';
        $_SESSION['filter']['tingkat'] = isset($_GET['tingkatPelaporan']) ? $_GET['tingkatPelaporan'] : '';
        $_SESSION['filter']['status'] = isset($_GET['statusPelaporan']) ? $_GET['statusPelaporan'] : '';
    
        unset($_SESSION['allData']);
    
        echo json_encode(['status' => 'success']);
        exit;
    
    }
}
?>