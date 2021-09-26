<?php

echo "<form action=\"index.php?page=docs&form=request\" method=\"post\" >
	<input type=\"hidden\" name=\"msc\" value=\"" . $msc . "\" />
        <table>
        <tr><td>Kwartał: </td>
            <td><select class=\"form_inputs\" name=\"kwartal\">
                <option value=\"I\">I</option>
                <option value=\"II\">II</option>
                <option value=\"III\">III</option>
                <option value=\"IV\">IV</option>
                </select></td></tr>
        <tr><td>Typ wniosku:</td><td> <select class=\"form_inputs\" name=\"typ\">
		<option value=\"0\"></option>
		<option value=\"dz\">Działanie ratownicze</option>
		<option value=\"sz\">Szkolenie pożarnicze</option>
		</select></td></tr>
        <tr><td>Ilość członków: </td><td><input class=\"form_inputs\" type=\"number\" name=\"ilosc\" /></td></tr>
        </table>
					<div><input class=\"form_button\" type=\"submit\" value=\"Generuj wniosek\" /></div>
        </form>";


 ?>
