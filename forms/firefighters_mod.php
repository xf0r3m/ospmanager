<?php
$row1 = mysqli_fetch_row($result1);
echo "<form action=\"index.php?page=firefighters&action=mod\" method=\"post\">
		<div style=\"width: 50%; float:left;\">
    <h3>Dane osobowe:</h3>
      <table id=\"str_do\">
      <tr>
        <td>Imię:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_imie\"
        value =\"" . $row1[1] . "\"
        /></td>
      </tr>
      <tr>
        <td>Drugie imię:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_imie2\"
        value =\"" . $row1[2] . "\"
        /></td>
      </tr>
      <tr>
        <td>Nazwisko:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_nazwisko\"
        value =\"" . $row1[3] . "\"
         /></td>
      </tr>";
      $row1[4] = convertData($row1[4], 'y');
echo "<tr>
        <td>Data urodzenia:</td>
        <td><input class=\"form_inputs\" type=\"date\" name=\"str_do_data_ur\"
        value =\"" . $row1[4] . "\"
         /></td>
      </tr>
      <tr>
        <td>Miejsce urodzenia:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_msc_ur\"
          value =\"" . $row1[5] . "\"
         /></td>
      </tr>
      <tr>
        <td>Pesel:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_pesel\"
        value =\"" . $row1[6] . "\"
         /></td>
      </tr>
      <tr>
        <td>Imię ojca:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_imie_ojca\"
        value =\"" . $row1[7] . "\"
         /></td>
      </tr>
      <tr>
        <td>Plec:</td>
        <td><select class=\"form_inputs\" name=\"str_do_plec\"><option value=\"" . $row1[8] . "\">";
          if ( $row1[8] === "M" ) { echo "Męska</option><option value=\"K\">Żeńska</option></select>"; }
          else { echo "Żeńska</option><option value=\"M\">Męska</option></select>"; }
        echo "</td>
      </tr>
      <tr>
        <td>Zawód:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_zawod\"
        value =\"" . $row1[9] . "\"
         /></td>
      </tr>
      <tr>
        <td>Wykształcenie:</td>
        <td><select class=\"form_inputs\" name=\"str_do_wyksztalcenie\">
            <option value=\"" . $row1[10] . "\">";
          $list1 = ['P' => "Podstawowe", 'Z' => "Zawodowe", 'S' => "Średnie", 'W' => "Wyższe"];
              generateSelectOptionList($list1[$row1[10]], $list1);
              echo "</select>";
      echo "</td>
      </tr>
      <tr>
        <td>Miejsce pracy:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_msc_pracy\"
        value =\"" . $row1[11] . "\"
         /></td>
      </tr>
      <tr>
        <td>Numer tel.:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_nr_tel\"
        value =\"" . $row1[12] . "\"
         /></td>
      </tr>
	<tr>
		<td>Adres zamieszkania: </td>
		<td><input class=\"form_inputs\" type=\"text\" name=\"str_do_adres\"
		value=\"" . $row1[13] . "\"></td>
	</tr>
      </table>
			</div>
			<div style=\"width: 50%; float:left;\">";

$row2 = mysqli_fetch_row($result2);

      echo "<h3>Dane strażackie: </h3>
      <table>
      <tr>
        <td>Rodzaj: </td>
        <td><select class=\"form_inputs\" name=\"str_str_rodzaj\">
            <option value=\"" . $row2[0] . "\">";
            $list2 = ["Honorowy", "MDP", "Wspierający", "Zwyczajny"];
                generateSelectOptionList($row2[0], $list2);
                echo "</select>";
        echo "</td>
      </tr>
      <tr>
        <td>Stopień</td>
        <td><select class=\"form_inputs\" name=\"str_str_stopien\">
            <option value=\"" . $row2[1] . "\">";
            $list3 = ["Członek komisji rewizyjnej", "Członek zarządu", "Pomocnik dowódcy plutonu",
            "Dowódca plutonu", "Dowódca roty", "Pomocnik dowódcy sekcji", "Dowódca sekcji",
            "Prezes", "Przewodniczący komsji rewizyjnej", "Starszy strażak",
            "Strażak", "Wiceprezes naczelnik", "Zastępca naczelnika"];

                  generateSelectOptionList($row2[1], $list3);
                  echo "</select>";

        echo "</td>
      </tr>
      <tr>
        <td>Funkcja</td>
        <td><select class=\"form_inputs\" name=\"str_str_funkcja\">
            <option value=\"" . $row2[2] . "\">";
            $list4 = ["Gospodarz", "Kronikarz", "Naczelnik", "Zastępca naczelnika", "Opiekun MDP", "Prezes",
             "Skarbnik", "Przewodniczący komisji rewizyjnej", "Członek komisji rewizyjnej", "Strażak", "Strażak ratownik"];

              generateSelectOptionList($row2[2], $list4);

            echo "</select>
        </td>
      </tr>
      <tr>
        <td>Nr legitymacji:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_str_nr_legitymacji\"
          value=\"" . $row2[3] . "\"
         /></td>
      </tr>";
      $row2[4] = convertData($row2[4], 'y');
echo  "<tr>
        <td>Data wstąpienia:</td>
        <td><input class=\"form_inputs\" type=\"date\" name=\"str_str_data_wst\"
          value=\"" . $row2[4] . "\"
         /></td>
      </tr>
      <tr>
        <td>Udział w akcjach:</td>
        <td><select class=\"form_inputs\" name=\"str_str_udzwakc\">
            <option value=\"" . $row2[5] . "\">";
            $list5 = ["Strażak", "Kierowca", "Dowódca", "Dowódca + Kierowca", "Nie bierze"];

            generateSelectOptionList($row2[5], $list5);

            echo "</select>
        </td>
      </tr>
      </table>
      <input type=\"hidden\" class=\"form_inputs\" name=\"mod_id\" value=\"" . $mod_id . "\" />
      </div>
      <div style=\"width: 100%; float: left; margin-top: 1%; margin-bottom: 1%;\">
				<input class=\"form_button\" type=\"submit\" value=\"Zapisz!\" />
        <button id=\"clear\">Wyczyść!</button>
      </div>
    </form>";
?>
