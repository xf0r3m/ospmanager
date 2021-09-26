<?php

$row0 = mysqli_fetch_row($result0);

echo "<form action=\"index.php?page=vehicle_parameters&action=mod&id=" . $row0[0] . "&vehicle_id=" . $row0[4] . "\" method=\"post\">
			<table>
			<tr>
			<td>Nazwa parametru: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_parameters_nazwa\" value=\"" . $row0[1] . "\" /></td>
			</tr>
			<tr>
			<tr>
			<td>Wartość: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_parameters_value\" value=\"" . $row0[2] . "\" /></td>
			</tr>
			<tr>
			<td>Jednostka: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_parameters_jednostka\" value=\"" . $row0[3] . "\" /></td>
			</tr>
			</table>
				<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
					<button id=\"clear\">Wyczyść</button>
					</div>
			</form>";

?>
