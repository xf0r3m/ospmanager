<?php

echo "<form action=\"index.php?page=meeting_member&action=mod&id=" . $mod_id . "&meet_id=" . $row[2] . "\" method=\"post\" >
      <table>
      <tr><td>Uczestnik: </td><td><select class=\"form_inputs\" name=\"m_member_personal_id\">";

        while ( $row1 = mysqli_fetch_row($result1) ) {

          if ( $row[0] === $row1[0] ) {
            echo "<option value=\"" . $row1[0] . "\">" . $row1[1] . " " . $row1[2] . "</option>";
          }

        }

        mysqli_data_seek($result1, 0);

        while( $row1 = mysqli_fetch_row($result1) ) {

          if ( $row[0] === $row1[0] ) { continue; }
          else {
              echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";
          }

        }

echo "</select></td></tr>
      <tr><td>Funkcja: </td><td><select class=\"form_inputs\" name=\"m_member_funkcja\">
      <option>";

$list = ["Asysta sztandaru", "Dzień strażaka", "Fotograf",
        "Prowadzący", "Sztandarowy", "Święto kościelne"];

generateSelectOptionList($row[1], $list);

echo "</select></td></tr>
      </table>
				<div style=\"margin-top: 1%;\">
				<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany\" />
        <button id=\"clear\">Wyczyść</button>
        </div>

      </form>";


 ?>
