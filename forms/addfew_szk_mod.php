<?php
$row1 = mysqli_fetch_row($result1);
echo "<form action=\"index.php?page=szk&action=mod&id=" . $row1[0] . "\"  method=\"post\">
      <table>
        <tr>
          <td>Strażak: </td>
          <td><select class=\"form_inputs\" name=\"str_szk_personal_id\">";

          $result_bak = $result2;

          while ($row2 = mysqli_fetch_row($result2)) {
            if ( $row1[7] === $row2[0] ) {
              echo "<option value=\"" . $row2[0] . "\">" . $row2[1] . " " . $row2[2] . "</option>";
            }
          }
          while ($row_bak = mysqli_fetch_row($result_bak)) {
            if ( $row1[7] === $row_bak[0] ) { continue; }
            else {
              echo "<option value=\"" . $row_bak[0] . "\">" . $row_bak[1] . " " . $row_bak[2] . "</option>";
            }
          }

            echo "</select></td>
        </tr>
        <tr>
          <td>Szkolenie: </td>
          <td><select class=\"form_inputs\" name=\"str_szk_nazwa\">
	    <option>";
		$list6 = ["Szkolenie strażaków ratowników OSP kurs jednolity (jednoetapowy)",
                        "Szkolenie podstawowe strażaków ratowników OSP cz. I",
                        "Szkolenie z zakresu sprzętu ochrony dróg oddechowych cz. II",
                        "Szkolenie dowódców OSP",
                       "Działania poszukiwawczo-ratownicze",
                       "Kierowców - konserwatorów sprzętu ratowniczego OSP",
                       "Szkolenie Szkolenie Komendantów Gminnych Związków Ochotniczej Straży pożarnej RP",
                       "Szkolenie z zakresu kwalifikowanej pierwszej pomocy",
                       "Egzamin ( termin ostatniej recertyfikacji )  potwierdzający uprawnienia w zakresie KPP",
                       "Szkolenie z zakresu kierowania ruchem drogowym",
                       "Szkolenie doskonalące dla strażaków KSRG z zakresu współdziałania z SP ZOZ lotnicze pogotowie ratunkowe.",
                       "Szkolenie specjalistyczne w zakresie eksploatacji i obsługi podnośników",
                       "Szkolenie operatorów sprzętu OSP",
                       "Szkolenie naczelników OSP",
                       "Podstawowe strażaków ratowników OSP",
                       "Ratownictwo chemiczne i ekologiczne",
                       "Szkolenie strażaków z zakresu działań przeciwpowodziowych oraz ratownictwa na wodzie.",
                       "Ratownictwo wysokościowe",
                       "Współpraca z LPR"];
            generateSelectOptionList($row1[1], $list6);

            $row1[2] = convertData($row1[2], 'y');
            $row1[3] = convertData($row1[3], 'y');

            echo "</select></td>
        </tr>
        <tr>
          <td>Data rozpoczęcia: </td>
          <td><input class=\"form_inputs\" type=\"date\" name=\"str_szk_data_roz\" value=\"" . $row1[2] . "\" /></td>
        </tr>
        <tr>
          <td>Data zakończenia: </td>
          <td><input class=\"form_inputs\" type=\"date\" name=\"str_szk_data_zak\" value=\"" . $row1[3] . "\" /></td>
        </tr>
        <tr>
          <td>Data ważności: </td>
          <td><input class=\"form_inputs\" type=\"date\" name=\"str_szk_data_exp\" value=\"" . $row1[4] . "\" /></td>
          <td><button id=\"szk_form_dataexp\" type=\"button\" >Nie dotyczy</button></td>
        </tr>
        <tr>
          <td>Numer zaświadczenia: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"str_szk_nr_zaswiadczenia\" value=\"" . $row1[5] . "\" /></td>
        </tr>
        <tr>
          <td>Uwagi</td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"str_szk_uwagi\" value=\"" . $row1[6] . "\" /></td>
        </tr>
        </table>
					<div style=\"margin-top: 1%;\">
					<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
					<button id=\"clear\">Wyczyść!</button>
					</div>
        </form>";
?>
