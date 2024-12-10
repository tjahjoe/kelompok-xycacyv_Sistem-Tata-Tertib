<?php

function authMiddleware()
{
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  if (!isset($_SESSION['user'])) {
    header('Location: ./login.php');
    exit();
  }
}

function roleMiddleware($allowedRoles){
  $userRole = $_SESSION['user']['role'];

  if (!in_array($userRole, $allowedRoles)) {
    header('Location: ./');
    exit();
  }
}