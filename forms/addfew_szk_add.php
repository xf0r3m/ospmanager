<?php
echo "<form action=\"index.php?page=szk\"  method=\"post\">
      <table>
        <tr>
          <td>Strażak: </td>
          <td><select class=\"form_inputs\" name=\"str_szk_personal_id\">
            <option></option>";
              while ($row0 = mysqli_fetch_row($result0)) {
                echo "<option value=\"" . $row0[0] . "\">" . $row0[1] . " " . $row0[2] . "</option>";
              }
            echo "</select></td>
        </tr>
        <tr>
          <td>Szkolenie: </td>
          <td><select class=\"form_inputs\" name=\"str_szk_nazwa\">
            <option></option>
            ";
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
            generateSelectOptionList("", $list6);
            echo "</select></td>
        </tr>
        <tr>
          <td>Data rozpoczęcia: </td>
          <td><input class=\"form_inputs\" type=\"date\" name=\"str_szk_data_roz\" /></td>
        </tr>
        <tr>
          <td>Data zakończenia: </td>
          <td><input class=\"form_inputs\" type=\"date\" name=\"str_szk_data_zak\" /></td>
        </tr>
          <td>Data ważności: </td>
          <td><input class=\"form_inputs\" type=\"date\" name=\"str_szk_data_exp\" /></td>
          <td><button id=\"szk_form_dataexp\" type=\"button\" >Nie dotyczy</button></td>
        </tr>
        <tr>
          <td>Numer zaświadczenia: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"str_szk_nr_zaswiadczenia\" /></td>
        </tr>
        <tr>
          <td>Uwagi</td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"str_szk_uwagi\" /></td>
	</tr>
	</table>
					<div style=\"margin-top: 1%;\">
         <input class=\"form_button\" type=\"submit\" value=\"Dodaj szkolenie\" />
          <button id=\"clear\">Wyczyść!</button>
				 </div>
        </form>";
 ?>
