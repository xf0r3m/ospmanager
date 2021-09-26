<?php

function theTables($connection, $trips_id) {

	$eqArray = array('eqManual', 'eqEngine');
				for ( $i=0; $i < count($eqArray); $i++ ) {

					$tName = 't_' . $eqArray[$i];

					if ( $i === 0 ) {
						$csh = 'eq_id,personal_id,czas,uwagi,id';
					} else {
						$csh = 'eq_id,personal_id,czas,paliwo,uwagi,id';
					}

					$whereValue = 'trips_id=' . $trips_id;

					$result1 = prepareForm($connection, $tName, $csh, $whereValue);

					if ( $i === 1 ) { echo "<div class=\"" . $eqArray[$i] . "\" style=\"display: none;\">"; }
					else { echo "<div class=\"" . $eqArray[$i] . "\">"; }

					if ( mysqli_num_rows($result1) > 0 ) {

						if ( $i === 0 ) {

							echo "<table class=\"moduleTable\">
							<tr class=\"nonParityTableRow\">
							<th class=\"tableHeaderCell\">Nazwa sprzętu</th>
							<th class=\"tableHeaderCell\">Obsługujący</th>
							<th class=\"tableHeaderCell\">Czas użycia</th>
							<th class=\"tableHeaderCell\">Uwagi</th>
							<th class=\"tableHeaderCell\" colspan=\"2\">Akcja</th></tr>";

						} else {

							echo "<table class=\"moduleTable\">
							<tr class=\"nonParityTableRow\">
							<th class=\"tableHeaderCell\">Nazwa sprzętu</th>
							<th class=\"tableHeaderCell\">Obsługujący</th>
							<th class=\"tableHeaderCell\">Czas użycia</th>
							<th class=\"tableHeaderCell\">Zużycie paliwo</th>
							<th class=\"tableHeaderCell\">Uwagi</th>
							<th class=\"tableHeaderCell\" colspan=\"2\">Akcja</th>
							</tr>";

						}

						$rcount = 2;

						while ( $row1 = mysqli_fetch_row($result1) ) {

							if ( $rcount % 2 === 0 ) {

								echo "<tr class=\"parityTableRow\">";

							} else {
								echo "<tr class=\"nonParityTableRow\">";
							}

							$tName = 'eq_about';
							$csh = 'nazwa';
							$whereValue = 'id=' . $row1[0];
							$result2 = prepareForm($connection, $tName, $csh, $whereValue);
							$row2 = mysqli_fetch_row($result2);

							echo "<td class=\"tableDataCell\">" . $row2[0] . "</td>";

							$tName = 'str_do';
							$csh = 'imie,nazwisko';
							$whereValue = 'id=' . $row1[1];
							$result3 = prepareForm($connection, $tName, $csh, $whereValue);
							$row3 = mysqli_fetch_row($result3);

							echo "<td class=\"tableDataCell\">" . $row3[0] . " " . $row3[1] . "</td>";

							echo "<td class=\"tableDataCell\">" . $row1[2] . "</td>
								  <td class=\"tableDataCell\">" . $row1[3] . "</td>";

							if ( $i === 1 ) {
								echo "<td class=\"tableDataCell\"> " . $row1[4] . "</td>";
							}

							if ( $i === 0 ) { $idIndex = 4; }
							else { $idIndex = 5; }

							echo "<td class=\"tableDataCell\"><a href=\"index.php?page=trips_eq&type=" . $eqArray[$i] . "&action=mod&id=" . $row1[$idIndex] . "&trips_id=" . $trips_id . "\">
							<button id=\"m_button\"><img id=\"m_image\" src=\"resources/edit.png\" /></button></a></td>
							<td class=\"tableDataCell\"><a href=\"index.php?page=trips_eq&type=" . $eqArray[$i] . "&action=del&id=" . $row1[$idIndex] . "&trips_id=" . $trips_id . "\">
							<button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button></a></td>";

							$rcount++;
						}

						echo "</table>";

					} else {
						echo "<h3>Brak danych do wyświetlenia</h3>";
					}

					echo "</div>";

				}
}

if ( ! isset($_GET['trips_id']) ) {

	$tName = 't_about';
	$result0 = getLastIdOnTable($connection, $tName);
	$row0 = mysqli_fetch_row($result0);
	$trips_id = $row0[0];

} else {
	$trips_id = $_GET['trips_id'];
}

if ( $trips_id === NULL ) {

	echo "<div id=\"startinfo\"><h1>Aby mód dodać sprzęt należy na początku zdefiniować sam wyjazd</h1></div>";

} else {


	if ( count($_POST) > 0 ) {

		if ( isset($_GET['action']) && ( $_GET['action'] === "mod" ) ) {

			$mod_id = $_GET['id'];

			if ( isset($_GET['type']) && ( $_GET['type'] === 'eqEngine' ) ) {
				$tName = 't_eqEngine';
				$csh = 'eq_id,personal_id,czas,paliwo,uwagi';
			} else {
				$tName = 't_eqManual';
				$csh = 'eq_id,personal_id,czas,uwagi';
			}

			$pKL = generatePKL($tName, $csh);
			$whereValue = "id=" . $mod_id;

			dbMod($connection, $tName, $csh, $pKL, $whereValue);

		} else {

			if ( isset($_GET['type']) && ( $_GET['type'] === 'eqEngine' ) ) {
				$tName = 't_eqEngine';
				$csh = 'eq_id,personal_id,czas,paliwo,uwagi,trips_id';
			} else {
				$tName = 't_eqManual';
				$csh = 'eq_id,personal_id,czas,uwagi,trips_id';
			}

			$pKL = generatePKL($tName, $csh);

			dbAdd($connection, $tName, $csh, $pKL);

		}

		theTables($connection, $trips_id);

	} else {

		if ( isset($_GET['action']) && ( $_GET['action'] === "del" ) ) {

			$del_id = $_GET['id'];

			if ( isset($_GET['type']) && ( $_GET['type'] === 'eqEngine' ) ) {
				$tName = 't_eqEngine';
			} else { $tName = 't_eqManual'; }

			$whereValue = 'id=' . $del_id;

			dbDel($connection, $tName, $whereValue);

			theTables($connection, $trips_id);

		} else if ( isset($_GET['action']) && ( $_GET['action'] === "mod" ) ) {

			$mod_id = $_GET['id'];

			if ( isset($_GET['type']) && ( $_GET['type'] === 'eqEngine' ) ) {

					$tName = 't_eqEngine';

			} else {

					$tName = 't_eqManual';
			}

			$csh = '*';
			$whereValue = 'id=' . $mod_id;

			$result0 = prepareForm($connection, $tName, $csh, $whereValue);

			if ( mysqli_num_rows($result0) > 0 ) {

				$row0 = mysqli_fetch_row($result0);

				$tName = 'eq_about';
				$csh = "id,nazwa";

				if ( isset($_GET['type']) && ( $_GET['type'] === "eqEngine" ) ) {

					$whereValue = 'id=' . $row0[4];

				} else {

					$whereValue = 'id=' . $row0[3];

				}

				$result1 = prepareForm($connection, $tName, $csh, $whereValue);

				if ( mysqli_num_rows($result1) > 0 ) {

					$row1 = mysqli_fetch_row($result1);

					$tName = 'eq_about';
					$csh = "id,nazwa";
					$prepareValue = mysqli_real_escape_string($connection, 'Sprzęt o napędzie spalinowym');

					if ( isset($_GET['type']) && ( $_GET['type'] === 'eqEngine') ) {
						$whereValue = "rodzaj='" . $prepareValue . "';";
					} else {
						$whereValue = "rodzaj<>'" . $prepareValue . "';";
					}

					$result2 = prepareForm($connection, $tName, $csh, $whereValue);

					$tName = 'str_do';
					$csh = 'id,imie,nazwisko';

					if ( isset($_GET['type']) && ( $_GET['type'] === 'eqEngine' ) ) {

						$whereValue = 'id=' . $row0[5];

					} else {

						$whereValue = 'id=' . $row0[4];
					}


					$result3 = prepareForm($connection, $tName, $csh, $whereValue);
					if ( mysqli_num_rows($result3) > 0 ) {

						$row3 = mysqli_fetch_row($result3);

						$tName = 'str_do';
						$csh = 'id,imie,nazwisko';
						$whereValue = 'id IN (SELECT personal_id FROM t_member WHERE trips_id=' . $trips_id . ');';

						$result4 = prepareForm($connection, $tName, $csh, $whereValue);

						if ( isset( $_GET['type'] ) && ( $_GET['type'] === 'eqManual' ) ) {

							include('forms/trips_eqManual_mod.php');

						} else {

							include('forms/trips_eqEngine_mod.php');

						}

					} else {
						echo "<h3>Nie znaleziono strażaka o takim identyfikatorze</h3>";
					}

				} else {
					echo "<h3>Nie znaleziono sprzętu o tym identyfikatorze</h3>";
				}

			} else {
				echo "<h3>Nie znaleziono wpisu o tym identyfikatorze</h3>";
			}

		} else {

					echo "<div><button class=\"chtype\" id=\"eqManual\" disabled=\"disabled\">Sprzęt ręczny</button>
							<button class=\"chtype\" id=\"eqEngine\">Sprzęt o napędzie spalinowym</button></div>
							<hr id=\"theline\">";

				echo "<div id=\"form\">";

				$tName = 'eq_about';
				$csh = "id,nazwa";

				$prepareValue = mysqli_real_escape_string($connection, 'Sprzęt o napędzie spalinowym');
				$whereValue = "rodzaj='" . $prepareValue . "';";
				$result3 = prepareForm($connection, $tName, $csh, $whereValue);

				$whereValue = "rodzaj<>'" . $prepareValue . "';";
				$result4 = prepareForm($connection, $tName, $csh, $whereValue);

				$tName = 'str_do';
				$csh = 'id,imie,nazwisko';
				$whereValue = 'id IN (SELECT personal_id FROM t_member WHERE trips_id=' . $trips_id . ');';

				$result5 = prepareForm($connection, $tName, $csh, $whereValue);

				include('forms/trips_eq.php');

				echo "</div>
						<hr id=\"theline\">
						<div id=\"result\">";

				theTables($connection, $trips_id);

				echo "</div>";
			}
	}
}
 ?>
