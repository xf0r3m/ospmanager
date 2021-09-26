<?php
echo "
<form action=\"index.php?page=psl\" method=\"post\">
<table>
  <tr>
    <td>Strażak: </td>
    <td><select class=\"form_inputs\" class=\"form_inputs\" name=\"str_psl_personal_id\">
    <option></option>";

    while($row0 = mysqli_fetch_row($result0)) {
      echo "<option value=\"" . $row0[0] . "\">" . $row0[1] . " " . $row0[2] . "</option>";
    }

  echo "</select>
  </tr>
  <tr>
    <td>Stanowisko/funkcja:</td>
    <td><select class=\"form_inputs\" name=\"str_psl_nazwa\">
      <option></option>
      <option value=\"Prezes\">Prezes</option>
        <option value=\"Skarbnik\">Skarbnik</option>
        </select>&nbsp;<button class=\"plusButton\">+</button>
    </td>
  </tr>
  <tr style=\"display: none;\">
    <td style=\"margin-left: 10%; display: block;\">Wartość:</td>
    <td><input class=\"form_inputs\" type=\"text\" style=\"border-color: black;\" />&nbsp;<button class=\"addButton\">Dodaj</button></td>
  </tr>
  <tr>
    <td>Data rozpoczęcia:</td>
    <td><input class=\"form_inputs\" type=\"date\" name=\"str_psl_data_roz\" /></td>
  </tr>
  <tr>
    <td>Data zakończenia:</td>
    <td><input class=\"form_inputs\" type=\"date\" name=\"str_psl_data_zak\" /></td>
    <td><button type=\"button\" id=\"current\">Obecnie</button></td>
  </tr>
  <tr>
    <td>Opis</td>
    <td><textarea class=\"form_inputs\" name=\"str_psl_opis\" ></textarea></td>
  </tr>
</table>
		<div style=\"margin-top: 1%;\">
    <input class=\"form_button\" type=\"submit\" value=\"Dodaj przebieg służby\" />
    <button id=\"clear\">Wyczyść!</button>
		</div>
</form>";
?>
