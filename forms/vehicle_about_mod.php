<?php
$row0 = mysqli_fetch_row($result0);

echo "<form action=\"index.php?page=vehicle_about&action=mod&id=" . $row0[0] . "\" method=\"post\">
				<table>
					<tr>
					<td>Nazwa: </td>
					<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_about_nazwa\" value=\"" . $row0[1] . "\" /></td>
					</tr>
					<tr>
					<td>Marka: </td>
					<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_about_marka\" value=\"" . $row0[2] . "\" /></td>
					</tr>
					<tr>
					<td>Klasa wagowa: </td>
					<td><select class=\"form_inputs\" name=\"vehicle_about_waga\" />
						<option>";

$list14 = ["Lekki", "Średni", "Cieżki"];
generateSelectOptionList($row0[3], $list14);

echo "</select></td>
			</tr>
			<tr>
			<td>Typ: </td>
			<td><select class=\"form_inputs\" name=\"vehicle_about_typ\">
				<option>";

$list15 = ["Gaśniczy", "Specjalny"];
generateSelectOptionList($row0[4], $list15);

echo "</select></td>
			</tr>
			<tr>
			<td>Rodzja pojazdu: </td>
			<td><select class=\"form_inputs\" name=\"vehicle_about_rodzaj\">
				<option>";

$list16 = ["Dowodzenia i łączności", "Kontenerowy", "Kwatermistrzowski",
						"Operacyjny", "Ratownictwa chemicznego", "Ratownictwa ekologicznego",
						"Ratownictwa medycznego", "Ratownictwa technicznego",
						"Ratownictwa wodnego", "Ratowniczo-poszukiwawczy",
						"Rozpoznawczo-ratowniczy", "Wężowy"];
generateSelectOptionList($row0[5], $list16);

echo "</select></td>
			</tr>
			<tr>
			<td>Numer rejestracyjny: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_about_rejestracja\" value=\"" . $row0[6] . "\" /></td>
			</tr>
			<tr>
			<td>Numer operacyjny: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_about_numer\" value=\"" . $row0[7] . "\" /></td>
			</tr>
			<tr>
			<td>Obsada: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"vehicle_about_obsada\" value=\"" . $row0[8] . "\" /></td>
			</tr>
			<tr>
			<td>Rodzja paliwa: </td>
			<td><select class=\"form_inputs\" name=\"vehicle_about_paliwo\">
				<option>";

$list17 = ["LPG", "ON"];
generateSelectOptionList($row0[9], $list17);

echo "</select></td>
			</tr>
			<tr>
			<td>Pojemność zbiornika paliwa: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"vehicle_about_zbiornik\" value=\"" . $row0[10] . "\" /></td>
			</tr>
			<tr>
			<td>Napęd: </td>
			<td><select class=\"form_inputs\" name=\"vehicle_about_naped\">
				<option>";

$list18 = ["2x4", "4x4"];
generateSelectOptionList($row0[11], $list18);

echo "</select></td>
			</tr>
			</table>
				<div style=\"margin-top: 1%;\">
				<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
					<button id=\"clear\">Wyczyść!</button></div>
			</form>";

?>
