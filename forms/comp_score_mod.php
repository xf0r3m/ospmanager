<?php
$row0 = mysqli_fetch_row($result0);

echo "<form action=\"index.php?page=comp_score&comp_id=" . $comp_id . "\" method=\"post\">
			<table>
			<tr>
			<td>Uzyskane miejsce: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"c_score_msc\" value=\"" . $row0[0] . "\" /></td>
			</tr>
			<tr>
			<td>Czas sztafety: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"c_score_sztafeta\" value=\"" . $row0[1] . "\" /></td>
			</tr>
			<tr>
			<td>Punkty karne sztafety: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"c_score_pktk_sz\" value=\"" . $row0[2] . "\" /></td>
			</tr>
			<tr>
			<td>Czas bojówki: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"c_score_bojowka\" value=\"" . $row0[3] . "\" /></td>
			</tr>
			<tr>
			<td>Punkty karne bojówki: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"c_score_pktk_bj\" value=\"" . $row0[4] . "\" /></td>
			</tr>
			<tr>
			<td>Suma punktów: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"c_score_pkt\" value=\"" . $row0[5] . "\" /></td>
			</tr>
			</table>
				<div style=\"margin-top: 1%;\">
				<input class=\"form_button\" type=\"submit\" value=\"Zatwierdź!\" />
					<button id=\"clear\">Stan początkowy</button>
					</div>
			</form>
			";
 ?>
