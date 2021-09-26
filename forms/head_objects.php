<?php

  echo "<form action=\"index.php?page=head_objects\" method=\"post\">
        <table>
        <tr>
        <td>Nazwa: </td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"h_objects_nazwa\" /></td>
        </tr>
        <tr>
        <td>Rok budowy: </td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"h_objects_rok\" /></td>
        </tr>
        <tr>
        <td>Ilość boksów,wielkość sali<br />
            ilość pomiesczeń:</td>
        <td><textarea class=\"form_inputs\" name=\"h_objects_ilosc\"></textarea></td>
        </tr>
        <tr>
        <td>Modernizacje - <br />
            co rozbudowano i kiedy: </td>
        <td><textarea class=\"form_inputs\" name=\"h_objects_mods\"></textarea></td>
        </tr>
        <tr>
        <td>Remonty -<br />
            rodzaj prac</td>
        <td><textarea class=\"form_inputs\" name=\"h_objects_remonty\"></textarea></td>
        </tr>
        </table>
                    <div style=\"margin-top: 1%;\">
                    <input class=\"form_button\" type=\"submit\" value=\"Dodaj objekt\" />
							<button id=\"clear\">Wyczyść!</button>
						</div>
        </form>";

 ?>
