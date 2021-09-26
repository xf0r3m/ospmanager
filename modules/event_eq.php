<?php

function theTables($connection, $event_id) {

	$classTable = array('eqManual', 'eqEngine');

	for( $i=0; $i < count($classTable); $i++ ) {

		if ( $i === 1 ) {echo "<div class=\"" . $classTable[$i] . "\" style=\"display: none;\">";}
		else {echo "<div class=\"" . $classTable[$i] . "\">";}

		$tName = 'e_' . $classTable[$i];

		if ( $i === 0 ) {
			$csh = 'eq_id,personal_id,czas,uwagi,id';
		} else {
			$csh = 'eq_id,personal_id,czas,paliwo,uwagi,id';
		}
		$whereValue = 'event_id=' . $event_id;
		$result1 = prepareForm($connection, $tName, $csh, $whereValue);

		if ( mysqli_num_rows($result1) > 0 ) {

			echo "<table class=\"moduleTable\">";

			if ( $i === 0 ) {
				echo "<tr class=\"nonParityTableRow\">
				<th class=\"tableHeaderCell\">Nazwa sprzętu</th>
				<th class=\"tableHeaderCell\">Obsługujący</th>
				<th class=\"tableHeaderCell\">Czas użycia</th>
				<th class=\"tableHeaderCell\">Uwagi</th>
				<th class=\"tableHeaderCell\" colspan=\"2\">Akcja</th></tr>";
			} else {
				echo "<tr class=\"nonParityTableRow\">
				<th class=\"tableHeaderCell\">Nazwa sprzętu</th>
				<th class=\"tableHeaderCell\">Obsługujący</th>
				<th class=\"tableHeaderCell\">Czas użycia</th>
				<th class=\"tableHeaderCell\">Zużycie paliwo</th>
				<th class=\"tableHeaderCell\">Uwagi</th>
				<th class=\"tableHeaderCell\" colspan=\"2\">Akcja</th></tr>";
			}

			$rcount = 2;

			while ( $row1 = mysqli_fetch_row($result1) ) {

				if ( $rcount % 2 === 0 ) {
					echo "<tr class=\"parityTableRow\">";
				} else {
					echo "<tr class=\"nonParityTableRow\">";
				}

				$tName = 'eq_about';
				$csh = "nazwa";
				$whereValue = "id=" . $row1[0];
				$result3 = prepareForm($connection, $tName, $csh, $whereValue);
				$row3 = mysqli_fetch_row($result3);

				echo "<td class=\"tableDataCell\">" . $row3[0] . "</td>";

				$tName = 'str_do';
				$csh = "imie,nazwisko";
				$whereValue = "id=" . $row1[1];
				$result3 = prepareForm($connection, $tName, $csh, $whereValue);
				$row3 = mysqli_fetch_row($result3);

				echo "<td class=\"tableDataCell\">" . $row3[0] . " " . $row3[1] . "</td>
							<td class=\"tableDataCell\">" . $row1[2] . "</td>
							<td class=\"tableDataCell\">" . $row1[3] . "</td>";

				if ( $i === 1 ) { echo "<td class=\"tableDataCell\">" . $row1[4] . "</td>"; $recordId = $row1[5];}
				else { $recordId = $row1[4]; }

				echo "<td class=\"tableDataCell\"><a href=\"index.php?page=event_eq&type=" . $classTable[$i]  . "&action=mod&id=" . $recordId . "&event_id=" . $event_id . "\">
				<button id=\"m_button\"><img id=\"m_image\" src=\"resources/edit.png\" /></button></a></td>
				<td class=\"tableDataCell\"><a href=\"index.php?page=event_eq&type=" . $classTable[$i] . "&action=del&id=" . $recordId . "&event_id=" . $event_id . "\">
				<button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button></a></td>";

				echo "</tr>";
				$rcount++;
			}
			echo "</table>";
		} else {
				echo "<h3>Brak danych do wyświetlenia</h3>";
		}
		echo "</div>";
	}
}

	if ( ! isset($_GET['event_id']) ) {

		$tName = 'e_about';
		$result0 = getLastIdOnTable($connection, $tName);
		$row0 = mysqli_fetch_row($result0);
		$event_id = $row0[0];
	} else {
		$event_id = $_GET['event_id'];
	}

	if ( $event_id === NULL ) {
		echo "<div id=\"startinfo\"><h1>Aby móc dodać sprzęt użyty na akcji
		na początku należy zdefiniować samą akcje</h1></div>";

} else {

	if ( count($_POST) > 0 ) {

		if ( isset($_GET['action']) && ( $_GET['action'] === "mod" ) ) {

			$mod_id = $_GET['id'];

			if ( isset($_GET['type']) && ( $_GET['type'] === 'eqEngine' ) ) {
				$tName = 'e_eqEngine';
				$csh = 'eq_id,personal_id,czas,paliwo,uwagi';
			} else {
				$tName = 'e_eqManual';
				$csh = 'eq_id,personal_id,czas,uwagi';
			}

			$pKL = generatePKL($tName, $csh);
			$whereValue = "id=" . $mod_id;
			dbMod($connection, $tName, $csh, $pKL, $whereValue);

		} else {

			if ( isset($_GET['type']) && ( $_GET['type'] === 'eqEngine' ) ) {
				$tName = 'e_eqEngine';
				$csh = 'eq_id,personal_id,czas,paliwo,uwagi,event_id';
			} else {
				$tName = 'e_eqManual';
				$csh = 'eq_id,personal_id,czas,uwagi,event_id';
			}

			$pKL = generatePKL($tName, $csh);
			dbAdd($connection, $tName, $csh, $pKL);
		}
			theTables($connection, $event_id);

	} else {

		if ( isset($_GET['action']) && ( $_GET['action'] === "del" ) ) {

			$del_id = $_GET['id'];

			if ( isset($_GET['type']) && ( $_GET['type'] === 'eqEngine' ) ) {
				$tName = 'e_eqEngine';
			} else { $tName = 'e_eqManual'; }

			$whereValue = 'id=' . $del_id;

			dbDel($connection, $tName, $whereValue);

			theTables($connection, $event_id);

		} else if ( isset($_GET['action']) && ( $_GET['action'] === "mod" ) ) {

			$mod_id = $_GET['id'];

			//Pobranie wszystkich kolumn z tabeli danego rekordu.
			if ( $_GET['type'] === 'eqManual' ) {
				$tName = 'e_eqManual';
			} else {
				$tName = 'e_eqEngine';
			}
				$csh = '*';
				$whereValue = 'id=' . $mod_id;
				$result0 = prepareForm($connection, $tName, $csh, $whereValue);

				if ( mysqli_num_rows($result0) > 0 ) {
					$row0 = mysqli_fetch_row($result0);

					$tName = 'eq_about';
					$csh = "id,nazwa";

					if ( $_GET['type'] === 'eqManual' ) {
						$whereValue = 'id=' . $row0[3];
					} else {
						$whereValue = 'id=' . $row0[4];
					}

					$result1 = prepareForm($connection, $tName, $csh, $whereValue);
					if ( mysqli_num_rows($result1) > 0 ) {
						$row1 = mysqli_fetch_row($result1);

						$tName = 'eq_about';
						$csh = "id,nazwa";
						$prepareValue = mysqli_real_escape_string($connection, 'Sprzęt o napędzie spalinowym');
						if ( $_GET['type'] === 'eqManual' ) {
							$whereValue = "rodzaj<>'" . $prepareValue . "';";
						} else {
							$whereValue = "rodzaj='" . $prepareValue . "';";
						}
						$result2 = prepareForm($connection, $tName, $csh, $whereValue);

						$tName = 'str_do';
						$csh = 'id,imie,nazwisko';

						if ( $_GET['type'] === 'eqManual' ) {
							$whereValue = 'id=' . $row0[4];
						} else {
							$whereValue = 'id=' . $row0[5];
						}

						$result3 = prepareForm($connection, $tName, $csh, $whereValue);
						if ( mysqli_num_rows($result3) > 0 ) {

							$row3 = mysqli_fetch_row($result3);

							$tName = 'str_do';
							$csh = 'id,imie,nazwisko';
							$whereValue = 'id IN (SELECT personal_id FROM e_member WHERE event_id=' . $_GET['event_id'] . ');';

							$result4 = prepareForm($connection, $tName, $csh, $whereValue);

							if ( $_GET['type'] === 'eqManual' ) {
								include('forms/event_eqManual_mod.php');
							} else {
								include('forms/event_eqEngine_mod.php');
							}

						} else {
							echo "<h3>Nie znaleziono osobowy o takim id</h3>";
						}

					} else {
						echo "<h3>Nie znaleziono takigo sprzętu</h3>";
					}

				} else {
					echo "<h3>Nie znaleziono wpisu o takim id</h3>";
				}
		} else {
			//Przygotowanie danych do formularza

				echo "<div><button id=\"eqManual\" class=\"chtype\" disabled=\"disabled\" style=\"float: left;\">Sprzęt ręczny</button>
					<button id=\"eqEngine\" class=\"chtype\" style=\"float: right\">Sprzęt silnikowy</button></div>
					<hr id=\"theline\">";

				echo "<div id=\"form\">";

				$tName = 'eq_about';
				$csh = "id,nazwa";
				//Użyto mysqli_real_escape_string ze względu na polskie znaki w zapytaniu
				$prepareValue = mysqli_real_escape_string($connection, 'Sprzęt o napędzie spalinowym');

				$whereValue = "rodzaj='" . $prepareValue . "';";
				$result3 = prepareForm($connection, $tName, $csh, $whereValue);

				$whereValue = "rodzaj<>'" . $prepareValue . "';";
				$result4 = prepareForm($connection, $tName, $csh, $whereValue);


				$tName = 'str_do';
				$csh = 'id,imie,nazwisko';
				$whereValue = 'id IN (SELECT personal_id FROM e_member WHERE event_id=' . $event_id . ');';

				$result5 = prepareForm($connection, $tName, $csh, $whereValue);

				include('forms/event_eq.php');

				echo "</div>
							<hr id=\"theline\">
							<div id=\"result\">";

				theTables($connection, $event_id);

			echo "</div>";

	}
}
}

 ?>
