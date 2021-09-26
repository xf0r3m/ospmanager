<?php

function theTables ($connection) {

		$tName = "eq_about";
		$th = "Nazwa,Stan,Rodzaj,Podrodzaj,Zródło finansowania";
		$csh = "id,nazwa,stan,rodzaj,podrodzaj,finansowanie";
		tables($connection, $tName, $th, $csh);

}

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ($_GET['action'] === 'mod') ) {

		#Modyfikacja sprzętu
		$mod_id = $_GET['id'];
		$tName = "eq_about";
		$csh = "nazwa,sn,rodzaj,podrodzaj,dest,datazak,marka,poj,stan,liczba,CNBOP,lokalizacja,finansowanie";
		$pKL = generatePKL($tName, $csh);
		$whereValue = "id=" . $mod_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);


	} else {

		#Dodawanie sprzętu
		$tName = "eq_about";
		$csh = "nazwa,sn,rodzaj,podrodzaj,dest,datazak,marka,poj,stan,liczba,CNBOP,lokalizacja,finansowanie";
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);


	}

	theTables($connection);
	
} else {

	if ( isset($_GET['action']) && ($_GET['action'] === "del") ) {

		#Usunięcie sprzętu
		$del_id = $_GET['id'];
		$tName = 'eq_about';
		$whereValue = "id=" . $del_id;

		dbDel($connection, $tName, $whereValue);

		# W momencie usunięcia sprzętu należy usunąć wszystkie powiązane
		# z nim terminy.
		$tName = 'eq_deadlines';
		$whereValue = "thng_id=" . $del_id;
		dbDel($connection, $tName, $whereValue);

		theTables($connection);

	} else if ( isset($_GET['action']) && ($_GET['action'] === "mod") ) {

		#Przygotowanie formularza dla modyfikacji sprzętu
		$mod_id = $_GET['id'];
		$tName = "eq_about";
		$csh = "id,nazwa,sn,rodzaj,podrodzaj,dest,datazak,marka,poj,stan,liczba,CNBOP,lokalizacja,finansowanie";
		$whereValue = "id=" . $mod_id;

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);
		include('forms/eq_about_mod.php');


	} else {

			#Formularz dodawania sprzętu.
			echo "<div id=\"form\">";

				include('forms/eq_about.php');

			echo "</div>
				<hr id=\"theline\">
					<div id=\"result\">";
		
			theTables($connection);

			echo "</div>";


}

}
?>
