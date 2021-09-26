<?php
$row0 = mysqli_fetch_row($result0);
echo "<form action=\"index.php?page=head_vehicles&action=mod&id=" . $row0[0] . "\" method=\"post\">
      <table>
      <tr>
      <td>Marka i typ<br />posiadanego<br />samochodu - <br />rocznik: </td>
      <td><input class=\"form_inputs\" type=\"text\" name=\"h_vehicle_marka\" value=\"" . $row0[1] . "\" /></td>
      </tr>
      <tr>
      <td>Remonty samochodu <br /> - co<br />wykonano: </td>
      <td><textarea class=\"form_inputs\" name=\"h_vehicle_remonty\">" . $row0[2] . "</textarea></td>
      </tr>
      <tr>
      <td>Data i <br />sposób<br />likwidacji<br />pojazdu: </td>
      <td><input class=\"form_inputs\" type=\"text\" name=\"h_vehicle_likwidacja\" value=\"" . $row0[3] . "\" /></td>
      </tr>
      <tr>
      <td>Uwagi: </td>
      <td><input class=\"form_inputs\" type=\"text\" name=\"h_vehicle_uwagi\" value=\"" . $row0[4] . "\" /></td>
      </tr>
      </table>
				<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany\" />
					<button id=\"clear\">Wyczyść!</button>
				</div>
      </form>";

 ?>
