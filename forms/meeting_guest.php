<?php

echo "<form action=\"index.php?page=meeting_guest\" method=\"post\" >
      <input class=\"form_inputs\" type=\"hidden\" name=\"m_guest_meet_id\" value=\"" . $meet_id . "\" />
      <table>
      <tr><td>Imię i Nazwisko gościa: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"m_guest_dpguest\" maxlength=\"60\" /></td></tr>
      <tr><td>Podchodznie gościa: <br />( z jakiej firmy czy PSP itp. )</td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"m_guest_pochodzenie\" maxlength=\"60\" /></td></tr>
      </table>
				<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Dodaj gościa\" />
					<button id=\"clear\">Wyczyść</button>
				</div>
      </form>";

 ?>
