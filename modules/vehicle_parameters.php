<?php

function theTable ($connection, $vehicle_id) {

		$tName = "vehicle_parameters WHERE vehicle_id=" . $vehicle_id;
		$th = "Nazwa,Wartość,Jednostka";
		$csh = "id,nazwa,value,jednostka";

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

	echo "<div id=\"startinfo\"><h1>Aby móc dodać parametry pojazdu, na początku
			należy zdefiniować sam pojazd</h1></div>";

} else {

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ( $_GET['action'] === "mod") ) {

		$mod_id = $_GET['id'];

		#Modyfikacja parametrów
		$tName = 'vehicle_parameters';
		$csh = "nazwa,value,jednostka";
		$pKL = generatePKL($tName, $csh);
		$whereValue = "id=" . $mod_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		$vehicle_id = $_GET['vehicle_id'];

	} else {

		#Dodawanie terminów
		$tName = 'vehicle_parameters';
		$csh = "nazwa,value,jednostka,vehicle_id";
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);
		
		$vehicle_id = $_POST['vehicle_parameters_vehicle_id'];
	}

	theTable($connection, $vehicle_id);

} else {

	if ( isset($_GET['action']) && ( $_GET['action'] === "del") ) {

		$del_id = $_GET['id'];
		$tName = 'vehicle_parameters';
		$csh = "vehicle_id";
		$whereValue = "id=" . $del_id;

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);
		$row0 = mysqli_fetch_row($result0);
		$vehicle_id = $row0[0];

		#Usunięcie parametru
		dbDel($connection, $tName, $whereValue);

		theTable($connection, $vehicle_id);

	} else if ( isset($_GET['action']) && ( $_GET['action'] === "mod") ) {

		$mod_id = $_GET['id'];
		$tName = 'vehicle_parameters';
		$csh = "id,nazwa,value,jednostka,vehicle_id";
		$whereValue = "id=" . $mod_id;

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);
		include('forms/vehicle_parameters_mod.php');

	} else {

			echo "<div id=\"form\">";
				include('forms/vehicle_parameters.php');
			echo "</div>
					<hr id=\"theline\">
				<div id=\"result\">";

			theTable($connection, $vehicle_id);

			echo "</div>";
	}

}

}
?>
