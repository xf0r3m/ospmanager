<?php
echo "<form action=\"index.php?page=comp_comp\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"c_comp_comp_id\" value=\"" . $comp_id . "\" />
			<table>
			<tr>
			<td>Zawodnik: </td>
			<td><select class=\"form_inputs\" name=\"c_comp_personal_id\">
			<option></option>";

			while ($row0 = mysqli_fetch_row($result0) ) {
				echo "<option value=\"" . $row0[0] . "\">" . $row0[1] . " " . $row0[2] . "</option>";
			}

echo "</select></td>
			</tr>
			<tr>
			<td>Funkcja w ćwiczeniu bojowym: </td>
			<td><input type=\"text\" class=\"form_inputs\" name=\"c_comp_bj_func\" />";


echo "</td>
			</tr>
			<tr>
			<td>Funkcja w sztafecie: </td>
			<td><select class=\"form_inputs\" name=\"c_comp_sz_func\">
			<option></option>";

			$list27 = ["Zmiana I", "Zmiana II", "Zmiana III", "Zmiana IV", "Zmiana V", "Zmiana VI", "Zmiana VII", "Zmiana VIII"];
			generateSelectOptionList("", $list27);

echo "</select></td>
			</tr>
			<tr>
			<td>Uwagi: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"c_comp_uwagi\" /></td>
			</tr>
			<tr>
			<td></td>
			</tr>
			</table>
				<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Dodaj zawodnika!\" />
					<button id=\"clear\">Wyczyść!</button>
				</div>
			</form>
			";
 ?>
