<?php

$row0 = mysqli_fetch_row($result0);

echo "<form action=\"index.php?page=head_fp&action=mod&id=" . $row0[0] . "\" method=\"post\">
      <table>
      <tr>
      <td>Rok: </td>
      <td><input class=\"form_inputs\" type=\"text\" name=\"h_fpstatus_rok\" value=\"" . $row0[1] . "\" /></td>
      </tr>
      <tr><td><h3>Budynki: </h3></td></tr>
      <tr>
      <td>Ilość gospodarstw<br />we wsi/dzielnicy: </td>
      <td><textarea class=\"form_inputs\" name=\"h_fpstatus_ilosc\">" . $row0[2] . "</textarea></td>
      </tr>
      <tr>
      <td>Gospodarstwa o dużym zagrożeniu: </td>
      <td><textarea class=\"form_inputs\" name=\"h_fpstatus_gospodz\">" . $row0[3] . "</textarea></td>
      </tr>
      <tr><td><h3>Zaopatrzenie wodne: </h3></td></tr>
      <tr>
      <td>Rodzaj - zbiorniki<br />hydranty, stawy<br />rzeki: </td>
      <td><textarea class=\"form_inputs\" name=\"h_fpstatus_zaowr\">" . $row0[4] . "</textarea></td>
      </tr>
      <tr>
      <td>Ocena stanu zaopatrzeni<br />wystarczające lub nie<br />
          co trzeba wybudować: </td>
      <td><textarea class=\"form_inputs\" name=\"h_fpstatus_zaows\">" . $row0[5] . "</textarea></td>
      </tr>
      <tr><td><h3>Zakłady pracy</h3></td></tr>
      <tr>
      <td>Zakłady pracy w miejscowości: </td>
      <td><textarea class=\"form_inputs\" name=\"h_fpstatus_zaklady\">" . $row0[6] . "</textarea></td>
      </tr>
      <tr>
      <td>Główne zagrożenia w zakładach: </td>
      <td><textarea class=\"form_inputs\" name=\"h_fpstatus_zagroz\">" . $row0[7] . "</textarea></td>
      </tr>
      <tr><td><h3>Łączność OSP</h3></td></tr>
      <tr>
      <td>Rodzaj łączności<br />telefon,<br />radiostacja, itp</td>
      <td><input class=\"form_inputs\" type=\"text\" name=\"h_fpstatus_laczr\" value=\"" . $row0[8] . "\" /></td>
      </tr>
      <tr>
      <td>Co trzeba <br /> poprawić w <br />systemie<br />łączności</td>
      <td><textarea class=\"form_inputs\" name=\"h_fpstatus_laczp\">" . $row0[9] . "</textarea></td>
      </tr>
      </table>
			<br />
				<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
					<button id=\"clear\">Wyczyść!</button>
					</div>
      </form>";

 ?>
