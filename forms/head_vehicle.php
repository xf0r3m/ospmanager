<?php

echo "<form action=\"index.php?page=head_vehicles\" method=\"post\">
      <table>
      <tr>
      <td>Marka i typ<br />posiadanego<br />samochodu - <br />rocznik: </td>
      <td><input class=\"form_inputs\" type=\"text\" name=\"h_vehicle_marka\" /></td>
      </tr>
      <tr>
      <td>Remonty samochodu <br /> - co<br />wykonano: </td>
      <td><textarea class=\"form_inputs\" name=\"h_vehicle_remonty\"></textarea></td>
      </tr>
      <tr>
      <td>Data i <br />sposób<br />likwidacji<br />pojazdu: </td>
      <td><input class=\"form_inputs\" type=\"text\" name=\"h_vehicle_likwidacja\" /></td>
      </tr>
      <tr>
      <td>Uwagi: </td>
      <td><input class=\"form_inputs\" type=\"text\" name=\"h_vehicle_uwagi\" /></td>
      </tr>
      </table>
				<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Dodaj samochód\" />
					<button id=\"clear\">Wyczyść</button>
				</div>
      </form>";

 ?>
