<?php
echo "<form action=\"index.php?page=firefighters\" method=\"post\">
		<div style=\"width: 50%; float:left;\">
    <h3>Dane osobowe:</h3>
      <table id=\"str_do\">
      <tr>
        <td>Imię:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_imie\" /></td>
      </tr>
      <tr>
        <td>Drugie imię:</td>
        <td><input  class=\"form_inputs\" type=\"text\" name=\"str_do_imie2\" /></td>
      </tr>
      <tr>
        <td>Nazwisko:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_nazwisko\" /></td>
      </tr>
      <tr>
        <td>Data urodzenia:</td>
        <td><input class=\"form_inputs\" type=\"date\" name=\"str_do_data_ur\" /></td>
      </tr>
      <tr>
        <td>Miejsce urodzenia:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_msc_ur\" /></td>
      </tr>
      <tr>
        <td>Pesel:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_pesel\" /></td>
      </tr>
      <tr>
        <td>Imię ojca:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_imie_ojca\" /></td>
      </tr>
      <tr>
        <td>Plec:</td>
        <td><select class=\"form_inputs\" name=\"str_do_plec\"><option></option><option value=\"M\">Męska</option>
            <option value=\"K\">Żeńska</option></select></td>
      </tr>
      <tr>
        <td>Zawód:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_zawod\" /></td>
      </tr>
      <tr>
        <td>Wykształcenie:</td>
        <td><select class=\"form_inputs\" name=\"str_do_wyksztalcenie\">
            <option></option>
            <option value=\"P\">Podstawowe</option>
            <option value=\"Z\">Zawodowe</option>
            <option value=\"S\">Średnie</option>
            <option value=\"W\">Wyższe</option>
            </select></td>
      </tr>
      <tr>
        <td>Miejsce pracy:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_msc_pracy\" /></td>
      </tr>
      <tr>
        <td>Numer tel.:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_do_nr_tel\" /></td>
      </tr>
	<tr>
		<td>Adres zamieszkania:</td>
		<td><input class=\"form_inputs\" type=\"text\" name=\"str_do_adres\" /></td>
	</tr> 
      </table>
      </div>
			<div style=\"width: 50%; float: left;\">
      <h3>Dane strażackie: </h3>
      <table>
      <tr>
        <td>Rodzaj: </td>
        <td><select class=\"form_inputs\" name=\"str_str_rodzaj\">
            <option></option>
            <option value=\"Honorowy\">Honorowy</option>
            <option value=\"MDP\">MDP</option>
            <option value=\"Wspierający\">Wspierający</option>
            <option value=\"Zwyczajny\">Zwyczajny</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>Stopień</td>
        <td><select class=\"form_inputs\" name=\"str_str_stopien\">
            <option></option>
            <option value=\"Członek komisji rewizyjnej\">Członek komisji rewizyjnej</option>
	    <option value=\"Członek zarządu\">Członek zarządu</option>
		<option value=\"Pomocnik dowódcy plutonu\">Pomocnik dowódcy plutonu</option>
            <option value=\"Dowódca plutonu\">Dowódca plutonu</option>
	    <option value=\"Dowódca roty\">Dowódca roty</option>
		<option value=\"Pomocnik dowódcy sekcji\">Pomocnik dowódcy sekcji</option>
            <option value=\"Dowódca sekcji\">Dowódca sekcji</option>
            <option value=\"Prezes\">Prezes</option>
            <option value=\"Przewodniczący komisji rewizyjnej\">Przewodniczący komisji rewizyjnej</option>
            <option value=\"Starszy strażak\">Starszy strażak</option>
            <option value=\"Strażak\">Strażak</option>
            <option value=\"Wiceprezes naczelnik\">Wiceprezes naczelnik</option>
            <option value=\"Zastępca naczelnika\">Zastępca naczelnika</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>Funkcja</td>
        <td><select class=\"form_inputs\" name=\"str_str_funkcja\">
	    <option></option>
		<option value=\"Gospodarz\">Gospodarz</option>
            <option value=\"Kronikarz\">Kronikarz</option>
	    <option value=\"Naczelnik\">Naczelnik</option>
		<option value=\"Zastępca naczelnika\">Zastępca naczelnika</option>
            <option value=\"Opiekun MDP\">Opiekun MDP</option>
            <option value=\"Prezes\">Prezes</option>
            <option value=\"Sekretarz\">Sekretarz</option>
	    <option value=\"Skarbnik\">Skarbnik</option>
		<option value=\"Przewodniczący komisji rewizyjnej\">Przewodniczący komisji rewizyjnej</option>
		<option value=\"Członek komisji rewizyjnej\">Członek komisji rewizyjnej</option>
            <option value=\"Strażak\">Strażak</option>
            <option value=\"Strażak ratownik\">Strażak ratownik</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>Nr legitymacji:</td>
        <td><input class=\"form_inputs\" type=\"text\" name=\"str_str_nr_legitymacji\" /></td>
      </tr>
      <tr>
        <td>Data wstąpienia:</td>
        <td><input class=\"form_inputs\" type=\"date\" name=\"str_str_data_wst\" /></td>
      </tr>
      <tr>
        <td>Udział w akcjach:</td>
        <td><select class=\"form_inputs\" name=\"str_str_udzwakc\">
            <option></option>
            <option value=\"Strażak\">Strażak</option>
            <option value=\"Kierowca\">Kierowca</option>
            <option value=\"Dowódca\">Dowódca</option>
            <option value=\"Dowódca + Kierowca\">Dowódca + Kierowca</option>
            <option value=\"Nie bierze\">Nie bierze</option>
            </select>
        </td>
      </tr>
      </table>
			</div>
			<div style=\"width: 100%; float: left; margin-top: 1%; margin-bottom: 1%;\">
			<input class=\"form_button\" type=\"submit\" value=\"Zapisz!\" />
			<button id=\"clear\">Wyczyść!</button>
			</div>
			</form>";
?>
