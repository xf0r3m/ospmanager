<?php
$row0 = mysqli_fetch_row($result1);
echo "
  <form action=\"index.php?page=odz&action=mod&id=" . $row0[0] . "\" method=\"post\">
  <table>
  <tr>
    <td>Strażak: </td>
    <td><select class=\"form_inputs\" name=\"str_odz_personal_id\">";

    $result_bak = $result2;
    while( $row1 = mysqli_fetch_row($result2)) {
      if ( $row0[5] === $row1[0] ) {
        echo "<option value=\"" . $row1[0] . "\">" . $row1[1] . " " . $row1[2] . "</option>";
      }
    }
    while( $row2 = mysqli_fetch_row($result_bak) ) {
      if ( $row0[5] === $row2[0] ) { continue; }
      else {
        echo "<option value=\"" . $row2[0] . "\">" . $row2[1] . " " . $row2[2] . "</option>";
      }
    }

    echo "</select></td></tr>
    <tr>
      <td>Odznaczenie: </td>
      <td><select class=\"form_inputs\" name=\"str_odz_nazwa\">
        <option>";
        $list7 = ["Brązowa Odznaka MDP", "Brązowy Krzyż Zasługi", "Brązowy Medal 'Za Zasługi dla Pożarnictwa'",
        "Medal Honorowy im. Bolesłwa Chomicza", "Odznaka 'Strażaka Wzorowy'", "Srebna Odznaka MDP", "Srebrny Krzyż Zasługi",
        "Srebrny Medal 'Za Zasługi Dla Pożarnictwa'", "Za Wysługę Lat - 5", "Za Wysługę Lat - 10", "Za Wysługę Lat - 15",
        "Za Wysługę Lat - 20", "Za Wysługę Lat - 25", "Za Wysługę Lat - 30", "Za Wysługę Lat - 35", "Za Wysługę Lat - 40",
        "Za Wysługę Lat - 45", "Za Wysługę Lat - 50", "Za Wysługę Lat - 55", "Za Wysługę Lat - 60", "Za Wysługę Lat - 65",
        "Za Wysługę Lat - 70", "Złota Odznaka MDP", "Złota Krzyż Zasługi", "Złota Medal 'Za Zasługi Dla Pożarnictwa'",
        "Złota Medal 'Za Zasługi Dla Pożarnictwa' Po raz drugi", "Złoty Znak Związku OSP RP"];
        generateSelectOptionList($row0[1], $list7);
        $row0[2] = convertData($row0[2], 'y');
        echo "</select></td>
      </tr>
      <tr>
      <td>Data nadania: </td>
      <td><input class=\"form_inputs\" type=\"date\" name=\"str_odz_data_nad\" value=\"" . $row0[2] . "\" /></td>
      </tr>
      <tr>
        <td>Nr legitymacji: </td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_odz_nr_legitymacji\" value=\"" . $row0[3] . "\" /></td>
      </tr>
      <tr>
        <td>Uwagi</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_odz_uwagi\" value=\"" . $row0[4] . "\" /></td>
      </tr>
			</table>
			<div style=\"margin-top: 1%;\">
        <input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany\" />
				<button id=\"clear\">Wyczyść!</button>
				</div>
      </form>";
 ?>
