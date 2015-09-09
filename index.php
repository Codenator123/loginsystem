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
			<div id="login">
			<?php
            $user = new User();
            if($user->isLoggedIn()) {
                echo '<b>Welkom </b>' .escape($user->data()->username);
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

if(Session::exists('home')) {
	echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();
if($user->isLoggedIn()) {
?>
	<p style="text-align: left; text-decoration:none; margin-bottom: -100px;"><span style="font-size: 25px;"><b>Welkom</b> <a href="profile.php?user=<?php echo escape($user->data()->username);?>"><?php echo escape($user->data()->username);?></a></p><br>
	<br>
	<br>
	<br>
	<div class="homepage-info">
	<p> Dit is de website van Rent-a-Car, Hier kunt u gemakkelijk een auto huren voor de laagste prijs.. <br>
	<br>
	Wij beschikken over 11 auto`s in onze assortiment die te huur zijn. <br>
	<br>
	Bezoek hier je <a href="user_panel.php"> account</a> pagina.
	<br>
	<br>
	<b>Hier ziet u 3 van onze populaire auto`s van dit moment:</b></p>
	</div>
	<div class="circular">
	</div>
	<br>
	<br>
	<br>
	
<?php

} else { ?>
	
	<p style="text-align: left; font-size: 25px; margin-bottom: -20px;"> <b> Welkom Gast </b></p>
	<div class="homepage-info">
	<p> Dit is de website van Rent-a-Car, Hier kunt u gemakkelijk een auto huren voor de laagste prijs.. <br>
	<br>
	Wij beschikken over 11 auto`s in onze assortiment die te huur zijn. <br>
	<br>
	Nog geen account ? <a href="register.php"> Registreer hier!</a> <br>toch wel een account ? <a href="login.php"> Log dan in!</a>
	<br>
	<br>
	<b>Hier ziet u 3 van onze populaire auto`s van dit moment:</b></p>
	</div>
	<div class="circular">
	</div>
	<br>
	<br>
	<br>
<?php }
?>

						<?php getPro(); ?>
						<?php getMerkPro(); ?>
						<?php getUitPro(); ?>

					</div>

			</div>
			
			</nav>
			
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