<?php

echo "<div id=\"form\">";
	echo "<form action=\"presentation.php\" method=\"post\">
				<table>
				<tr><td>Okres jakiego ma dotyczyć prezentacja: </td>
						<td><input class=\"form_inputs\" type=\"date\" name=\"pmeeting_start\" />
						- <input class=\"form_inputs\" type=\"date\" name=\"pmeeting_end\" /></td></tr>
				<tr><td>Zakres danych na prezntacji</td><td>
						<input class=\"form_inputs\" type=\"checkbox\" name=\"pmeeting_info\" />
						Informacje o jednostce<br />
						<input class=\"form_inputs\" type=\"checkbox\" name=\"pmeeting_ff\" />
						Strażacy<br />
						<input class=\"form_inputs\" type=\"checkbox\" name=\"pmeeting_event\" />
						Akcje<br />
						<input class=\"form_inputs\" type=\"checkbox\" name=\"pmeeting_eq\" />
						Sprzęt<br />
						<input class=\"form_inputs\" type=\"checkbox\" name=\"pmeeting_vehicle\" />
						Pojazdy<br />
						<input class=\"form_inputs\" type=\"checkbox\" name=\"pmeeting_comp\" />
						Zawody<br />
						<input class=\"form_inputs\" type=\"checkbox\" name=\"pmeeting_jobs\" />
						Prace na rzec straży<br /><br /></tr>
				<tr><td></td></tr>
				</table>
					<div>
					<input id=\"presentation\" class=\"form_button\" type=\"submit\" value=\"Generuj prezentacje\" />
					</div>
				</form>
			</div>
			<hr id=\"theline\">
			<div id=\"result\">
			</div>";


 ?>
