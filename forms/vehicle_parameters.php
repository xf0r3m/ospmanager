<?php

echo "<form action=\"index.php?page=vehicle_parameters\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"vehicle_parameters_vehicle_id\" value=\"" . $vehicle_id . "\" />
			<table>
			<tr>
			<td>Nazwa parametru: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_parameters_nazwa\" /></td>
			</tr>
			<tr>
			<tr>
			<td>Wartość: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_parameters_value\" /></td>
			</tr>
			<tr>
			<td>Jednostka: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_parameters_jednostka\" /></td>
			</tr>
			</table>
				<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Dodaj parametr\" />
					<button id=\"clear\">Wyczyść!</button>
				</div>
			</form>";

?>
