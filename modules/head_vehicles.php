<?php

function theTables($connection) {

		$tName = 'h_vehicle';
		$csh  = '*';
		$th = 'Marka i typ posiadanego samochodu<br /> - rocznik,Remony samochodu -<br />co wykonano,Likwidacja - kiedy<br />/ w jaki sposób,Uwagi';
		tables($connection,$tName,$th,$csh);
}

if ( count($_POST) > 0 ) {

  if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

    $mod_id = $_GET['id'];
      $tName = 'h_vehicle';
      $csh = 'marka,remonty,likwidacja,uwagi';
      $pKL = generatePKL($tName, $csh);
      $whereValue = 'id=' . $mod_id;

      dbMod($connection, $tName, $csh, $pKL, $whereValue);
  } else {

      $tName = 'h_vehicle';
      $csh = 'marka,remonty,likwidacja,uwagi';
      $pKL = generatePKL($tName, $csh);

      dbAdd($connection, $tName, $csh, $pKL);
  }

	theTables($connection);

} else {

  if ( isset($_GET['action']) && ( $_GET['action'] === 'del' ) ) {

    $del_id = $_GET['id'];
      $tName = 'h_vehicle';
      $whereValue = 'id=' . $del_id;

      dbDel($connection, $tName, $whereValue);
      theTables($connection);

  } else if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

      $mod_id = $_GET['id'];
      $tName = 'h_vehicle';
      $csh = 'id,marka,remonty,likwidacja,uwagi';
      $whereValue = 'id=' . $mod_id;

      $result0 = prepareForm($connection, $tName, $csh, $whereValue);
      include('forms/head_vehicle_mod.php');

  } else {
    echo "<h2>Pojazdy: </h2>";
		echo "<div id=\"form\">";
		include('forms/head_vehicle.php');
		echo "</div>";
		echo "<hr id=\"theline\" />";
		echo "<div id=\"result\">";
		theTables($connection);
		echo "</div>";

  }

}

 ?>
