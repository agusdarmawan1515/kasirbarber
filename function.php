<?php
include('function_tgl.php');
session_start();

$conn = mysqli_connect('localhost','root','','barber');

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = mysqli_query($conn, "SELECT * FROM login WHERE username='$username' and password='$password'");
    $hitung = mysqli_num_rows($check);

    if($hitung>0){
        //Jika data nya ditemukan
        //berhasil login

        $_SESSION['login'] = 'True';
        header('location:index.php');
    } else {
        //Data tidak berhasil ditemukan
        //gagal login
        echo '
        <script>alert("Username atau Password salah");
        window.location.href="login.php"
        </script>
        ';
    }
}

//tambahservice
if(isset($_POST['simpan'])){
    $kategori = $_POST['kategori'];
    $itemname = $_POST['itemname'];
    $harga = $_POST['harga'];

    $insert = mysqli_query($conn, "insert into service (kategori,itemname,harga) values ('$kategori','$itemname','$harga')");

    if($insert){
        header('location:service.php');
    } else {
        echo '
        <script>alert("Gagal menambah");
        window.location.href="service.php"
        </script>
        ';
    }
}

//editservice
if(isset($_POST['editservice'])){
    $kategori = $_POST['kategori'];
    $itemname = $_POST['itemname'];
    $harga = $_POST['harga'];
    $ids = $_POST['ids'];

    $query = mysqli_query($conn, "update service set kategori='$kategori', itemname='$itemname', harga='$harga' where idservice='$ids' ");

    if($query){
        header('location:service.php');
    } else {
        echo '
        <script>alert("Gagal menambah");
        window.location.href="service.php"
        </script>
        ';
    }
}

//hapusbarang
if(isset($_POST['deleteservice'])){
    $ids = $_POST['ids'];

    $query = mysqli_query($conn, "delete from service where idservice='$ids' ");

    if($query){
        header('location:service.php');
    } else {
        echo '
        <script>alert("Gagal menambah");
        window.location.href="service.php"
        </script>
        ';
    }
}

//tambahcustomer
if(isset($_POST['tambahcustomer'])){
    $namacust = $_POST['namacust'];
    $notelpcust = $_POST['notelpcust'];
    $alamatcust = $_POST['alamatcust'];
    $kategoricust = $_POST['kategoricust'];

    $insert = mysqli_query($conn, "insert into customer (namacust,notelpcust,alamatcust,kategoricust) values ('$namacust','$notelpcust','$alamatcust','$kategoricust')");

    if($insert){
        header('location:customer.php');
    } else {
        echo '
        <script>alert("Gagal menambah");
        window.location.href="customer.php"
        </script>
        ';
    }
}

//editcustomer
if(isset($_POST['editcustomer'])){
    $namacust = $_POST['namacust'];
    $notelpcust = $_POST['notelpcust'];
    $alamatcust = $_POST['alamatcust'];
    $kategoricust = $_POST['kategoricust'];
    $member = $_POST['member'];
    $idc = $_POST['idc'];

    $query = mysqli_query($conn, "update customer set namacust='$namacust', notelpcust='$notelpcust', alamatcust='$alamatcust', kategoricust='$kategoricust', member='$member' where idcustomer='$idc' ");

    if($query){
        header('location:customer.php');
    } else {
        echo '
        <script>alert("Gagal menambah");
        window.location.href="customer.php"
        </script>
        ';
    }
}

//deletecostumer
if(isset($_POST['deletecustomer'])){
    $idc = $_POST['idc'];

    $query = mysqli_query($conn, "delete from customer where idcustomer='$idc' ");

    if($query){
        header('location:customer.php');
    } else {
        echo '
        <script>alert("Gagal menambah");
        window.location.href="customer.php"
        </script>
        ';
    }
}

//tambahkaryawan
if(isset($_POST['tambahkaryawan'])){
    $lokasi = $_POST['lokasi'];
    $namakar = $_POST['namakar'];
    $notelpkar = $_POST['notelpkar'];
    $jkkar = $_POST['jkkar'];
    $jabatan = $_POST['jabatan'];
    $alamatkar = $_POST['alamatkar'];
    $usernamekar = $_POST['usernamekar'];
    $passwordkar = $_POST['passwordkar'];

    $insert = mysqli_query($conn, "insert into karyawan (lokasi,namakar,notelpkar,jkkar,jabatan,alamatkar,usernamekar,passwordkar) values ('$lokasi','$namakar','$notelpkar','$jkkar','$jabatan','$alamatkar','$usernamekar','$passwordkar')");

    if($insert){
        header('location:karyawan.php');
    } else {
        echo '
        <script>alert("Gagal menambah");
        window.location.href="karyawan_add.php"
        </script>
        ';
    }
}

//editkaryawan
if(isset($_POST['editkaryawan'])){
    $namakar = $_POST['namakar'];
    $notelpkar = $_POST['notelpkar'];
    $jkkar = $_POST['jkkar'];
    $jabatan = $_POST['jabatan'];
    $alamatkar = $_POST['alamatkar'];
    $usernamekar = $_POST['usernamekar'];
    $passwordkar = $_POST['passwordkar'];
    $idk = $_POST['idk'];

    $query = mysqli_query($conn, "update karyawan set namakar='$namakar',notelpkar='$notelpkar',jkkar='$jkkar',jabatan='$jabatan',alamatkar='$alamatkar',usernamekar='$usernamekar',passwordkar='$passwordkar' where idkaryawan='$idk' ");

    if($query){
        header('location:karyawan.php');
    } else {
        echo '
        <script>alert("Gagal menambah");
        window.location.href="karyawan.php"
        </script>
        ';
    }
}

//deletecostumer
if(isset($_POST['deletekaryawan'])){
    $idk = $_POST['idk'];

    $query = mysqli_query($conn, "delete from karyawan where idkaryawan='$idk' ");

    if($query){
        header('location:karyawan.php');
    } else {
        echo '
        <script>alert("Gagal menambah");
        window.location.href="karyawan.php"
        </script>
        ';
    }
}

?>
