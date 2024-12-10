<?php 
require_once '../app/authMiddleware.php';
authMiddleware();

roleMiddleware(['kps', 'dpa', 'sekjur', 'admin']);

include '../app/views/daftarPelaporan.php';