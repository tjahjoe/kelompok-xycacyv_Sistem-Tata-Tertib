<?php
session_start();

header('Content-Type: application/json');

require_once __DIR__ . "/../models/User.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userModel = new User();

    $response = [
        'status' => 'error',
        'message' => 'Email or Password is incorrect!',
    ];

    $id = $_POST['idAnggota'];
    $password = $_POST['password'];

    $user = $userModel->login($id, $password);

    if ($user) {
        $_SESSION['user'] = $user;
        $response['status'] = 'success';
        $response['message'] = 'Login successful';
    }

    echo json_encode($response);
    exit;
}
?>