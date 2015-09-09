<!DOCTYPE>
<?php
//require_once ('classes/Cookie.php');
require_once ('core/init.php');
include("functions/functions.php");
?>
<html>
<head>
	<title>Rent-a-Car| Search Results</title>
	<link rel="stylesheet" type="text/css" href="style/style.css" media="all"/>
	<script src="script/modernizr-2.6.1.min.js"></script>
	<script src="script/modernizr.custom.js"></script>
	<script src="js/classie.js"></script>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script src="js/lean-slider.js"></script>
    <link rel="stylesheet" href="style/lean-slider.css" type="text/css" />
    <link rel="stylesheet" href="style/sample-styles.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="style/component.css" />
</head>
<body>

	<!-- Main containter start hier -->
	<div class="main_wrapper">

		<!-- Header start hier -->
		<div class="header_wrapper"> 
			<div id="login">
			<?php
            $user = new User();
            if($user->isLoggedIn()) {
                echo 'Welkom ' .escape($user->data()->username);
            } else {
                echo 'Welkom Gast';
                echo '<li><a href="register.php"><i class=""></i> Registreren</a></li>';
                echo '<li><a href="login.php"><i class=""></i> Inloggen</a></li>';
            }
            ?>
                            <li><a href="user_panel.php"><i class=""></i> Mijn Account</a></li>
                            <?php
       
            if($user->isLoggedIn()) {
                echo '<li><a href="logout.php"><i class=""></i> Uitloggen</a></li>';
            } else {
                echo '';
            }
        ?>
    	</div>

			<a href="index.php"><img id="logo" src="images/logo.jpg" height="100px" width="200px"></a>

		</div>
		<!-- Header eindigt hier -->
		

		<div class="slider-wrapper">
				<div id="slider">
					<div class="slide1">
						<img src="images/1.jpg" alt="" />
					</div>
					<div class="slide2">
						<img src="images/2.jpg" alt="" />
					</div>
					<div class="slide3">
						<img src="images/3.jpg" alt="" />
					</div>
					<div class="slide4">
						<img src="images/4.jpg" alt="" />
					</div>
					<div class="slide1">
						<img src="images/5.jpg" alt="" />
					</div>
					<div class="slide2">
						<img src="images/6.jpg" alt="" />
					</div>
					<div class="slide3">
						<img src="images/7.jpg" alt="" />
					</div>
					<div class="slide4">
						<img src="images/8.jpg" alt="" />
					</div>
				</div>
		</div>

		
		<!-- Menu start hier -->
		<div class="menubar">
			<?php if (!isset($_SESSION['$naam'])): ?>
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
			<?php endif; ?>
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

				<div id="products_box">

					<?php

						if(isset($_GET['search'])){

						$search_query = $_GET['user_query'];

						$get_pro = "select * from autos where auto_keywords like '%$search_query%'";

						$run_pro = mysqli_query($con, $get_pro);

						while($row_pro = mysqli_fetch_array($run_pro)){

						$auto_id = $row_pro['auto_id'];
						$auto_merk = $row_pro['auto_merk'];
						$auto_uit = $row_pro['auto_uit'];
						$auto_naam = $row_pro['auto_naam'];
						$auto_prijs = $row_pro['auto_prijs'];
						$auto_image = $row_pro['auto_image'];
						$auto_kent = $row_pro['auto_kent'];
  						$auto_gps = $row_pro['auto_gps'];

						 echo "
						 	<div id='single_product'>

						    <h3>$auto_naam</h3>

						    <img src='admin/product_images/$auto_image' width='180' height='180' />

						    <p><b> &euro; $auto_prijs </b></p>
						    <p><b> Kenteken:</b> $auto_kent </p>
    						<p><b> Aanwezigheid GPS:</b> $auto_gps </p><br>

						    <a href='details.php?auto_id=$auto_id' style='float:left;'>Details</a>
						    <a href='index.php?auto_id=$auto_id'><button style='float:right'>Add to Cart</button></a>

						   </div>
						  ";


						}

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