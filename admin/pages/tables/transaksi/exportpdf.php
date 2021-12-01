<?php
session_start();
include '../../../../helper/connection.php';
if(!isset($_POST['tanggal1']) || !isset($_POST['tanggal2'])){
    header("location:tabel_transaksi.php");
}

// mpdfnya
require_once __DIR__ . '/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$tanggal1 = $_POST['tanggal1'];
$tanggal2 = $_POST['tanggal2'];

$query = "select t.id_transaksi,c.nama_customer,b.judul_buku,t.tgl_transaksi,t.jumlah,t.total from transaksi t,customer c,buku b
    where t.id_customer = c.id_customer AND
    b.id_buku = t.id_buku AND t.tgl_transaksi BETWEEN '{$tanggal1}' AND '{$tanggal2}'";

$result = mysqli_query($con, $query);

ob_start();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"></head>
    <h1 class="text-center">Laporan Transaksi</h1>
    <div class="text-center"><b>Periode : <?php echo $tanggal1 . " - " . $tanggal2 ?></b></div>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Customer</th>
                <th>Judul Buku</th>
                <th>Tanggal Transaksi</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
    
<?php
if (mysqli_num_rows($result) > 0)
{
    $index = 1;

    while($row = mysqli_fetch_assoc($result))
    {
        $id_transaksi = $row['id_transaksi'];
        echo "
        <tr>
            <td>" . $index++ . "</td>
            <td>" . $row["nama_customer"] . "</td>
            <td>" . $row["judul_buku"] . "</td>
            <td>" . $row["tgl_transaksi"] . "</td>
            <td>" . $row["jumlah"] . "</td>
            <td>Rp." . $row["total"] . ",-</td>
        </tr>
        ";
    }
}

mysqli_close($con);

?> 
        </tbody>
    </table>
<?php
$html = ob_get_contents();
ob_end_clean();
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output();
?>