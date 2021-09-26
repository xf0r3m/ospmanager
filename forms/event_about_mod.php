<?php

$row0 = mysqli_fetch_row($result0);
echo "<form action=\"index.php?page=event_about&action=mod&id=" . $row0[0] . "\" method=\"post\">
			<table>
			<tr>
			<td>Nazwa: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"e_about_nazwa\" value=\"" . $row0[1] . "\" />
			</tr>
			<tr>
			<td>Rodzaj: </td>
			<td><input type=\"text\" class=\"form_inputs\" name=\"e_about_rodzaj\" value=\"" . $row0[2] . "\" />";

echo "</td>
			</tr>
			<tr>
			<td>Numer Meldunku: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"e_about_nrmel\" value=\"" . $row0[3] . "\" /></td>
			</tr>
			<tr>
			<td>Uwagi: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"e_about_uwagi\" value=\"" . $row0[4] . "\" /></td>
			</tr>
			<tr>
			<td>Miejscowość: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"e_about_miejscowosc\" value=\"" . $row0[5] . "\" /></td>
			</tr>
			<tr>
			<td>Ulica: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"e_about_ulica\" value=\"" . $row0[6] . "\" /></td>
			</tr>
			<tr>
			<td>Numer posesji: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"e_about_posesja\" value=\"" . $row0[7] . "\" /></td>
			</tr>
			<tr>";

			//$row0[9] = convertData($row0[9]);
			//$row0[10] = convertData($row0[10]);
			//$row0[11] = convertData($row0[11]);

			for ( $i=8; $i <= 10; $i++ ) {
				$timeExplode = explode(' ', $row0[$i]);
				$newDTL = $timeExplode[0] . 'T' . $timeExplode[1];
				$row0[$i] = $newDTL;
			}

$alarmDT = explode('T', $row0[8]);
$rozDT = explode('T', $row0[9]);
$zakDT = explode('T', $row0[10]);

echo 	"<td>Czas zaalarmowania: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"e_about_alarm\" value=\"" . $row0[8] . "\" />
				<input class=\"form_inputs\" type=\"hidden\" value=\"" . $alarmDT[0] . "\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" value=\"" . $alarmDT[1] . "\" />
			</td>
			</tr>
			<tr>
			<td>Czas rozpoczęcia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"e_about_rozpoczecie\" value=\"" . $row0[9] . "\" />
			<input class=\"form_inputs\" type=\"hidden\" value=\"" . $rozDT[0] . "\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" value=\"" . $rozDT[1] . "\" />

			</td>
			</tr>
			<tr>
			<td>Czas zakończenia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"e_about_zakonczenie\" value=\"" . $row0[10] . "\" />
			<input class=\"form_inputs\" type=\"hidden\" value=\"" . $zakDT[0] . "\" />&nbsp;
			<input class=\"form_inputs\" type=\"hidden\" value=\"" . $zakDT[1] . "\" />

			</td>
			</tr>
			<tr>
			<td>Czas trwania akcji: </td>
			<td><input class=\"form_inputs\" type=\"time\" name=\"e_about_trwanie\" value=\"" . $row0[11] . "\" /></td>
			</tr>
			</table>
			<div style=\"margin-top: 1%;\">
			<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
						<button id=\"clear\">Wyczyść!</button></div>
			</form>";

 ?>
