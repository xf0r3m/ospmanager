<?php

echo "<form action=\"index.php?page=trips_about\" method=\"post\">
			<table>
			<tr>
			<td>Nazwa: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"t_about_nazwa\" /></td>
			</tr>
			<tr>
			<td>Rodzaj: </td>
			<td><input type=\"text\" class=\"form_inputs\" name=\"t_about_rodzaj\" />";


echo "</td>
			</tr>
			<tr>
			<td>Miejscowość: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"t_about_miejscowosc\" /></td>
			</tr>
			<tr>
			<td>Ulica: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"t_about_ulica\" /></td>
			</tr>
			<tr>
			<td>Numer posesji: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"t_about_posesja\" /></td>
			</tr>
			<tr>
			<td>Czas rozpoczęcia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"t_about_rozpoczecie\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\"/></td>
			</tr>
			<tr>
			<td>Czas zakończenia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"t_about_zakonczenie\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\" /></td>
			</tr>
			<tr>
			<td>Czas trwania: </td>
			<td><input class=\"form_inputs\" type=\"time\" name=\"t_about_czas\" /></td>
			</tr>
			</table>
			<div style=\"margin-top: 1%;\">
			<input class=\"form_button\" type=\"submit\" value=\"Dodaj wyjazd\" />
				<button id=\"clear\">Wyczyść!</button>
				</div>
			</div>
			</form>";


 ?>
