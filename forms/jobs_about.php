<?php
echo "<form action=\"index.php?page=jobs_about\" method=\"post\">
			<table>
			<tr>
			<td>Nazwa: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"j_about_nazwa\" /></td>
			</tr>";

echo "<tr>
			<tr>
			<td>Czas rozpoczęcia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"j_about_rozpoczecie\" />	
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\" /></td>
			</tr>
			<tr>
			<td>Czas zakończenia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"j_about_zakonczenie\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\" ></td>
			</tr>
			<tr>
			<td>Czas trwania: </td>
			<td><input class=\"form_inputs\" type=\"time\" name=\"j_about_czas\" /></td>
			</tr>
			<tr><td></td></tr>
			</table>
			<div style=\"margin-top: 1%;\">
			<input class=\"form_button\" type=\"submit\" value=\"Dodaj prace\" />
				<button id=\"clear\">Wyczyść!</button>
				</div>
			</form>";

 ?>
