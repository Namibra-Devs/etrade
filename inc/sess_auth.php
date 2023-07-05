<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
    $link = "https"; 
else
    $link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST']; 
$link .= $_SERVER['REQUEST_URI'];
if(!strpos($link, 'sign-in.php') && !strpos($link, 'register.php') && (!isset($_SESSION['userdata']) || (isset($_SESSION['userdata']['login_type']) && $_SESSION['userdata']['login_type'] != 3)) ){
	redirect('sign-in.php');
}
if(strpos($link, 'sign-in.php') && isset($_SESSION['userdata']['login_type']) && $_SESSION['userdata']['login_type'] == 3){
	redirect('index.php');
}
