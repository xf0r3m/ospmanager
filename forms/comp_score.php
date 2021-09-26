<?php

echo "<form action=\"index.php?page=comp_score\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"c_score_comp_id\" value=\"" . $comp_id . "\" />
			<table>
			<tr>
			<td>Uzyskane miejsce: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"c_score_msc\" /></td>
			</tr>
			<tr>
			<td>Czas sztafety: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"c_score_sztafeta\" /></td>
			</tr>
			<tr>
			<td>Punkty karne sztafety: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"c_score_pktk_sz\" /></td>
			</tr>
			<tr>
			<td>Czas bojówki: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"c_score_bojowka\" /></td>
			</tr>
			<tr>
			<td>Punkty karne bojówki: </td>
			<td><input class=\"form_inputs\" type=\"number\" name=\"c_score_pktk_bj\" /></td>
			</tr>
			<tr>
			<td>Suma punktów: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"c_score_pkt\" /></td>
			</tr>
			<tr>
			<td></td>
			</tr>
			</table>
				<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Zatwierdź!\" />
					<button id=\"clear\">Wyczyść!</button>
				</div>
			</form>
			";
 ?>
