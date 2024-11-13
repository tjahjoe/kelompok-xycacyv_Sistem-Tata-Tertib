<?php
session_start();
$_SESSION['user']['id_users'] = '198912032017095008';
function isLogin(){
    return isset($_SESSION['user']) ? true : false;
}
?>