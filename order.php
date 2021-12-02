<?php 
include 'helper/connection.php';
session_start(); 

$id_customer = $_SESSION['id_customer'];
$query = "SELECT * from customer where id_customer = '$id_customer'";

$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$nama = $row['nama_customer'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Cart</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Sublime project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="styles/cart.css">
	<link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP"
	 crossorigin="anonymous">
	<link href='images/logo.png' rel='SHORTCUT ICON' />
	<style>
		.logout {
			margin-left: 10px;
			color: black;
		}
	</style>
</head>

<?php include 'view/header.php'; ?>

		<!-- Home -->

		<div class="home">
			<div class="home_container">
				<div class="home_background" style="background-image:url(images/cover.jpg)"></div>
				<div class="home_content_container">
					<div class="container">
						<div class="row">
							<div class="col">
								<div class="home_content">
									<div class="breadcrumbs">
										<ul>
											<li><a href="index.php">Home</a></li>
											<li>Orders</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Cart Info -->

		<div class="cart_info">
			<div class="container">
				<p> Silahkan hubungi nomer <a href="https://wa.me/082229019220">admin</a> untuk menanyakan seputar orderan anda.</p>
				<div class="row">
					<div class="col">
						<table id="tabell" class="table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>ID Transaksi</th>
									<th>Judul Buku</th>
									<th>Tanggal Transaksi</th>
									<th>Jumlah</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<?php
                                            $query = 
                                            "SELECT * FROM transaksi t,buku b where t.id_customer='$id_customer' AND t.id_buku = b.id_buku";
                                            
                                            $result = mysqli_query($con, $query);

                                            if (mysqli_num_rows($result) > 0)
                                            {
                                                $index = 1;

                                                while($row = mysqli_fetch_assoc($result))
                                                {
                                                    $id_buku = $row['id_buku'];
                                                    echo "
                                                    <tr>
                                                        <td>" . $index++ . "</td>
                                                        <td>" . $row["id_transaksi"] . "</td>
                                                        <td>" . $row["judul_buku"] . "</td>
                                                        <td>" . $row["tgl_transaksi"] . "</td>
                                                        <td>" . $row["jumlah"] . "</td>
                                                        <td>Rp." . $row["total"] . ",-</td>
                                                    </tr>
                                                    ";
                                                }
                                            }
                                            else
                                            {
                                                echo "<tr>
                                                <td colspan='7'>Maaf, anda belum pernah bertransaksi.</td>
                                                </tr>";
                                            }

                                            mysqli_close($con);
                                            ?>
							</tbody>
						</table>

						<br><br>

						<!-- Footer -->

						<?php include 'view/footer.php'; ?>