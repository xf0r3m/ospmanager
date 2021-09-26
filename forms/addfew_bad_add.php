<?php
echo "<form action=\"index.php?page=bad\" method=\"post\">
      <table>
      <tr>
        <td>Strażak</td>
        <td><select class=\"form_inputs\" name=\"str_bad_personal_id\">
        <option></option>";
        while ($row0 = mysqli_fetch_row($result0)) {
          echo "<option value=\"" . $row0[0] . "\">" . $row0[1] . " " . $row0[2] . "</option>";
        }
echo "</select></td>
      </tr>
      <td>Nazwa badania:</td>
      <td><select class=\"form_inputs\" name=\"str_bad_nazwa\">
          <option></option>
          <option value=\"Kierowców\">Kierowców</option>
          <option value=\"Okresowe\">Okresowe</option>
          </select>
      </td>
    </tr>
    <tr>
      <td>Data badania:</td>
      <td><input class=\"form_inputs\" type=\"date\" name=\"str_bad_data_bad\" /></td>
    </tr>
    <tr>
      <td>Data ważności:</td>
      <td><input class=\"form_inputs\" type=\"date\" name=\"str_bad_data_exp\" /></td>
    </tr>
    <tr>
      <td>Nr zaświadczenia:</td>
      <td><input class=\"form_inputs\" type=\"text\" name=\"str_bad_nr_zaswiadczenia\" /></td>
    </tr>
    <tr>
      <td>Uwagi:</td>
      <td><input class=\"form_inputs\" type=\"text\" name=\"str_bad_uwagi\" /></td>
    </tr>
  </table>
      <div style=\"margin-top: 1%;\">
     <input class=\"form_button\" type=\"submit\" value=\"Dodaj badanie\" />
     <button id=\"clear\">Wyczyść!</button>
		 	</div>
  </form>";
?>
