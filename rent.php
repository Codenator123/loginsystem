<!DOCTYPE HTML>
<?php
	require_once('core/init.php');
	include("admin/includes/db.php");
?>
<html>
<head>
	<title>Reservering maken</title>
	<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script>tinymce.init({selector:'textarea'});</script>
</head>
<body bgcolor="skyblue">

	<form action="rent.php" method="post" enctype="multipart/form-data" style="padding-top:10px;">
					
						<table style="padding-top: 10px;" align="center" width="700px" border="2px" bgcolor="#FFF">
									
									<tr>
									<td colspan="7" align="center"><h2> Auto huren </h2><br></td>
									</tr>
									
									<tr>
										<td align="left"><b> Selecteer Auto </b></td>
										<td>
										<select name="auto_id" required>
											<option> Selecteer Auto </option>
											<?php

												$get_autoid = "select * from autos";

												$run_autoid = mysqli_query($con, $get_autoid);

												while ($row_autoid=mysqli_fetch_array($run_autoid)){

													$auto_id = $row_autoid['auto_id'];
													$auto_naam = $row_autoid['auto_naam'];

												echo "<option value='$auto_id'>$auto_id $auto_naam</option>";

												}

											?>
										</td>
										<td>
										* Verplicht veld
										</td>
									</tr>
									<td><b> Gebruikersnaam: </b></td>
									<td><input type="text" name="username" placeholder="Vul hier uw gebruikersnaam" required /></td>
									<td>
										* Verplicht veld
									</td>
									</tr>
									<tr>
									<td><b> Telefoon: </b></td>
									<td><input type="text" name="phone" placeholder="Vul hier uw telefoonnummer" required /></td>
									<td>
										* Verplicht veld
									</td>
									</tr>
									<tr>
									<td><b> Ophaaldatum: </b></td>
									<td><input type="date" name="date_pickup" required /></td>
									<td>
										* Verplicht veld
									</td>
									</tr>
									<tr>
									<td><b> Afleverdatum: </b></td>
									<td><input type="date" name="date_deliver" required /></td>
									<td>
										* Verplicht veld
									</td>
									</tr>
									<tr>
									<tr>
									<td><b> Ophaaldatum 2: </b></td>
									<td><input type="date" name="date_pickup2" /></td>
									<td>
										( Optioneel )
									</td>
									</tr>
									<tr>
									<td><b> Afleverdatum 2: </b></td>
									<td><input type="date" name="date_deliver2" /></td>
									<td>
										( Optioneel )
									</td>
									</tr>
									<tr>
									<tr>
									<td><b> Ophaaldatum 3: </b></td>
									<td><input type="date" name="date_pickup3" /></td>
									<td>
										( Optioneel )
									</td>
									</tr>
									<tr>
									<td><b> Afleverdatum 4: </b></td>
									<td><input type="date" name="date_deliver3" /></td>
									<td>
										( Optioneel )
									</td>
									</tr>
									
									<tr>
										<td align="right"><b> Ophaalpunt </b></td>
										<td>
										<select name="pickup" required>
											<option> Selecteer Ophaalpunt </option>
											<?php

												$get_filiaal = "select * from filiaal";

												$run_filiaal = mysqli_query($con, $get_filiaal);

												while ($row_filiaal=mysqli_fetch_array($run_filiaal)){

													$filiaal_id = $row_filiaal['filiaal_id'];
													$filiaal_naam = $row_filiaal['filiaal_naam'];

												echo "<option value='$filiaal_id'>$filiaal_naam</option>";

												}

											?>
										</td>
										<td>
										* Verplicht veld
										</td>
									</tr>
									<tr>
										<td align="right"><b> Afleverpunt </b></td>
										<td>
										<select name="deliver" required>
											<option> Selecteer Afleverpunt </option>
											<?php

												$get_filiaal = "select * from filiaal";

												$run_filiaal = mysqli_query($con, $get_filiaal);

												while ($row_filiaal=mysqli_fetch_array($run_filiaal)){

													$filiaal_id = $row_filiaal['filiaal_id'];
													$filiaal_naam = $row_filiaal['filiaal_naam'];

												echo "<option value='$filiaal_id'>$filiaal_naam</option>";

												}

											?>
										</td>
										<td>
										* Verplicht veld
										</td>
									</tr>
									<td align="center"><input type="submit" name="insert_post" value="Plaats Reservering" /></td>
									</tr>
								</table>
						</form>

	<a href="user_panel.php">Terug naar Mijn Account</a>
</body>
</html>

<?php

	if(isset($_POST['insert_post'])) {

		// Text data uit de velden pakken
		$auto_id = $_POST['auto_id'];
		$username = $_POST['username'];
		$phone = $_POST['phone'];
		$date_pickup = $_POST['date_pickup'];
		$date_deliver = $_POST['date_deliver'];
		$date_pickup2 = $_POST['date_pickup2'];
		$date_deliver2 = $_POST['date_deliver2'];
		$date_pickup3 = $_POST['date_pickup3'];
		$date_deliver3 = $_POST['date_deliver3'];
		$pickup = $_POST['pickup'];
		$deliver = $_POST['deliver'];

		echo $insert_product = "insert into verhuur (auto_id,username,phone,date_pickup,date_deliver,date_pickup2,date_deliver2,date_pickup3,date_deliver3,pickup,deliver) values ('$auto_id','$username','$phone','$date_pickup','$date_deliver','$date_pickup2','$date_deliver2','$date_pickup3','$date_deliver3','$pickup','$deliver')";

		$insert_pro = mysqli_query($con, $insert_product);

		if($insert_pro) {

			echo "<script>alert('Bedankt, Uw Reservering is geplaatst! U krijgt reactie binnen 24 uur, problemen ? bel met 1 van onze filialen.')</script>";
			echo "<script>window.open('user_panel.php', '_self')</script>";
		}
	}

?>