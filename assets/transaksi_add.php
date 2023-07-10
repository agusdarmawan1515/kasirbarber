<?php

require '../ceklogin.php';

$service = mysqli_query($conn, "select * from service");
$cust = mysqli_query($conn, "select * from customer");

$i = 1;
$datenow = date('Y-m-d');
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
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>Login: y</a>
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
                <div class="content-wrapper">
                            <div class="page-header mb-4">

                            </div>
                            <div class="row">
                            <div class="col-lg-3 grid-margin stretch-card">
                                <div class="card mb-4">
                                <div class="card-body">
                                    <form method="post" name="serv" action="transaksi_act.php" onsubmit="return validateForm()">
                                    <!--<h4 class="card-title"></h4>-->
                                    <div class="form-group">
                                    <p class="card-description">Tanggal</p>
                                    <input type="date" class="form-control" data-date-format="DD/MMM/YYYY" name="transdate" value="<?=$datenow;?>">
                                    </div>

                                    <div class="form-group">
                                    <p class="card-description">No. Invoice</p>
                                    <input type="text" class="form-control" name="noinvoice" value="JL230600002">
                                    </div>

                                    <div class="form-group">
                                         
                                        <p class="card-description"><button type="button" class="btn btn-primary btn-sm mt-2" data-toggle="modal" data-target="#myModal">Cari Customer<span class="glyphicon glyphicon-search"></span></button></p>
                                        <div class="row">
                                            <div class="col-md-12">
                                            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                                                <input type="hidden" class="form-control" name="idcustomer" id="idcustomer" value="<?=$value['idcustomer']?>">
                                                <input type="text" class="form-control" name="namacust" id="namacust" placeholder="Nama Customer" value="<?=$value['namacust']?>"><br>
                                                <input type="text" class="form-control" name="notelpcust" id="notelpcust" placeholder="No. HP/Telp" value="<?=$value['notelpcust']?>"><br>             
                                            <?php } ?>
                                             
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cari Customer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="lookup_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="lookup_length"><label>Show <select name="lookup_length" aria-controls="lookup" class="form-select form-select-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="lookup_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="lookup"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="lookup" class="table table-hover bg-white dataTable no-footer" aria-describedby="lookup_info">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center sorting sorting_asc" tabindex="0" aria-controls="lookup" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No.: activate to sort column descending" style="width: 0px;">No.</th>
                                                        <th class="sorting" tabindex="0" aria-controls="lookup" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 0px;">Nama</th>
                                                        <th class="sorting" tabindex="0" aria-controls="lookup" rowspan="1" colspan="1" aria-label="No. HP / Telp: activate to sort column ascending" style="width: 0px;">No. HP / Telp</th>
                                                        <th class="text-center sorting" tabindex="0" aria-controls="lookup" rowspan="1" colspan="1" aria-label="Opsi: activate to sort column ascending" style="width: 0px;">Opsi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php while ($row = mysqli_fetch_array($cust)) { ?>             
                                                    <tr class="pilih" data-custid="<?=$row['idcustomer']?>" data-custname="<?=$row['namacust']?>" data-phone="<?=$row['notelpcust']?>">
                                                    <td align="center" class="sorting"><?=$i++;?></td>
                                                    <td><b><?=$row['namacust']?></b></td>
                                                    <td><b><?=$row['notelpcust']?></b></td>
                                                    <td align="center"><a class="btn btn-info" href="transaksi_add.php?<?=$row['idcustomer']?>">Pilih</a></td>
                                                <?php } ?>    

                                                    

                                                </tbody>
                                            </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="lookup_info" role="status" aria-live="polite">Showing 1 to 4 of 4 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="lookup_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="lookup_previous"><a href="#" aria-controls="lookup" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="lookup" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="lookup_next"><a href="#" aria-controls="lookup" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>                    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>           
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- End Modal -->


                                    

                                </form></div>

                                </div>
                            </div>
                            <div class="col-lg-9 grid-margin stretch-card">
                                <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Buat Transaksi</h4>
                                    <a href="reset_trx.php"><button type="button" class="btn btn-inverse-warning">Reset</button></a>
                                    <button type="button" class="btn btn-inverse-danger" data-toggle="modal" data-target="#carijasa">Cari Jasa</button>
                                    <!-- Modal jasa-->
                                    <div class="modal fade" id="carijasa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" style="width:50%;">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cari Jasa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            </div>
                                            
                                            <div class="modal-body">
                                            <div class="table-responsive">
                                                <div id="tablejasa_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="tablejasa_length"><label>Show <select name="tablejasa_length" aria-controls="tablejasa" class="form-select form-select-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="tablejasa_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="tablejasa"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="table bg-white dataTable no-footer" id="tablejasa" aria-describedby="tablejasa_info">
                                                <thead>
                                                    <tr><th class="text-center sorting sorting_asc" tabindex="0" aria-controls="tablejasa" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No.: activate to sort column descending" style="width: 0px;">No.</th><th class="sorting" tabindex="0" aria-controls="tablejasa" rowspan="1" colspan="1" aria-label="Itemname: activate to sort column ascending" style="width: 0px;">Itemname</th><th class="text-right sorting" tabindex="0" aria-controls="tablejasa" rowspan="1" colspan="1" aria-label="Harga: activate to sort column ascending" style="width: 0px;">Harga</th><th class="text-center sorting" tabindex="0" aria-controls="tablejasa" rowspan="1" colspan="1" aria-label="OPSI: activate to sort column ascending" style="width: 0px;">OPSI</th></tr>
                                                </thead>
                                                <tbody>                                                                                   
                                                <?php while ($row = mysqli_fetch_array($service)) { ?>             
                                                    <tr data-nim="<?=$row['itemname']?>" class="odd">
                                                    <td align="center" class="sorting_1"><?=$i++;?></td>
                                                    <td><b><?=$row['itemname']?></b></td>
                                                    <td align="right"><b><?=$row['harga']?></b></td>
                                                    <td align="center"><a href="transaksi_add.php?<?=$row['idservice']?>" class="btn btn-outline-danger btn-fw btn-sm">Pilih</a></td>
                                                <?php } ?>                                                                                                                      
                                                </tbody>
                                                </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="tablejasa_info" role="status" aria-live="polite">Showing 1 to 4 of 4 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="tablejasa_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="tablejasa_previous"><a href="#" aria-controls="tablejasa" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="tablejasa" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="tablejasa_next"><a href="#" aria-controls="tablejasa" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
                                                
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                                            
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <!-- End Modal jasa -->
                                    
                                    <div class="row">
                      <div class="col-12">
                        <div class="table-responsive pt-3">
                          <table class="table" border="0">
                            <thead>
                              <tr>
                                <th>No.</th>
                                <th>Itemname</th>
                                <th>Qty</th>
                                <th class="text-right">Harga</th>
                                <th class="text-right">Total Harga</th>
                                <th class="text-center">Opsi</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                                <tr>
                                <td><?=$i++;?><input type="hidden" name="id[]" value="404"></td>
                                <td><?=$value['itemname']?></td>
                                <td align="center"><input type="number" class="form-control" name="qty[]" id="qty" required="required" value="<?=$value['qty']?>"><input type="hidden" name="itemcost[]" value="0"></td>
                                <td align="right"><?=$value['harga']?><input type="hidden" class="form-control" name="itemprice[]" id="itemprice" value="5000"><input type="hidden" class="form-control" name="komisisalesperitem[]" value="0"></td>
                                <td align="right"><?=$value['qty']*$value['harga']?></td>
                                <td align="center">
                                <a href="salesinfo_deldummy.php?id=404" class="btn btn-inverse-danger">x</a>
                                </td>
                                </tr>
                             <?php } ?>
                
                                                            <tr>
                                <td colspan="2"></td>
                                <td><input type="submit" id="submitadd" name="submitadd" class="btn btn-inverse-info" value="Update Qty"></td>
                              <td align="right"><b>Total</b><br>
                              </td><td align="right"><b> 5,000</b>                              <input type="hidden" class="form-control" name="totalsales" id="totalsales" required="required" value="5000"></td>
                              <td></td>
                              </tr>
                                <tr><td colspan="4" align="right"><input type="button" id="showbayar" name="showbayar" class="btn btn-sm btn-warning mr-1" value="P"><b>Bayar</b></td>
                                <td><input type="number" class="form-control" name="bayar" id="bayar" onkeyup="sum();"></td>
                                <td></td>
                              </tr>
                              <tr>
                              <td colspan="4" align="right">
                                <label id="labelkembali"><b>Kurang/Kembali</b></label>
                             </td>
                                <td><input type="hidden" class="form-control" name="kembali" id="kembali" readonly="">
                                   <input type="text" class="form-control" name="kembalishow" id="kembalishow"></td>
                                  <td></td>
                              </tr>
                              <tr>
                              <td colspan="4" align="right">
                                <b>Jenis Pembayaran</b></td>
                                <td>
                                  <select name="jenisbayar" id="select" class="form-control">  
                                                                          <option value="Cash">Cash</option>                
                                                                            <option value="EDC">EDC</option>                
                                                                            <option value="Transfer">Transfer</option>                
                                          
                                  </select>   
                                </td>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>

                        <div class="row">
                          <div class="col-12">
                            <div class="form-group">
                              <p class="card-description">Nama Barberman</p>
                              <select class="form-control" name="sales" readonly="readonly">
                                                                        <option value="62">Agus</option>                     
                                                                            <option value="2">Andre</option>                     
                                                                            <option value="63">budi</option>                     
                                                                            <option value="61">Mr. Joni</option>                     
                                          
                              </select>
                              
                            </div> 

                            <div class="form-group">
                              <p class="card-description">Keterangan</p>
                              <textarea class="form-control" name="notes" rows="3"></textarea>
                            </div>
                          </div>
                          
                        </div>

                        <div class="row">
                          <div class="col-12">
                            <input type="submit" id="submitsave" name="submitsave" class="btn btn-primary" value="Simpan"> 

                          </div>
                        </div>




                      </div> <!-- end col 12 -->
                    </div>
                                    </div>
                                </div>

                                </div>
                            </div>
                            
                            
                            
                            
                            </div><!-- end row -->
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
