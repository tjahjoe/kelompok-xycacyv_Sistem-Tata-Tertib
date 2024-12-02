<?php
session_start();
function isLogin(){
    return isset($_SESSION['user']) ? true : false;
}

function logout(){
    session_destroy();
}
?>