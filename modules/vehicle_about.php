<?php

function theTable($connection) {

		$tName = "vehicle_about";
		$th = "Nazwa,Marka,Typ,Rodzaj pojazdu,Numer operacyjny,Obsada";
		$csh = "id,nazwa,marka,typ,rodzaj,numer,obsada";
		tables($connection, $tName, $th, $csh);
}

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ($_GET['action'] === 'mod') ) {

		#Modyfikacja sprzętu
		$mod_id = $_GET['id'];
		$tName = "vehicle_about";
		$csh = "nazwa,marka,waga,typ,rodzaj,rejestracja,numer,obsada,paliwo,zbiornik,naped";
		$pKL = generatePKL($tName, $csh);
		$whereValue = "id=" . $mod_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

	} else {

		#Dodawanie pojazdów
		$tName = "vehicle_about";
		$csh = "nazwa,marka,waga,typ,rodzaj,rejestracja,numer,obsada,paliwo,zbiornik,naped";
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

	}

		theTable($connection);
	
} else {

	if ( isset($_GET['action']) && ($_GET['action'] === "del") ) {

		#Usunięcie pojazdu
		$del_id = $_GET['id'];
		$tName = 'vehicle_about';
		$whereValue = "id=" . $del_id;

		dbDel($connection, $tName, $whereValue);

		# W momencie usunięcia pojazdu należy usunąć wszystkie powiązane
		# z nim terminy oraz parametry
		$tName = 'vehicle_deadlines';
		$whereValue = "vehicle_id=" . $del_id;
		dbDel($connection, $tName, $whereValue);

		#Usunięcie parametru
		$tName = 'vehicle_parameters';
		$whereValue = "id=" . $del_id;

		dbDel($connection, $tName, $whereValue);

		theTable($connection);

	} else if ( isset($_GET['action']) && ($_GET['action'] === "mod") ) {

		#Przygotowanie formularza dla modyfikacji pojazdu
		$mod_id = $_GET['id'];
		$tName = "vehicle_about";
		$csh = "id,nazwa,marka,waga,typ,rodzaj,rejestracja,numer,obsada,paliwo,zbiornik,naped";
		$whereValue = "id=" . $mod_id;

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);
		include('forms/vehicle_about_mod.php');


	} else {

			#Formularz dodawania pojazdów
					echo "<div id=\"form\">";
					include('forms/vehicle_about.php');

					echo "</div>
						<hr id=\"theline\">
						<div id=\"result\">";

					theTable($connection);

					echo "</div>";
}

}

 ?>
