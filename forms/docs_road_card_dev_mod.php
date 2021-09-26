<?php

$row0 = mysqli_fetch_row($result0);
$row1 = mysqli_fetch_row($result1);
$row2 = mysqli_fetch_row($result2);
$row3 = mysqli_fetch_row($result3);
$row4 = mysqli_fetch_row($result4);
$row6 = mysqli_fetch_row($result6);
$row9 = mysqli_fetch_row($result9);

echo "<style>
	form { width: inherit; }
	#contentmenu { display: none; }
	.form_inputs, .form_button, #genCard { font-size: 9px; }
	</style>";

echo "<form action=\"index.php?page=docs_rcardev&action=load\" method=\"post\">
	<input class=\"form_inputs\" type=\"hidden\" name=\"rcardev_common_id\" value=\"" . $load_id . "\" />
        <table>
        <tr><td>Numer ewidencyjny karty pracy: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_common_seria\" value=\"" . $row0[1] . "\" /></td></tr>
        <tr><td>Karta na miesiąc: </td>
            <td>
            <select class=\"form_inputs\" name=\"rcardev_common_miesiac\">
	    <option value=\"" . $row0[2] . "\">";

	$list0 = ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", 
		"Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Listopad", "Grudzień"];
	generateSelectOptionList($row0[2], $list0);
	

		

       echo " </select>
            </td></tr>
        <tr><td>Marka pojazdu: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_vehicle_marka\" value=\"" . $row1[1] . "\" /></td></tr>
        <tr><td>Typ pojazdu: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_vehicle_typ\" value=\"" . $row1[2] . "\" /></td></tr>
        <tr><td>Rodzaj pojazdu: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_vehicle_rodzaj\" value=\"" . $row1[3] . "\" /></td></tr>
        <tr><td>Nr rejestracyjny:</td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_vehicle_rej\" value=\"" . $row1[4] . "\" /></td></tr>
        <tr><td>Nr operacyjny: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_vehicle_nrop\" value=\"" . $row1[5] . "\" /></td></tr>
        <tr><td>Pojemność zbiornika: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_vehicle_zbior\" value=\"" . $row1[6] . "\" /></td></tr>
        <tr><td>Norma zużycia paliwa: </td>
            <td><input id=\"n1\" onchange=\"paliwo();\" type=\"text\" class=\"form_inputs\" name=\"rcardev_vehicle_norma\" value=\"" . $row1[7] . "\" />/100 km</td></tr>
        <tr><td>Praca silnika na postoju: </td>
            <td><input type=\"text\" class=\"form_inputs\" name=\"rcardev_vehicle_normap\" value=\"" . $row1[8] . "\"/> Litra/min.</td></tr>
        </table>
        <h3>Rozliczenie zużycia paliwa</h3>
        <table>
        <tr><td>Stan licznika na koniec bierzącego okresu rozliczeniowego: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_usage_stkoniecbr\" value=\"" . $row2[1] . "\" /></td></tr>
        <tr><td>Stan licznika na koniec poprzedniego okresu rozliczeniowego: </td>
	    <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_usage_stkoniecpo\" value=\"" . $row2[2] . "\" /></td></tr>
        <tr><td>Przebieg pojazdu w bierzącym okresie rozliczeniowym: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_usage_przebiegbr\" value=\"" . $row2[3] . "\" /></td></tr>
        <tr><td>Przebieg km: <input class=\"form_inputs\" type=\"text\" name=\"rcardev_usage_przebieg\" size=\"5\" value=\"" . $row2[4] . "\" />
            x norma <input id=\"n2\" class=\"form_inputs\" type=\"text\" size=\"5\" /> dm<sup>3</sup>/100 km =
            <input id=\"wynik\" class=\"form_inputs\" type=\"text\" name=\"rcardev_przebieg_wynik\" size=\"5\" /> dm<sup>3</sup></td>
            <td>Przyjęto do rozliczenia: <input class=\"form_inputs\" type=\"text\" name=\"rcardev_usage_pdroz\" size=\"5\"  value=\"" . $row2[5] . "\" /></td></tr>
        <tr><td>Praca silnika na postoju: <input class=\"form_inputs\" type=\"text\" name=\"rcardev_usage_postoj\" size=\"5\" value=\"" . $row2[6] . "\" />
            minut x norma <input id=\"n3\" class=\"form_inputs\" type=\"text\" size=\"5\" /> dm<sup>3</sup>/min. =
            <input id=\"wynik\" class=\"form_inputs\" type=\"text\" name=\"rcardev_minuty_wynik\" size=\"5\" /> dm<sup>3</sup></td></tr>
        <tr><td>Rozruch kontrolny <input type=\"text\" class=\"form_inputs\" name=\"rcardev_usage_rk\" value=\"" . $row2[7] . "\" /> litra / RK</tr>
        <tr><td>Razem zużyto: <input class=\"form_inputs\" id=\"razem\" type=\"text\" name=\"rcardev_usage_razem\" value=\"" . $row2[8] . "\" /> dm<sup>3</sup></td></tr>
	</table>
	<br />
	<table>
		<tr><td>Autopompa czas pracy <input class=\"form_inputs\" type=\"text\" name=\"rcardev_pompa_minut\" value=\"" . $row3[1] . "\" size=\"5\" /> minut x norma <input class=\"form_inputs\" typ\"text\" name=\"rcardev_pompa_norma\" value=\"" . $row3[2] . "\" size=\"5\" /> dm<sup>3</sup>/min. = <input class=\"form_inputs\" type=\"text\" name=\"pompa_wynik\" /> dm<sup>3</sup></td></tr>
		<tr><td>Webasto urządzenie grzewcze <input class=\"form_inputs\" type=\"text\" name=\"rcardev_web_minut\" value=\"" . $row4[1] . "\" /> minut x norma <input class=\"form_inputs\" type=\"text\" name=\"rcardev_web_norma\" value=\"" . $row4[2] . "\" /> = <input class=\"form_inputs\" type=\"text\" name=\"web_wynik\" /> dm<sup>3<sup></td></tr>
	</table>
		<br />
		<br />
	<table>
<tr><th>Razem zużyto: <input class=\"form_inputs\" id=\"razem\" type=\"text\" name=\"rcardev_usage_razem\" value=\"" . $row2[8] . "\" /> dm<sup>3</sup></th></tr>
	</table><br />";
	echo "<br />
		<table>
			<tr><th colspan=\"4\">Pobrano (w litrach)</th><th>Podpis kierowcy</th><th>Podpis osoby<br />odpowiedzialnej</th></tr>
		<tr><th>data</th><th>nr.faktury</th><th>ilość paliw</th><th>ilość oleju</th></tr>";

	$tName = 'str_do';
	$csh = 'id,imie,nazwisko';
	$whereValue = 'true';

	$result7 = prepareForm($connection, $tName, $csh, $whereValue);

	while ( $row7 = mysqli_fetch_row($result7) ) {

		if ( ! isset($optionList) ) {
			$optionList = "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
		} else {

			$optionList .= "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";

		}
	}

	mysqli_data_seek($result7, 0);


	while ( $row5 = mysqli_fetch_row($result5) ) {

		$row5_1tab = explode(' ', $row5[1]);

		echo "<tr>
			<td><input class=\"form_inputs\" type=\"date\" name=\"rcardev_fuel1_data[]\" value=\"" . $row5_1tab[0] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel1_faktura[]\" value=\"" . $row5[2] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel1_paliwo[]\" value=\"" . $row5[3] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel1_olej[]\" value=\"" . $row5[4] . "\" /></td>
			<td><select class=\"form_inputs\" name=\"rcardev_fuel1_personal_id0[]\">";

		while ( $row7 = mysqli_fetch_row($result7) ) {

			if ( $row5[5] === $row7[0] ) { echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
			}

		}

		mysqli_data_seek($result7, 0);

		while ( $row7 = mysqli_fetch_row($result7) ) {
		
			if ( $row5[5] === $row7[0] ) {continue;}
			else {
				echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
			}
		}

		mysqli_data_seek($result7, 0);

		echo "</select></td>
			<td><select class=\"form_inputs\" name=\"rcardev_fuel1_personal_id1[]\">";

		while ( $row7 = mysqli_fetch_row($result7) ) {

			if ( $row5[6] === $row7[0] ) {
				echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
			}
		}

		mysqli_data_seek($result7, 0);

		while ( $row7 = mysqli_fetch_row($result7) ) {


			if ( $row5[6] === $row7[0] ) {continue;}
			else {
				echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
			}


		}

		mysqli_data_seek($result7, 0);

		echo "</select></td>
		</tr>";

	}

	for($i=mysqli_num_rows($result5); $i<4; $i++) {
		
			echo "<tr>
			<td><input class=\"form_inputs\" type=\"date\" name=\"rcardev_fuel1_data[]\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel1_faktura[]\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel1_paliwo[]\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel1_olej[]\" /></td>
			<td><select class=\"form_inputs\" name=\"rcardev_fuel1_personal_id0[]\">
				<option></option>" . $optionList . "</select></td>
			<td><select class=\"form_inputs\" name=\"rcardev_fuel1_personal_id1[]\">
				<option></option>" . $optionList . "</select></td>
			</tr>";

	}
			

	echo "<tr><th colspan=\"2\">Ogółem: </th><td><input class=\"form_inputs\" type=\"text\" name=\"razem_paliwo\" /></td><td><input class=\"form_inputs\" type=\"text\" name=\"razem_olej\" /></td><td colspan=\"2\"></td></tr>

	</table>
	<br />
	<table>
		<tr><th colspan=\"5\">litrów</th><th>paliwa</th><th>oleju</th></tr>
		<tr><td>1. </td><td colspan=\"4\">Pozostało z ubiegłego miesiąca: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_pozostalo_paliwo0\" value=\"" . $row6[1] . "\" />
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_pozostalo_olej0\" value=\"" . $row6[2] . "\" /></td>
		</tr>
		<tr><td>2. </td><td colspan=\"4\">Pobrano w ciągu miesiąca: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_pobrano_paliwo\" value=\"" . $row6[3] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_pobrano_olej\" value=\"" . $row6[4] . "\" /></td>
		</tr>
		<tr><td>3. </td><td colspan=\"4\">Razem: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_razem_paliwo0\"value=\"" . $row6[5] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_razem_olej0\" value=\"" . $row6[6] . "\" /></td>
		</tr>
		<tr><td>4. </td><td>Przebyto km: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_km\" value=\"" . $row6[7] . "\" /></td>
			<td>5. </td>
			<td>zużyto: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_kmz_paliwo\" value=\"" . $row6[8] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_kmz_olej\" value=\"" . $row6[9] . "\" /></td>
		</tr>
		<tr><td>6. </td><td>Przepracowano minut: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_minut\" value=\"" . $row6[10] . "\" /></td>
			<td>7. </td>
			<td>zużyto: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_m_paliwo\" value=\"" . $row6[11] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_m_olej\" value=\"" . $row6[12] . "\" /></td>
		</tr>
		<tr><td>8. </td><td>Wykonano rozruchów</td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_rk\" value=\"" . $row6[13] . "\" /></td>
			<td>9. </td>
			<td>zużyto: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_rk_paliwo\" value=\"" . $row6[14] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_rk_olej\" value=\"" . $row6[15] . "\" /></td>
		</tr>
		<tr><td>10. </td><td colspan=\"4\">Zużyto w ciągu miesiąca razem: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_razem_paliwo1\" value=\"" . $row6[16] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_razem_olej1\" value=\"" . $row6[17] . "\" /></td>
		</tr>
		<tr><td>11. </td><td colspan=\"4\">Pozostało na następny miesiąc: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_pozostalo_paliwo1\" value=\"" . $row6[18] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_fuel2_pozostalo_olej1\" value=\"" . $row6[19] . "\" /></td>
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

	while ( $row8 = mysqli_fetch_row($result8) ) {


		$row8_1tab = explode(' ', $row8[1]);

		echo "<tr>
			<td><input class=\"form_inputs\" type=\"date\" name=\"rcardev_tab_data[]\" value=\"" . $row8_1tab[0] . "\" /></td>
			<td><select class=\"form_inputs\" name=\"rcardev_tab_personal_id0[]\" />
				";
			while ( $row7 = mysqli_fetch_row($result7) ) {
			
				if ( $row8[2] === $row7[0] ) {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
				}
			}

			mysqli_data_seek($result7, 0);

			while ( $row7 = mysqli_fetch_row($result7) ) {

				if ( $row8[2] === $row7[0] ) { continue; }
				else {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";

				}
			}

			mysqli_data_seek($result7, 0);

		echo "</select></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_trasa[]\" value=\"" . $row8[3] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_cel[]\" value=\"" . $row8[4] . "\" /></td>
			<td><select class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_personal_id1[]\" >";

			while ( $row7 = mysqli_fetch_row($result7) ) {
			
				if ( $row8[5] === $row7[0] ) {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
				}
			}

			mysqli_data_seek($result7, 0);

			while ( $row7 = mysqli_fetch_row($result7) ) {

				if ( $row8[5] === $row7[0] ) { continue; }
				else {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";

				}
			}

			mysqli_data_seek($result7, 0);


		echo "</select></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_ostanl[]\" value=\"" . $row8[6] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_pstanl[]\" value=\"" . $row8[7] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_dev[]\" value=\"" . $row8[8] . "\" /></td>
			<td><select class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_personal_id2[]\">";
			while ( $row7 = mysqli_fetch_row($result7) ) {
			
				if ( $row8[9] === $row7[0] ) {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
				}
			}

			mysqli_data_seek($result7, 0);

			while ( $row7 = mysqli_fetch_row($result7) ) {

				if ( $row8[9] === $row7[0] ) { continue; }
				else {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";

				}
			}

			mysqli_data_seek($result7, 0);

		echo "</select></td>
		</tr>";

				
	}



	for ($i=mysqli_num_rows($result8); $i < 16; $i++) {
	
		echo "<tr>
			<td><input class=\"form_inputs\" type=\"date\" name=\"rcardev_tab_data[]\" /></td>
			<td><select class=\"form_inputs\" name=\"rcardev_tab_personal_id0[]\" >
				<option></option>" . $optionList . "</select></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_trasa[]\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_cel[]\" /></td>
			<td><select class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_personal_id1[]\" ><option></option>" . $optionList . "</select></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_ostanl[]\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_pstanl[]\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcardev_tab_dev[]\" /></td>
			<td><select class=\"form_inputs\" name=\"rcardev_tab_personal_id2[]\">
				<option></option>" . $optionList . "</select></td>
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
			<td><select class=\"form_inputs\" name=\"rcardev_common2_personal_id0\">";

			while ( $row7 = mysqli_fetch_row($result7) ) {
			
				if ( $row9[1] === $row7[0] ) {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
				}
			}

			mysqli_data_seek($result7, 0);

			while ( $row7 = mysqli_fetch_row($result7) ) {

				if ( $row9[1] === $row7[0] ) { continue; }
				else {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";

				}
			}

			mysqli_data_seek($result7, 0);

 echo "</select></td>
			<td><select class=\"form_inputs\" name=\"rcardev_common2_personal_id1\">";
		while ( $row7 = mysqli_fetch_row($result7) ) {
			
				if ( $row9[2] === $row7[0] ) {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
				}
			}

			mysqli_data_seek($result7, 0);

			while ( $row7 = mysqli_fetch_row($result7) ) {

				if ( $row9[2] === $row7[0] ) { continue; }
				else {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";

				}
			}

			mysqli_data_seek($result7, 0);

			$row9_4tab=explode(' ', $row9[4]);


			echo "</select></td>
			<td><input class=\"form_inputs\" name=\"rcardev_common2_msc\" type=\"text\" value=\"" . $row9[3] . "\" /></td>
			<td><input class=\"form_inputs\" name=\"rcardev_common2_data\" type=\"date\" value=\"" . $row9_4tab[0] . "\" /></td>
			<td><select class=\"form_inputs\" name=\"rcardev_common2_personal_id2\">";

			while ( $row7 = mysqli_fetch_row($result7) ) {
			
				if ( $row9[5] === $row7[0] ) {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
				}
			}

			mysqli_data_seek($result7, 0);

			while ( $row7 = mysqli_fetch_row($result7) ) {

				if ( $row9[5] === $row7[0] ) { continue; }
				else {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";

				}
			}

				echo "</select></td>
			</tr>
		</table>";

		
		
		
	
			echo "<div><input class=\"form_button\" type=\"submit\" value=\"Zapisz\">
				<a href=\"index.php?page=docs&form=road_card_dev\"><button id=\"genCard\">Generuj kartę</button></a></div>
        </form>";





 ?>
