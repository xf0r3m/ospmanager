<?php

echo "<form action=\"index.php?page=comp_about\" method=\"post\">
			<table>
			<tr>
			<td>Nazwa: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"c_about_nazwa\" /></td>
			</tr>
			<tr>
			<td>Rodzaj: </td>
			<td><input type=\"text\" class=\"form_inputs\" name=\"c_about_rodzaj\" />";


echo "</td>
			</tr>
			<tr>
			<td>Grupa: </td>
			<td><select class=\"form_inputs\" name=\"c_about_grupa\">
			<option></option>";

			$list24 = ["Żeńska", "Męska"];
			generateSelectOptionList("", $list24);

echo "</select></td>
			</tr>
			<tr>
			<td>Szczebel: </td>
			<td><select class=\"form_inputs\" name=\"c_about_szczebel\">
			<option></option>";

			$list25 = ["Gminny", "Powiatowy", "Wojwódzki", "Krajowy"];
			generateSelectOptionList("", $list25);

echo "</select></td>
			</tr>
			<tr>
			<td>Miejscowość: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"c_about_miejscowosc\" /></td>
			</tr>
			<tr>
			<td>Czas rozpoczęcia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"c_about_rozpoczecie\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\" /></td>
			</tr>
			<tr>
			<td>Czas zakończenia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"c_about_zakonczenie\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\" /></td>
			</tr>
			<tr>
			<td>Czas trwania: </td>
			<td><input class=\"form_inputs\" type=\"time\" name=\"c_about_czas\" /></td>
			</tr>
			</table>
			<div style=\"margin-top: 1%;\">
				<input class=\"form_button\" type=\"submit\" value=\"Zatwierdź\" />
				<button id=\"clear\">Wyczyść</button>
			</div>
			</form>";
 ?>
