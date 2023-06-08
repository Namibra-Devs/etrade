<?php
include "../partials/conn.php";
$email = $_POST['email'];
$msg = $_POST['msg'];

$sql = "INSERT INTO contacts(email,msg) VALUES ('$email','$msg')";
$connect->query($sql);

?>