<?php

echo "<form action=\"index.php?page=head_heads\" method=\"post\">
			<table>
			<tr><td>Imie i nazwisko naczelnika: </td>
					<td><input class=\"form_inputs\" type=\"text\" name=\"h_head_nazwisko\" /></td></tr>
			<tr><td>Lata sprawowania funkcji: </td>
					<td><input class=\"form_inputs\" type=\"text\" name=\"h_head_lata\" /></td></tr>
			<tr><td>Zawód: </td>
					<td><input class=\"form_inputs\" type=\"text\" name=\"h_head_zawod\" /></td></tr>
			<tr><td>Przeszkolenie: </td>
					<td><input class=\"form_inputs\" type=\"text\" name=\"h_head_szkolenie\" /></td></tr>
			<tr><td>Uwagi: </td>
					<td><input class=\"form_inputs\" type=\"text\" name=\"h_head_uwagi\" /></td></tr>
			</table>
			<div style=\"margin-top: 1%;\">
			<input class=\"form_button\" type=\"submit\" value=\"Zapisz\" />
			<button id=\"clear\">Wyczyść!</button>
					</div>
			</form>";

 ?>
