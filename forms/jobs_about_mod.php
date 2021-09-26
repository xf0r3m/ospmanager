<?php

$row0 = mysqli_fetch_row($result0);

echo "<form action=\"index.php?page=jobs_about&action=mod&id=". $row0[0] ."\" method=\"post\">
			<table>
			<tr>
			<td>Nazwa: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"j_about_nazwa\" value=\"" . $row0[1] . "\" /></td>
			</tr>";

			//$row0[2] = convertData($row0[2]);
			//$row0[3] = convertData($row0[3]);

			for ( $i=2; $i <= 3; $i++ ) {

				$timeExplode = explode(' ', $row0[$i]);
				$newDTL = $timeExplode[0] . 'T' . $timeExplode[1];
				$row0[$i] = $newDTL;
			}

$rozDT = explode('T', $row0[2]);
$zakDT = explode('T', $row0[3]);

echo "<tr>
			<tr>
			<td>Czas rozpoczęcia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"j_about_rozpoczecie\" value=\"" . $row0[2] . "\" />
				<input class=\"form_inputs\" type=\"hidden\" value=\"" . $rozDT[0] . "\" size=\"5\" />&nbsp;
<input class=\"form_inputs\" type=\"hidden\" value=\"" . $rozDT[1] . "\" size=\"3\" /></td>
			</tr>
			<tr>
			<td>Czas zakończenia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"j_about_zakonczenie\" value=\"" . $row0[3] . "\" />
				<input class=\"form_inputs\" type=\"hidden\" value=\"" . $zakDT[0] . "\" size=\"5\" />&nbsp;
<input class=\"form_inputs\" type=\"hidden\" value=\"" . $zakDT[1] . "\" size=\"3\" /></td>
			</tr>
			<tr>
			<td>Czas trwania: </td>
			<td><input class=\"form_inputs\" type=\"time\" name=\"j_about_czas\" value=\"" . $row0[4] . "\" /></td>
			</tr>
			<tr>
			</table>
				<div style=\"margin-top: 1%;\">
				<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
					<button id=\"clear\">Wyczyść!</button>
					</div>
			</form>";

 ?>
