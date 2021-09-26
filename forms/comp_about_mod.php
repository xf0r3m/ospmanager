<?php

$row0 = mysqli_fetch_row($result0);

echo "<form action=\"index.php?page=comp_about&action=mod&id=" . $row0[0] . "\" method=\"post\">
			<table>
			<tr>
			<td>Nazwa: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"c_about_nazwa\" value=\"" . $row0[1] . "\" /></td>
			</tr>
			<tr>
			<td>Rodzaj: </td>
			<td><input type=\"text\" class=\"form_inputs\" name=\"c_about_rodzaj\" value=\"" . $row0[2] . "\" />";

echo "</td
			</tr>
			<tr>
			<td>Grupa: </td>
			<td><select class=\"form_inputs\" name=\"c_about_grupa\">
			<option>";

			$list24 = ["Żeńska", "Męska"];
			generateSelectOptionList($row0[3], $list24);

echo "</select></td>
			</tr>
			<tr>
			<td>Szczebel: </td>
			<td><select class=\"form_inputs\" name=\"c_about_szczebel\">
			<option>";

			$list25 = ["Gminny", "Powiatowy", "Wojwódzki", "Krajowy"];
			generateSelectOptionList($row0[4], $list25);

echo "</select></td>
			</tr>
			<tr>
			<td>Miejscowość: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"c_about_miejscowosc\" value=\"" . $row0[5] . "\" /></td>
			</tr>
			<tr>";

			//$row0[6] = convertData($row0[6]);
			//$row0[7] = convertData($row0[7]);

			for ( $i=6; $i <= 7; $i++ ) {
				$timeExplode = explode(' ', $row0[$i]);
				$newDTL = $timeExplode[0] . 'T' . $timeExplode[1];
				$row0[$i] = $newDTL;
			}

$rozDT = explode('T', $row0[6]);
$zakDT = explode('T', $row0[7]);

echo  "<td>Czas rozpoczęcia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"c_about_rozpoczecie\" value=\"" . $row0[6] . "\" />
				<input class=\"form_inputs\" type=\"hidden\" value=\"" . $rozDT[0] . "\" size=\"5\" />&nbsp;
<input class=\"form_inputs\" type=\"hidden\" value=\"" . $rozDT[1] . "\" size=\"3\" /></td>
			</tr>
			<tr>
			<td>Czas zakończenia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"c_about_zakonczenie\" value=\"" . $row0[7] . "\" />
				<input class=\"form_inputs\" type=\"hidden\" value=\"" . $zakDT[0] . "\" />&nbsp;
<input class=\"form_inputs\" type=\"hidden\" value=\"" . $zakDT[1] . "\" size=\"3\" /></td>
			</tr>
			<tr>
			<td>Czas trwania: </td>
			<td><input class=\"form_inputs\" type=\"time\" name=\"c_about_czas\" value=\"" . $row0[8] . "\" /></td>
			</tr>
			</table>
				<div style=\"margin-top: 1%;\">
				<input class=\"form_button\" type=\"submit\" value=\"Zatwierdź!\" />
					<button id=\"clear\">Wyczyść!</button>
				</div>
			</form>";
 ?>
