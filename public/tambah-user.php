<?php
require_once '../app/authMiddleware.php';
authMiddleware();

roleMiddleware(['admin']);

include '../app/views/tambahUser.php';
