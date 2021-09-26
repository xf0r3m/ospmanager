<?php
echo "<form action=\"index.php?page=event_about\" method=\"post\">
			<table>
			<tr>
			<td>Nazwa: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"e_about_nazwa\" />
			</tr>
			<tr>
			<td>Rodzaj: </td>
			<td><input type=\"text\" class=\"form_inputs\" name=\"e_about_rodzaj\" />";

echo "</td>
			</tr>
			<tr>
			<td>Numer Meldunku: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"e_about_nrmel\" /></td>
			</tr>
			<tr>
			<td>Uwagi: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"e_about_uwagi\" /></td>
			</tr>
			<tr>
			<td>Miejscowość: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"e_about_miejscowosc\" /></td>
			</tr>
			<tr>
			<td>Ulica: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"e_about_ulica\" /></td>
			</tr>
			<tr>
			<td>Numer posesji: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"e_about_posesja\" /></td>
			</tr>
			<tr>
			<td>Czas zaalarmowania: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"e_about_alarm\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\">&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\"></td>
			</tr>
			<tr>
			<td>Czas rozpoczęcia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"e_about_rozpoczecie\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\">&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\"></td>


			</tr>
			<tr>
			<td>Czas zakończenia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"e_about_zakonczenie\" />

				<input class=\"form_inputs\" type=\"hidden\" size=\"5\">&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\"></td>

			</tr>
			<tr>
			<td>Czas trwania akcji: </td>
			<td><input class=\"form_inputs\" type=\"time\" name=\"e_about_trwanie\" /></td>
			</tr>
			</table>
			<div style=\"margin-top: 1%;\">
			<input class=\"form_button\" type=\"submit\" value=\"Zatwierdź\" />
					<button id=\"clear\">Wyczyść!</button></div>
				</div>
			</form>";

?>
