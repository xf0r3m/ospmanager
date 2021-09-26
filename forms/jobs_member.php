<?php
echo "<form action=\"index.php?page=jobs_member\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"j_member_jobs_id\" value=\"" . $jobs_id . "\" />
			<table>
			<tr>
			<td>Funkcja: </td>
			<td><select class=\"form_inputs\" name=\"j_member_funkcja\">
			<option>";

$list10 = ["Fotograf", "Organizator", "Pozorant", "Prowadzący" ];
generateSelectOptionList("", $list10);

echo "</select></td>
			</tr>
			<tr>
			<td>Uczestnik: </td>
			<td><select class=\"form_inputs\" name=\"j_member_personal_id\">
			<option></option>";

			while ( $row0 = mysqli_fetch_row($result0) ) {
				echo "<option value=\"" . $row0[0] . "\">" . $row0[1] . "  " . $row0[2] . "</option>";
			}

echo "</select></td>
			</tr>
			<tr>
			<td>Czas rozpoczęcia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"j_member_rozpoczecie\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\" />
			</td>
			</tr>
			<tr>
			<td>Czas zakończenia: </td>
			<td><input class=\"form_inputs\" type=\"datetime-local\" name=\"j_member_zakonczenie\" />
				<input class=\"form_inputs\" type=\"hidden\" size=\"5\" />&nbsp;
				<input class=\"form_inputs\" type=\"hidden\" size=\"3\" />
			</td>
			</tr>
			<tr>
			<td>Czas udziału: </td>
			<td><input class=\"form_inputs\" type=\"time\" name=\"j_member_udzial\" /></td>
			</tr>";

echo "<tr>
			<td>Uwagi: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"j_member_uwagi\" /></td>
			</tr>
			</table>
				<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Dodaj Uczestnika\">
					<button id=\"clear\">Wyczyść</button>
				</div>
			</form>";
?>
