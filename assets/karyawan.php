<?php

require '../ceklogin.php';

$get = mysqli_query($conn, "select * from login");

while($c=mysqli_fetch_array($get)){
$username = $c['username'];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barbershop</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Aplikasi Barber</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>Login: <?=$username;?></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="../index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="transaksi.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                                Transaksi
                            </a>
                            <a class="nav-link" href="service.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-scissors"></i></div>
                                Service
                            </a>
                            <a class="nav-link" href="customer.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-group"></i></div>
                                Customer
                            </a>
                            <a class="nav-link" href="karyawan.php">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                                User / Karyawan
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Karyawan</h1>
    
                        <!-- Button to Open the Modal -->
                        <a type="button" class="btn btn-outline-primary mb-4 mt-3" href="karyawan_add.php">Tambah</a>

                        <div class="card mb-4">
                            <div class="card-body">
                                <table class="table table-bordered" id="datatablesSimple" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Lokasi</th>
                                            <th>Nama</th>
                                            <th>No. Telepon</th>
                                            <th>Jabatan / Bagian</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <?php
                                    $get = mysqli_query($conn, "select * from karyawan");
                                    $i = 1;

                                    while($k=mysqli_fetch_array($get)){
                                    $lokasi = $k['lokasi'];
                                    $namakar = $k['namakar'];
                                    $notelpkar = $k['notelpkar'];
                                    $jkkar = $k['jkkar'];
                                    $jabatan = $k['jabatan'];
                                    $alamatkar = $k['alamatkar'];
                                    $usernamekar = $k['usernamekar'];
                                    $passwordkar = $k['passwordkar'];
                                    $idkaryawan = $k['idkaryawan'];

                                    ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$lokasi;?></td>
                                            <td><?=$namakar;?></td>
                                            <td><?=$notelpkar;?></td>
                                            <td><?=$jabatan;?></td>
                                            <td>
                                            <a class="btn btn-outline-warning btn-sm" href="karyawan_edit.php?id=62">Edit</a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete<?=$idkaryawan;?>">                                 
                                                Delete
                                            </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="delete<?=$idkaryawan;?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Data Karyawan</h4>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <form method="POST" role="form">
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus <b>Karyawan <?=$namakar;?>?</b>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <input type="hidden" name="idk" value="<?=$idkaryawan;?>">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-outline-success" name="deletekaryawan">Yakin</button>
                                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Tidak</button>
                                            </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                    <?php
                                    }; //end of while
                                    ?>
                                </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="demo/chart-area-demo.js"></script>
        <script src="demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
