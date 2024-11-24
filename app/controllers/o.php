<?php
require_once __DIR__ . "/check.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isLogin()) {
    echo json_encode($_FILES['lampiran']['name']);
}
?>