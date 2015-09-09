<!DOCTYPE>
<?php
//require_once ('classes/Cookie.php');
require_once ('core/init.php');
include("functions/functions.php");
?>
<html>
<head>
	<title>Rent-a-Car|Login</title>
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
			
			<ul id="menu">
				<li><a href="index.php"> Home </a></li>
				<li><a href="products.php"> Auto`s </a></li>
				<li><a href="about.php"> Over ons </a></li>
				<li><a href="contact.php"> Contact </a></li>
				<li><a href="register.php"> Registreren </a></li>
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
				
				<div id="products_box">
					<div class ="login_panel">
<?php

	if(Input::exists()) {
		if(Token::check(Input::get('token'))) {

		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array('required' => true),
			'password' => array('required' => true),
			 
			));

			if($validation->passed()) {
				$user = new User();					

				$remember = (Input::get('remember') === 'on') ? true : false; 
				$login = $user->login(Input::get('username'), Input::get('password'), $remember);

				if($login) {
					Redirect::to('index.php');	
				} else {
					echo 'Helaas, uw username of password kloppen niet.';
				}
			} else {
				foreach($validation->errors() as $error) {
				echo $error, '<br>';
			}
	}
}
}
?>

<form action"" method="post">
	<div class="field">
		<label for="username">Username:</label>
		<input type="text" name="username" id="username" autocomplet="off">
	</div>

	<div class="field">
		<label for="password">Password:</label>
		<input type="password" name="password" id="password" autocomplet="off">
	</div>

	<div class="field">
		<label for="remember">
			<input type="checkbox" name="remember" id="remember"> Remember me
		</label>
	</div>

	<div class="field">
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
		<input type="submit" value="Log in">
	</div>
</form>

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