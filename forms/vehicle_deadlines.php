<?php

echo "<form action=\"index.php?page=vehicle_deadlines\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"vehicle_deadlines_vehicle_id\" value=\"" . $vehicle_id . "\" />
			<table>
			<tr>
			<td>Nazwa: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_deadlines_nazwa\" /></td>
			</tr>
			<tr>
			<td>Termin: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"vehicle_deadlines_termin\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\" /></td>
			</tr>
			</table>
				<div style=\"margin-top: 1%;\">
				<input class=\"form_button\" type=\"submit\" value=\"Dodaj termin\" />
					<button id=\"clear\">Wyczyść!</button>
				</div>
			</form>";
			
?>
