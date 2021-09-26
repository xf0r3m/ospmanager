<?php

$row0 = mysqli_fetch_row($result0);

$tName = 'str_do';
$csh = "id,imie,nazwisko";
$whereValue = "id=" . $row0[6];
$result3 = prepareForm($connection, $tName, $csh, $whereValue);
$row3 = mysqli_fetch_row($result3);



echo "<form action=\"index.php?page=event_member&action=mod&id=" . $row0[0] . "&event_id=" . $row0[7] . "\" method=\"post\">
			<table>
			<tr>
			<td>Funkcja: </td>
			<td><select class=\"form_inputs\" name=\"e_member_funkcja\">
			<option>";

$list10 = ["Dowódca", "Kierowca", "Strażak"];
generateSelectOptionList($row0[1], $list10);

echo "</select></td>
			</tr>
			<tr>
			<td>Uczestnik: </td>
			<td><select class=\"form_inputs\" name=\"e_member_personal_id\">
			<option value=\"" . $row3[0] . "\">" . $row3[1] . " " . $row3[2] . "</option>";

			while ( $row1 = mysqli_fetch_row($result1) ) {
				if ( $row1[0] === $row3[0] ) { continue; }
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
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"e_member_rozpoczecie\" value=\"" . $row0[2] . "\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\" value=\"" . $rozDT[0] . "\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\" value=\"" . $rozDT[1] . "\" />
			</td>
			</tr>
			<tr>
			<td>Czas zakończenia: </td>
			<td><input class=\"form_inputs\" type=\"datetime_local\" name=\"e_member_zakonczenie\" value=\"" . $row0[3] . "\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\" value=\"" . $zakDT[0] . "\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\" value=\"" . $zakDT[1] . "\" />
			</td>
			</tr>
			<tr>
			<td>Czas udziału: </td>
			<td><input class=\"form_inputs\" type=\"time\" name=\"e_member_udzial\" value=\"" . $row0[4] . "\" /></td>
			</tr>
			<tr>
			<td>Pojazd: </td>
			<td><select class=\"form_inputs\" name=\"e_member_pojazd\" />
			<option>";

$row2 = mysqli_fetch_row($result2);
generateSelectOptionList($row0[5], $row2);

echo "</select></td>
			</tr>
			</table>
			<div style=\"margin-top: 1%;\">
			<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\">
			<button id=\"clear\">Wyczyść!</button>
			</div>
			</form>";
?>
