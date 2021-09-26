<?php
echo "<style>
	form { widht: inherit; }
	#contentmenu { display: none; }
	.form_inputs, .form_button, #genCard { font-size: 9px; }
	</style>";
  echo "<form action=\"index.php?page=docs_rcardev\" method=\"post\">
        <table>
        <tr><td>Numer ewidencyjny karty pracy: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_common_seria\" value=\"0\" /></td></tr>
        <tr><td>Karta na miesiąc: </td>
            <td>
            <select class=\"form_inputs\" name=\"rcardev_common_miesiac\">
            <option value=\"0\"></option>
            <option value=\"Styczeń\">Styczeń</option>
            <option value=\"Luty\">Luty</option>
            <option value=\"Marzec\">Marzec</option>
            <option value=\"Kwiecień\">Kwiecień</option>
            <option value=\"Maj\">Maj</option>
            <option value=\"Czerwiec\">Czerwiec</option>
            <option value=\"Lipiec\">Lipiec</option>
            <option value=\"Sierpień\">Sierpień</option>
            <option value=\"Wrzesień\">Wrzesień</option>
            <option value=\"Październik\">Październik</option>
            <option value=\"Listopad\">Listopad</option>
            <option value=\"Grudzień\">Grudzień</option>
            </select>
            </td></tr>
        <tr><td>Marka pojazdu: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_vehicle_marka\" value=\"" . $row[1] . "\" /></td></tr>
        <tr><td>Typ pojazdu: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_vehicle_typ\" value=\"" . $row[2] . "\" /></td></tr>
        <tr><td>Rodzaj pojazdu: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_vehicle_rodzaj\" value=\"" . $row[0] . "\" /></td></tr>
        <tr><td>Nr rejestracyjny:</td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_vehicle_rej\" value=\"" . $row[3] . "\" /></td></tr>
        <tr><td>Nr operacyjny: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_vehicle_nrop\" value=\"" . $row[4] . "\" /></td></tr>
        <tr><td>Pojemność zbiornika: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_vehicle_zbior\" value=\"" . $row[5] . "\" /></td></tr>
        <tr><td>Norma zużycia paliwa: </td>
            <td><input id=\"n1\" type=\"text\" class=\"form_inputs\" name=\"rcardev_vehicle_norma\" value=\"" . $norma . "\" />/100 km</td></tr>
        <tr><td>Praca silnika na postoju: </td>
            <td><input type=\"text\" class=\"form_inputs\" name=\"rcardev_vehicle_normap\" value=\"" . $postoj_norma . "\" /> Litra/min.</td></tr>
        </table>
        <h3>Rozliczenie zużycia paliwa</h3>
        <table>
        <tr><td>Stan licznika na koniec bierzącego okresu rozliczeniowego: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_usage_stkoniecbr\" value=\"0\" /></td></tr>
        <tr><td>Stan licznika na koniec poprzedniego okresu rozliczeniowego: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_usage_stkoniecpo\" value=\"0\" /></td></tr>
        <tr><td>Przebieg pojazdu w bierzącym okresie rozliczeniowym: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_usage_przebiegbr\" value=\"0\" /></td></tr>
        <tr><td>Przebieg km: <input class=\"form_inputs\" type=\"text\" name=\"rcardev_usage_przebieg\" size=\"5\" value=\"0\" />
            x norma <input id=\"n2\" class=\"form_inputs\" type=\"text\" size=\"5\" value=\"" . $norma . "\" /> dm<sup>3</sup>/100 km =
            <input id=\"wynik\" class=\"form_inputs\" type=\"text\" name=\"rcardev_przebieg_wynik\" size=\"5\" value=\"0\" /> dm<sup>3</sup></td>
            <td>Przyjęto do rozliczenia: <input class=\"form_inputs\" type=\"text\" name=\"rcardev_usage_pdroz\" size=\"5\" value=\"0\" /></td></tr>
        <tr><td>Praca silnika na postoju: <input class=\"form_inputs\" type=\"text\" name=\"rcardev_usage_postoj\" size=\"5\" value=\"0\" />
            minut x norma <input id=\"n3\" class=\"form_inputs\" type=\"text\" size=\"5\" value=\"" . $postoj_norma . "\" /> dm<sup>3</sup>/min. =
            <input id=\"wynik\" class=\"form_inputs\" type=\"text\" name=\"rcardev_minuty_wynik\" size=\"5\" value=\"0\" /> dm<sup>3</sup></td></tr>
        <tr><td>Rozruch kontrolny <input type=\"text\" class=\"form_inputs\" name=\"rcardev_usage_rk\" value=\"" . $rk_norma . "\" /> litra / RK</tr>
	</table>
	<br />
	<h3>Urządzenia specjalne</h3>
	<table>
		<tr><td>Autopompa czas pracy <input class=\"form_inputs\" type=\"text\" name=\"rcardev_pompa_minut\" size=\"5\" value=\"0\" /> minut x norma <input class=\"form_inputs\" type=\"text\" name=\"rcardev_pompa_norma\" size=\"5\" value=\"" . $autopompa_norma . "\" /> dm<sup>3</sup>/min. = <input class=\"form_inputs\" type=\"text\" name=\"pompa_wynik\" size=\"5\" value=\"0\" /> dm<sup>3</sup></td></tr>
		<tr><td>Webasto Urządzenie grzewcze <input class=\"form_inputs\" type=\"text\" name=\"rcardev_web_minut\" size=\"5\" value=\"0\" /> minut x norma <input class=\"form_inputs\" type=\"text\" name=\"rcardev_web_norma\" size=\"5\" value=\"" . $web_norma . "\" /> dm<sup>3</sup>/min. = <input class=\"form_inputs\" type=\"text\" name=\"web_wynik\" size=\"5\" value=\"0\" /> dm<sup>3</sup></td></tr>
	</table>
	<br />
	<table>
	<tr><th>Razem zużyto: <input class=\"form_inputs\" id=\"razem\" type=\"text\" name=\"rcardev_usage_razem\" value=\"0\" /> dm<sup>3</sup></th></tr>
	</table>";
	echo "<br />
		<table>
			<tr><th colspan=\"4\">Pobrano (w litrach)</th><th>Podpis kierowcy</th><th>Podpis osoby<br />odpowiedzialnej</th></tr>
		<tr><th>data</th><th>nr.faktury</th><th>ilość paliw</th><th>ilość oleju</th></tr>";

	$tName='str_do';
	$csh='id,imie,nazwisko';
	$whereValue='true';
	$result = prepareForm($connection, $tName, $csh, $whereValue);

	while ( $row = mysqli_fetch_row($result) ) {

		if ( ! isset($optionsList) ) {
			$optionsList = "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option> ";
		} else {

			$optionsList .= "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option> ";

		}
		
	}

	for($i=0; $i < 4; $i++) {

		echo "<tr>
			<td><input class=\"form_inputs\" type=\"date\" name=\"rcardev_fuel1_data[]\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel1_faktura[]\" value=\"0\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel1_paliwo[]\" value=\"0\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel1_olej[]\" value=\"0\" /></td>
			<td><select class=\"form_inputs\" name=\"rcardev_fuel1_personal_id0[]\">
				<option value=\"0\"></option>" . $optionsList . "</select></td>
			<td><select class=\"form_inputs\" name=\"rcardev_fuel1_personal_id1[]\">
				<option value=\"0\"></option>" . $optionsList . "</select></td>
		</tr>";
			
	}

	echo "<tr><th colspan=\"2\">Ogółem: </th><td><input class=\"form_inputs\" type=\"text\" name=\"razem_paliwo\" value=\"0\"/></td><td><input class=\"form_inputs\" type=\"text\" name=\"razem_olej\" value=\"0\"/></td><td colspan=\"2\"></td></tr>

	</table>
	<br />
	<table>
		<tr><th colspan=\"5\">litrów</th><th>paliwa</th><th>oleju</th></tr>
		<tr><td>1. </td><td colspan=\"4\">Pozostało z ubiegłego miesiąca: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_pozostalo_paliwo0\" value=\"0\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_pozostalo_olej0\" value=\"0\" /></td>
		</tr>
		<tr><td>2. </td><td colspan=\"4\">Pobrano w ciągu miesiąca: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_pobrano_paliwo\" value=\"0\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_pobrano_olej\" value=\"0\" /></td>
		</tr>
		<tr><td>3. </td><td colspan=\"4\">Razem: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_razem_paliwo0\" value=\"0\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_razem_olej0\" value=\"0\" /></td>
		</tr>
		<tr><td>4. </td><td>Przebyto km: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_km\" value=\"0\" /></td>
			<td>5. </td>
			<td>zużyto: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_kmz_paliwo\" value=\"0\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_kmz_olej\" value=\"0\" /></td>
		</tr>
		<tr><td>6. </td><td>Przepracowano minut: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_minut\" value=\"0\" /></td>
			<td>7. </td>
			<td>zużyto: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_m_paliwo\" value=\"0\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_m_olej\" value=\"0\" /></td>
		</tr>
		<tr><td>8. </td><td>Wykonano rozruchów</td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_rk\" value=\"0\" /></td>
			<td>9. </td>
			<td>zużyto: </td>
			<td><input class=\"form_inputs\" type=\"text\" type=\"text\" name=\"rcardev_fuel2_rk_paliwo\" value=\"0\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" type=\"text\" name=\"rcardev_fuel2_rk_olej\" value=\"0\" /></td>
		</tr>
		<tr><td>10. </td><td colspan=\"4\">Zużyto w ciągu miesiąca razem: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_razem_paliwo1\" value=\"0\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_razem_olej1\" value=\"0\" /></td>
		</tr>
		<tr><td>11. </td><td colspan=\"4\">Pozostało na następny miesiąc: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_pozostalo_paliwo1\" value=\"0\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_pozostalo_olej1\" value=\"0\" /></td>
		</tr>
	</table>
	<br />
	<table>
		<tr>
		<th rowspan=\"2\">Data</th>
		<th rowspan=\"2\">Nazwisko<br />dysponenta<br />(dowódcy)<br /></th>
		<th rowspan=\"2\">Trasa jazdy<br />skąd-dokąd</th>
		<th rowspan=\"2\">Cel jazdy</th>
		<th rowspan=\"2\">Nazwisko</th>
		<th>Odjazd</th>
		<th>Przyjazd</th>
		<th rowspan=\"2\">Minut pracy urządzeń specjalnych</th>
		<th rowspan=\"2\">Podpis dysponenta</th>
		</tr>
		<tr><th>Stan<br />licznika</th><th>Stan<br />licznika</td></tr>
";

	for ($i=0; $i < 16; $i++) {
	
		echo "<tr>
			<td><input class=\"form_inputs\" type=\"date\" name=\"rcardev_tab_data[]\" /></td>
			<td><select class=\"form_inputs\" name=\"rcardev_tab_personal_id0[]\" />
				<option value=\"0\"></option>" . $optionsList . "</select></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_trasa[]\" value=\"0\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_cel[]\" value=\"0\" /></td>
			<td><select class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_personal_id1[]\" />
				<option value=\"0\"></option>" . $optionsList . "</select></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_ostanl[]\" value=\"0\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_pstanl[]\" value=\"0\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_dev[]\" value=\"0\" /></td>
			<td><select class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_personal_id2[]\">
	<option value=\"0\"></option>" . $optionsList . "</select></td>
		</tr>";

	}

	echo "</table>
		<br />
		<table>
			<tr>
			<th>Obliczył</th>
			<th>Sprawdził</th>
			<th colspan=\"2\">Kartę wystawiono</th>
			<th>Wystawił</th>
			</tr>
			<tr>
			<td><select class=\"form_inputs\" name=\"rcardev_common2_personal_id0\">
				<option value=\"0\"></option>" . $optionsList . "</select></td>
			<td><select class=\"form_inputs\" name=\"rcardev_common2_personal_id1\">
				<option value=\"0\"></option>" . $optionsList . "</select></td>
			<td><input class=\"form_inputs\" name=\"rcardev_common2_msc\" type=\"text\" value=\"0\" /></td>
			<td><input class=\"form_inputs\" name=\"rcardev_common2_data\" type=\"date\" /></td>
			<td><select class=\"form_inputs\" name=\"rcardev_common2_personal_id2\">
				<option value=\"0\"></option>" . $optionsList . "</select></td>
			</tr>
		</table>";

		
		
		
	
			echo "<div><input class=\"form_button\" type=\"submit\" value=\"Zapisz\">
				<a href=\"index.php?page=docs&form=road_card_dev\"><button id=\"genCard\">Generuje kartę</button></a></div>
        </form>";





 ?>
