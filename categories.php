<!DOCTYPE html>
<html lang="en">

<head>
	<title>Genre</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Sublime project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="styles/categories.css">
	<link rel="stylesheet" type="text/css" href="styles/categories_responsive.css">
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

$kategori_terpilih = $_GET['id_kategori'];
$query2 = "SELECT * FROM kategori where id_kategori = '$kategori_terpilih'";

$result = mysqli_query($con, $query2);
$row2 = mysqli_fetch_assoc($result);

$namakategori = $row2['nama_kategori'];

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
									<div class="home_title">Buku
										<?php echo $namakategori; ?><span>.</span></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Products -->

		<div class="products">
			<div class="container">
				<div class="row">
					<div class="col">
						<?php 
							$query = 
							"select * from buku b,pengarang p
							where b.id_pengarang = p.id_pengarang AND b.id_kategori = '$kategori_terpilih'";
							
							$result = mysqli_query($con, $query); 
						?>
						<!-- Product Sorting -->
						<div class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">
							<div class="results">Showing <span><?= mysqli_num_rows($result); ?></span> results</div>
							<div class="sorting_container ml-md-auto">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col">

						<div class="product_grid">

							<!-- Product -->
							<?php

								if (mysqli_num_rows($result) > 0)
								{
									$index = 1;

									while($row = mysqli_fetch_assoc($result))
									{
										$id_buku = $row['id_buku'];
										echo "
										<div class='product'>
											<div class='product_image'><img src='images/". $row['gambar'] ."' alt=''></div>
											<div class='product_content'>
												<div class='product_title'><a href='product.php?id_buku=$id_buku'>".$row['judul_buku']."</a></div>
												<div class='product_price'>Rp.".$row['harga'].",-</div>
												<br>
												<div class='nmpengarang'>".$row['nama_pengarang']."</div>
											</div>
										</div>
										";
									}
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Icon Boxes -->

		<div class="icon_boxes">
			<div class="container">
				<div class="row icon_box_row">

					<!-- Icon Box -->
					<div class="col-lg-4 icon_box_col">
						<div class="icon_box">
							<div class="icon_box_image"><img src="images/icon_1.svg" alt=""></div>
							<div class="icon_box_title">Gratis Ongkir Se-Jawa</div>
							<div class="icon_box_text">
								<p>Gratis Ongkir Pulau Jawa Non Minimum Selama Periode Desember 2021.</p>
							</div>
						</div>
					</div>

					<!-- Icon Box -->
					<div class="col-lg-4 icon_box_col">
						<div class="icon_box">
							<div class="icon_box_image"><img src="images/icon_2.svg" alt=""></div>
							<div class="icon_box_title">Gratis Pengembalian</div>
							<div class="icon_box_text">
								<p>Khawatir buku tidak cocok? Jangan khawatir, karena apapun alasannya return di Tri Sukma gratis & mudah!</p>
							</div>
						</div>
					</div>

					<!-- Icon Box -->
					<div class="col-lg-4 icon_box_col">
						<div class="icon_box">
							<div class="icon_box_image"><img src="images/icon_3.svg" alt=""></div>
							<div class="icon_box_title">24 Jam Customer Service</div>
							<div class="icon_box_text">
								<p>Hubungi Kami di 00000000</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php include 'view/footer.php'; ?>