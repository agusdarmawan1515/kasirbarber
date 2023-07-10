<?php
require '../ceklogin.php';

$id = $_GET['idservice'];

$cart = $_SESSION['cart'];

$k = array_filter($cart, function ($var) use ($id){
    return ($var['idservice']==$id);
});

foreach ($k as $key => $value) {
    unset($_SESSION['cart'][$key]);
}

$_SESSION['cart'] = array_values($_SESSION['cart']);

header('location:tesskwkjw.php');
?>