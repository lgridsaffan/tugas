<?php
include '../../../../helper/connection.php';

$tanggal1 = $_POST['tanggal1'];
$tanggal2 = $_POST['tanggal2'];

$query = "select t.id_transaksi,c.nama_customer,b.judul_buku,t.tgl_transaksi,t.jumlah,t.total from transaksi t,customer c,buku b
    where t.id_customer = c.id_customer AND
    b.id_buku = t.id_buku AND t.tgl_transaksi BETWEEN '{$tanggal1}' AND '{$tanggal2}'";

$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0)
{
    $index = 1;

    while($row = mysqli_fetch_assoc($result))
    {
        $id_transaksi = $row['id_transaksi'];
        echo "
        <tr>
            <td>" . $index++ . "</td>
            <td>" . $row["id_transaksi"] . "</td>
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