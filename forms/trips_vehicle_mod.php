<?php

$row1 = mysqli_fetch_row($result1);

$tName = 'vehicle_parameters';
$csh = 'vehicle_id,value';
$whereValue = "nazwa='norma'";
$result10 = prepareForm($connection, $tName, $csh, $whereValue);
$whereValue = "nazwa='postoj_norma'";
$resutl11 = prepareForm($connection, $tName, $csh, $whereValue);
$whereValue = "nazwa='autopompa_norma'";
$resutl12 = prepareForm($connection, $tName, $csh, $whereValue);


echo "<form action=\"index.php?page=trips_vehicle&action=mod&id=" . $row1[0] . "\" method=\"post\">
		<input class=\"form_inputs\" type=\"hidden\" name=\"t_vehicle_trips_id\" value=\"" . $row1[7] . "\" />";

		if ( mysqli_num_rows($result10) > 0 ) {

			while ( $row10 = mysqli_fetch_row($result10) ) {
			
				echo "<input type=\"hidden\" name=\"" . $row10[0] . "_norma\" value=\"" . $row10[1] . "\" />";
			}
		}

		if ( mysqli_num_rows($resutl11) > 0 ) {

			while ( $row11 = mysqli_fetch_row($result11) ) {
				
				echo "<input type=\"hidden\" name=\"" . $row11[0] . "_postoj_norma\" value=\"" . $row11[1] . "\" />";
			}
			
		}

		if ( mysqli_num_rows($result12) > 0 ) {
		
			while ( $row12 = mysqli_fetch_row($result12) ) {
			
				echo "<input type=\"hidden\" name=\"" . $row12[0] . "_autopompa_norma\" value=\"" . $row12[1] . "\" />";
			}
		}

		echo "<table>
		<tr>
		<td>Pojazd: </td>
		<td><select class=\"form_inputs\" name=\"t_vehicle_vehicle_id\">";

		$result_bak = $result2;

		while($row2 = mysqli_fetch_row($result2)) {
			if ( $row2[0] === $row1[6] ) {
				echo "<option value=\"" . $row2[0] . "\">" . $row2[1] . "</option>";
			}
		}

		while ( $row_bak = mysqli_fetch_row($result_bak) ) {
			if ( $row_bak[0] === $row1[6] ) {  continue; }
			echo "<option value=\"" . $row_bak[0] . "\">" . $row_bak[1] . "</option>";
		}

echo "</select></td>
			</tr>
			<tr>
			<td>Przebyte kilometry: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"t_vehicle_kilometry\" value=\"" . $row1[1] . "\" /></td>
			</tr>
			<tr>
			<td>Praca pojazdu na postoju: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"t_vehicle_praca_postuj\" value=\"" . $row1[2] . "\" /></td>
			</tr>
			<tr>
			<td>Praca pojazdu z autopompą: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"t_vehicle_praca_autopompa\" value=\"" . $row1[3] . "\"/></td>
			</tr>
			<tr>
			<td>Zużyte paliwo: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"t_vehicle_paliwo\" value=\"" . $row1[4] . "\" /></td>
			</tr>
			<tr>
			<td>Uwagi: </td>
			<td><input class=\"form_inputs\" type=\"text\"  name=\"t_vehicle_uwagi\" value=\"" . $row1[5] . "\" /></td>
			</tr>
			<tr>
			<td></td>
			</tr>
			</table>
				<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
					<button id=\"clear\">Wyczyść!</button>
				</div>
			</form>";


?>
