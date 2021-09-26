<?php
echo "<form action=\"ajax.php?page=meeting_about&action=mod&id=" . $mod_id . "\" method=\"post\">
      <table>
      <tr><td>Nazwa: </td><td><input class=\"form_inputs\" type=\"text\" name=\"m_about_nazwa\" value=\"" . $row[0] .  "\"/></td></tr>
      <tr><td>Data zebrania: </td>";
      $row[1] = convertData($row[1], 'y');
echo "<td><input class=\"form_inputs\" type=\"date\" name=\"m_about_data_zebrania\" value=\"" . $row[1] . "\" /></td></tr>
      <tr><td>Rodzaj: </td><td><input class=\"form_inputs\" type=\"text\" name=\"m_about_rodzaj\" value=\"" . $row[2] . "\" /></td></tr>
      <tr><td>Notatka: </td><td><textarea class=\"form_inputs\"  name=\"m_about_notatka\">" . $row[3] . "</textarea></td></tr>
      </table>
      <div style=\"margin-top: 1%;\">
            <input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany\" />
            <button id=\"clear\">Wyczyść!</button>
      </div>
	</form>
	</div>";

 ?>
