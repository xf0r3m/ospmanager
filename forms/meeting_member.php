<?php

echo "<form action=\"index.php?page=meeting_member\" method=\"post\" >
      <input class=\"form_inputs\" type=\"hidden\" name=\"m_member_meet_id\" value=\"" . $meet_id . "\" />
      <table>
      <tr><td>Uczestnik: </td><td><select class=\"form_inputs\" name=\"m_member_personal_id\">
      <option></option>";

        while( $row = mysqli_fetch_row($result) ) {
          echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";
        }

echo "</select></td></tr>
      <tr><td>Funkcja: </td><td><select class=\"form_inputs\" name=\"m_member_funkcja\">
      <option></option>";

$list = ["Asysta sztandaru", "Dzień strażaka", "Fotograf",
        "Prowadzący", "Sztandarowy", "Święto kościelne"];

generateSelectOptionList("", $list);

echo "</select></td></tr>
      </table>
                        <div style=\"margin-top: 1%;\">
                        <input class=\"form_button\" type=\"submit\" value=\"Dodaj uczestnika\" />
                                    <button id=\"clear\">Wyczyść</button>
                                    </div>
      </form>";

 ?>
