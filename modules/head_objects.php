<?php

function theTable($connection) {

	$tName = 'h_objects';
	$csh = "*";
	$th = 'Nazwa,Rok budowy,Ilość boksów/wielkość sali<br />/ilość pomiesczeń,Modernizacje -<br />co rozbudowano i kiedy,Remonty -<br />rodzaj prac';
	tables($connection, $tName, $th, $csh);

}

if ( count($_POST) > 0 ) {

  if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

    	$mod_id = $_GET['id'];

      $tName = 'h_objects';
      $csh = 'nazwa,rok,ilosc,mods,remonty';
      $pKL = generatePKL($tName, $csh);
      $whereValue = 'id=' . $mod_id;

      dbMod($connection, $tName, $csh, $pKL, $whereValue);

  } else {

      $tName = 'h_objects';
      $csh = 'nazwa,rok,ilosc,mods,remonty';
      $pKL = generatePKL($tName, $csh);

      dbAdd($connection, $tName, $csh, $pKL);
  }

		theTable($connection);

} else {

  if ( isset($_GET['action']) && ( $_GET['action'] === 'del' ) ) {

    	$del_id = $_GET['id'];

      $tName = 'h_objects';
      $whereValue = 'id=' . $del_id;

      dbDel($connection, $tName, $whereValue);
      theTable($connection);

  } else if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

      $mod_id = $_GET['id'];

      $tName = 'h_objects';
      $csh = 'id,nazwa,rok,ilosc,mods,remonty';
      $whereValue = 'id=' . $mod_id;

      $result0 = prepareForm($connection, $tName, $csh, $whereValue);
      include('forms/head_objects_mod.php');

  } else {

    echo "<h2>Obiekty: </h2>
		<div id=\"form\">";
		include('forms/head_objects.php');
		echo "</div>
		<hr id=\"theline\" />";
    echo "<div id=\"result\">";
			theTable($connection);
		echo "</div>";
  }

}


 ?>
