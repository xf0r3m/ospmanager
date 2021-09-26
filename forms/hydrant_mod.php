<?php
	$row = mysqli_fetch_row($result);
echo "<form action=\"index.php?page=hydrant&action=mod\" method=\"post\">
	<input class=\"form_inputs\" name=\"hydrant_id\" type=\"hidden\" value=\"" . $mod_id . "\" />
		<table>
			<tr>
				<td>Nazwa</td>
				<td><input class=\"form_inputs\" type=\"text\" name=\"hydrant_nazwa\" value=\"" . $row[0] . "\" /></td>
			</tr>
			<tr>
				<td>Szerokość geograficza</td>
				<td><input class=\"form_inputs\" type=\"text\" name=\"hydrant_sz\" value=\"" . $row[1] . "\" /></td>
			</tr>
			<tr>
				<td>Długość geograficzna</td>
				<td><input class=\"form_inputs\" type=\"text\" name=\"hydrant_dl\" value=\"" . $row[2] . "\" /></td>
			</tr>
		</table>
		<div><input class=\"form_button\" type=\"submit\" value=\"Zapisz\" />
			<button id=\"clear\">Wyczyść</button></div>
		</form>";
?> 
