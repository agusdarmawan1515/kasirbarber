<?php

require '../ceklogin.php';
$service = mysqli_query($conn, "select * from service");
$cust = mysqli_query($conn, "select * from customer");
$karyawan = mysqli_query($conn, "select * from karyawan");

$sum = 0;
if(isset($_SESSION['cart'])){
    foreach ($_SESSION['cart'] as $key => $value) {
        $sum += $value['harga']*$value['qty'];
    }
}

$i = 1;
$datenow = date('Y-m-d');
$noinv = 'JL';
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

    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Aplikasi Barber</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-auto me-0 me-md-3 my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>Login: yaa</a>
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
                        <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Data Transaksi</h4>
                            <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 mb-3 col-form-label">Tanggal:</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control" data-date-format="DD/MMM/YYYY" name="transdate" value="<?=$datenow;?>">
                                </div>
                            <label for="exampleInputUsername2" class="col-sm-3 mb-3 col-form-label">No. Invoice:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="noinvoice" value="<?=$noinv;?>">
                                </div>
                            <label for="exampleInputUsername2" class="col-sm-3 mb-2 col-form-label">Cari Customer:</label>
                                <div class="col-sm-9">
                                <select name="idcust" class="form-control" required>
                                    <option value="">Pilih Customer</option>   
                                    <?php while ($row = mysqli_fetch_array($cust)) { ?>             
                                    <option value="<?=$row['idcustomer']?>"><?=$row['namacust']?></option>      
                                    <?php } ?>                          
                                </select>
                                </div>
                            </div>
                            <form class="forms-sample" action="transaksi_act.php" method="post">    
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 mb-2 col-form-label">Cari Service:</label>
                                <div class="col-sm-9">
                                <select name="idserv" class="form-control" required>
                                    <option value="">Pilih Service</option>   
                                    <?php while ($row = mysqli_fetch_array($service)) { ?>             
                                    <option value="<?=$row['idservice']?>"><?=$row['itemname']?></option>      
                                    <?php } ?>                          
                                </select>
                                <span class="input-group-btn">
                                    <button class="btn btn-primary btn-sm mb-3 mt-3" type="submit">Tambah</button>
                                </span>
                                </div>
                            </div> 
                            </form>
                            <form method="post" action="update_trx.php">
                            <div class="table-responsive pt-3">
                            <table class="table" border="0">                
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Itemname</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                        <th class="text-center">Opsi</th>
                                    </tr>
                                </thead>
                                    <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$value['itemname']?></td>
                                            <td align="center" class="col-md-2"><input type="number" name="qty[]" value="<?=$value['qty']?>" class="form-control"></td>
                                            <td align="right"><?=number_format($value['harga'])?></td>
                                            <td align="right"><?=number_format($value['qty']*$value['harga'])?></td>
                                            <td align="center"><a href="hapus_trx.php?id=<?=$value['idservice']?>" class="btn btn-danger btn-sm">x</a></td>
                                        </tr>
                                    <?php } ?>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td><input type="submit" id="submitadd" name="submitadd" class="btn btn-outline-dark" value="Update Qty"></td>
                                            <td align="right">Total</td>
                                            <br>
                                            <td align="right"><b>Rp. <?=number_format($sum)?></b><input type="hidden" class="form-control" name="totalsales" id="totalsales" required="required" value="<?=$sum?>"></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>                          
                                        <tr>
                                            <td colspan="4" align="right"><input type="button" id="showbayar" name="showbayar" class="btn btn-sm btn-warning" value="P"><b>Bayar</b></td>
                                            <td><input type="number" class="form-control" name="bayar" id="bayar" onkeyup="sum();"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" align="right">
                                                <label id="labelkembali"><b>Kurang/Kembali</b></label>
                                            </td>
                                            <td><input type="hidden" class="form-control" name="kembali" id="kembali" readonly>
                                                <input type="text" class="form-control" name="kembalishow" id="kembalishow"></td>
                                            <td></td>
                                        </tr>
                                </div>
                            </table>  
                            </form>
                            <br>
                            <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 mb-2 col-form-label">Nama Barberman</label>
                                <div class="col-sm-9">
                                <select name="idkar" class="form-control" required>
                                    <?php while ($row = mysqli_fetch_array($karyawan)) { ?>             
                                    <option value="<?=$row['idkaryawan']?>"><?=$row['namakar']?></option>      
                                    <?php } ?>                          
                                </select>
                                </div>
                            <label for="exampleInputUsername2" class="col-sm-3 mb-2 col-form-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="notes" rows="3"></textarea>
                                </div>
                            </div>
                            <br>
                        </div>
                      </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-9"> 
                        <button type="submit" name="tambahtrx" class="btn btn-success mr-2">Simpan</button>
                        <a type="button" class="btn btn-danger" href="reset_trx.php">Reset</a>
                        </div>
                    </div>
                    <br>
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

        <script type="text/javascript">
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
                document.getElementById('labelkembali').innerHTML = "Kembali";
            } else if (parseInt(txtSecondNumberValue) <= parseInt(txtFirstNumberValue)) {
                document.getElementById('labelkembali').innerHTML = "Kurang";
            }
        };
</script>
    </body>
</html>
 