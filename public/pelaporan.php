<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['user'])) {
  header('Location: ./login.php');
  exit();
}
include '../app/views/pelaporanPage.php';