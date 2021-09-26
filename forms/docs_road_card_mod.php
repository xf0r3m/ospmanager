<?php

$row0 = mysqli_fetch_row($result0);
$row1 = mysqli_fetch_row($result1);
$row2 = mysqli_fetch_row($result2);
$row4 = mysqli_fetch_row($result4);
$row6 = mysqli_fetch_row($result6);

echo "<style>
	form { width: inherit; }
	#contentmenu { display: none; }
	.form_inputs, .form_button, #genCard { font-size: 9px; }
	</style>";

echo "<form action=\"index.php?page=docs_rcard&action=load\" method=\"post\">
	<input class=\"form_inputs\" type=\"hidden\" name=\"rcard_common_id\" value=\"" . $load_id . "\" />
        <table>
        <tr><td>Numer ewidencyjny karty pracy: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcard_common_seria\" value=\"" . $row0[1] . "\" /></td></tr>
        <tr><td>Karta na miesiąc: </td>
            <td>
            <select class=\"form_inputs\" name=\"rcard_common_miesiac\">
	    <option value=\"" . $row0[2] . "\">";

	$list0 = ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", 
		"Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Listopad", "Grudzień"];
	generateSelectOptionList($row0[2], $list0);
	

		

       echo " </select>
            </td></tr>
        <tr><td>Marka pojazdu: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcard_vehicle_marka\" value=\"" . $row1[1] . "\" /></td></tr>
        <tr><td>Typ pojazdu: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcard_vehicle_typ\" value=\"" . $row1[2] . "\" /></td></tr>
        <tr><td>Rodzaj pojazdu: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcard_vehicle_rodzaj\" value=\"" . $row1[3] . "\" /></td></tr>
        <tr><td>Nr rejestracyjny:</td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcard_vehicle_rej\" value=\"" . $row1[4] . "\" /></td></tr>
        <tr><td>Nr operacyjny: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcard_vehicle_nrop\" value=\"" . $row1[5] . "\" /></td></tr>
        <tr><td>Pojemność zbiornika: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcard_vehicle_zbior\" value=\"" . $row1[6] . "\" /></td></tr>
        <tr><td>Norma zużycia paliwa: </td>
            <td><input id=\"n1\" onchange=\"paliwo();\" type=\"text\" class=\"form_inputs\" name=\"rcard_vehicle_norma\" value=\"" . $row1[7] . "\" />/100 km</td></tr>
        <tr><td>Praca silnika na postoju: </td>
            <td><input type=\"text\" class=\"form_inputs\" name=\"rcard_vehicle_normap\" value=\"" . $row1[8] . "\"/> Litra/min.</td></tr>
        </table>
        <h3>Rozliczenie zużycia paliwa</h3>
        <table>
        <tr><td>Stan licznika na koniec bierzącego okresu rozliczeniowego: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcard_usage_stkoniecbr\" value=\"" . $row2[1] . "\" /></td></tr>
        <tr><td>Stan licznika na koniec poprzedniego okresu rozliczeniowego: </td>
	    <td><input class=\"form_inputs\" type=\"text\" name=\"rcard_usage_stkoniecpo\" value=\"" . $row2[2] . "\" /></td></tr>
        <tr><td>Przebieg pojazdu w bierzącym okresie rozliczeniowym: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"rcard_usage_przebiegbr\" value=\"" . $row2[3] . "\" /></td></tr>
        <tr><td>Przebieg km: <input class=\"form_inputs\" type=\"text\" name=\"rcard_usage_przebieg\" size=\"5\" value=\"" . $row2[4] . "\" />
            x norma <input id=\"n2\" class=\"form_inputs\" type=\"text\" size=\"5\" /> dm<sup>3</sup>/100 km =
            <input id=\"wynik\" class=\"form_inputs\" type=\"text\" name=\"rcard_przebieg_wynik\" size=\"5\" /> dm<sup>3</sup></td>
            <td>Przyjęto do rozliczenia: <input class=\"form_inputs\" type=\"text\" name=\"rcard_usage_pdroz\" size=\"5\"  value=\"" . $row2[5] . "\" /></td></tr>
        <tr><td>Praca silnika na postoju: <input class=\"form_inputs\" type=\"text\" name=\"rcard_usage_postoj\" size=\"5\" value=\"" . $row2[6] . "\" />
            minut x norma <input id=\"n3\" class=\"form_inputs\" type=\"text\" size=\"5\" /> dm<sup>3</sup>/min. =
            <input id=\"wynik\" class=\"form_inputs\" type=\"text\" name=\"rcard_minuty_wynik\" size=\"5\" /> dm<sup>3</sup></td></tr>
        <tr><td>Rozruch kontrolny <input type=\"text\" class=\"form_inputs\" name=\"rcard_usage_rk\" value=\"" . $row2[7] . "\" /> litra / RK</tr>
        <tr><td>Razem zużyto: <input class=\"form_inputs\" id=\"razem\" type=\"text\" name=\"rcard_usage_razem\" value=\"" . $row2[8] . "\" /> dm<sup>3</sup></td></tr>
	</table>";
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


	while ( $row3 = mysqli_fetch_row($result3) ) {

		$row3_1tab = explode(' ', $row3[1]);

		echo "<tr>
			<td><input class=\"form_inputs\" type=\"date\" name=\"rcard_fuel1_data[]\" value=\"" . $row3_1tab[0] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel1_faktura[]\" value=\"" . $row3[2] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel1_paliwo[]\" value=\"" . $row3[3] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel1_olej[]\" value=\"" . $row3[4] . "\" /></td>
			<td><select class=\"form_inputs\" name=\"rcard_fuel1_personal_id0[]\">";

		while ( $row7 = mysqli_fetch_row($result7) ) {

			if ( $row3[5] === $row7[0] ) { echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
			}

		}

		mysqli_data_seek($result7, 0);

		while ( $row7 = mysqli_fetch_row($result7) ) {
		
			if ( $row3[5] === $row7[0] ) {continue;}
			else {
				echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
			}
		}

		mysqli_data_seek($result7, 0);

		echo "</select></td>
			<td><select class=\"form_inputs\" name=\"rcard_fuel1_personal_id1[]\">";

		while ( $row7 = mysqli_fetch_row($result7) ) {

			if ( $row3[6] === $row7[0] ) {
				echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
			}
		}

		mysqli_data_seek($result7, 0);

		while ( $row7 = mysqli_fetch_row($result7) ) {


			if ( $row3[6] === $row7[0] ) {continue;}
			else {
				echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
			}


		}

		mysqli_data_seek($result7, 0);

		echo "</select></td>
		</tr>";

	}

	for($i=mysqli_num_rows($result3); $i<4; $i++) {
		
			echo "<tr>
			<td><input class=\"form_inputs\" type=\"date\" name=\"rcard_fuel1_data[]\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel1_faktura[]\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel1_paliwo[]\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel1_olej[]\" /></td>
			<td><select class=\"form_inputs\" name=\"rcard_fuel1_personal_id0[]\">
				<option></option>" . $optionList . "</select></td>
			<td><select class=\"form_inputs\" name=\"rcard_fuel1_personal_id1[]\">
				<option></option>" . $optionList . "</select></td>
			</tr>";

	}
			

	echo "<tr><th colspan=\"2\">Ogółem: </th><td><input class=\"form_inputs\"
	      	type=\"text\" name=\"razem_paliwo\" /></td><td><input class=\"form_inputs\" type=\"text\" name=\"razem_olej\" /></td><td colspan=\"2\"></td></tr>

	</table>
	<br />
	<table>
		<tr><th colspan=\"5\">litrów</th><th>paliwa</th><th>oleju</th></tr>
		<tr><td>1. </td><td colspan=\"4\">Pozostało z ubiegłego miesiąca: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_pozostalo_paliwo0\" value=\"" . $row4[1] . "\" />
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_pozostalo_olej0\" value=\"" . $row4[2] . "\" /></td>
		</tr>
		<tr><td>2. </td><td colspan=\"4\">Pobrano w ciągu miesiąca: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_pobrano_paliwo\" value=\"" . $row4[3] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_pobrano_olej\" value=\"" . $row4[4] . "\" /></td>
		</tr>
		<tr><td>3. </td><td colspan=\"4\">Razem: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_razem_paliwo0\"value=\"" . $row4[5] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_razem_olej0\" value=\"" . $row4[6] . "\" /></td>
		</tr>
		<tr><td>4. </td><td>Przebyto km: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_km\" value=\"" . $row4[7] . "\" /></td>
			<td>5. </td>
			<td>zużyto: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_kmz_paliwo\" value=\"" . $row4[8] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_kmz_olej\" value=\"" . $row4[9] . "\" /></td>
		</tr>
		<tr><td>6. </td><td>Przepracowano minut: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_minut\" value=\"" . $row4[10] . "\" /></td>
			<td>7. </td>
			<td>zużyto: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_m_paliwo\" value=\"" . $row4[11] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_m_olej\" value=\"" . $row4[12] . "\" /></td>
		</tr>
		<tr><td>8. </td><td>Wykonano rozruchów</td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_rk\" value=\"" . $row4[13] . "\" /></td>
			<td>9. </td>
			<td>zużyto: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_rk_paliwo\" value=\"" . $row4[14] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_rk_olej\" value=\"" . $row4[15] . "\" /></td>
		</tr>
		<tr><td>10. </td><td colspan=\"4\">Zużyto w ciągu miesiąca razem: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_razem_paliwo1\" value=\"" . $row4[16] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_razem_olej1\" value=\"" . $row4[17] . "\" /></td>
		</tr>
		<tr><td>11. </td><td colspan=\"4\">Pozostało na następny miesiąc: </td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_pozostalo_paliwo1\" value=\"" . $row4[18] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_fuel2_pozostalo_olej1\" value=\"" . $row4[19] . "\" /></td>
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

	while ( $row5 = mysqli_fetch_row($result5) ) {


		$row5_1tab = explode(' ', $row5[1]);

		echo "<tr>
			<td><input class=\"form_inputs\" type=\"date\" name=\"rcard_tab_data[]\" value=\"" . $row5_1tab[0] . "\" /></td>
			<td><select class=\"form_inputs\" name=\"rcard_tab_personal_id0[]\" />
				";
			while ( $row7 = mysqli_fetch_row($result7) ) {
			
				if ( $row5[2] === $row7[0] ) {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
				}
			}

			mysqli_data_seek($result7, 0);

			while ( $row7 = mysqli_fetch_row($result7) ) {

				if ( $row5[2] === $row7[0] ) { continue; }
				else {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";

				}
			}

			mysqli_data_seek($result7, 0);

		echo "</select></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_tab_trasa[]\" value=\"" . $row5[3] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_tab_cel[]\" value=\"" . $row5[4] . "\" /></td>
			<td><select class=\"form_inputs\" type=\"text\" name=\"rcard_tab_personal_id1[]\" >";

			while ( $row7 = mysqli_fetch_row($result7) ) {
			
				if ( $row5[5] === $row7[0] ) {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
				}
			}

			mysqli_data_seek($result7, 0);

			while ( $row7 = mysqli_fetch_row($result7) ) {

				if ( $row5[5] === $row7[0] ) { continue; }
				else {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";

				}
			}

			mysqli_data_seek($result7, 0);


		echo "</select></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_tab_ostanl[]\" value=\"" . $row5[6] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_tab_pstanl[]\" value=\"" . $row5[7] . "\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_tab_dev[]\" value=\"" . $row5[8] . "\" /></td>
			<td><select class=\"form_inputs\" type=\"text\" name=\"rcard_tab_personal_id2[]\">";
			while ( $row7 = mysqli_fetch_row($result7) ) {
			
				if ( $row5[9] === $row7[0] ) {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
				}
			}

			mysqli_data_seek($result7, 0);

			while ( $row7 = mysqli_fetch_row($result7) ) {

				if ( $row5[9] === $row7[0] ) { continue; }
				else {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";

				}
			}

			mysqli_data_seek($result7, 0);

		echo "</select></td>
		</tr>";

				
	}



	for ($i=mysqli_num_rows($result5); $i < 16; $i++) {
	
		echo "<tr>
			<td><input class=\"form_inputs\" type=\"date\" name=\"rcard_tab_data[]\" /></td>
			<td><select class=\"form_inputs\" name=\"rcard_tab_personal_id0[]\" >
				<option></option>" . $optionList . "</select></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_tab_trasa[]\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_tab_cel[]\" /></td>
			<td><select class=\"form_inputs\" type=\"text\" name=\"rcard_tab_personal_id1[]\" ><option></option>" . $optionList . "</select></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_tab_ostanl[]\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_tab_pstanl[]\" /></td>
			<td><input class=\"form_inputs\" type=\"text\" name=\"rcard_tab_dev[]\" /></td>
			<td><select class=\"form_inputs\" name=\"rcard_tab_personal_id2[]\">
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
			<td><select class=\"form_inputs\" name=\"rcard_common2_personal_id0\">";

			while ( $row7 = mysqli_fetch_row($result7) ) {
			
				if ( $row6[1] === $row7[0] ) {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
				}
			}

			mysqli_data_seek($result7, 0);

			while ( $row7 = mysqli_fetch_row($result7) ) {

				if ( $row6[1] === $row7[0] ) { continue; }
				else {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";

				}
			}

			mysqli_data_seek($result7, 0);

 echo "</select></td>
			<td><select class=\"form_inputs\" name=\"rcard_common2_personal_id1\">";
		while ( $row7 = mysqli_fetch_row($result7) ) {
			
				if ( $row6[2] === $row7[0] ) {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
				}
			}

			mysqli_data_seek($result7, 0);

			while ( $row7 = mysqli_fetch_row($result7) ) {

				if ( $row6[2] === $row7[0] ) { continue; }
				else {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";

				}
			}

			mysqli_data_seek($result7, 0);

			$row6_4tab=explode(' ', $row6[4]);


			echo "</select></td>
			<td><input class=\"form_inputs\" name=\"rcard_common2_msc\" type=\"text\" value=\"" . $row6[3] . "\" /></td>
			<td><input class=\"form_inputs\" name=\"rcard_common2_data\" type=\"date\" value=\"" . $row6_4tab[0] . "\" /></td>
			<td><select class=\"form_inputs\" name=\"rcard_common2_personal_id2\">";

			while ( $row7 = mysqli_fetch_row($result7) ) {
			
				if ( $row6[5] === $row7[0] ) {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";
				}
			}

			mysqli_data_seek($result7, 0);

			while ( $row7 = mysqli_fetch_row($result7) ) {

				if ( $row6[5] === $row7[0] ) { continue; }
				else {
					echo "<option value=\"" . $row7[0] . "\">" . $row7[1] . " " . $row7[2] . "</option>";

				}
			}

				echo "</select></td>
			</tr>
		</table>";

		
		
		
	
			echo "<div><input class=\"form_button\" type=\"submit\" value=\"Zapisz\">
				<a href=\"index.php?page=docs&form=road_card\"><button id=\"genCard\">Generuj kartę</button></a></div>
        </form>";





 ?>
