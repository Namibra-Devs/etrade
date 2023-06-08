<?php
session_start();



if(isset($_POST['login'])){
  include("../partials/conn.php");
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = "select * from customers where username = '$email' and password = '$password'";
  $result = $connect->query($sql);
  $final = $result -> fetch_assoc();

 
  // exit();

  if($email = $final['username'] and $password =$final['password']){
    $_SESSION['email'] = $final['username'];
    $_SESSION['password'] = $final['password'];
    $_SESSION['customer_id'] = $final['id'];
    header('location:../cart-two.php');
  }else{
    echo "<script>alert('Credentials are wrong!');
    window.location.href='../customersform.php';</script>";
  }
}


?>