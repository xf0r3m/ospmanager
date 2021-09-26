<?php
echo "<form action=\"index.php?page=event_member\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"e_member_event_id\" value=\"" . $event_id . "\" />
			<table>
			<tr>
			<td>Funkcja: </td>
			<td><select class=\"form_inputs\" name=\"e_member_funkcja\">
			<option>";

$list10 = ["Dowódca", "Kierowca", "Strażak"];
generateSelectOptionList("", $list10);

echo "</select></td>
			</tr>
			<tr>
			<td>Uczestnik: </td>
			<td><select class=\"form_inputs\" name=\"e_member_personal_id\">
			<option></option>";

			while ( $row0 = mysqli_fetch_row($result0) ) {
				echo "<option value=\"" . $row0[0] . "\">" . $row0[1] . "  " . $row0[2] . "</option>";
			}

echo "</select></td>
			</tr>
			<tr>
			<td>Czas rozpoczęcia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"e_member_rozpoczecie\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\" />
			</td>
			</tr>
			<tr>
			<td>Czas zakończenia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"e_member_zakonczenie\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\" />
			</td>
			</tr>
			<tr>
			<td>Czas udziału: </td>
			<td><input class=\"form_inputs\" type=\"time\" name=\"e_member_udzial\" /></td>
			</tr>
			<tr>
			<td>Pojazd: </td>
			<td><select class=\"form_inputs\" name=\"e_member_pojazd\" />
			<option></option>";

			while ( $row1 = mysqli_fetch_row($result1) ) {
				echo "<option value=\"" . $row1[0] . "\">" . $row1[0] . "</option>";
			}

echo "</select></td>
			</tr>
			</table>
			<div style=\"margin-top: 1%;\">
			<input class=\"form_button\" type=\"submit\" value=\"Dodaj Uczestnika\">
			<button id=\"clear\">Wyczyść!</button>
			</div>
			</form>";
?>
