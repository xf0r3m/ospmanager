<?php

$row0=mysqli_fetch_row($result0);

echo "<style>
	form { width: inherit; }
	#contentmenu { display: none; }
	.form_inputs, .form_button, #genCard { font-size: 9px; }
	</style>";

echo "<h3>Okresowa karta pracy sprzętu silnikowego</h3>";
echo "<form action=\"index.php?page=docs_eqec&action=load\" method=\"post\">
	<input class=\"form_inputs\" type=\"hidden\" name=\"eqec_common_eqec_id\" value=\"" . $row0[0] . "\" />
      <table>
        <tr><td>Seria: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common_serial\" value=\"" . $row0[1] . "\"/></td><tr>
        <tr><td>Okres karty pracy: </td>
     <td><input class=\"form_inputs\" type=\"date\" name=\"eqec_common_starts\" value=\"" . $row0[2] . "\"/><br /><span style=\"text-align: center;\">-</span><br />
                <input class=\"form_inputs\" type=\"date\" name=\"eqec_common_ends\" value=\"" . $row0[3] . "\" /></td></tr>
        <tr><td>Marka: </td><td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common_marka\" value=\"" . $row0[4] . "\" /></td></tr>
        <tr><td>Typ: </td><td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common_typ\" value=\"" . $row0[5] . "\"/></td></tr>
        <tr><td>Rodzaj: </td><td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common_rodzaj\" value=\"" . $row0[6] . "\" /></td></tr>
        <tr><td>Nr ewidencyjny: </td><td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common_nrewi\" value=\"" . $row0[7] . "\" /></td></tr>
        <tr><td>Norma eksploatacyjna na 1 godzinę pracy: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common_norma\" value=\"" . $row0[8] . "\" /> litów</td></tr>
      </table><br />
      <table>
      	<tr><th>Data</th><th>Nazwisko<br />obsługującego</th><th>Minut pracy</th>
      	<th>Cel użycia</th><th style=\"width: 133px\">Podpis<br />dysponenta</th></tr>
      ";

$limit=16;
$tName='str_do';
$csh='id,imie,nazwisko';
$whereValue='true';
$result = prepareForm($connection, $tName, $csh, $whereValue);
//var_dump($result1);

	while($row1=mysqli_fetch_row($result1)) {

		//var_dump($row1);

		$data=explode(' ', $row1[1]);
		
		echo "<tr><td><input class=\"form_inputs\" type=\"date\" name=\"eqec_usage_data[]\" value=\"" . $data[0] . "\" /></td>
		<td><select class=\"form_inputs\" name=\"eqec_usage_nazwisko[]\" />";
		
		while ( $row=mysqli_fetch_row($result) ) {

			if ( $row[0] === $row1[2] ) { 
				echo "<option value=\"" . $row1[2] . "\">" . $row[1] . " " . $row[2] . "</option>";
			}
		}
		mysqli_data_seek($result, 0);
		while ( $row=mysqli_fetch_row($result) ) {

			if ( $row[0] === $row1[2] ) { continue; }
			else {
				echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";
			}
		}
		mysqli_data_seek($result, 0);
			
		echo "</select></td>
		<td><input type=\"text\" class=\"form_inputs\" name=\"eqec_usage_minuty[]\" value=\"" . $row1[3] . "\" /></td>
<td><input type=\"text\" class=\"form_inputs\" name=\"eqec_usage_uzycie[]\" value=\"" . $row1[4] . "\" /></td>
<td><select class=\"form_inputs\" name=\"eqec_usage_personal_id[]\">";
		
		while ( $row = mysqli_fetch_row($result) ) {

			if ( $row[0] == $row1[5] ) {

				echo "<option value=\"" . $row1[5] . "\">" . $row[1] . " " . $row[2] . "</option>"; 
			}
		}
		mysqli_data_seek($result, 0);
		while ( $row = mysqli_fetch_row($result) ) {

			if ( $row[0] == $row1[5] ) { continue; }
			else {
				echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";
			}

		}
		mysqli_data_seek($result, 0);

		echo "</select></td></tr>";	
	}	
	

      for ($i=1; $i <= ( $limit - mysqli_num_rows($result1) ); $i++) {
        echo "<tr><td><input class=\"form_inputs\" type=\"date\" name=\"eqec_usage_data[]\" /></td>";
	echo "<td><select class=\"form_inputs\" name=\"eqec_usage_nazwisko[]\" >
		<option></option>";

	if ( mysqli_num_rows($result) > 0 ) {

		while ($row = mysqli_fetch_row($result) ) {

			echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";

		}
		mysqli_data_seek($result, 0);
	}

	echo "</select></td>";

                 echo " <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_usage_minuty[]\" /></td>
                  <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_usage_uzycie[]\" /></td>";
	echo "<td>";
		echo "<select class=\"form_inputs\" name=\"eqec_usage_personal_id[]\">
			<option></option>";
		if ( mysqli_num_rows($result) > 0 ) {
		
			while ( $row = mysqli_fetch_row($result) ) {
				echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";
			}
			mysqli_data_seek($result, 0);
		}

	echo "</select></td></tr>";
      }

      echo "<tr><td colspan=\"2\">Razem minut pracy</td>
                <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_usage_rmin\" /></td></tr>
      </table><br />
      <h4>Rozliczenie materiałów pędnych</h4><br />
      <table>
      <tr><th colspan=\"4\">POBRANO W LITRACH</th></tr>
      <tr><th>Data</th><th>Nr faktury</th><th>Paliwo</th><th style=\"width: 131px;\">Podpis</th></tr>";

$limit=5;
	while ($row3 = mysqli_fetch_row($result3) ) {

		$data=explode(' ', $row3[1]);

		echo "<tr><td><input class=\"form_inputs\" type=\"date\" name=\"eqec_fuel_data[]\" value=\"" . $data[0] . "\" /></td>
<td><input class=\"form_inputs\" type=\"text\" name=\"eqec_fuel_faktura[]\" value=\"" . $row3[2] . "\" /></td>
<td><input class=\"form_inputs\" type=\"text\" name=\"eqec_fuel_paliwo[]\" value=\"" . $row3[3] . "\" /></td>
<td><select class=\"form_inputs\" name=\"eqec_fuel_personal_id[]\" />";

	if ( mysqli_num_rows($result) > 0 ) {

		while ( $row = mysqli_fetch_row($result) ) {

			if ( $row[0] === $row3[4] ) {
				echo "<option value=\"" . $row3[4] . "\">" . $row[1] . " " . $row[2] . "</option>";
			}
		}
		mysqli_data_seek($result, 0);
		while ( $row = mysqli_fetch_row($result) ) {
			if ( $row[0] === $row3[4] ) { continue; }
			else {
				echo "<option value=\"$row[0]\">" . $row[1] . " " . $row[2] . "</option>";
			}
	
		}
		mysqli_data_seek($result, 0);
	}

	echo "</select></td></tr>";

	}

      for ($i=1; $i <= ( $limit - mysqli_num_rows($result3) ); $i++) {
        echo "<tr><td><input class=\"form_inputs\" type=\"date\" name=\"eqec_fuel_data[]\" /></td>
                  <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_fuel_faktura[]\" /></td>
                  <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_fuel_paliwo[]\" /></td>
		  <td>
			<select class=\"form_inputs\" name=\"eqec_fuel_personal_id[]\">
				<option></option>";
			if ( mysqli_num_rows($result) > 0 ) {
			
				while ( $row = mysqli_fetch_row($result)) {

					echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";
				}

				mysqli_data_seek($result, 0);
	
			}
echo "</select></td>
</tr>";
      }
$row4 = mysqli_fetch_row($result4);

      echo "<tr><td colspan=\"2\">Razem</td><td><input class=\"form_inputs\" type=\"text\" name=\"eqec_fuel_rlitr\"</td></tr>
      </table>
      <table>
      <tr><th colspan=\"2\"></th><th colspan=\"3\">Litrów paliwa: </th></tr>
      <tr><td>1.</td><td>Pozostało z ubiegłego okresu: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_pozostalo0\" value=\"" . $row4[1] . "\" /></td></tr>
      <tr><td>2.</td><td>Pobrano w okresie bierzącym: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_pobrano\" value=\"" . $row4[2] . "\" /></td></tr>
      <tr><td>3.</td><td>Razem: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_razem0\" value=\"" . $row4[3] . "\" /></td></tr>
      <tr><td>4.</td><td>Przepracowano minut: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_minut\" value=\"" . $row4[4] . "\" /></td>
          <td>5.</td><td>zużyto:</td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_uzycie0\" value=\"" . $row4[5] . "\" /></td></tr>
      <tr><td>6.</td><td>Wykonano rozruchów: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_rozruch\" value=\"" . $row4[6] . "\" /></td>
          <td>7.</td><td>zużyto:</td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_uzycie1\" value=\"" . $row4[7] . "\" /></td></tr>
      <tr><td>8.</td><td>Zużyto w ciągu okresu razem: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_razem1\" value=\"" . $row4[8]  . "\" /></td></tr>
      <tr><td>9.</td><td>Pozostało na okres następny: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_pozostalo1\" value=\"" . $row4[9] . "\" /></td></tr>
      </table>";

      echo "<table>
            <tr>
            <th>Obliczył: </th><td>
	<select class=\"form_inputs\" name=\"eqec_common2_personal_id0\" >";

		if ( mysqli_num_rows($result) > 0 ) {

			$row4[10] = intval($row4[10]);

			while ( $row = mysqli_fetch_row($result) ) {

				if ( $row[0] == $row4[10] ) {
				
				echo "<option value=\"" . $row4[10] . "\">" . $row[1] . " " . $row[2] . "</option>";		
				}


			}
			mysqli_data_seek($result, 0);

			while ( $row = mysqli_fetch_row($result) ) {

				if ( $row[0] == $row4[10] ) { continue; }
				else { 
					echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";
				}
			}
			mysqli_data_seek($result, 0);
		}
	
	echo "</select></td>

            <th>Sprawdził: </th>
		<td><select class=\"form_inputs\" name=\"eqec_common2_personal_id1\">";

		if ( mysqli_num_rows($result) > 0 ) {
			while ( $row = mysqli_fetch_row($result) ) {

				if ( $row4[11] == $row[0] ) {
	
					echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";

				}
			}
			mysqli_data_seek($result, 0);
			
			while ( $row = mysqli_fetch_row($result) ) {

				if ( $row4[11] == $row[0] ) { continue; }
				else {
					echo "<option  value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";
				}
			
			}


		}

	echo "</select></td>
            </tr>
            </table>";
    echo "<div><button class=\"form_button\">Zapisz</button>
		<a href=\"index.php?page=docs&form=eqEngine_card\"><button id=\"genCard\">Generuj kartę</button></a></div>
          </form>";




 ?>
