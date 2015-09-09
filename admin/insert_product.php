<!DOCTYPE HTML>
<?php
	include("includes/db.php");
?>
<html>
<head>
	<title>Auto Toevoegen</title>
	<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script>tinymce.init({selector:'textarea'});</script>
</head>
<body bgcolor="skyblue">

	<form action="insert_product.php" method="post" enctype="multipart/form-data">

		<table align="center" width="700px" border="2px" bgcolor="orange">

			<tr align="center">
				<td colspan="7"><h2> Voeg nieuwe auto toe </h2></td>
			</tr>

			<tr>
				<td align="right"><b> Auto Naam: </b></td>
				<td><input type="text" name="auto_naam" size="60" required /></td>
			</tr>

			<tr>
				<td align="right"><b> Auto Merk: </b></td>
				<td>
				<select name="auto_merk" required>
					<option> Selecteer Merk </option>
					<?php

						$get_merk = "select * from merk";

						$run_merk = mysqli_query($con, $get_merk);

						while ($row_merk=mysqli_fetch_array($run_merk)){

							$merk_id = $row_merk['merk_id'];
							$merk_naam = $row_merk['merk_naam'];

						echo "<option value='$merk_id'>$merk_naam</option>";

						}

					?>
				</td>
			</tr>

			<tr>
				<td align="right"><b> Auto Uitvoering: </b></td>
				<td>
					<select name="auto_uit" required>
					<option> Selecteer Uitvoering </option>
					<?php

						$get_uit = "select * from uitvoering";

						$run_uit = mysqli_query($con, $get_uit);

						while ($row_uit=mysqli_fetch_array($run_uit)){

							$uit_id = $row_uit['uit_id'];
							$uit_naam = $row_uit['uit_naam'];

						echo "<option value='$uit_id'>$uit_naam</option>";

						}

					?>

				</td>
			</tr>

			<tr>
				<td align="right"><b> Auto Afbeelding: </b></td>
				<td><input type="file" name="auto_image" required /></td>
			</tr>

			<tr>
				<td align="right"><b> Auto Prijs: </b></td>
				<td><input type="text" name="auto_prijs" required /></td>
			</tr>

			<tr>
				<td align="right"><b> Auto Omschrijving: </b></td>
				<td><textarea name="auto_omsch" cols="20" rows="10"></textarea></td>
			</tr>

			<tr>
				<td align="right"><b> Auto Keywords: </b></td>
				<td><input type="text" name="auto_keywords" size="50" required /></td>
			</tr>

			<tr>
				<td align="right"><b> Auto Kenteken: </b></td>
				<td><input type="text" name="auto_kent" size="50" placeholder="xx-xx-xx of xx-xxx-x" required /></td>
			</tr>

			<tr>
				<td align="right"><b> Auto GPS: </b></td>
				<td><input type="text" name="auto_gps" size="50" placeholder="Ja of Nee" required /></td>
			</tr>

			<tr align="center">
				<td colspan="7"><input type="submit" name="insert_post" value="Toevoegen" /></td>
			</tr>
			<tr align="center">
			<td height="50px" colspan="7"><a style="font-size:20; background-color: grey; color: #000000; text-decoration: none; border: 1px solid #000000; padding: 5px;" href="../user_panel.php">Terug naar Account</a></td>
			</tr>
	</form>
	
</body>
</html>

<?php

	if(isset($_POST['insert_post'])) {

		// Text data uit de velden pakken
		$auto_naam = $_POST['auto_naam'];
		$auto_merk = $_POST['auto_merk'];
		$auto_uit = $_POST['auto_uit'];
		$auto_prijs = $_POST['auto_prijs'];
		$auto_omsch = $_POST['auto_omsch'];
		$auto_keywords = $_POST['auto_keywords'];
		$auto_kent = $_POST['auto_kent'];
		$auto_gps = $_POST['auto_gps'];

		// Image uit de velden pakken
		$auto_image = $_FILES['auto_image']['name'];
		$auto_image_tmp = $_FILES['auto_image']['tmp_name'];

		move_uploaded_file($auto_image_tmp, "product_images/$auto_image");

		echo $insert_product = "insert into autos (auto_naam,auto_merk,auto_uit,auto_image,auto_prijs,auto_omsch,auto_keywords,auto_kent,auto_gps) values ('$auto_naam','$auto_merk','$auto_uit','$auto_image','$auto_prijs','$auto_omsch','$auto_keywords','$auto_kent','$auto_gps')";

		$insert_pro = mysqli_query($con, $insert_product);

		if($insert_pro) {

			echo "<script>alert('Product Has been inserted!')</script>";
			echo "<script>window.open('insert_product.php', '_self')</script>";
		}
	}

?>