<?php

echo "<form action=\"index.php?page=eq_deadlines\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"eq_deadlines_thng_id\" value=\"" . $thng_id . "\" />
			<table>
			<tr>
			<td>Nazwa: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"eq_deadlines_nazwa\" /></td>
			</tr>
			<tr>
			<td>Termin: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"eq_deadlines_termin\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\" /></td>
			</tr>
			<tr>
			<td></tr>
			</table>
			<div style=\"margin-top: 1%;\">
			<input class=\"form_button\" type=\"submit\" value=\"Dodaj termin\" />
				<button id=\"clear\">Wyczyść!</button></div>
			</form>";
?>
