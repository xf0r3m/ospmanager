<?php

echo "<form action=\"index.php?page=meeting_about\" method=\"post\">
      <table>
      <tr><td>Nazwa: </td><td><input class=\"form_inputs\" type=\"text\" name=\"m_about_nazwa\" /></td></tr>
      <tr><td>Data zebrania: </td>
      <td><input class=\"form_inputs\" type=\"date\" name=\"m_about_data_zebrania\" /></td></tr>
      <tr><td>Rodzaj: </td><td><input class=\"form_inputs\" type=\"text\" name=\"m_about_rodzaj\" /></td></tr>
      <tr><td>Notatka: </td><td><textarea class=\"form_inputs\" name=\"m_about_notatka\"></textarea></td></tr>
      </table>
      <div>
            <input class=\"form_button\" type=\"submit\" value=\"Dodaj zebranie\" />
            <button id=\"clear\">Wyczyść!</button>
      </div>
	</form>
	</div>";
 ?>
