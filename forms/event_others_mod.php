<?php

$row2 = mysqli_fetch_row($result2);

echo "<form action=\"index.php?page=event_others&action=mod&id=" . $row2[0] . "\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"e_others_event_id\" value=\"" . $row2[4] . "\" />
			<table>
				<tr>
				<td>Nazwa: </td>
				<td><input class=\"form_inputs\" type=\"text\" name=\"e_others_nazwa\" value=\"" . $row2[1] . "\" /></td>
				</tr>
				<tr>
				<td>Rodzaj: </td>
				<td><input type=\"text\" class=\"form_inputs\" name=\"e_others_rodzaj\" value=\"" . $row2[2] . "\" />";

echo "</td>
				</tr>
				<tr>
				<td>Nr. operacyjny: </td>
				<td><input class=\"form_inputs\" type=\"text\" name=\"e_others_nroperacyjny\" value=\"" . $row2[3] . "\" /></td>
				</tr>
				</table>
				<div style=\"margin-top: 1%;\">
				<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany\" />
				<button id=\"clear\">Wyczyść!</button>
				</div>
			</form>";

 ?>
