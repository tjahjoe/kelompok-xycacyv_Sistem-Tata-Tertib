<?php 
require_once '../app/authMiddleware.php';
authMiddleware();

include '../app/views/userProfile.php';
