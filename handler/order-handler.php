<?php
session_start();
include "../partials/conn.php";
$total = $_POST['total'];
echo $total;
$phone = $_POST['phone'];
$address = $_POST['address'];
$customerid = $_SESSION['customer_id'];
$payment_method = $_POST['payment'];
// $sql3 = "insert into orders_details(order_id,product_id,quantity) values('1', '2', '3')";
// $connect ->query($sql3);

$sql = "insert into orders(customer_id, address, phone, total, pay_method) values('$customerid', '$address', '$phone', '$total', '$payment_method')";
$connect -> query($sql);
echo $payment_method;


$sql_2 = "select id from orders order by id DESC limit 1";
$result = $connect ->query($sql_2);
$final = $result ->fetch_assoc();
$order_id = $final['id'];
echo $order_id;

foreach($_SESSION['cart'] as $Key => $value){
    print_r( $_SESSION['cart']);
    $pro_id = $value['item_id'];
    $quantity = $value['quantity'];

$sql3 = "insert into orders_details(order_id,product_id,quantity) values ('$order_id', '$pro_id', '$quantity')";
$connect ->query($sql3);
}
// echo $customerid;

if ($payment_method == "Paypal") {
        header('location:paypal.php');
}else{
    
    echo "<script>alert('ORDER IS PLACED');
    window.locaton.href='../index.php';</script>";
    
}
// unset($_SESSION['cart']);



?>