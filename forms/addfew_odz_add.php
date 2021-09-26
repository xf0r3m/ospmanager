<?php
echo "
  <form action=\"index.php?page=odz\" method=\"post\">
  <table>
  <tr>
    <td>Strażak: </td>
    <td><select class=\"form_inputs\" name=\"str_odz_personal_id\">
      <option></option>";
      while ($row0 = mysqli_fetch_row($result0)) {
        echo "<option value=\"" . $row0[0] . "\">" . $row0[1] . " " . $row0[2] . "</option>";
      }
    echo "</td></tr>
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
        generateSelectOptionList("", $list7);
        echo "</select></td>
      </tr>
      <tr>
      <td>Data nadania: </td>
      <td><input class=\"form_inputs\" type=\"date\" name=\"str_odz_data_nad\" /></td>
      </tr>
      <tr>
        <td>Nr legitymacji: </td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_odz_nr_legitymacji\" /></td>
      </tr>
      <tr>
        <td>Uwagi</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_odz_uwagi\" /></td>
      </tr>
      </table>
				<div style=\"margin-top: 1%;\">
        <input class=\"form_button\" type=\"submit\" value=\"Dodaj odznaczenie\" />
        <button id=\"clear\">Wyczyść!</button>
				</div>
      </form>";
?>
