<?php

#echo "<script src=\"forms/add.js\"></script>";

echo "<form action=\"index.php?page=eq_about\" method=\"post\" />
	<table>
	<tr>
	<td>Nazwa: </td>
	<td><input class=\"form_inputs\" type=\"text\" name=\"eq_about_nazwa\" /></td>
	</tr>
	<tr>
	<td>Numer seryjny: </td>
	<td><input class=\"form_inputs\" type=\"text\" name=\"eq_about_sn\" /></td>
	</tr>
	<tr>
	<td>Rodzaj: </td>
	<td>";



echo "
	 <select class=\"form_inputs\" name=\"eq_about_rodzaj\">
		<option></option>
        <option value=\"Agregaty gaśnicze\">Agregaty gaśnicze</option>
        <option value=\"Drabiny pożarnicze\">Drabiny pożarnicze</option>
        <option value=\"Podręczny sprzęt gaśniczy\">Podręczny sprzęt gaśniczy</option>
        <option value=\"Pompy pożarnicze\">Pompy pożarnicze</option>
        <option value=\"Płachtowe urządzenie ratownicze\">Płachtowe urządzenie ratownicze</option>
        <option value=\"Sprzęt burzący\">Sprzęt burzący</option>
        <option value=\"Sprzęt i armatura wodna\">Sprzęt i armatura wodna</option>
        <option value=\"Sprzęt nurkowy i pływający\">Sprzęt nurkowy i pływający</option>
        <option value=\"Sprzęt o napędzie elektrycznym\">Sprzęt o napędzie elektrycznym</option>
        <option value=\"Sprzęt o napędzie pneumatycznym\">Sprzęt o napędzie pneumatycznym</option>
        <option value=\"Sprzęt o napędzie spalinowym\">Sprzęt o napędzie spalinowym</option>
        <option value=\"Sprzęt oświetleniowy\">Sprzęt oświetleniowy</option>
        <option value=\"Sprzęt pianowy\">Sprzęt pianowy</option>
        <option value=\"Sprzęt łączności\">Sprzęt łączności</option>
        <option value=\"Uzbrojenie osobiste\">Uzbrojenie osobiste</option>
        </select>&nbsp;
	<button class=\"plusButton\">+</button>
	</td>
	</tr>
	<tr style=\"display: none\">
		<td style=\"margin-left: 10%; display: block;\">Wartość: </td>
		<td><input class=\"form_inputs\" type=\"text\" style=\"margin-left: 10%; border-color: black; \"/>&nbsp;<button class=\"addButton\">Dodaj</button></td>
</tr>
		<tr>
		<td>Podrodzaj: </td>
		<td><input class=\"form_inputs\" type=\"text\" name=\"eq_about_podrodzaj\" /></td>
		</tr>
		<tr>
		<td>Przeznaczenie: </td>
		<td>";





echo "
	<select class=\"form_inputs\" name=\"eq_about_dest\">
	<option></option>
        <option value=\"Akcje\">Akcje</option>
        <option value=\"Biuro\">Biuro</option>
        <option value=\"Zawody\">Zawody</option>
        </select>&nbsp;<button class=\"plusButton\">+</button>
        </td>
	</tr>
	<tr style=\"display: none\">
		<td style=\"margin-left: 10%; display: block;\">Wartość: </td>
		<td><input class=\"form_inputs\" type=\"text\" style=\"margin-left: 10%; border-color: black; \"/>&nbsp;<button class=\"addButton\">Dodaj</button></td>
	</tr>

		<tr>
		<td>Data zakupu: </td>
		<td><input class=\"form_inputs\" type=\"date\" name=\"eq_about_datazak\" /></td>
		</tr>
		<tr>
		<td>Marka: </td>
		<td><input class=\"form_inputs\" type=\"text\" name=\"eq_about_marka\" /></td>
		</tr>
		<tr>
		<td>Pojemność: </td>
		<td><input class=\"form_inputs\" type=\"number\" name=\"eq_about_poj\" readonly value=\"0\"/></td>
		</tr>
		<tr>
		<td>Stan: </td>
		<td>
				";

$list13 = ["Zdatny", "Niezdatny", "Naprawa"];


echo "
    <select class=\"form_inputs\" name=\"eq_about_stan\">
	<option></option>
        <option value=\"Zdatny\">Zdatny</option>
        <option value=\"Niezdatny\">Niezdatny</option>
        <option value=\"Naprawa\">Naprawa</option>
     </select>&nbsp;<button class=\"plusButton\">+</button>
	</td>
	<tr style=\"display: none\">
		<td style=\"margin-left: 10%; display: block;\">Wartość: </td>
		<td><input class=\"form_inputs\" type=\"text\" style=\"margin-left: 10%; border-color: black; \"/>&nbsp;<button class=\"addButton\">Dodaj</button></td>
	</tr>

	</tr>
	<tr><td>Liczba sztuk: </td>
	<td><input class=\"form_inputs\" type=\"number\"  name=\"eq_about_liczba\" /></td>
	</tr>
	<tr>
	<td>CNBOP: </td>
	<td><input class=\"form_inputs\" type=\"text\" name=\"eq_about_CNBOP\" /></td>
	</tr>
	<tr>
	<td>Lokalizacja: </td>
	<td><select class=\"form_inputs\" name=\"eq_about_lokalizacja\" />
		<option></option>
		</select>
	<button class=\"plusButton\">+</button>
      	</td> 
	</tr>
	<tr style=\"display: none\">
		<td style=\"margin-left: 10%; display: block;\">Wartość: </td>
		<td><input class=\"form_inputs\" type=\"text\" style=\"margin-left: 10%; border-color: black; \"/>&nbsp;<button class=\"addButton\">Dodaj</button></td>
	</tr>
	<tr>
	<td>Źródło finansowania: </td>
	<td><select class=\"form_inputs\" name=\"eq_about_finansowanie\" />
		<option></option>
		</select>
		<button class=\"plusButton\">+</button></td>
	</tr>
	<tr style=\"display: none\">
		<td style=\"margin-left: 10%; display: block;\">Wartość: </td>
		<td><input class=\"form_inputs\" type=\"text\" style=\"margin-left: 10%; border-color: black; \"/>&nbsp;<button class=\"addButton\">Dodaj</button></td>
	</tr>

	</table>
	<div style=\"margin-top: 1%;\">
	<input class=\"form_button\" type=\"submit\" value=\"Dodaj sprzęt\" />
			<button id=\"clear\">Wyczyść!</button>
		</div>
	</form>";



?>
