<?php

	echo "<form action=\"index.php?page=trips_eq&type=eqEngine&action=mod&id=" . $mod_id . "\" method=\"post\">";
	echo "<input class=\"form_inputs\" type=\"hidden\" name=\"t_eqEngine_trips_id\" value=\"" . $trips_id . "\" />";

				echo "<table>
				<tr>
				<td>Sprzęt: </td>
				<td><select class=\"form_inputs\" name=\"t_eqEngine_eq_id\">
				<option value=\"" . $row1[0] . "\">" . $row1[1] . "</option>";

				while( $row2 = mysqli_fetch_row($result2) ) {
					if ( $row1[0] === $row2[0] ) { continue; }
					else {
						echo "<option value=\"" . $row2[0] . "\">" . $row2[1] . "</option>";
					}
				}

	echo "</select></td>
				</tr>
				<tr>
				<td>Obsługujący: </td>
				<td><select class=\"form_inputs\" name=\"t_eqEngine_personal_id\">
				<option value=\"" . $row3[0] . "\">" . $row3[1] . " " . $row3[2] . "</option>";

				while( $row4 = mysqli_fetch_row($result4) ) {
					if ( $row3[0] === $row4[0] ) { continue; }
					else {
						echo "<option value=\"" . $row4[0] . "\">" . $row4[1] . " " . $row4[2] . "</option>";
					}
				}

	echo "</select></td>
				</tr>
				<tr>
				<td>Czas użycia: </td>
				<td><input class=\"form_inputs\" type=\"time\" name=\"t_eqEngine_czas\" value=\"" . $row0[1] . "\" /></td>
				</tr>";

	echo "<tr>
				<td>Zużyte paliwo: </td>
				<td><input class=\"form_inputs\" type=\"text\" name=\"t_eqEngine_paliwo\" value=\"" . $row0[2] . "\" /></td>
				</tr>";
	echo "<tr>
				<td>Uwagi: </td>
				<td><input class=\"form_inputs\" type=\"text\" name=\"t_eqEngine_uwagi\" value=\"" . $row0[3] . "\" /></td>
				</tr>
				</table>
				<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany\" />
					<button id=\"clear\">Wyczyść!</button>
				</div>
				</form>";
