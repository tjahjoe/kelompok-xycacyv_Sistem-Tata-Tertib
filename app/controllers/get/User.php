<?php
require_once __DIR__ . "/../../models/User.php";

function filterUserById(){
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $userModel = new User();
    
        $response = [
            'status' => 'error',
            'message' => 'data not valid',
        ];
    
        $id = isset($_GET['searchNim']) ? $_GET['searchNim'] : '';
        $idUser = $_SESSION['user']['id_users'];
    
        $result = $userModel->getDataUsersByFilter($id, $idUser);
    
        echo $result ? json_encode(['status' => 'success', 'data' => $result]) : json_encode($response);
        exit;
    }
}
?>