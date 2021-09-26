<?php

echo "<form action=\"index.php?page=event_eq&type=eqManual\" method=\"post\">";
echo "<input class=\"form_inputs\" type=\"hidden\" name=\"e_eqManual_event_id\" value=\"" . $event_id . "\" />";

				echo "<table>
				<tr>
				<td>Sprzęt: </td>
				<td class=\"eqEngine\" style=\"display: none\">
					<select class=\"form_inputs\" name=\"e_eqEngine_eq_id\">
					<option></option>";

					while( $row3 = mysqli_fetch_row($result3) ) {
						echo "<option value=\"" . $row3[0] . "\">" . $row3[1] . "</option>";
					}

				echo "</select>
				</td>
				<td class=\"eqManual\"><select class=\"form_inputs\" name=\"e_eqManual_eq_id\">
				<option></option>";

				while( $row4 = mysqli_fetch_row($result4) ) {
					echo "<option value=\"" . $row4[0] . "\">" . $row4[1] . "</option>";
				}

	echo "</select></td>
				</tr>
				<tr>
				<td>Obsługujący: </td>
				<td><select class=\"form_inputs\" name=\"e_eqManual_personal_id\">
				<option></option>";

				while( $row5 = mysqli_fetch_row($result5) ) {
					echo "<option value=\"" . $row5[0] . "\">" . $row5[1] . " " . $row5[2] . "</option>";
				}

	echo "</select></td>
				</tr>
				<tr>
				<td>Czas użycia: </td>
				<td><input class=\"form_inputs\" type=\"time\" name=\"e_eqManual_czas\" /></td>
				</tr>";

		echo "<tr>
					<td>Zużyte paliwo: </td>
					<td><input class=\"eqEngine form_inputs\"type=\"text\" disabled=\"disabled\" name=\"e_eqEngine_paliwo\" /></td>
					</tr>";

	echo "<tr>
				<td>Uwagi: </td>
				<td><input class=\"form_inputs\" type=\"text\" name=\"e_eqManual_uwagi\" /></td>
				</tr>
				</table>
				<div style=\"margin-top: 1%;\">
				<input class=\"form_button\" type=\"submit\" value=\"Dodaj sprzęt\" />
				<button id=\"clear\">Wyczyść!</button>
				</div>
				</form>";
