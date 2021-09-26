<?php

function theTables ($connection, $thng_id) {

		$tName = "eq_deadlines WHERE thng_id=" . $thng_id;
		$th = "Nazwa,Termin";
		$csh = "id,nazwa,termin";

		tables($connection, $tName, $th, $csh);

}

if ( ! isset($_GET['eq_id']) ) {

	$tName = 'eq_about';
	$result0 = getLastIdOnTable($connection, $tName);
	$row0 = mysqli_fetch_row($result0);
	$thng_id = $row0[0];

} else {
	$thng_id = $_GET['eq_id'];
}

if ( $thng_id === NULL ) {

	echo "<div id=\"startinfo\"><h1>Aby móc zdefiniować terminy dla sprzętu, na początku
			należy zdefiniować sam sprzęt</h1></div>";

} else {

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ( $_GET['action'] === "mod") ) {

		$mod_id = $_GET['id'];

		#Modyfikacja terminów
		$tName = 'eq_deadlines';
		$csh = "nazwa,termin";
		$pKL = generatePKL($tName, $csh);
		$whereValue = "id=" . $mod_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

	} else {

		#Dodawanie terminów
		$tName = 'eq_deadlines';
		$csh = "nazwa,termin,thng_id";
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

	}

		$thng_id = $_POST['eq_deadlines_thng_id'];

		theTables($connection, $thng_id);

} else {

	if ( isset($_GET['action']) && ( $_GET['action'] === "del") ) {

		$del_id = $_GET['id'];
		$tName = 'eq_deadlines';
		$whereValue = "id=" . $del_id;
		#Usunięcie terminu

		dbDel($connection, $tName, $whereValue);
		theTables($connection, $thng_id);

	} else if ( isset($_GET['action']) && ( $_GET['action'] === "mod") ) {

		$mod_id = $_GET['id'];
		$tName = 'eq_deadlines';
		$csh = "id,nazwa,termin,thng_id";
		$whereValue = "id=" . $mod_id;

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);
		include('forms/eq_deadlines_mod.php');

	} else {

			echo "<div id=\"form\">";
			include('forms/eq_deadlines.php');
			echo "</div>
					<hr id=\"theline\">
					<div id=\"result\">";	

			theTables($connection, $thng_id);

			echo "</div>";

	}

}

}
?>
