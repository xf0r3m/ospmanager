<?php

$keys = array("rcardev_common_seria", "rcardev_common_miesiac", "rcardev_vehicle_marka", "rcardev_vehicle_typ", "rcardev_vehicle_rodzaj",
							"rcardev_vehicle_rej", "rcardev_vehicle_nrop", "rcardev_vehicle_zbior", "rcardev_vehicle_norma", "rcardev_vehicle_normap",
						 "rcardev_usage_stkoniecbr", "rcardev_usage_stkoniecpo", "rcardev_usage_przebiegbr", "rcardev_usage_przebieg",
					 		"przebieg_wynik", "rcardev_usage_postoj", "rcardev_usage_pdroz", "minuty_wynik",
						 	"rcardev_pompa_minut", "rcardev_pompa_norma", "autopompa_wynik",
							"rcardev_web_minut", "rcardev_web_norma", "webasto_wynik", "rcardev_usage_rk", "rcardev_usage_razem");

for ( $i=0; $i < count($keys); $i++ ) {

	if ( strlen($_POST[$keys[$i]]) <= 0 ) { $_POST[$keys[$i]] = "............"; }

}

echo "<a href=\"javascript:print()\"><button id=\"p_button\"><img id=\"p_image\" src=\"resources/printer.png\"></button></a><br /><br />";

echo "<div id=\"first_side\" style=\"width: 291mm; height: 195mm; padding: 5mm; font-size: 12px; background-color: white;\">
      <div id=\"left_side\" style=\"width: 50%; float: left; height: 70%;\">
      <h3>Rozliczenie materiałów pędnych</h3>
      <table border=\"1\" style=\"border-collapse: collapse; width: 100%;\">
      <tr><th colspan=\"4\">Pobrano (w litrach)</th><th rowspan=\"2\">Podpis kierowcy</th><th rowspan=\"2\">Podpis osoby<br />odpowiedzialnej</th></tr>
      <tr><th>data</th><th>nr faktury</th><th>ilosc paliw</th><th>ilosc oleju</th></tr>";

		$tName = 'str_do';
		$csh = 'imie,nazwisko';

	  for ( $i=0; $i < 4; $i++ ) {

		  if ( strlen($_POST['rcardev_fuel1_data'][$i]) > 0 ) {

		  echo "<tr>
                  <td style=\"height: 18px;\">" . $_POST['rcardev_fuel1_data'][$i] . "</td>
                  <td style=\"height: 18px;\">" . $_POST['rcardev_fuel1_faktura'][$i] . "</td>
                  <td style=\"height: 18px;\">" . $_POST['rcardev_fuel1_paliwo'][$i] . "</td>
                  <td style=\"height: 18px;\">" . $_POST['rcardev_fuel1_olej'][$i] . "</td>
		  <td style=\"height: 18px;\"><span class=\"hide\">"; 
	
		 	 $whereValue = 'id=' . $_POST['rcardev_fuel1_personal_id0'][$i];
			$result = prepareForm($connection, $tName, $csh, $whereValue);
		  	$row = mysqli_fetch_row($result);
			echo $row[0] . " " . $row[1];
		
			echo "</span></td><td style=\"height: 18px;\"><span class=\"hide\">"; 

			$whereValue = 'id=' . $_POST['rcardev_fuel1_personal_id1'][$i];
			$result = prepareForm($connection, $tName, $csh, $whereValue);
			$row = mysqli_fetch_row($result);

			echo $row[0] . " " . $row[1];

			echo "</span></td></tr>";



		  } else {

		echo "<tr>
                  <td style=\"height: 18px;\"></td>
                  <td style=\"height: 18px;\"></td>
                  <td style=\"height: 18px;\"></td>
                  <td style=\"height: 18px;\"></td>
                  <td style=\"height: 18px;\"></td><td style=\"height: 18px;\"></td></tr>";
  
		  
		  }


          }

echo "<tr><td colspan=\"2\"><strong>ogółem<strong></td><td><strong>" . $_POST['razem_paliwo'] . "</strong></td><td><strong>" . $_POST['razem_olej'] . "</strong></td></tr>
      </table>
      <p>&nbsp;</p>
      <table border=\"1\" style=\"border-collapse: collapse; width: 100%; \">
      <tr><th colspan=\"5\">litrów</th><th>paliwa</th><th>oleju</th></tr>
      <tr>
          <td>1.</td>
          <td colspan=\"4\">Pozostało z ubiegłego miesiąca: </td>
          <td>" . $_POST['rcardev_fuel2_pozostalo_paliwo0'] . "</td>
	  <td>" . $_POST['rcardev_fuel2_pozostalo_olej0'] . "</td>
      </tr>
      <tr>
          <td>2.</td>
          <td colspan=\"4\">Pobrano w ciągu miesiąca: </td>
	  <td>" . $_POST['rcardev_fuel2_pobrano_paliwo'] . "</td>
          <td>" . $_POST['rcardev_fuel2_pobrano_olej'] . "</td>
      </tr>
      <tr>
          <td>3.</td>
          <td colspan=\"4\">Razem: </td>
          <td>" . $_POST['rcardev_fuel2_razem_paliwo0'] . "</td>
          <td>" . $_POST['rcardev_fuel2_razem_olej0'] . "</td>
      </tr>
      <tr>
          <td>4.</td>
          <td>Przebyto km: </td>
          <td style=\"width: 80px;\">" . $_POST['rcardev_fuel2_km'] . "</td>
          <td>5.</td>
          <td>zużyto: </td>
          <td>" . $_POST['rcardev_fuel2_kmz_paliwo'] . "</td>
          <td>" . $_POST['rcardev_fuel2_kmz_olej'] . "</td>
      </tr>
      <tr>
          <td>6.</td>
          <td>Przepracowano minut: </td>
          <td style=\"width: 80px;\">" . $_POST['rcardev_fuel2_minut'] . "</td>
          <td>7.</td>
          <td>zużyto: </td>
          <td>" . $_POST['rcardev_fuel2_m_paliwo'] . "</td>
          <td>" . $_POST['rcardev_fuel2_m_olej'] . "</td>
      </tr>
      <tr>
          <td>8.</td>
          <td>Wykonano rozruchów:</td>
          <td style=\"width: 80px;\">" . $_POST['rcardev_fuel2_rk'] . "</td>
          <td>9.</td>
          <td>zużyto: </td>
          <td>" . $_POST['rcardev_fuel2_rk_paliwo'] . "</td>
          <td>" . $_POST['rcardev_fuel2_rk_olej'] . "</td>
      </tr>
      <tr>
          <td>10.</td>
          <td colspan=\"4\">Zużyto w ciągu miesiąca razem: </td>
          <td>" . $_POST['rcardev_fuel2_razem_paliwo1'] . "</td>
          <td>" . $_POST['rcardev_fuel2_razem_olej1'] . "</td>
      </tr>
      <tr>
          <td>11.</td>
          <td colspan=\"4\">Pozostało na następny miesiąc: </td>
          <td>" . $_POST['rcardev_fuel2_pozostalo_paliwo1'] . "</td>
          <td>" . $_POST['rcardev_fuel2_pozostalo_olej1'] . "</td>
      </tr>
      </table>
      </div>
      <div id=\"right-side\" style=\"width: 49%; float: left; height: 70%; margin-left: 1%;\">
      <p>
        <span style=\"float: left; margin-left: 20%;\" >mp.</span>
        <p style=\"border: 1px solid black; margin-left: 50%; width: 50%;\">NUMER EWIDENC. KARTY PRACY<br />
                  Seria " . $_POST['rcardev_common_seria'] ."</p>
      </p>
      <p style=\"text-align: center;\">
        <span style=\"font-weight: bold; font-size: 22px;\">MIESIĘCZNA KARTA POJAZDU</span><br />
        <span style=\"font-weight: bold; font-size: 12px;\">POŻARNICZEGO POJAZDU SAMOCHODOWEGO</span><br />
          <br />";
          $currentYear = date("Y");
          echo "Na miesiąc: " . $_POST['rcardev_common_miesiac'] . " " . $currentYear . "r.<br />
      </p>
      <p style=\"width: 80%; margin: auto;\">
      <table>
        <tr><td>Marka: " . $_POST['rcardev_vehicle_marka'] . "</td><td>Typ: " . $_POST['rcardev_vehicle_typ'] . "</td></tr>
        <tr><td>Rodzaj: " . $_POST['rcardev_vehicle_rodzaj'] . "</td><td>Nr rej.: " . $_POST['rcardev_vehicle_rej'] . "</td></tr>
        <tr><td>Numer operacyjny: " . $_POST['rcardev_vehicle_nrop'] . "</td><td>Pojemność zbiornika: " . $_POST['rcardev_vehicle_zbior'] . " l</td></tr>
        <tr><td>Norma zużycia paliwa: " . $_POST['rcardev_vehicle_norma'] . " /100 km</td><td>Praca silnika na postoju: " . $_POST['rcardev_vehicle_normap'] . " litr/min.</td></tr>
      </table>
      </p>
      <p>
      <h3>Rozliczenie zużycia paliwa</h3>
      <table>
      <tr><td>Stan licznika na koniec bierzącego okresu rozliczeniowego: </td>
	  <td>" . $_POST['rcardev_usage_stkoniecbr'] . "</td></tr>
      <tr><td>Stan licznika na koniec poprzedniego okresu rozliczeniowego: </td>
	  <td>" . $_POST['rcardev_usage_stkoniecpo'] . "</td></tr>
      <tr><td>Przebieg pojazdu w bierzącym okresie rozliczeniowym: </td>
	  <td>" . $_POST['rcardev_usage_przebiegbr'] . "</td></tr>
      <tr><td>Przebieg km: " . $_POST['rcardev_usage_przebieg'] . " x norma " . $_POST['rcardev_vehicle_norma'] . " dm<sup>3</sup>/100 km = " . $_POST['rcardev_przebieg_wynik'] . " dm<sup>3</sup></td>
		<td>Przyjęto do rozliczenia: " . $_POST['rcardev_usage_pdroz'] . "</td></tr>
		<tr><td>Praca silnika na postoju: " . $_POST['rcardev_usage_postoj'] . " minut x norma " . $_POST['rcardev_vehicle_normap'] . " dm<sup>3</sup>/min. = " . $_POST['rcardev_minuty_wynik'] . " dm<sup>3</sup></td></tr>
      <tr><th>Urządzenia specjalne</th></tr>
			<tr><td>Autopompa czas pracy: " . $_POST['rcardev_pompa_minut'] . " minut x norma " . $_POST['rcardev_pompa_norma'] . " dm<sup>3</sup>/min. = " . $_POST['pompa_wynik'] . " dm<sup>3</sup></td></tr>
      <tr><td>Urządzenie grzewcze czas pracy: " . $_POST['rcardev_web_minut'] . " minut x norma " . $_POST['rcardev_web_norma'] . " dm<sup>3</sup>/min. = " . $_POST['web_wynik'] . " dm<sup>3</sup></td></tr>
      <tr><td>Rozruch kontrolny: " . $_POST['rcardev_usage_rk'] . " litra / RK</td></tr>
      <tr><td>Razem zużyto: " . $_POST['rcardev_usage_razem'] . " dm<sup>3</sup></td></tr>
      </table>
      </p>
      </div>
      <div id=\"footer\" style=\"width: 100%; float: left;\">
      <table cellspacing=\"40\" style=\"width: 100%;\">
      <tr><th>Obliczył: </th><th>Sprawdził: </th><th>Kartę wystawiono: </th><th>Wystawił: </th></tr>";
	$tName = 'str_do';
	$csh = 'imie,nazwisko';
	$whereValue = 'id=' . $_POST['rcardev_common2_personal_id0'];
	$result = prepareForm($connection, $tName, $csh, $whereValue);
	$row = mysqli_fetch_row($result);	
echo "<tr style=\"text-align: center;\"><td style=\"text-align: center;\"><span class=\"hide\">" . $row[0] . " " . $row[1] . "</span><br />.........................<br />
          <p style=\"text-align: center; font-size: 10px; margin: 0;\">(czytelny podpis)</p></td>
	  <td><span class=\"hide\">"; 

		$whereValue = 'id=' . $_POST['rcardev_common2_personal_id1'];
		$result = prepareForm($connection, $tName, $csh, $whereValue);
		$row = mysqli_fetch_row($result);

		echo $row[0] . " " . $row[1] . "</span><br />" .
			$_POST['rcardev_common2_data'] . "<br />.................................<br />
            <p style=\"text-align: center; font-size: 10px; margin: 0;\">(Nazwisko, imie, podpis, data)</p></td></td>
	  <td>" . $_POST['rcardev_common2_msc'] . ", dnia " . $_POST['rcardev_common2_data'] .  " 2019r.</td>";

		$whereValue = 'id=' . $_POST['rcardev_common2_personal_id2'];
		$result = prepareForm($connection, $tName, $csh, $whereValue);
		$row = mysqli_fetch_row($result);

         echo "<td><span class=\"hide\">" . $row[0] . " " . $row[1] . "</span><br />.........................</td></tr>
      </table>
      </div>
      </div>
      <div id=\"second_side\" style=\"width: 291mm; padding: 5mm; background-color: white;\">
      <table border=\"1\" style=\"border-collapse: collapse; margin-left: 5mm;\">
        <tr><th rowspan=\"2\" style=\"width: 18px;\">Data</th><th rowspan=\"2\">Nazwisko dysponenta<br /> (dowódcy)</th>
            <th rowspan=\"2\">Trasa jazdy skąd-dokąd</th><th rowspan=\"2\">Cel jazdy</th>
            <th rowspan=\"2\">Nazwisko</th><th>Odjazd</th><th>Przyjazd</th><th>Minut
            pracy<br /> urządzeń specjalnych</th><th>Podpis dysponenta</th></tr>
        <tr><th>Stan licznika</th><th>Stan Licznika</th>
            <td></td>
            <td></td></tr>";

            /*
            for ( $i=0; $i < count($_POST['card_table1_date']); $i++ ) {

                if ( strlen($_POST['card_table1_date'][$i]) > 0 ) {

                  echo "<tr><td>" . $_POST['card_table1_date'][$i] . "</td>
                            <td>" . $_POST['card_table1_dyspo'][$i] . "</td>
                            <td>" . $_POST['card_table1_trasa'][$i] . "</td>
                            <td>" . $_POST['card_table1_cel'][$i] . "</td>
                            <td>" . $_POST['card_table1_kierowca'][$i] . "</td>
                            <td>" . $_POST['card_table1_odj'][$i] . "</td>
                            <td>" . $_POST['card_table1_przyj'][$i] . "</td>
                            <td>" . $_POST['card_table1_min'][$i] . "</td>
                            <td></td></tr>";

                }
            */
	for ( $i=0; $i < 18; $i++ ) {

		if ( isset($_POST['rcardev_tab_data'][$i]) ) {

			if ( strlen($_POST['rcardev_tab_data'][$i]) > 0 ) {

				echo "<tr style=\"height: 30px;\">
				<td style=\"width: 100px;\">" . $_POST['rcardev_tab_data'][$i] . "</td>
				<td>"; 
					$whereValue = 'id=' . $_POST['rcardev_tab_personal_id0'][$i];
					$result = prepareForm($connection, $tName, $csh, $whereValue);
					$row = mysqli_fetch_row($result);

					echo $row[0] . " " . $row[1];

				echo "</td>
				<td style=\"width: 150px;\">" . $_POST['rcardev_tab_trasa'][$i] . "</td>
                        	<td style=\"width: 150px;\">" . $_POST['rcardev_tab_cel'][$i] . "</td>
				<td style=\"width: 100px;\">";

					$whereValue = 'id=' . $_POST['rcardev_tab_personal_id1'][$i];
					$result = prepareForm($connection, $tName, $csh, $whereValue);
					$row = mysqli_fetch_row($result);

					echo $row[0] . " " . $row[1];

	    			echo "</td>
                        	<td>" . $_POST['rcardev_tab_ostanl'][$i] . "</td>
                        	<td>" . $_POST['rcardev_tab_pstanl'][$i] . "</td>
                        	<td>" .	$_POST['rcardev_tab_dev'][$i] . "</td>
				<td><span class=\"hide\">";

					$whereValue = 'id=' . $_POST['rcardev_tab_personal_id2'][$i];
					$result = prepareForm($connection, $tName, $csh, $whereValue);
					$row = mysqli_fetch_row($result);

					echo $row[0] . " " . $row[1] . "</span></td></tr>";
			}

		} else {
		echo "<tr style=\"height: 30px;\">
			<td style=\"width: 100px;\"></td>
                        <td></td>
                        <td style=\"width: 150px;\"></td>
                        <td style=\"width: 150px;\"></td>
			<td style=\"width: 100px;\"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td></tr>";

		}
            }


      echo "
      </table>
      </div>";
 ?>
