<?php

$row0 = mysqli_fetch_row($result0);

//$row0[2] = convertData($row0[2]);

$timeExplode = explode(' ', $row0[2]);
$newDTL = $timeExplode[0] . 'T' . $timeExplode[1];
$row0[2] = $newDTL;

$termDT = explode('T', $row0[2]);

echo "<form action=\"index.php?page=vehicle_deadlines&action=mod&id=" . $row0[0] . "&vehicle_id=" . $row0[3] . "\" method=\"post\">
			<table>
			<tr>
			<td>Nazwa: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"vehicle_deadlines_nazwa\" value=\"" . $row0[1] . "\" /></td>
			</tr>
			<tr>
			<td>Termin: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"vehicle_deadlines_termin\" value=\"" . $row0[2] . "\" />
				<input class=\"form_inputs\" type=\"hidden\" value=\"" . $termDT[0] . "\" size=\"5\" />&nbsp;
<input class=\"form_inputs\" type=\"hidden\" value=\"" . $termDT[1] . "\" /></td>
			</tr>
			</table>
				<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
					<button id=\"clear\">Wyczyść!</button>
				</div>
			</form>";
?>
