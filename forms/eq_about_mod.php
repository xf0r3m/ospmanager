<?php

$row0 = mysqli_fetch_row($result0);

echo "
	<script src=\"forms/add.js\"></script>
	<form action=\"index.php?page=eq_about&action=mod&id=" . $row0[0] . "\" method=\"post\" />
	<table>
	<tr>
	<td>Nazwa: </td>
	<td><input class=\"form_inputs\" type=\"text\" name=\"eq_about_nazwa\" value=\"" . $row0[1] . "\" /></td>
	</tr>
	<tr>
	<td>Numer seryjny: </td>
	<td><input class=\"form_inputs\" type=\"text\" name=\"eq_about_sn\" value=\"" . $row0[2] . "\" /></td>
	</tr>
	<tr>
	<td>Rodzaj: </td>
	<td><select class=\"form_inputs\" id=\"s1\" name=\"eq_about_rodzaj\" onClick=\"spalinowy()\">
			<option>";

$list11 = ["Agregaty gaśnicze", "Drabiny pożarnicze",
						"Podręczny sprzęt gaśniczy", "Pompy pożarnicze",
						"Płachtowe urządzenie ratownicze", "Sprzęt burzący",
						"Sprzęt i armatura wodna", "Sprzęty nurkowy i pływający",
						"Sprzęt o napędzie elektryczny", "Sprzęt o napędzie elektrycznym",
						"Sprzęt o napędzie pneumatycznym", "Sprzęt o napędzie spalinowym",
						"Sprzęt oświetleniowy", "Sprzęt pianowy", "Sprzęt łączności",
						"Uzbrojenie osobiste"];

generateSelectOptionList($row0[3], $list11);

echo "</select> 
    <button class=\"plusButton\">+</button>
</td>
	<tr style=\"display: none;\">
		<td style=\"margin-left: 10%; display: block;\">Wartość: </td>
		<td><input class=\"form_inputs\" type=\"text\" style=\"margin-left: 10%; border-color: black;\" />&nbsp;<button class=\"addButton\">Dodaj</button></td>
	</tr>
		<tr>
		<td>Podrodzaj: </td>
		<td><input class=\"form_inputs\" type=\"text\" name=\"eq_about_podrodzaj\" value=\"" . $row0[4] . "\" /></td>
		</tr>
		<tr>
		<td>Przeznaczenie: </td>
		<td><select class=\"form_inputs\" id=\"s2\" name=\"eq_about_dest\">
			<option>";

$list12 = ["Akcje", "Biuro", "Zawody"];

generateSelectOptionList($row0[5], $list12);

echo "</select><button class=\"plusButton\">+</button></td>
	</tr>
	<tr style=\"display: none;\">
		<td style=\"margin-left: 10%; display: block;\">Wartość: </td>
		<td><input class=\"form_inputs\" type=\"text\" style=\"margin-left: 10%; border-color: black;\" />&nbsp;<button class=\"addButton\">Dodaj</button></td>
	</tr>
		<tr>";

$row0[6] = convertData($row0[6], 'y');

echo "<td>Data zakupu: </td>
		<td><input class=\"form_inputs\" type=\"date\" name=\"eq_about_datazak\" value=\"" . $row0[6] . "\" /></td>
		</tr>
		<tr>
		<td>Marka: </td>
		<td><input class=\"form_inputs\" type=\"text\" name=\"eq_about_marka\" value=\"" . $row0[7] . "\" /></td>
		</tr>
		<tr>
		<td>Pojemność: </td>";
		if ( stripos($row0[3], 'Sprzęt o napędzie spalinowym') !== FALSE ) {
			echo "<td><input class=\"form_inputs\" type=\"number\" name=\"eq_about_poj\" value=\"" . $row0[8] . "\" /></td>";

		} else {
			echo "<td><input class=\"form_inputs\" id=\"reado\" type=\"number\" name=\"eq_about_poj\" value=\"" . $row0[8] . "\" readonly=\"readonly\"/></td>";
		}
		echo "</tr>
		<tr>
		<td>Stan: </td>
		<td><select class=\"form_inputs\" id=\"s3\" name=\"eq_about_stan\" />
				<option>";

$list13 = ["Zdatny", "Niezdatny", "Naprawa"];

generateSelectOptionList($row0[9], $list13);

echo "</select><button class=\"plusButton\">+</button>
	</td>
	</tr>

	<tr style=\"display: none;\">
		<td style=\"margin-left: 10%; display: block;\">Wartość: </td>
		<td><input class=\"form_inputs\" type=\"text\" style=\"margin-left: 10%; border-color: black;\" />&nbsp;<button class=\"addButton\">Dodaj</button></td>
	</tr>

	<tr>
	<td>Liczba sztuk: </td>
	<td><input class=\"form_inputs\" type=\"number\" name=\"eq_about_liczba\" value=\"" . $row0[10] . "\" /></td>
	</tr>
	<tr>
	<td>CNBOP: </td>
	<td><input class=\"form_inputs\" type=\"text\" name=\"eq_about_CNBOP\" value=\"" . $row0[11] . "\" /></td>
	</tr>
	<tr>
	<td>Lokalizacja: </td>
	<td><select class=\"form_inputs\" id=\"s4\" name=\"eq_about_lokalizacja\" />
		<option value=\"" . $row0[12] . "\">" . $row0[12] . "</option>
		</select>
	<button class=\"plusButton\">+</button></td>
	</tr>
	<tr style=\"display: none;\">
		<td style=\"margin-left: 10%; display: block;\">Wartość: </td>
		<td><input class=\"form_inputs\" type=\"text\" style=\"margin-left: 10%; border-color: black;\" />&nbsp;<button class=\"addButton\">Dodaj</button></td>
	</tr>

	<tr>
	<td>Źródło finansowania: </td>
	<td><select class=\"form_inputs\" id=\"s5\" name=\"eq_about_finansowanie\" />
		<option value=\"" . $row0[13] . "\">" . $row0[13] . "</option>
		</select>
		<button class=\"plusButton\">+</button></td>

	</tr>
<tr style=\"display: none;\">
		<td style=\"margin-left: 10%; display: block;\">Wartość: </td>
		<td><input class=\"form_inputs\" type=\"text\" style=\"margin-left: 10%; border-color: black;\" />&nbsp;<button class=\"addButton\">Dodaj</button></td>
	</tr>

	</table>
		<div style=\"margin-top: 1%;\">
		<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
			<button id=\"clear\">Wyczyść!</button>
			</div>
	</form>";



?>
