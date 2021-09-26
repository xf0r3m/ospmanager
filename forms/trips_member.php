<?php
echo "<form action=\"index.php?page=trips_member\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"t_member_trips_id\" value=\"" . $trips_id . "\" />
			<table>
			<tr>
			<td>Funkcja: </td>
			<td><input type=\"text\" class=\"form_inputs\" name=\"t_member_funkcja\">";

echo "</td>
			</tr>
			<tr>
			<td>Uczestnik: </td>
			<td><select class=\"form_inputs\" name=\"t_member_personal_id\">
			<option></option>";

			while ( $row0 = mysqli_fetch_row($result0) ) {
				echo "<option value=\"" . $row0[0] . "\">" . $row0[1] . "  " . $row0[2] . "</option>";
			}

echo "</select></td>
			</tr>
			<tr>
			<td>Czas rozpoczęcia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"t_member_rozpoczecie\" />
					<input class=\"form_inputs\" type=\"hidden\" size=\"5\" />&nbsp;
<input class=\"form_inputs\" type=\"hidden\" size=\"3\" /></td>
			</tr>
			<tr>
			<td>Czas zakończenia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"t_member_zakonczenie\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\" /></td>
			</tr>
			<tr>
			<td>Czas udziału: </td>
			<td><input class=\"form_inputs\" type=\"time\" name=\"t_member_udzial\" /></td>
			</tr>
			<tr>
			<td>Pojazd: </td>
			<td><select class=\"form_inputs\" name=\"t_member_pojazd\" />
			<option></option>";

			while ( $row1 = mysqli_fetch_row($result1) ) {
				echo "<option value=\"" . $row1[0] . "\">" . $row1[0] . "</option>";
			}

echo "</select></td>
			</tr>
			<tr>
			<td>Uwagi: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"t_member_uwagi\" /></td>
			</tr>
			</table>
			<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Dodaj Uczestnika\">
					<button id=\"clear\">Wyczyść!</button>
			</div>
			</form>";
?>
