<?php
echo "<form action=\"index.php?page=vehicle_about\" method=\"post\">
				<table>
					<tr>
					<td>Nazwa: </td>
					<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_about_nazwa\" /></td>
					</tr>
					<tr>
					<td>Marka: </td>
					<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_about_marka\" /></td>
					</tr>
					<tr>
					<td>Klasa wagowa: </td>
					<td><select class=\"form_inputs\" name=\"vehicle_about_waga\" />
						<option>";

$list14 = ["Lekki", "Średni", "Cieżki"];
generateSelectOptionList("", $list14);

echo "</select></td>
			</tr>
			<tr>
			<td>Typ: </td>
			<td><select class=\"form_inputs\" name=\"vehicle_about_typ\">
				<option>";

$list15 = ["Gaśniczy", "Specjalny"];
generateSelectOptionList("", $list15);

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
generateSelectOptionList("", $list16);

echo "</select></td>
			</tr>
			<tr>
			<td>Numer rejestracyjny: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_about_rejestracja\" /></td>
			</tr>
			<tr>
			<td>Numer operacyjny: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_about_numer\" /></td>
			</tr>
			<tr>
			<td>Obsada: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"vehicle_about_obsada\" /></td>
			</tr>
			<tr>
			<td>Rodzja paliwa: </td>
			<td><select class=\"form_inputs\" name=\"vehicle_about_paliwo\">
				<option>";

$list17 = ["LPG", "ON"];
generateSelectOptionList("", $list17);

echo "</select></td>
			</tr>
			<tr>
			<td>Pojemność zbiornika paliwa: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"vehicle_about_zbiornik\" /></td>
			</tr>
			<tr>
			<td>Napęd: </td>
			<td><select class=\"form_inputs\" name=\"vehicle_about_naped\">
				<option>";

$list18 = ["2x4", "4x4"];
generateSelectOptionList("", $list18);

echo "</select></td>
			</tr>
			</table>
			<div style=\"margin-top: 1%;\">
			<input class=\"form_button\" type=\"submit\" value=\"Dodaj pojazd\" />
				<button id=\"clear\">Wyczyść!</button>
			</div>
			</form>";

?>
