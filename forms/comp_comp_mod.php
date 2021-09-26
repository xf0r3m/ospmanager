<?php

$row1 = mysqli_fetch_row($result1);

echo "<form action=\"index.php?page=comp_comp&action=mod&id=" . $row1[0] . "\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"c_comp_comp_id\" value=\"" . $row1[5] . "\" />
			<table>
			<tr>
			<td>Zawodnik: </td>
			<td><select class=\"form_inputs\" name=\"c_comp_personal_id\">";

      $result_bak = $result0;

      while ($row_bak = mysqli_fetch_row($result_bak) ) {
        if ( $row_bak[0]  === $row1[4] ) {
				      echo "<option value=\"" . $row_bak[0] . "\">" . $row_bak[1] . " " . $row_bak[2] . "</option>";
        }
			}

			while ($row0 = mysqli_fetch_row($result0) ) {
        if ( $row0[0] === $row1[4] ) { continue; }
        else {
          echo "<option value=\"" . $row0[0] . "\">" . $row0[1] . " " . $row0[2] . "</option>";
        }
			}

echo "</select></td>
			</tr>
			<tr>
			<td>Funkcja w ćwiczeniu bojowym: </td>
			<td><input type=\"text\" class=\"form_inputs\" name=\"c_comp_bj_func\" value=\"" . $row1[1] . "\">";

echo "</td>
			</tr>
			<tr>
			<td>Funkcja w sztafecie: </td>
			<td><select class=\"form_inputs\" name=\"c_comp_sz_func\">
			<option>";

			$list27 = ["Zmiana I", "Zmiana II", "Zmiana III", "Zmiana IV", "Zmiana V", "Zmiana VI", "Zmiana VII", "Zmiana VIII"];
			generateSelectOptionList($row1[2], $list27);

echo "</select></td>
			</tr>
			<tr>
			<td>Uwagi: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"c_comp_uwagi\" value=\"" . $row1[3] ."\" /></td>
			</tr>
			</table>
				<div style=\"margin-top: 1%;\">
				<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
					<button id=\"clear\">Wyczyść!</button></div>
			</form>
			";
 ?>
