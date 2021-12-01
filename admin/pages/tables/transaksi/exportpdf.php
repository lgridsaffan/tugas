<?php
include '../../../../helper/connection.php';

$tanggal1 = $_POST['tanggal1'];
$tanggal2 = $_POST['tanggal2'];

$query = 
    "select t.id_transaksi,c.nama_customer,b.judul_buku,t.tgl_transaksi,t.jumlah,t.total from transaksi t,customer c,buku b
    where t.id_customer = c.id_customer AND
    b.id_buku = t.id_buku WHERE t.tgl_transaksi BETWEEN {$tanggal1} AND {$tanggal2}";

$result = mysqli_query($con, $query);



?>