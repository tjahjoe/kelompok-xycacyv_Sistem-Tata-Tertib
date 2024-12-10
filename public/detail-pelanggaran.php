<?php 
require_once '../app/authMiddleware.php';
authMiddleware();

roleMiddleware(['mahasiswa']);

include '../app/views/detailPelanggaran.php';