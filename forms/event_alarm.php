<?php

echo "<form action=\"index.php?page=event_alarm\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"e_alarm_event_id\" value=\"" . $event_id . "\" />
			<table>
			<tr>
				<td>Uczesnik: </td>
				<td><select class=\"form_inputs\" name=\"e_alarm_personal_id\">
				<option></option>
				";
				while( $row1 = mysqli_fetch_row($result1) ) {
					echo "<option value=\"" . $row1[0] . "\">" . $row1[1] . " " . $row1[2] . "</option>";
				}

echo "</select></td>
			</tr>
			</table>
				<div style=\"margin-top: 1%;\">
				<input class=\"form_button\" type=\"submit\" value=\"Dodaj\"></div>
			</form>";

?>
