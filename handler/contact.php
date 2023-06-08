<?php
require_once '../helpers/auxiliaries.php';

$email = $_POST['email'];
$msg = $_POST['msg'];

$sql = "INSERT INTO contacts(email,msg) VALUES ('$email','$msg')";
$connect->query($sql);

?>