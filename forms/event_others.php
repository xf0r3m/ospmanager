<?php

echo "<form action=\"index.php?page=event_others\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"e_others_event_id\" value=\"" . $event_id . "\" />
			<table>
				<tr>
				<td>Nazwa: </td>
				<td><input class=\"form_inputs\" type=\"text\" name=\"e_others_nazwa\" /></td>
				</tr>
				<tr>
				<td>Rodzaj: </td>
				<td><input type=\"text\" class=\"form_inputs\" name=\"e_others_rodzaj\" />";

echo "</td>
				</tr>
				<tr>
				<td>Nr. operacyjny: </td>
				<td><input class=\"form_inputs\" type=\"text\" name=\"e_others_nroperacyjny\" /></td>
				</tr>
				</table>
					<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Dodaj inne służby\" />
					<button id=\"clear\">Wyczyść!</button>
					</div>
			</form>";

 ?>
