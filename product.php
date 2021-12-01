<!DOCTYPE html>
<html lang="en">

<head>
	<title>Product</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Sublime project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
	<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="styles/product.css">
	<link rel="stylesheet" type="text/css" href="styles/product_responsive.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP"
	 crossorigin="anonymous">
	<link href='images/logo.png' rel='SHORTCUT ICON' />
	<link rel="icon" type="image/png" href="images/logo.png">
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

$id_buku = $_GET['id_buku'];

?>

<?php include 'view/header.php'; ?>
		<!-- Product Details -->

		<div class="product_details">
			<div class="container">
				<div class="row details_row">

					<?php
					$query = 
					"SELECT * from buku where id_buku='$id_buku'";
					
					$result = mysqli_query($con, $query);
					$row = mysqli_fetch_assoc($result);
					$kategori = $row['id_kategori'];
				?>
					<div class='col-lg-6'>
						<div class='details_image'>
							<div class='details_image_large'><img src='images/<?php echo $row['gambar'] ?>' alt=''>
							</div>
						</div>
					</div>

					<!-- Product Content -->
					<div class="col-lg-6">
						<div class="details_content">
							<br><br>
							<div class="details_name">
								<?php echo $row['judul_buku'] ?>
							</div>

							<div class="details_price">Rp.
								<?php echo $row['harga'] ?>,-</div>


							<!-- In Stock -->
							<div class="in_stock_container">
								<div class="availability">Availability:</div>
								<?php if($row['stok'] > 0){ ?>
								<span>In Stock</span>
								<?php } else { ?>
								<span>
									<font color="red">Sold Out</font>
								</span>
								<?php } ?>
							</div>

							<div class="details_text">
								<p>
									<?php echo $row['deskripsi'] ?>
								</p>
							</div>

							<!-- Product Quantity -->
							<?php if($row['stok'] > 0){ ?>
							<div class="product_quantity_container">
								<div class="button cart_button"><a href="process/update-cart.php?id_buku=<?php echo $id_buku; ?>">Add to cart</a></div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Products -->

		<div class="products">
			<div class="container">
				<div class="row">
					<div class="col text-center">
						<div class="products_title">Produk Dengan Kategori Yang Sama</div>
					</div>
				</div>
				<div class="row">
					<div class="col">

						<div class="product_grid">
							<?php
								$query = 
								"SELECT * from buku WHERE id_kategori='$kategori' AND id_buku!='$id_buku'";
								
								$result = mysqli_query($con, $query);

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

		<!-- Footer -->

		<?php include 'view/footer.php'; ?>