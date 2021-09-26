<?php
$row0 = mysqli_fetch_row($result1);
echo "<form action=\"index.php?page=bad&action=mod&id=" . $row0[0] . "\" method=\"post\">
      <table>
      <tr>
        <td>Strażak</td>
        <td><select class=\"form_inputs\" name=\"str_bad_personal_id\">";

        $result_bak = $result2;

        while ( $row1 = mysqli_fetch_row($result2) ) {
          if ( $row1[0] === $row0[6] ) {
            echo "<option value=\"" . $row1[0] . "\">" . $row1[1] . " " . $row1[2] . "</option>";
          }
        }

        while ($row_bak = mysqli_fetch_row($result_bak)) {
          if ( $row_bak[0] === $row0[6] ) { continue; }
          else {
            echo "<option value=\"" . $row[0] . "\">" . $row0[1] . " " . $row0[2] . "</option>";
          }
        }

echo "</select></td>
      </tr>
      <td>Nazwa badania:</td>
      <td><select class=\"form_inputs\" name=\"str_bad_nazwa\">";
      if ( $row0[1] === 'Kierowców' ) {
        echo "<option value=\"Kierowców\">Kierowców</option>
              <option value=\"Okresowe\">Okresowe</option>";
      } else {
        echo "<option value=\"Okresowe\">Okresowe</option>
              <option value=\"Kierowców\">Kierowców</option>";
      }
echo "</select>
      </td>
    </tr>
    <tr>";
    $row0[2] = convertData($row0[2], 'y');
echo "<td>Data badania:</td>
      <td><input class=\"form_inputs\" type=\"date\" name=\"str_bad_data_bad\" value=\"" . $row0[2] ."\" /></td>
    </tr>
    <tr>";
    if ( $row0[3] === '1970-01-01 00:00:00' ) {
      echo "<td>Data ważności:</td>
            <td><input class=\"form_inputs\" type=\"date\" name=\"str_bad_data_exp\" /></td>
          </tr>";
    } else {
        $row0[3] = convertData($row0[3], 'y');
        echo "<td>Data ważności:</td>
              <td><input class=\"form_inputs\" type=\"date\" name=\"str_bad_data_exp\" value=\"" . $row0[3] ."\" /></td>
              </tr>";
    }

echo "<tr>
      <td>Nr zaświadczenia:</td>
      <td><input type=\"text\" class=\"form_inputs\" name=\"str_bad_nr_zaswiadczenia\" value=\"" . $row0[4] ."\" /></td>
    </tr>
    <tr>
      <td>Uwagi:</td>
      <td><input type=\"text\" class=\"form_inputs\" name=\"str_bad_uwagi\" value=\"" . $row0[5] ."\" /></td>
    </tr>
  </table>
		<div style=\"margin-top: 1%;\">
		      <input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
					<button id=\"clear\">Wyczyść!</button>
		</div>
  </form>";

?>
