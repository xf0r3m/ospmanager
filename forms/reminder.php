<?php

echo "<form action=\"ajax.php?page=" . $_GET['page'] . "\" method=\"post\" >
		<table>
		<tr>
		<td>Wybierz filtr przypomnień: </td>
		<td>
		<select class=\"form_inputs\" name=\"typ\">
			<option value=\"ind\">Liczba określona indwidualnie dla terminu</option>
			<option value=\"ldni\">Ujednolicona liczba dni wybrana poniżej</option>
		</select>
		</td>
		<td>
		<tr>
		<td>Pokaż terminy do których pozostało: </td>
		<td>
		<input  class=\"form_inputs\" type=\"number\" name=\"liczbadni\" disabled />
		dni.
		</td>
		</tr>
		</table>
		<div style=\"margin-top: 1%\">
			<input class=\"form_button\" type=\"submit\" value=\"Zatwierdź\" />
		</div>
	</form>";
		
