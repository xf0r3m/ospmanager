<?php

$row0 = mysqli_fetch_row($result0);

echo "<form action=\"index.php?page=trips_about&action=mod&id=" . $row0[0] . "\" method=\"post\">
			<table>
			<tr>
			<td>Nazwa: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"t_about_nazwa\" value=\"" . $row0[1] . "\" /></td>
			</tr>
			<tr>
			<td>Rodzaj: </td>
			<td><input type=\"text\" class=\"form_inputs\" name=\"t_about_rodzaj\" value=\"" . $row0[2] . "\" />";


			//$row0[6] = convertData($row0[6]);
			//$row0[7] = convertData($row0[7]);

			for ( $i=6; $i <= 7; $i++ ) {
				$timeExplode = explode(' ', $row0[$i]);
				$newDTL = $timeExplode[0] . 'T' . $timeExplode[1];
				$row0[$i] = $newDTL;
			}

$rozDT = explode('T', $row0[6]);
$zakDT = explode('T', $row0[7]);

echo "</td>
			</tr>
			<tr>
			<td>Miejscowość: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"t_about_miejscowosc\" value=\"" . $row0[3] . "\" /></td>
			</tr>
			<tr>
			<td>Ulica: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"t_about_ulica\" value=\"" . $row0[4] . "\" /></td>
			</tr>
			<tr>
			<td>Numer posesji: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"t_about_posesja\" value=\"" . $row0[5] . "\" /></td>
			</tr>
			<tr>
			<td>Czas rozpoczęcia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"t_about_rozpoczecie\" value=\"" . $row0[6] . "\" />
				<input class=\"form_inputs\" type=\"hidden\" value=\"" . $rozDT[0] . "\" size=\"5\" />&nbsp;
<input class=\"form_inputs\" type=\"hidden\" value=\"" . $rozDT[1] . "\" size=\"3\" /></td>
			</tr>
			<tr>
			<td>Czas zakończenia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"t_about_zakonczenie\" value=\"" . $row0[7] . "\" />
				<input class=\"form_inputs\" type=\"hidden\" value=\"" . $zakDT[0] . "\" />&nbsp;
<input class=\"form_inputs\" type=\"hidden\" value=\"" . $zakDT[1] . "\" /></td>
			</tr>
			<tr>
			<td>Czas trwania: </td>
			<td><input class=\"form_inputs\" type=\"time\" name=\"t_about_czas\" value=\"" . $row0[8] . "\" /></td>
			</tr>
			</table>
			<div style=\"margin-top: 1%;\">
				<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
					<button id=\"clear\">Wyczyść</button>
			</div>
			</form>";

 ?>
