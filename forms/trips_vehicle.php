<?php

$tName = 'vehicle_parameters';
$csh = 'vehicle_id,value';
$whereValue = "nazwa='norma'";
$result10 = prepareForm($connection, $tName, $csh, $whereValue);
$whereValue = "nazwa='postoj_norma'";
$result11 = prepareForm($connection, $tName, $csh, $whereValue);
$whereValue = "nazwa='autopompa_norma'";
$result12 = prepareForm($connection, $tName, $csh, $whereValue);

echo "<form action=\"index.php?page=trips_vehicle\" method=\"post\">
		<input class=\"form_inputs\" type=\"hidden\" name=\"t_vehicle_trips_id\" value=\"" . $trips_id . "\" />";

		if ( mysqli_num_rows($result10) > 0 ) {
		
			while ( $row10 = mysqli_fetch_row($result10) ) {
			
				echo "<input type=\"hidden\" name=\"" . $row10[0] . "_norma\" value=\"" . $row10[1] . "\" />";
			}
		}
		if ( mysqli_num_rows($result11) > 0 ) {

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
		<td><select class=\"form_inputs\" name=\"t_vehicle_vehicle_id\">
		<option></option>";

		while ( $row0 = mysqli_fetch_row($result0) ) {
			echo "<option value=\"" . $row0[0] . "\">" . $row0[1] . "</option>";
		}

echo "</select></td>
			</tr>
			<tr>
			<td>Przebyte kilometry: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"t_vehicle_kilometry\" />km</td>
			</tr>
			<tr>
			<td>Praca pojazdu na postoju: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"t_vehicle_praca_postuj\" /></td>
			</tr>
			<tr>
			<td>Praca pojazdu z autopompą: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"t_vehicle_praca_autopompa\" /></td>
			</tr>
			<tr>
			<td>Zużyte paliwo: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"t_vehicle_paliwo\" /></td>
			</tr>
			<tr>
			<td>Uwagi: </td>
			<td><input class=\"form_inputs\" type=\"text\"  name=\"t_vehicle_uwagi\" /></td>
			</tr>
			</table>
				<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Dodaj pojazd\" />
					<button id=\"clear\">Wyczyść</button></div>
			</form>";



?>
