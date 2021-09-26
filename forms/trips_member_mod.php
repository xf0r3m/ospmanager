<?php

$row0 = mysqli_fetch_row($result0);

echo "<form action=\"index.php?page=trips_member&action=mod&id=" . $row0[0] . "\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"t_member_trips_id\" value=\"" . $row0[8] . "\" />
			<table>
			<tr>
			<td>Funkcja: </td>
			<td><input type=\"text\" class=\"form_inputs\" name=\"t_member_funkcja\" value=\"" . $row0[1] . "\" />";

echo "</td>
			</tr>
			<tr>
			<td>Uczestnik: </td>
			<td><select class=\"form_inputs\" name=\"t_member_personal_id\">";

			$result_bak = $result1;

			while ( $row_bak = mysqli_fetch_row($result_bak) ) {
				if ( $row_bak[0] === $row0[7]) {
					echo "<option value=\"" . $row_bak[0] . "\">" . $row_bak[1] . "  " . $row_bak[2] . "</option>";
				}
			}

			while ( $row1 = mysqli_fetch_row($result1) ) {
				if ( $row1[0] === $row0[7] ) { continue; }
				else {
					echo "<option value=\"" . $row1[0] . "\">" . $row1[1] . "  " . $row1[2] . "</option>";
				}
			}

			//$row0[2] = convertData($row0[2]);
			//$row0[3] = convertData($row0[3]);

			for ( $i=2; $i <= 3; $i++ ) {

				$timeExplode = explode(' ', $row0[$i]);
				$newDTL = $timeExplode[0] . 'T' . $timeExplode[1];
				$row0[$i] = $newDTL;

			}

$rozDT = explode('T', $row0[2]);
$zakDT = explode('T', $row0[3]);

echo "</select></td>
			</tr>
			<tr>
			<td>Czas rozpoczęcia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"t_member_rozpoczecie\" value=\"" . $row0[2] . "\" />
				<input class=\"form_inputs\" type=\"hidden\" value=\"" . $rozDT[0] . "\" size=\"5\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" value=\"" . $rozDT[1] . "\" size=\"3\" /></td>
			</tr>
			<tr>
			<td>Czas zakończenia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"t_member_zakonczenie\" value=\"" . $row0[3] . "\" />
				<input class=\"form_inputs\" type=\"hidden\" value=\"" . $zakDT[0] . "\" size=\"5\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" value=\"" . $zakDT[1] . "\" size=\"3\" /></td>
			</tr>
			<tr>
			<td>Czas udziału: </td>
			<td><input class=\"form_inputs\" type=\"time\" name=\"t_member_udzial\" value=\"" . $row0[4] . "\" /></td>
			</tr>
			<tr>
			<td>Pojazd: </td>
			<td><select class=\"form_inputs\" name=\"t_member_pojazd\" />";
			echo "<option value=\"" . $row0[5] . "\">" . $row0[5] . "</option>";

			while ( $row2 = mysqli_fetch_row($result2) ) {
				if ( $row2[0] === $row0[5]) { continue; }
				else {
					echo "<option value=\"" . $row2[0] . "\">" . $row2[0] . "</option>";
				}
			}

echo "</select></td>
			</tr>
			<tr>
			<td>Uwagi: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"t_member_uwagi\" value=\"" . $row0[6] . "\" /></td>
			</tr>
			<tr>
			<td></td>
			</tr>
			</table>
			<div style=\"margin-top: 1%\">
				<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\">
				<button id=\"clear\">Wyczyść!</button>
				</div>
			</form>";
?>
