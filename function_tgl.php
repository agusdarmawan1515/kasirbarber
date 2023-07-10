<?php
//inputtanggal
function Inputtgl($tanggal){
    $pisah = explode('/', $tanggal);
    $lari = array($pisah[2], $pisah[1], $pisahh[0]);
    $satukan = implode("-", $lari);

    return $satukan;
}
?>