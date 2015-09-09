<!DOCTYPE>
<?php
//require_once ('classes/Cookie.php');
require_once ('core/init.php');
include("functions/functions.php");
?>
<html>
<head>
	<title>Rent-a-Car|Registreren</title>
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
				<li><a href="login.php"> Log in </a></li>
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

<?php
if(Input::exists()) {
	if(Token::check(Input::get('token'))) {

		echo 'I have been run';

		$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'username' => array(
					'required' => true,
					'min' => 2,
					'max' => 20, 
					'unique' => 'users'
				),
				'password' => array(
					'required' => true,
					'min' => 4
				),
				'password_again' => array(
					'required' => true,
					'matches' => 'password'
				),
				'name' => array(
					'required' => true,
					'min' => 2,
					'max' => 50
				)
			));

			if($validation->passed()) {
				$user = new User();

				$salt =  Hash::salt(32);

				try {

				$user->create(array(
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,
					'name' => Input::get('name'),
					'joined' => date('Y-m-d H:i:s'),
					'group' => 1
					));		

					Session::flash('home', 'Uw registratie is voltooid, u kunt nu inloggen');
					Redirect::to('login.php');							

			}	catch(Exception $e) {
				die($e->getMessage());
			}


			} else {
				foreach($validation->errors() as $error) {
					echo $error, '<br>';
				}
			}

		}
	}
?>

				<form action="" method="post">
					<div class="field">
						<label for="username">Gebruikersnaam:</label><br>
						<input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off">
					</div><br>

					<div class="field">
						<label for="password">Wachtwoord:</label><br>
						<input type="password" name="password" id="password">
					</div><br>

					<div class="field">
						<label for="password_again">Wachtwoord controle:</label><br>
						<input type="password" name="password_again" id="password_again">
					</div><br>

					<div class="field">
						<label for="name">Uw naam: </label><br>
						<input type="text" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name">
					</div><br>
					
					<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
					<input type="submit" value="Registreren">
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