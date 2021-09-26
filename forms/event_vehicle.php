<?php

$tName = 'vehicle_parameters';
$csh = 'vehicle_id,value';
$whereValue = "nazwa='norma'";
$result = prepareForm($connection, $tName, $csh, $whereValue);
$whereValue = "nazwa='postoj_norma'";
$result10 = prepareForm($connection, $tName, $csh, $whereValue);
$whereValue = "nazwa='autopompa_norma'";
$result11 = prepareForm($connection, $tName, $csh, $whereValue);

echo "<form action=\"index.php?page=event_vehicle\" method=\"post\">
		<input class=\"form_inputs\" type=\"hidden\" name=\"e_vehicle_event_id\" value=\"" . $event_id . "\" />";
		if ( mysqli_num_rows($result) > 0 ) {
			while ( $row = mysqli_fetch_row($result) ) {
				echo "<input type=\"hidden\" name=\"" . $row[0] . "_norma\" value=\"" . $row[1] . "\" />";
			}
		}
		if ( mysqli_num_rows($result10) > 0 ) {
			while ( $row10 = mysqli_fetch_row($result10) ) {
				echo "<input type=\"hidden\" name=\"" . $row10[0] . "_postoj_norma\" value=\"" . $row10[1] . "\" />"; 
			}
		}
		if ( mysqli_num_rows($result11) > 0 ) {
			while ( $row11 = mysqli_fetch_row($result11) ) {
				echo "<input type=\"hidden\" name=\"" . $row11[0] .  "_autopompa_norma\" value=\"" . $row11[1] . "\" />";
			}
		}
		echo "<table>
		<tr>
		<td>Pojazd: </td>
		<td><select class=\"form_inputs\" name=\"e_vehicle_vehicle_id\">
		<option></option>";

		while ( $row0 = mysqli_fetch_row($result0) ) {
			echo "<option value=\"" . $row0[0] . "\">" . $row0[1] . "</option>";
		}

echo "</select></td>
			</tr>
			<tr>
			<td>Przebyte kilometry: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"e_vehicle_kilometry\" /></td>
			</tr>
			<tr>
			<td>Minut pracy pojazdu na postoju: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"e_vehicle_praca_postuj\" /></td>
			</tr>
			<tr>
			<td>Minut pracy z autopompą: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"e_vehicle_praca_autopompa\" /></td>
			</tr>
			<tr>
			<td>Zużyte paliwo: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"e_vehicle_paliwo\" /></td>
			</tr>
			<tr>
			<td>Uwagi: </td>
			<td><input class=\"form_inputs\" type=\"text\"  name=\"e_vehicle_uwagi\" /></td>
			</tr>
			</table>
			<div style=\"margin-top: 1%;\">
				<input class=\"form_button\" type=\"submit\" value=\"Dodaj pojazd\" />
				<button id=\"clear\">Wyczyść!</button>
			</div>
			</form>";


?>
