<!DOCTYPE>
<?php
//require_once ('classes/Cookie.php');
require_once ('core/init.php');
include("functions/functions.php");
?>
<html>
<head>
	<title>Rent-a-Car| Wachtwoord aanpassen</title>
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
					
					<h2> Wachtwoord Wijzigen </h2>
<?php
$user = new User();

if(!$user->isLoggedIn()) {
	Redirect::to('user_panel.php');
}

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'password_current'		=>	array(
				'required' => true,
				'min'	=> 6
				),
			'password_new'			=>	array(
				'required' => true,
				'min'	=> 6
				),
			'password_new_again'	=>	array(
				'required' => true,
				'min'	=> 6,
				'matches'=> 'password_new'
				)
			));
		if($validation->passed()) {
			
			if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {		
				echo 'Je huidige wachtwoord is verkeerd';
			} else {
				$salt = Hash::salt(32); 																			
				$user->update(array(
					'password' => Hash::make(Input::get('password_new'), $salt),
					'salt' => $salt
					));

				Session::flash('home', 'Je wachtwoord is gewijzigd!');
				Redirect::to('user_panel.php');
			}

		} else {
			foreach($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}
	}	
}
?>
<br>
<form action="" method="post">
	<div class="field">
		<label for="password_current">Huidige wachtwoord:</label>
		<input type="password" name="password_current" id="password_current">
	</div>
	<br>
	<div class="field">
		<label for="password_new">Nieuwe wachtwoord</label>
		<input type="password" name="password_new" id="password_new">
	</div>

	<div class="field">
		<label for="password_new_again">Herhaal wachtwoord</label>
		<input type="password" name="password_new_again" id="password_new_again">
	</div>
<br>
	<input type="submit" value="Verander wachtwoord">
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>
<br>
<br>
<a style="font-size:20; background-color: grey; color: #000000; text-decoration: none; border: 1px solid #000000; padding: 5px;" href="user_panel.php">Terug naar Account</a>
				
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