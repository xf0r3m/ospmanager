<?php
echo "<form action=\"index.php?page=head_fp\" method=\"post\">
      <table>
      <tr>
      <td>Rok: </td>
      <td><input class=\"form_inputs\" type=\"text\" name=\"h_fpstatus_rok\" /></td>
      </tr>
      <tr><td><h3>Budynki: </h3></td></tr>
      <tr>
      <td>Ilość gospodarstw<br />we wsi/dzielnicy: </td>
      <td><textarea class=\"form_inputs\" name=\"h_fpstatus_ilosc\"></textarea></td>
      </tr>
      <tr>
      <td>Gospodarstwa o dużym zagrożeniu: </td>
      <td><textarea class=\"form_inputs\" name=\"h_fpstatus_gospodz\"></textarea></td>
      </tr>
      <tr><td><h3>Zaopatrzenie wodne: </h3></td></tr>
      <tr>
      <td>Rodzaj - zbiorniki<br />hydranty, stawy<br />rzeki: </td>
      <td><textarea class=\"form_inputs\" name=\"h_fpstatus_zaowr\"></textarea></td>
      </tr>
      <tr>
      <td>Ocena stanu zaopatrzenia<br />wystarczające lub nie<br />
          co trzeba wybudować: </td>
      <td><textarea class=\"form_inputs\" name=\"h_fpstatus_zaows\"></textarea></td>
      </tr>
      <tr><td><h3>Zakłady pracy</h3></td></tr>
      <tr>
      <td>Zakłady pracy w miejscowości: </td>
      <td><textarea class=\"form_inputs\" name=\"h_fpstatus_zaklady\"></textarea></td>
      </tr>
      <tr>
      <td>Główne zagrożenia w zakładach: </td>
      <td><textarea class=\"form_inputs\" name=\"h_fpstatus_zagroz\"></textarea></td>
      </tr>
      <tr><td><h3>Łączność OSP</h3></td></tr>
      <tr>
      <td>Rodzaj łączności<br />telefon,<br />radiostacja, itp</td>
      <td><input class=\"form_inputs\" type=\"text\" name=\"h_fpstatus_laczr\" /></td>
      </tr>
      <tr>
      <td>Co trzeba <br /> poprawić w <br />systemie<br />łączności</td>
      <td><textarea class=\"form_inputs\" name=\"h_fpstatus_laczp\"></textarea></td>
      </tr>
  		</table>
			<br />
			<div style=\"margin-top: 1%;\">
   				<input class=\"form_button\" type=\"submit\" value=\"Dodaj ocenę\" />
						<button id=\"clear\">Wyczyść!</button>
	 		</div>
      </form>";

 ?>
