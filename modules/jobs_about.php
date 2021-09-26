<?php

function theTables ($connection) {

	echo "<form action=\"index.php\" method=\"get\" style=\"width: 80%; display: block; margin: auto;\" >
						<input class=\"form_inputs\" type=\"hidden\" name=\"page\" value=\"jobs_about\" />
						<input class=\"form_inputs\" type=\"hidden\" name=\"data_scope\" value=\"on\" />
						<table style=\"width: 80%; margin-right: auto; margin-left: auto;\">
						<tr>";

			if ( isset($_GET['data_scope']) ) {

					$_GET['date_start'] = convertData($_GET['date_start'], 'y');
					$_GET['date_end'] = convertData($_GET['date_end'], 'y');

					echo "<td style=\"float: left;\"><input class=\"form_inputs\" type=\"date\" name=\"date_start\" value=\"" . $_GET['date_start'] . "\" /></td>
					<td style=\"float: right;\"><input class=\"form_inputs\" type=\"date\" name=\"date_end\" value=\"" . $_GET['date_end'] . "\" /></td>";

			} else {

					echo "<td style=\"float: left;\"><input class=\"form_inputs\" type=\"date\" name=\"date_start\" /></td>
					<td style=\"float: right;\"><input class=\"form_inputs\" type=\"date\" name=\"date_end\" /></td>";

			}

			echo "</tr>
					</table>
						<div style=\"width: 80%; margin-left: auto; margin-right: auto; text-align: center;\">
						<input class=\"get_form_button\" type=\"submit\" value=\"Pokaż\" />
							<button id=\"rst\">Reset</button></div>
					</form>
					<hr id=\"theline\">";

			if ( isset($_GET['data_scope']) ) {

				$tName = "j_about";
				$th = "Nazwa,Czas rozpoczęcia,Czas zakończenia,Czas Trwania";
				$csh = "id,nazwa,rozpoczecie,zakonczenie,czas";

				$query = 'SELECT ' . $csh . ' FROM ' . $tName . " WHERE rozpoczecie >= '" . $_GET['date_start'] . " 00:00:00' AND rozpoczecie <= '" . $_GET['date_end'] ." 23:59:59';";

				tables($connection, $tName, $th, $csh, $query);

			} else {

				$tName = "j_about";
				$th = "Nazwa,Czas rozpoczęcia,Czas zakończenia,Czas Trwania";
				$csh = "id,nazwa,rozpoczecie,zakonczenie,czas";
				tables($connection, $tName, $th, $csh);

			}

}


	if ( count($_POST) > 0 ) {

		if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

			$mod_id = $_GET['id'];
			$tName = "j_about";
			$csh = "nazwa,rozpoczecie,zakonczenie,czas";
			$pKL = generatePKL($tName, $csh);
			$whereValue = "id=" . $mod_id;

			dbMod($connection, $tName, $csh, $pKL, $whereValue);



		} else {
			$tName = "j_about";
			$csh = "nazwa,rozpoczecie,zakonczenie,czas";
			$pKL = generatePKL($tName, $csh);

			dbAdd($connection, $tName, $csh, $pKL);
		}

		theTables($connection);
	
	} else {
		if ( isset($_GET['action']) && ( $_GET['action'] === 'del' ) ) {

			$del_id = $_GET['id'];
			$whereValue = "jobs_id=" . $del_id;

			$tName = "j_member";
			dbDel($connection, $tName, $whereValue);

			$tName = "j_about";
			$whereValue = "id=" . $del_id;
			dbDel($connection, $tName, $whereValue);

			theTables($connection);


		} else if  ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

			$mod_id = $_GET['id'];
			$tName = "j_about";
			$csh = "id,nazwa,rozpoczecie,zakonczenie,czas";
			$whereValue = "id=" . $mod_id;

			$result0 = prepareForm($connection, $tName, $csh, $whereValue);
			include("forms/jobs_about_mod.php" );

		} else {

			echo "<div id=\"form\">";

			include('forms/jobs_about.php');

			echo "</div>
				<hr id=\"theline\">
				<div id=\"result\">";

			theTables($connection);

			echo "</div>";
		}
	}
 ?>
