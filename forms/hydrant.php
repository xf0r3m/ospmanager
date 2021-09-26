<?php

	echo "<form action=\"index.php?page=hydrant\" method=\"post\">
		<table>
			<tr>
				<td>Nazwa</td>
				<td><input class=\"form_inputs\" type=\"text\" name=\"hydrant_nazwa\" /></td>
			</tr>
			<tr>
				<td>Szerokość geograficza</td>
				<td><input class=\"form_inputs\" type=\"text\" name=\"hydrant_sz\" /></td>
			</tr>
			<tr>
				<td>Długość geograficzna</td>
				<td><input class=\"form_inputs\" type=\"text\" name=\"hydrant_dl\" /></td>
			</tr>
		</table>
		<div><input class=\"form_button\" type=\"submit\" value=\"Zapisz\" />
			<button id=\"clear\">Wyczyść</button></div>
		</form>";
?> 
