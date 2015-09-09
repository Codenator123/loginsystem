<?php

$con = mysqli_connect("localhost", "root", "", "examend");

if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

function cart(){

  if(isset($_GET['add_cart'])){

    global $con;

    $ip = getIp();

    $pro_id = $_GET['add_cart'];

    $check_pro = "select * FROM cart WHERE ip_add='$ip' AND p_id='$pro_id'";

    $run_check = mysqli_query($con, $check_pro);

    if(mysqli_num_rows($run_check)>0){

      echo "";
    }
    else {

      $insert_pro = "insert into cart (p_id,ip_add) values ('$pro_id','$ip')";

      $run_pro = mysqli_query($con, $insert_pro);

      echo "<script>window.open('index.php', '_self')</script>";
    }

  }

  }

  function total_items(){

    if(isset($_GET['add_cart'])){

      global $con;

      $ip = getIp();

      $get_items = "select * from cart where ip_add='$ip'";

      $run_items = mysqli_query($con, $get_items);

      $count_items = mysqli_num_rows($run_items);

    }

      else {

        global $con;

        $ip = getIp();

        $get_items = "select * from cart where ip_add='$ip'";

        $run_items = mysqli_query($con, $get_items);

        $count_items = mysqli_num_rows($run_items);
      }

      echo $count_items;

  }

function total_price(){

    $total = 0;

    global $con;

    $ip = getIp();

    $sel_price = "select * from cart where ip_add='$ip'";

    $run_price = mysqli_query($con, $sel_price);

    while($p_price=mysqli_fetch_array($run_price)){

      $pro_id = $p_price['p_id'];

      $pro_prijs = "select * from autos where auto_id='$pro_id'";

      $run_pro_price = mysqli_query($con,$pro_prijs);

      while ($pp_price = mysqli_fetch_array($run_pro_price)){

        $product_prijs = array($pp_price['auto_prijs']);

        $values = array_sum($product_prijs);

        $total +=$values;


      }

    }

    echo $total;

}

//verkrijgen van categorieën

function getMerk(){

 global $con;

 $get_merk = "select * from merk";

 $run_merk = mysqli_query($con, $get_merk);

 while ($row_merk = mysqli_fetch_array($run_merk)){

  $merk_id = $row_merk['merk_id'];
  $merk_naam = $row_merk['merk_naam'];

 echo "<li><a href='index.php?merk_id=$merk_id'>$merk_naam</a></li>";

 }
}

function getUitvoering(){

 global $con;

 $get_uit = "select * from uitvoering";

 $run_uit = mysqli_query($con, $get_uit);

 while ($row_uit = mysqli_fetch_array($run_uit)){

  $uit_id = $row_uit['uit_id'];
  $uit_naam = $row_uit['uit_naam'];

 echo "<li><a href='index.php?uit_id=$uit_id'>$uit_naam</a></li>";
 
 }
}

function getPro(){

 if(!isset($_GET['merk_id'])){
  if(!isset($_GET['uit_id'])){

 global $con;

 $get_pro = "select * from autos order by RAND() LIMIT 0, 3";

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
    <br>
    <h4>Reserverings Nummer: $auto_id</h4>
    <br>

    <img src='admin/product_images/$auto_image' width='180' height='180' />

    <p><b> Prijs: &euro; $auto_prijs </b></p>
    <p><b> Kenteken:</b> $auto_kent </p>
    <p><b> Aanwezigheid GPS:</b> $auto_gps </p><br>

    <a href='details.php?auto_id=$auto_id' style='float:left;'>Details</a>
	<a href='rent.php?auto_id=$auto_id'><button style='float:right'>Reserveer</button></a>

   </div>
  ";


 }
 }
}
}

function getMerkPro(){
  
  if(isset($_GET['merk_id'])){
   
   $merk_id = $_GET['merk_id'];
   
  
  global $con;
  
  $get_cat_pro = "select * from autos where auto_merk='$merk_id'";
  
  $run_cat_pro =  mysqli_query($con, $get_cat_pro);

  $count_cats = mysqli_num_rows($run_cat_pro);

  if($count_cats==0){

    echo "<h2 style='padding:20px;'>No products where found in category!</h2>";
  }
  
  while($row_cat_pro = mysqli_fetch_array($run_cat_pro)){
    
   
   
   $auto_id = $row_cat_pro['auto_id'];
   $auto_merk = $row_cat_pro['auto_merk'];
   $auto_uit = $row_cat_pro['auto_uit'];
   $auto_naam = $row_cat_pro['auto_naam'];
   $auto_prijs = $row_cat_pro['auto_prijs'];
   $auto_image = $row_cat_pro['auto_image'];
   $auto_kent = $row_cat_pro['auto_kent'];
   $auto_gps = $row_cat_pro['auto_gps'];
   
   
   echo "
   
   <div id='single_product'>
   
    <h3>$auto_naam</h3>
    <br>
    <h4>Reserverings Nummer: $auto_id</h4>
    <br>
    
    <img src='admin/product_images/$auto_image' width='180' height='180' />
    
    <p><b>&euro; $auto_prijs</b></p>
    <p><b> Kenteken:</b> $auto_kent </p>
    <p><b> Aanwezigheid GPS:</b> $auto_gps </p><br>
    
    <a href='details.php?auto_id=$auto_id' style='float:left;'>Details</a>
	<a href='rent.php?auto_id=$auto_id'><button style='float:right'>Reserveer</button></a>
    
    
   </div>
   
   
   ";
   
   
  }
  
  
 }
 
 }
 
 function getOrder(){

 if(!isset($_GET['auto_id'])){

 global $con;

 $get_huur = "select * from verhuur";

 $run_huur = mysqli_query($con, $get_huur);

 while($row_huur = mysqli_fetch_array($run_huur)){

  $id = $row_huur['id'];
  $username = $row_huur['username'];
  $phone = $row_huur['phone'];
  $date_pickup = $row_huur['date_pickup'];
  $date_deliver = $row_huur['date_deliver'];
  $date_pickup2 = $row_huur['date_pickup2'];
  $date_deliver2 = $row_huur['date_deliver2'];
  $date_pickup3 = $row_huur['date_pickup3'];
  $date_deliver3 = $row_huur['date_deliver3'];
  $pickup = $row_huur['pickup'];
  $deliver = $row_huur['deliver'];

  echo "
   <div id='single_product'>

    <br>
    <h4>Reserverings Nummer: $id</h4>
    <br>
    <p><b> Gebruikersnaam: $username </b></p>
	<br>
    <p><b> Telefoon nummer:</b> $phone </p>
	<br>
    <p><b> Ophaaldatum:</b> $date_pickup </p><br>
	<p><b> Afleverdatum:</b> $date_deliver </p><br>
	<p><b> Ophaaldatum 2:</b> $date_pickup2 </p><br>
	<p><b> Afleverdatum 2:</b> $date_deliver2 </p><br>
	<p><b> Ophaaldatum 3:</b> $date_pickup3 </p><br>
	<p><b> Afleverdatum 3:</b> $date_deliver3 </p><br>
	<br>
	<p><b> Ophaalpunt:</b> $pickup </p><br>
	<p><b> Afleverpunt:</b> $deliver </p><br>

   </div>
  ";


 }
 }
}

 function getUitPro(){
  
  if(isset($_GET['uit_id'])){
   
   $uit_id = $_GET['uit_id'];
   
  
  global $con;
  
  $get_uit_pro = "select * from autos where auto_uit='$uit_id'";
  
  $run_uit_pro =  mysqli_query($con, $get_uit_pro);

  $count_uit = mysqli_num_rows($run_uit_pro);

  if($count_uit==0){

    echo "<h2 style='padding:20px;'>No products where found in category!</h2>";
  }
  
  while($row_uit_pro = mysqli_fetch_array($run_uit_pro)){
    
   
   
   $auto_id = $row_uit_pro['auto_id'];
   $auto_merk = $row_uit_pro['auto_merk'];
   $auto_uit = $row_uit_pro['auto_uit'];
   $auto_naam = $row_uit_pro['auto_naam'];
   $auto_prijs = $row_uit_pro['auto_prijs'];
   $auto_image = $row_uit_pro['auto_image'];
   $auto_kent = $row_uit_pro['auto_kent'];
   $auto_gps = $row_uit_pro['auto_gps'];
   
   
   echo "
   
   <div id='single_product'>
   
    <h3>$auto_naam</h3>
    <br>
      <h4>Reserverings Nummer: $auto_id</h4>
    <br>
    
    <img src='admin/product_images/$auto_image' width='180' height='180' />
    
    <p><b>&euro; $auto_prijs</b></p>
    <p><b> Kenteken:</b> $auto_kent </p>
    <p><b> Aanwezigheid GPS:</b> $auto_gps </p><br>
    
    <a href='details.php?auto_id=$auto_id' style='float:left;'>Details</a>
	<a href='rent.php?auto_id=$auto_id'><button style='float:right'>Reserveer</button></a>
    
    
   </div>
   
   
   ";
   
   
  }
  
  
 }
 
 }
?>