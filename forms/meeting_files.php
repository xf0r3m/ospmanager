<?php

echo "<form enctype=\"multipart/form-data\" action=\"index.php?page=meeting_files\" method=\"post\">
        <input class=\"form_inputs\" type=\"hidden\" name=\"m_files_meet_id\" value=\"" . $meet_id . "\" />
        <table>
        <tr><td>Plik: </td><td><input class=\"form_inputs\" type=\"file\" name=\"plik\" /><td></tr>
        <tr><td>Informacje o pliku: </td><td><input class=\"form_inputs\" type=\"text\" name=\"m_files_informacje\" /></td></tr>
        </table>
        <div style=\"margin-top: 1%;\">
        <input class=\"form_button\" type=\"submit\" value=\"Wyślij plik\" />
					<button id=\"clear\">Wyczyść</button>
				</div>
      </form>";

 ?>
