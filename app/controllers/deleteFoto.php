<?php
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../../assets/utils/setData.php";
require_once __DIR__ . "/check.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isLogin()) {
    $userModel = new User();

    $response = [
        'status' => 'error',
        'message' => 'process failed',
    ];

    $id = $_SESSION['user']['id_users'];

    $lastFileName = $userModel->checkPhotoName($id);

    if ($lastFileName) {
        if ($lastFileName['foto_diri'] != null) {
            $targetDirectory = "../../assets/uploads/photo/";
            if (file_exists($targetDirectory . $lastFileName['foto_diri'])) {
                unlink($targetDirectory . $lastFileName['foto_diri']);
            }
        }
    }

    $fileName = null;

    $result = $userModel->changeFoto($id, $fileName);

    echo $result ? json_encode(['status' => 'success', 'message' => 'update success']) : json_encode($response);
    exit;
}
?>