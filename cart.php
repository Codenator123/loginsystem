<!DOCTYPE>
<?php
include("functions/functions.php");
?>
<html>
<head>
	<title>FlowerPower Webshop</title>
	<link rel="stylesheet" type="text/css" href="style/style.css" media="all"/>
</head>
<body>

	<!-- Main containter start hier -->
	<div class="main_wrapper">

		<!-- Header start hier -->
		<div class="header_wrapper"> 

			<a href="index.php"><img id="logo" src="images/logo.png" height="100px" width="200px"></a>
			<img id="banner" src="images/banner.png" height="100px" width="700px">

		</div>
		<!-- Header eindigt hier -->

		<!-- Menu start hier -->
		<div class="menubar">
			
			<ul id="menu">
				<li><a href="index.php"> Home </a></li>
				<li><a href="products.php"> Auto`s </a></li>
				<li><a href="about.php"> Over ons </a></li>
				<li><a href="contact.php"> Contact </a></li>
				<!-- <li><a href="cart.php"> Shopping Cart </a></li>
				<li><a href="#"> Contact </a></li> -->
			</ul>

			<div id="form">
				<form method="get" action="results.php" enctype="multipart/form-data">
					<input type="text" name="user_query" placeholder="Search a Product" / >
					<input type="submit" name="search" value="Search" />
				</form>
			</div>

		</div>
		<!-- Menu eindigt hier -->

		<!-- Content wrapper start hier -->
		<div class="content_wrapper">

			<div id="sidebar"> 

				<div id="sidebar_title"> Automerk </div>

				<ul id="categories">

				<?php getMerk(); ?>

				</ul>

				<div id="sidebar_title"> Uitvoering </div>

				<ul id="categories">

				<?php getUitvoering(); ?>

				</ul>

			</div>

		</div>

			<div id="content_area">

			<?php cart(); ?>

				<div id="shopping_cart">
					<span style="float:right; font-size:18px; padding:5px; line-height:40px;"> Welcome Guest! <b style="color:#FF0">Shopping Cart -</b> Total Items: <?php total_items(); ?> Total Price: <?php total_price(); ?> <a href="cart.php" style="color:#FF0; text-decoration:none;">Go to cart</a>
									</div>)

				<?php echo $ip=getIp(); ?>

				<div id="products_box">
					<form action="" method="post" enctype="multipart/form-data">

						<table align="center" width="700" bgcolor="skyblue">

							<tr align="center">
								<td colspan="5"><h2> Update your cart or checkout </h2><br></td>
							</tr>
							<br>
							<tr align="center">
								<th>Verwijder</th>
								<th>Auto</th>
								<th>Prijs per Dag</th>
							</tr>

							<?php 

								$total = 0;

							    $ip = getIp();

							    $sel_price = "select * from cart where ip_add='$ip'";

							    $run_price = mysqli_query($con, $sel_price);

							    while($p_price=mysqli_fetch_array($run_price)){

							      $pro_id = $p_price['p_id'];

							      $auto_prijs = "select * from autos where auto_id='$pro_id'";

							      $run_pro_price = mysqli_query($con,$auto_prijs);

							      while ($pp_price = mysqli_fetch_array($run_pro_price)){

							        $product_price = array($pp_price['auto_prijs']);

							        $product_titel = $pp_price['auto_naam'];
       
								    $product_image = $pp_price['auto_image'];
								       
								    $single_price = $pp_price['auto_prijs'];

								    $values = array_sum($product_price);

								    $total += $values;

							?>

							<tr align="center">
					        <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>" /></td>
					        <td><?php echo $product_titel; ?><br>
					        <img src="admin/product_images/<?php echo $product_image;?>" width="60" height="60"/>
					        </td>
					        <!-- <td><input type="text" size="4" name="qty"/></td>
					        <?php

							        if(isset($_POST['update_cart'])){
							         
							          $qty = $_POST['qty'];
							          
							          $update_qty = "update cart set qty='$qty'";
							          
							           $run_qty = mysqli_query($con, $update_qty);
							           
							           
							           $total = $total*$qty;
							         
							        }

					        ?> -->
					        <td><?php echo "&euro;" . $single_price; ?></td>
					       </tr>

					       <?php } } ?>

					       <tr align="right">
					       		<td colspan="4"><b>Prijs per dag:</b></td>
					       		<td colspan="4"><?php echo "&euro;" . $total; ?></td>
					       </tr>

					       <tr align="center">
					       		<td colspan="2"><input type="submit" name="update_cart" value="Verwijder auto" /></td>
					       		<td><button><a href="checkout.php" style="text-decoration:none; color:black;">Checkout</a></button></td>
					       </tr>

						</table>
					</form>

					<?php

						global $con;

						$ip = getIp();

						if(isset($_POST['update_cart'])){

							foreach($_POST['remove'] as $remove_id){

								$delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";

								$run_delete = mysqli_query($con, $delete_product);

								if($run_delete){

									echo "<script>window.open('cart.php', '_self')</script>";
								}
							}
						}

						if(isset($_POST['continue'])){

							echo "<script>window.open('index.php', '_self')</script>";
						}

					?>

				</div>

			</div>

		<!-- Content wrapper eindigt hier -->

		<div id="footer"> 

			<h3 style="text-align:left; padding-top:30px; padding-left: 10px;">&copy; 2015 Rent-a-Car</h3>
			<h5 style="text-align:left; padding-left: 10px;">Designed by FastDevelopment</h5>

		 </div>

	</div>
<script type="text/javascript">
    $(document).ready(function() {
        var slider = $('#slider').leanSlider({
            directionNav: '#slider-direction-nav',
            controlNav: '#slider-control-nav'
        });
    });
    </script>
</body>
</html>