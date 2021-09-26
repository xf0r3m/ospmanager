<?php

function fnResutl($connection) {

	echo "<form action=\"index.php\" method=\"get\" style=\"width: 80%; display: block; margin: auto;\">
	<input class=\"form_inputs\" type=\"hidden\" name=\"page\" value=\"event_about\" />
	<input class=\"form_inputs\" type=\"hidden\" name=\"data_scope\" value=\"on\" />
	<table style=\"width: 80%; margin-right: auto; margin-left: auto;\">
	<tr>";

	if ( isset($_GET['data_scope']) ) {

		$_GET['date_start'] = convertData($_GET['date_start'], 'y');
		$_GET['date_end'] = convertData($_GET['date_end'], 'y');

		echo "<td style=\"float: left;\"><input class=\"form_inputs\" type=\"date\" name=\"date_start\" value=\"" . $_GET['date_start'] . "\" /></td>
		<td style=\"float: right;\"><input class=\"form_inputs\" type=\"date\" name=\"date_end\" value=\"" . $_GET['date_end'] . "\" /></td>";

	} else {

		echo "<td style=\"float: left;\"> <input class=\"form_inputs\" type=\"date\" name=\"date_start\" /></td>
		<td style=\"float: right;\"><input class=\"form_inputs\" type=\"date\" name=\"date_end\" /></td>";

	}

		echo "</tr>
					</table>
						<div style=\"width: 80%; margin-left: auto; margin-right: auto; text-align: center;\">
						<input class=\"get_form_button\" type=\"submit\" value=\"Pokaż\" />
						<button id=\"rst\">Reset</button>
						</div>
					</form>
					<hr id=\"theline\">";

		if ( isset($_GET['data_scope']) ) {

						$tName = "e_about";
						$th = "Nazwa,Rodzaj,Numer meldunku,Miejscowość,Ulica,Numer posesji,Czas alarmu";
						$csh = "id,nazwa,rodzaj,nrmel,miejscowosc,ulica,posesja,alarm";

						$query = 'SELECT ' . $csh . ' FROM ' . $tName . " WHERE alarm >= '" . $_GET['date_start'] . " 00:00:00' AND alarm <= '" . $_GET['date_end'] ." 23:59:59';";
						tables($connection, $tName, $th, $csh, $query);

		} else {

						$tName = "e_about";
						$th = "Nazwa,Rodzaj,Numer meldunku,Miejscowość,Ulica,Numer posesji,Czas alarmu";
						$csh = "id,nazwa,rodzaj,nrmel,miejscowosc,ulica,posesja,alarm";
						tables($connection, $tName, $th, $csh);

		}
}

	if ( count($_POST) > 0 ) {

		if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

			$mod_id = $_GET['id'];
			$tName = "e_about";
			$csh = "nazwa,rodzaj,nrmel,uwagi,miejscowosc,ulica,posesja,alarm,rozpoczecie,zakonczenie,trwanie";
			$pKL = generatePKL($tName, $csh);
			$whereValue = "id=" . $mod_id;

			dbMod($connection, $tName, $csh, $pKL, $whereValue);

		} else {
			$tName = "e_about";
			$csh = "nazwa,rodzaj,nrmel,uwagi,miejscowosc,ulica,posesja,alarm,rozpoczecie,zakonczenie,trwanie";
			$pKL = generatePKL($tName, $csh);

			dbAdd($connection, $tName, $csh, $pKL);
		}

		fnResutl($connection);

	} else {
		if ( isset($_GET['action']) && ( $_GET['action'] === 'del' ) ) {

			$del_id = $_GET['id'];
			$whereValue = "event_id=" . $del_id;

			$tName = "e_note";
			dbDel($connection, $tName, $whereValue);

			$tName = "e_vehicle";
			dbDel($connection, $tName, $whereValue);

			$tName = "e_eqManual";
			dbDel($connection, $tName, $whereValue);

			$tName = "e_eqEngine";
			dbDel($connection, $tName, $whereValue);

			$tName = "e_alarm";
			dbDel($connection, $tName, $whereValue);

			$tName = "e_member";
			dbDel($connection, $tName, $whereValue);

			$tName = "e_about";
			$whereValue = "id=" . $del_id;
			dbDel($connection, $tName, $whereValue);

			fnResutl($connection);

		} else if  ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

			$mod_id = $_GET['id'];
			$tName = "e_about";
			$csh = "id,nazwa,rodzaj,nrmel,uwagi,miejscowosc,ulica,posesja,alarm,rozpoczecie,zakonczenie,trwanie";
			$whereValue = "id=" . $mod_id;

			$result0 = prepareForm($connection, $tName, $csh, $whereValue);
			include("forms/event_about_mod.php" );

		} else {

			echo "<div id=\"form\">";

			include('forms/event_about.php');

			echo "</div>
						<hr id=\"theline\" />";

			echo "<div id=\"result\">";
						fnResutl($connection);
			echo "</div>";
		}
	}


 ?>
