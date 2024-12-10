<?php 
require_once '../app/authMiddleware.php';
authMiddleware();

roleMiddleware(['dosen', 'kps', 'dpa', 'sekjur', 'admin']);

include '../app/views/detailPelaporan.php';
