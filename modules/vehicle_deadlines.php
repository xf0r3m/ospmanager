<?php

function theTables($connection, $vehicle_id) {


	$tName = "vehicle_deadlines WHERE vehicle_id=" . $vehicle_id;
	$th = "Nazwa,Termin";
	$csh = "id,nazwa,termin";

	tables($connection, $tName, $th, $csh);

}


if ( ! isset($_GET['vehicle_id']) ) {

	$result0 = getLastIdOnTable($connection, 'vehicle_about');
	$row0 = mysqli_fetch_row($result0);
	$vehicle_id = $row0[0];

} else {

	$vehicle_id = $_GET['vehicle_id'];
}

if ( $vehicle_id === NULL ) {

	echo "<div id=\"startinfo\"><h1>Aby móc dodać terminy dla pojazdów, na początku należy
			zdefiniować sam pojazd</h1></div>";

} else {

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ( $_GET['action'] === "mod") ) {

		$mod_id = $_GET['id'];

		#Modyfikacja terminów
		$tName = 'vehicle_deadlines';
		$csh = "nazwa,termin";
		$pKL = generatePKL($tName, $csh);
		$whereValue = "id=" . $mod_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		$vehicle_id = $_GET['vehicle_id'];

	} else {

			#Dodawanie terminów
			$tName = 'vehicle_deadlines';
			$csh = "nazwa,termin,vehicle_id";
			$pKL = generatePKL($tName, $csh);

			dbAdd($connection, $tName, $csh, $pKL);

			$vehicle_id = $_POST['vehicle_deadlines_vehicle_id'];
	}

	theTables($connection, $vehicle_id);

} else {

	if ( isset($_GET['action']) && ( $_GET['action'] === "del") ) {

		$del_id = $_GET['id'];
		$tName = 'vehicle_deadlines';
		$csh = "vehicle_id";
		$whereValue = "id=" . $del_id;

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);
		$row0 = mysqli_fetch_row($result0);
		$vehicle_id = $row0[0];

		#Usunięcie terminu
		dbDel($connection, $tName, $whereValue);

		theTables($connection, $vehicle_id);

	} else if ( isset($_GET['action']) && ( $_GET['action'] === "mod") ) {

		$mod_id = $_GET['id'];
		$tName = 'vehicle_deadlines';
		$csh = "id,nazwa,termin,vehicle_id";
		$whereValue = "id=" . $mod_id;

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);
		include('forms/vehicle_deadlines_mod.php');

	} else {

			echo "<div id=\"form\">";
			include('forms/vehicle_deadlines.php');
			echo "</div>
					<hr id=\"theline\">
					<div id=\"result\">";
			#tabela z terminami
			theTables($connection, $vehicle_id);

			echo "</div>";
	}

}

}
?>
