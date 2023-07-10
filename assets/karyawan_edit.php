<?php

require '../ceklogin.php';

$get = mysqli_query($conn, "select * from login");

while($c=mysqli_fetch_array($get)){
$role = $c['role'];
}
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
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>Login: <?=$role;?></a>
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
                    <div class="page-header mb-4">
                    
                    </div>
                        <div class="card mb-4" id="62">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Data Karyawan</h4>
                            <form class="forms-sample" action="" method="POST" role="form" onsubmit="return confirm('Yakin?')">
                            <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 mb-2 col-form-label">Lokasi</label>
                        <div class="col-sm-9">
                          <label><?=$lokasi;?></label>
                        </div>
                      </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 mb-2 col-form-label">Nama</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" name="namakar" value="<?=$namakar;?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 mb-3 col-form-label">No. HP</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" name="notelpkar" value="<?=$notelpkar;?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 mb-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    Laki-laki:
                                    <input type="radio" class="flat" name="jkkar" value="Laki-laki" checked="<?=$jkkar;?>"> 
                                    Perempuan:
                                    <input type="radio" class="flat" name="jkkar" value="Perempuan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 mb-2 col-form-label">Jabatan/Bagian</label>
                                <div class="col-sm-9">
                                <select name="jabatan" id="select" class="form-control">
                                    <option value="Admin">Admin</option>                  
                                    <option value="Kasir">Kasir</option>  
                                    <option value="Capster">Capster</option>                               
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 mb-5 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                <textarea class="resizable_textarea form-control" name="alamatkar"><?=$alamatkar;?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 mb-2 col-form-label">Username</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" name="usernamekar" value="<?=$usernamekar;?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 mb-2 col-form-label">Password</label>
                                <div class="col-sm-9">
                                <input type="password" class="form-control" name="passwordkar" value="<?=$passwordkar;?>" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-9">
                                <input type="hidden" name="idk" value="<?=$idkaryawan;?>">
                                </div>
                            </div>
                            </div>                       
                            <br>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label"></label>
                                <div class="col-sm-9"> 
                                <button type="submit" name="editkaryawan" class="btn btn-outline-success mr-2">Simpan</button>
                                <a class="btn btn-outline-danger" href="karyawan.php">Tutup</a>
                                </div>
                            </div>
                            </form> 
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
