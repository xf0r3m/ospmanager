<?php

function theTable($connection) {

	$tName = 'c_about';
	$csh = "id,nazwa,rodzaj,grupa,szczebel,miejscowosc,rozpoczecie,zakonczenie,czas";
	$th = "Nazwa,Rodzaj,Grupa,Szczebel,Miejscowość,Czas rozpoczęcia,Czas zakończenia,Czas trwania";
	tables($connection,$tName,$th,$csh);

}

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ( $_GET['action'] === "mod" ) ) {

		$mod_id = $_GET['id'];
		$tName = 'c_about';
		$csh = "nazwa,rodzaj,grupa,szczebel,miejscowosc,rozpoczecie,zakonczenie,czas";
		$pKL = generatePKL($tName, $csh);
		$whereValue = "id=" . $mod_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

	} else {

		$tName = 'c_about';
		$csh = "nazwa,rodzaj,grupa,szczebel,miejscowosc,rozpoczecie,zakonczenie,czas";
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

	}

	theTable($connection);
	
} else {

if ( isset($_GET['action']) && ($_GET['action'] === 'del') ) {

	$del_id = $_GET['id'];

	$tName = 'c_note';
	$whereValue = "comp_id=" . $del_id;

	dbDel($connection, $tName, $whereValue);

	$tName = 'c_score';
	$whereValue = "comp_id=" . $del_id;

	dbDel($connection, $tName, $whereValue);

	$tName = 'c_comp';
	$whereValue = "comp_id=" . $del_id;

	dbDel($connection, $tName, $whereValue);

	$tName = 'c_about';
	$whereValue = "id=" . $del_id;

	dbDel($connection, $tName, $whereValue);

	theTable($connection);

} else if ( isset($_GET['action']) && ($_GET['action'] === 'mod') ) {

	$mod_id = $_GET['id'];
	$tName = 'c_about';
	$csh = "id,nazwa,rodzaj,grupa,szczebel,miejscowosc,rozpoczecie,zakonczenie,czas";
	$whereValue = "id=" . $mod_id;

	$result0 = prepareForm($connection, $tName, $csh, $whereValue);
	include("forms/comp_about_mod.php");

} else {

		echo "<div id=\"form\">";
			include("forms/comp_about.php");
		echo "</div>";

		echo "<hr id=\"theline\" />";	
		echo "<div id=\"result\">";
			theTable($connection);
		echo "</div>";
	

}

}


 ?>
