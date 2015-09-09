<!DOCTYPE>
<?php
//require_once ('classes/Cookie.php');
require_once ('core/init.php');
include("functions/functions.php");
?>
<html>
<head>
	<title>Rent-a-Car</title>
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
					<div class="loginorregister">
<?php

if(Session::exists('home')) {
	echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();
if($user->isLoggedIn()) {
?>
	<p style="float: left; margin-top:20px; text-decoration:none;"><span style="font-size: 25px;"><b>Welkom</b> <a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username);?></a></p><br>
<br>
<br>
	<ul style="text-decoration:none; margin-top: 20px;">
		<li style="float: left; font-size: 20px; list-style:none; text-decoration:none;"><a style="text-decoration:none; color: #0000FF;" href="rent.php">Klik hier om een auto te huren</a></li><br>
		<br>
		<li style="float: left; font-size: 20px; "><a style="text-decoration:none; color: #0000FF;" href="update.php">Account gegevens wijzigen</a></li><br>
		<br>
		<li style="float: left; font-size: 20px; "><a style="text-decoration:none; color: #0000FF;" href="changepassword.php">Wachtwoord wijzigen</a></li><br><br>
		<li style="float: left; font-size: 20px; "><a style="text-decoration:none; color: #0000FF;" href="klant_reservering.php">Mijn reserveringen</a></li><br><br>
		<br>
		<li style="float: left; font-size: 20px; "><a style="text-decoration:none; " href="logout.php"><b>Uitloggen</b></a></li><br>
	</ul>
<?php

	if($user->hasPermission('admin')) {
?>
	<ul style="text-decoration:none; margin-top: 20px;">
		<h3 style="float: left; font-size: 25px;"> Personeel Opties </h3><br>
		<br>
		<li style="float: left; font-size: 20px; list-style:none; "><a style="text-decoration:none; color: #0000FF;" href="admin/insert_product.php">Voeg nieuwe auto toe</a></li><br>
		<br>
		<li style="float: left; font-size: 20px; list-style:none; "><a style="text-decoration:none; color: #0000FF;" href="medewerker_register.php">Voeg nieuwe medewerker toe</a></li><br>
		<br>
		<li style="float: left; font-size: 20px; list-style:none; "><a style="text-decoration:none; color: #0000FF;" href="overzicht.php">Reserveringen bekijken</a></li><br><br>
	</ul>	
<?php
	}

} else {
	echo '<p>You need to <a href="login.php"> log in</a> or <a href="register.php"> register </a></p>';
}
?>
	</div>
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