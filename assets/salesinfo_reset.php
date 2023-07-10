<?php
session_start();

$_SESSION['cart'] = [];
header('location:tess.php');
?>