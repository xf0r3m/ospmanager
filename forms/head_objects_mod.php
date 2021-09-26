<?php

  $row0 = mysqli_fetch_row($result0);
  echo "<form action=\"index.php?page=head_objects&action=mod&id=" . $row0[0] . "\" method=\"post\">
        <table>
        <tr>
        <td>Nazwa: </td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"h_objects_nazwa\" value=\"" . $row0[1] . "\" /></td>
        </tr>
        <tr>
        <td>Rok budowy: </td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"h_objects_rok\" value=\"" . $row0[2] . "\" /></td>
        </tr>
        <tr>
        <td>Ilość boksów,wielkość sali<br />
            ilość pomiesczeń:</td>
        <td><textarea class=\"form_inputs\" name=\"h_objects_ilosc\">" . $row0[3] . "</textarea></td>
        </tr>
        <tr>
        <td>Modernizacje - <br />
            co rozbudowano i kiedy: </td>
        <td><textarea class=\"form_inputs\" name=\"h_objects_mods\">" . $row0[4] . "</textarea></td>
        </tr>
        <tr>
        <td>Remonty -<br />
            rodzaj prac</td>
        <td><textarea class=\"form_inputs\" name=\"h_objects_remonty\">" . $row0[5] . "</textarea></td>
        </tr>
        </table>
					<div><input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany\" />
							<button id=\"clear\">Wyczyść!</button>
						</div>
        </form>";

 ?>
