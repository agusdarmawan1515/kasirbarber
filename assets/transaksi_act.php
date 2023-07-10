<?php
require '../ceklogin.php';

if(isset($_POST['idserv']))
{
    $ids = $_POST['idserv'];

    $data = mysqli_query($conn, "SELECT * FROM `service` WHERE idservice = $ids;");
    $s = mysqli_fetch_assoc($data);

    $service = [
        'ids' => $s['ids'],
        'itemname' => $s['itemname'],
        'kategori' => $s['kategori'],
        'harga' => $s['harga'],
        'qty' => 1
    ];

    $_SESSION['cart'][] = $service;

    header('location:add_transaksi.php');
}


// if(isset($_POST['tambahtrx'])){
//     $transdate = $_POST['transdate'];
//     $noinvoice = $_POST['noinvoice'];
//     $idcust = $_POST['idcust'];
//     $idserv = $_POST['idserv'];
//     $totalsales = $_POST['totalsales'];
//     $bayar = $_POST['bayar'];
//     $kembali = $_POST['kembali'];
//     $idkar = $_POST['idkar'];
//     $notes = $_POST['notes'];
//     $idtransaksi = $_POST['idtransaksi'];

//     $insert = mysqli_query($conn, "insert into transaksi (transdate,noinvoice,idcust,idserv,totalsales,bayar,kembali,idkar,notes) values ('$transdate','$noinvoice','$idcust','$idserv','$totalsales','$bayar','$idkar','$notes')");

//     if($insert){
//         header('location:assets/transaksi.php');
//     } else {
//         echo '
//         <script>alert("Gagal menambah");
       
//         </script>
//         ';
//     }
// }
?>