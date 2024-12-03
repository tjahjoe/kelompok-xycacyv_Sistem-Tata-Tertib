<?php
session_start();
if (isset($_SESSION['user'])) {
  header('Location: ./');
  exit();
}
include '../app/views/login.php';
