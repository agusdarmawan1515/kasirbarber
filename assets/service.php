<?php

require '../ceklogin.php';

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
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>Login:</a>
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
                        <h1 class="mt-4">Data Service</h1>
    
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-outline-primary mb-4 mt-3" data-toggle="modal" data-target="#myModal">
                            Tambah
                        </button>

                        <div class="card mb-4">
                            <div class="card-body">
                                <table class="table table-bordered" id="datatablesSimple" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Service</th>
                                            <th>Harga</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    <?php
                                    $get = mysqli_query($conn, "select * from service");
                                    $i = 1;

                                    while($s=mysqli_fetch_array($get)){
                                    $kategori = $s['kategori'];
                                    $itemname = $s['itemname'];
                                    $harga = $s['harga'];
                                    $idservice = $s['idservice'];

                                    ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$kategori;?></td>
                                            <td><?=$itemname;?></td>
                                            <td><?=number_format($harga);?></td>
                                            <td>
                                            <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#edit<?=$idservice;?>">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete<?=$idservice;?>">                                 
                                                Delete
                                            </button>
                                            </td>
                                        </tr>
                                        
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="edit<?=$idservice;?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Data Service</h4>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <form class="forms-sample" action=""  method="POST" role="form" onsubmit="return confirm('Yakin Simpan?')">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Kategori:</label>
                                                    <div class="col-sm-12">
                                                        <select name="kategori" id="select" class="form-control">
                                                            <option><?=$kategori;?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Service:</label>
                                                    <div class="col-sm-12">
                                                    <input type="text" name="itemname" class="form-control" value="<?=$itemname;?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Harga:</label>
                                                    <div class="col-sm-12">
                                                    <input type="num" name="harga" class="form-control" value="<?=number_format($harga);?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <input type="hidden" name="ids" value="<?=$idservice;?>">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-outline-success" name="editservice">Update</button>
                                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                                            </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>

                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="delete<?=$idservice;?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data Service</h4>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <form method="POST" role="form">
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus <b>Service <?=$itemname;?>?</b>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                    <input type="hidden" name="ids" value="<?=$idservice;?>">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-outline-success" name="deleteservice">Yakin</button>
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

  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Service</h4>
        </div>
        
        <!-- Modal body -->
        <form class="forms-sample" action=""  method="POST" role="form" onsubmit="return confirm('Yakin Simpan?')">
        <div class="modal-body">
            <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Kategori:</label>
                <div class="col-sm-12">
                    <select name="kategori" id="select" class="form-control">
                        <option value="Hair Cut & Wash">Hair Cut & Wash</option>
                        <option value="Colour & Bleach">Colour & Bleach</option>
                        <option value="Cornrows & Dreadlock">Cornrows & Dreadlock</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Service:</label>
                <div class="col-sm-12">
                <input type="text" name="itemname" class="form-control">
                </div>
            </div>
            <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Harga:</label>
                <div class="col-sm-12">
                <input type="num" name="harga" class="form-control">
                </div>
            </div>

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
        </div>
        </form>
      </div>
    </div>
  </div>

</html>
