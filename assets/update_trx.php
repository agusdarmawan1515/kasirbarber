<?php
require '../ceklogin.php';

$qty = $_POST['qty'];

foreach ($_SESSION['cart'] as $key => $value) {
    $_SESSION['cart'][$key]['qty'] = $qty[$key];
}
header('location:add_transaksi.php');
?>  