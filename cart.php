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
	<link href='images/logo.png' rel='SHORTCUT ICON' />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP"
	 crossorigin="anonymous">
	 <style>
		.logout {
			margin-left: 10px;
			color: black;
		}
	</style>
</head>

<?php 
include 'helper/connection.php';
session_start(); 

$id_customer = $_SESSION['id_customer'];
$query = "SELECT * from customer where id_customer = '$id_customer'";

$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

$nama = $row['nama_customer'];

?>

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
											<li>Shopping Cart</li>
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

		<br><br>

		<div class="col-lg-8 offset-lg-2">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Buku</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Subharga</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if(isset($_SESSION["keranjang"]))
						{
							$total = 0;
							$nomor = 1;
							foreach ($_SESSION["keranjang"] as $id_buku => $jumlah){
							
							$ambil = $con->query("SELECT * FROM buku WHERE id_buku='$id_buku'");
							$pecah = $ambil->fetch_assoc();
							$subharga =$pecah["harga"]*$jumlah;
							$total += $subharga;
						?>
					<tr>
						<td>
							<?php echo $nomor; ?>
						</td>
						<td>
							<?php echo $pecah['judul_buku']; ?>
						</td>
						<td>Rp.
							<?php echo number_format($pecah['harga']); ?>
						</td>
						<td>
							<?php echo $jumlah; ?>
						</td>
						<td>Rp.
							<?php echo number_format($subharga); ?>
						</td>
						<td width='50px'>
							<div class="button"><a href="process/delete-cart.php?id_buku=<?php echo $id_buku; ?>">Hapus</a></div>
						</td>
					</tr>
					<?php
					$nomor++;
					?>
					<?php }
							}
							else
							{
								echo "
								<tr>
									<td colspan='6'>Tidak Ada Data</td>
								</tr>";
							} ?>
				</tbody>
			</table>

			<br><br>

			<div class="row row_cart_buttons">
				<div class="col">
					<div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
						<div class="button continue_shopping_button"><a href="index.php#produk">Continue shopping</a></div>
						<?php if(isset($_SESSION["keranjang"])){ ?>
						<div class="cart_buttons_right ml-lg-auto">
							<div class="button clear_cart_button"><a href="process/clear-cart.php">Clear cart</a></div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>

		<br><br>

		<?php if(isset($_SESSION["keranjang"])){ ?>
		<div class="col-lg-8 offset-lg-2">
			<div class="cart_total">
				<div class="section_title">Cart total</div>
				<div class="section_subtitle">Final info</div>
				<div class="cart_total_container">
					<ul>
						<li class="d-flex flex-row align-items-center justify-content-start">
							<div class="cart_total_title">Total</div>
							<div class="cart_total_value ml-auto">Rp.
								<?php echo $total;?>,-</div>
						</li>
					</ul>
				</div>
				<br>
				<div class="button checkout_button"><a href="#" data-toggle="modal" data-target="#exampleModal">Proceed to checkout</a></div>

				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Bukti Pembayaran</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="process/input-cart.php" method="POST" enctype="multipart/form-data">
						<div class="modal-body">
							<p>
								Silakan transfer ke no. rek berikut : 198273824827397 
								<br>
								Atas nama Bambank Supratman
							</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary">Proses</button>
						</div>
					</form>
					</div>
				</div>
				</div>
			</div>
		</div>
		<?php } ?>

		<br><br>

		<!-- Footer -->

<?php include 'view/footer.php'; ?>