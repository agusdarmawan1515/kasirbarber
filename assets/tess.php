<?php

require '../ceklogin.php';

$service = mysqli_query($conn, "select * from service");
$cust = mysqli_query($conn, "select * from customer");
$karyawan = mysqli_query($conn, "select * from karyawan");

$n = 1;
$j = 1;
$i = 1;
$datenow = date('Y-m-d');

$sum = 0;
if(isset($_SESSION['cart'])){
    foreach ($_SESSION['cart'] as $key => $value) {
        $sum += $value['harga']*$value['qty'];
    }
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

        <script>
        function sum() {
            var txtFirstNumberValue = document.getElementById('totalsales').value;
            var txtSecondNumberValue = document.getElementById('bayar').value;
            var result =  parseInt(txtSecondNumberValue) - parseInt(txtFirstNumberValue);
            if (!isNaN(result)) {
                document.getElementById('kembali').value = result;
            }

            let number = Math.abs(result);
            let nf = new Intl.NumberFormat('en-US');
            nf.format(number);
            document.getElementById('kembalishow').value =nf.format(number);

            if (parseInt(txtSecondNumberValue) > parseInt(txtFirstNumberValue)) {
                document.getElementById('labelkembali').innerHTML = "<b>Kembali</b>";
            } else if (parseInt(txtSecondNumberValue) <= parseInt(txtFirstNumberValue)) {
                document.getElementById('labelkembali').innerHTML = "<b>Kurang</b>";
            }
        }
        </script>
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
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>Login: Admin</a>
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
                            <div class="card">
                                <div class="card-body">
                                <form method="post" name="myForm" action="transaksi_act.php" onsubmit="return validateForm()">
                                <!--<h4 class="card-title"></h4>-->
                                    <div class="form-group">
                                    <p class="card-description">Tanggal</p>
                                    <input type="date" class="form-control" data-date-format="DD/MMM/YYYY" name="transdate" value="<?=$datenow?>">
                                </div>
                                <div class="form-group">
                                    <p class="card-description">No. Invoice</p>
                                    <input type="text" class="form-control"  name="noinvoice" value="JL230700001" readonly>
                                </div>
                                <div class="form-group">    
                                    <p class="card-description"><button type="button" class="btn btn-outline-primary mt-3" data-toggle="modal" data-target="#myModal">Cari Customer<span class="glyphicon glyphicon-search"></span></button></p>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <input type="hidden" class="form-control" name="custid" id="custid">
                                            <input type="text" class="form-control" name="custname" id="custname" placeholder="Nama Customer" value="" readonly><br/>
                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="No. HP/Telp" value="" readonly><br/>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cari Customer</h5>
                                        </div>       
                                        <div class="modal-body">    
                                            <table id="lookup" class="table table-hover bg-white">
                                            <thead>
                                                <tr>
                                                <th class="text-center">No.</th>
                                                <th>Nama</th>
                                                <th>No. HP / Telp</th>
                                                <th class="text-center">Opsi</th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                <?php while ($row = mysqli_fetch_array($cust)) { ?>
                                                    <tr class="pilih" data-custid="<?=$row['idcustomer']?>" data-custname="<?=$row['namacust']?>" data-phone="<?=$row['notelpcust']?>">
                                                        <td align="center"><?=$n++;?></td>
                                                        <td><b><?=$row['namacust']?></b></td>
                                                        <td><b><?=$row['notelpcust']?></b></td>
                                                        <td align="center"> <a href="salesinfo_cari_add.php?id=<?=$row['idcustomer']?>" class="btn btn-outline-danger btn-fw btn-sm">Pilih</a>    
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>                                    
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Tutup</button>                       
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <!-- End Modal -->                              
                                </div>
                            </div>
                            </div>
                            <div class="col-lg-9 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                <h4 class="card-title">Buat Transaksi</h4>
                                <a href="salesinfo_reset.php"><button type="button" class="btn btn-outline-warning">Reset</button></a>
                                <button type="button" class="btn btn-outline-danger"  data-toggle="modal" data-target="#carijasa">Cari Jasa</button><br><br>
                                <!-- Modal jasa-->
                                    <div class="modal fade" id="carijasa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" style="width:50%;">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cari Jasa</h5>  
                                        </div>         
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                            <table  class="table bg-white" id="tablejasa">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">No.</th>
                                                    <th>Itemname</th>
                                                    <th class="text-right">Harga</th>
                                                    <th class="text-center">OPSI</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php while ($row = mysqli_fetch_array($service)) { ?>
                                                    <tr data-nim="<?=$row['itemname']?>">
                                                        <td align="center"><?=$j++;?></td>
                                                        <td><b><?=$row['itemname']?></b></td>
                                                        <td align="right"><b>Rp. <?=number_format($row['harga'])?></b></td>
                                                        <td align="center"><a href="salesinfo_cari_add.php?id=<?=$row['idservice']?>" class="btn btn-outline-danger btn-fw btn-sm">Pilih</a></td>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Tutup</button>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- End Modal jasa -->

                                <div class="row">
                                    <div class="col-12">
                                    <div class="table-responsive pt-3">
                                        <table class="table"  border="0">                                   
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
                                        <?php
                                        foreach ($_SESSION['cart'] as $key => $value) { ?>
                                            <tr>
                                                <td><?=$i++;?><input type="hidden" name="id[]" value=""></td>
                                                <td><?=$value['itemname']?></td>
                                                <td align="center"><input type="number" class="form-control" name="qty[]" id="qty"  required="required" value="<?=$value['qty']?>" ><input type="hidden" name="itemcost[]" value="<?=$value['qty']?>"></td>   
                                                <td align="right"><?=number_format($value['harga'])?><input type="hidden" class="form-control" name="itemprice[]" id="itemprice" value="<?=$value['harga']?>" ><input type="hidden" class="form-control" name="komisisalesperitem[]" value="0" ></td>
                                                <td align="right"><?=number_format($value['qty']*$value['harga'])?></td>
                                                <td align="center">
                                                <a href="salesinfo_deldummy.php?id=422" class="btn btn-danger btn-sm">x</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td><input type="submit" id="submitadd" name="submitadd" class="btn btn-outline-dark" value="Update Qty"></td>
                                                <td align="right"><b>Total</b><br>
                                                <td align='right'><b>Rp. <?=number_format($sum)?></b><input type="hidden" class="form-control" name="totalsales" id="totalsales" required="required" value="<?=$sum?>"></td>
                                                <td></td>
                                                </tr>
                                                <td colspan="4" align="right"><input type="button" id="showbayar" name="showbayar" class="btn btn-sm btn-dark mr-1" value="P"><b>Bayar</b></td>
                                                <td><input type="number" class="form-control" name="bayar" id="bayar"  onkeyup="sum();"></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" align="right">
                                                <label id="labelkembali"><b>Kurang/Kembali</b></label>
                                                </td>
                                                <td><input type="hidden" class="form-control" name="kembali" id="kembali">
                                                <input type="text" class="form-control" name="kembalishow" id="kembalishow" readonly></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                        <div class="form-group">
                                            <p class="card-description">Nama Barberman</p>
                                            <select class="form-control" name="sales" class="form-control" readonly="readonly">
                                            <?php while ($row = mysqli_fetch_array($karyawan)) { ?>             
                                                <option value="<?=$row['idkaryawan']?>"><?=$row['namakar']?></option>      
                                            <?php } ?>                                                  
                                            </select>  
                                        </div> 
                                        <div class="form-group mt-3">
                                            <p class="card-description">Keterangan</p>
                                            <textarea class="form-control" name="notes" rows="3"></textarea>
                                        </div>
                                        </div>       
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-3">
                                        <input type="submit" id="submitsave" name="submitsave" class="btn btn-outline-success" value="Simpan"> 
                                        </div>
                                    </div>
                                    </div> <!-- end col 12 -->
                                </div>
                                </div>
                            </div>
                            </div>
                            </form>
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

        <script>
        $(document).ready(function() {
        $('#tablejasa').DataTable();
        } );
        </script>

        <script type="text/javascript">
        //jika dipilih, masuk ke input dan modal di tutup
        $(document).on('click', '.pilih', function (e) {
        document.getElementById("custid").value = $(this).attr('data-custid');
        document.getElementById("custname").value = $(this).attr('data-custname');
        document.getElementById("phone").value = $(this).attr('data-phone');
        $(".close").click();
        $('#myModal').modal('hide');
        });

        //tabel lookup 
        $(function () {
        $("#lookup").dataTable();
        });

        document.getElementById('showbayar').onclick = function() {
      
        document.getElementById('bayar').value = document.getElementById("totalsales").value ;

        var txtFirstNumberValue = document.getElementById('totalsales').value;
        var txtSecondNumberValue = document.getElementById('bayar').value;
        var result =  parseInt(txtSecondNumberValue) - parseInt(txtFirstNumberValue);
        if (!isNaN(result)) {
            document.getElementById('kembali').value = result;
        }

        let number = Math.abs(result);
        let nf = new Intl.NumberFormat('en-US');
        nf.format(number);
        document.getElementById('kembalishow').value =nf.format(number);

        if (parseInt(txtSecondNumberValue) > parseInt(txtFirstNumberValue)) {
            document.getElementById('labelkembali').innerHTML = "<b>Kembali</b>";
        } else if (parseInt(txtSecondNumberValue) <= parseInt(txtFirstNumberValue)) {
            document.getElementById('labelkembali').innerHTML = "<b>Kurang</b>";
        }
        };
        </script>
    </body>
</html>
