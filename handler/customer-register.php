<?php 
include "../partials/conn.php";
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirmpassword'];
if($password == $confirm_password){
    $sql = "insert into customers(username, password) values ('$email','$password')";
    $connect -> query($sql);
    echo "<script>alert('You are registered!');
    window.location.href='../customersform.php';</script>";
}else{
    echo "<script>alert('Passwords did not match!');
    window.location.href='../customersform.php';</script>";
}

?>