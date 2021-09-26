<?php

$row = mysqli_fetch_row($result);

echo "<form action=\"index.php?page=head_heads&action=mod&id=" . $row[0] . "\" method=\"post\">
			<table>
			<tr><td>Imie i nazwisko naczelnika: </td>
					<td><input class=\"form_inputs\" type=\"text\" name=\"h_head_nazwisko\" value=\"" . $row[1] . "\" /></td></tr>
			<tr><td>Lata sprawowania funkcji: </td>
					<td><input class=\"form_inputs\" type=\"text\" name=\"h_head_lata\" value=\"" . $row[2] . "\" /></td></tr>
			<tr><td>Zawód: </td>
					<td><input class=\"form_inputs\" type=\"text\" name=\"h_head_zawod\" value=\"" . $row[3] . "\" /></td></tr>
			<tr><td>Przeszkolenie: </td>
					<td><input class=\"form_inputs\" type=\"text\" name=\"h_head_szkolenie\" value=\"" . $row[4] . "\" /></td></tr>
			<tr><td>Uwagi: </td>
					<td><input class=\"form_inputs\" type=\"text\" name=\"h_head_uwagi\" value=\"" . $row[5] . "\" /></td></tr>
			</table>
			<div style=\"margin-top: 1%;\">
			<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
			<button id=\"clear\">Wyczyść!</button>
					</div>
			</form>";
 ?>
