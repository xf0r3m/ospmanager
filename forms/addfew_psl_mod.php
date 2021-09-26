<?php
$row1 = mysqli_fetch_row($result1);
echo "<form action=\"index.php?page=psl&action=mod&id=" . $row1[0] . "\" method=\"post\">
<table>
  <tr>
    <td>Strażak: </td>
    <td><select class=\"form_inputs\" name=\"str_psl_personal_id\">";

    $result_bak = $result2;
    while ( $row2 = mysqli_fetch_row($result2) ) {
        if ( $row2[0] === $row1[5] ) {
          echo "<option value=\"" . $row2[0] . "\">" . $row2[1] . " " . $row2[2] . "</option>";
        }
    }

    while($row_bak = mysqli_fetch_row($result_bak)) {
      if ( $row_bak[0] === $row1[5] ) { continue; }
      else {
        echo "<option value=\"" . $row_bak[0] . "\">" . $row_bak[1] . " " . $row_bak[2] . "</option>";
      }
    }

  echo "</select>
  </tr>
  <tr>
    <td>Stanowisko/funkcja:</td>
    <td><select class=\"form_inputs\" name=\"str_psl_nazwa\">";
      if ( $row1[1] === 'Skarbnik' || $row1[1] === 'Prezes' ) {

        if ( $row1[1] === 'Skarbnik' ) {
          echo "<option value=\"Skarbnik\">Skarbnik</option>
                <option value=\"Prezes\">Prezes</option>";
        } else {
          echo "<option value=\"Prezes\">Prezes</option>
            <option value=\"Skarbnik\">Skarbnik</option>";
        }

      } else {
        echo "<option value=\"" . $row1[1] . "\">" . $row1[1] . "</option>
        <option value=\"Prezes\">Prezes</option>
          <option value=\"Skarbnik\">Skarbnik</option>";
      }
      $row1[2] = convertData($row1[2], 'y');
      $row1[3] = convertData($row1[3], 'y');
        echo "</select>&nbsp;<button class=\"plusButton\">+</button>
    </td>
  </tr>
  <tr style=\"display: none;\">
    <td style=\"margin-left: 10%; display: block;\">Wartość:</td>
    <td><input class=\"form_inputs\" type=\"text\" style=\"border-color: black;\" />&nbsp;<button class=\"addButton\">Dodaj</td>
  </tr>
  <tr>
    <td>Data rozpoczęcia:</td>
    <td><input class=\"form_inputs\" type=\"date\" name=\"str_psl_data_roz\" value=\"" . $row1[2] . "\" /></td>
  </tr>
  <tr>
    <td>Data zakończenia:</td>
    <td><input class=\"form_inputs\" type=\"date\" name=\"str_psl_data_zak\" value=\"" . $row1[3] . "\" /></td>
    <td><button type=\"button\" id=\"current\">Obecnie</button></td>
  </tr>
  <tr>
    <td>Opis</td>
    <td><textarea class=\"form_inputs\" name=\"str_psl_opis\" >" . $row1[4] . "</textarea></td>
  </tr>
</table>
  <div class=\"margin-top: 1%;\">
		 <input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
		 <button id=\"clear\">Wyczyść!</button>
	</div>
</form>";
?>
