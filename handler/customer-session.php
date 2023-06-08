<?php
    if (empty($_SESSION['email'] AND  $_SESSION['password'])) {
        echo "<script>alert('Please Log in');
        window.location.href='customersform.php';</script>";
    }


?>