<?php

$row0 = mysqli_fetch_row($result0);

echo "<form action=\"index.php?page=eq_deadlines&action=mod&id=" . $row0[0] . "\" method=\"post\">
		<input class=\"form_inputs\" type=\"hidden\" name=\"eq_deadlines_thng_id\" value=\"" . $thng_id . "\" />
			<table>
			<tr>
			<td>Nazwa: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"eq_deadlines_nazwa\" value=\"" . $row0[1] . "\" /></td>
			</tr>
			<tr>";
			//$row0[2] = convertData($row0[2]);
			$timeExplode = explode(' ', $row0[2]);
			$newDTL = $timeExplode[0] . 'T' . $timeExplode[1];
			$row0[2] = $newDTL;
			$termDT = explode('T', $row0[2]);
echo  "<td>Termin: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"eq_deadlines_termin\" value=\"" . $row0[2] . "\" />
				<input class=\"form_inputs\" type=\"hidden\" value=\"" . $termDT[0] .  "\" size=\"5\" />&nbsp;
<input class=\"form_inputs\" type=\"hidden\" value=\"" . $termDT[1] . "\" /></td>
			</tr>
			</table>
			<div style=\"margin-top: 1%;\">
			<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
					<button id=\"clear\">Wyczyść!</button>
			</div>
			</form>";
?>
