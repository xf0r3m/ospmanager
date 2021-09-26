<?php

echo "<style>
	form { width: inherit; }
	#contentmenu { display:none }
	.form_inputs, .form_button, #genCard { font-size: 9px; }
	</style>";

echo "<h3>Okresowa karta pracy sprzętu silnikowego</h3>";
echo "<form action=\"index.php?page=docs_eqec\" method=\"post\">
      <table>
        <tr><td>Seria: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common_serial\" /></td><tr>
        <tr><td>Okres karty pracy: </td>
     <td><input class=\"form_inputs\" type=\"date\" name=\"eqec_common_starts\" /><br /><span style=\"text-align: center;\">-</span><br />
                <input class=\"form_inputs\" type=\"date\" name=\"eqec_common_ends\" /></td></tr>
        <tr><td>Marka: </td><td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common_marka\" /></td></tr>
        <tr><td>Typ: </td><td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common_typ\" /></td></tr>
        <tr><td>Rodzaj: </td><td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common_rodzaj\" /></td></tr>
        <tr><td>Nr ewidencyjny: </td><td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common_nrewi\" /></td></tr>
        <tr><td>Norma eksploatacyjna na 1 godzinę pracy: </td>
            <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common_norma\" /> litów</td></tr>
      </table><br />
      <table>
      	<tr><th>Data</th><th>Nazwisko<br />obsługującego</th><th>Minut pracy</th>
      	<th>Cel użycia</th><th style=\"width: 133px\">Podpis<br />dysponenta</th></tr>
      ";

      for ($i=1; $i <= 16; $i++) {
        echo "<tr><td><input class=\"form_inputs\" type=\"date\" name=\"eqec_usage_data[]\" /></td>";
	echo "<td><select class=\"form_inputs\" name=\"eqec_usage_nazwisko[]\" >
		<option></option>";

	$tName='str_do';
	$csh='id,imie,nazwisko';
	$whereValue='true';

	$result0 = prepareForm($connection, $tName, $csh, $whereValue);

	if ( mysqli_num_rows($result0) > 0 ) {

		while ($row = mysqli_fetch_row($result0) ) {

			echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";

		}
		mysqli_data_seek($result0, 0);
	}

	echo "</select></td>";

                 echo " <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_usage_minuty[]\" /></td>
                  <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_usage_uzycie[]\" /></td>";
	echo "<td>";
		echo "<select class=\"form_inputs\" name=\"eqec_usage_personal_id[]\">
			<option></option>";
		if ( mysqli_num_rows($result0) > 0 ) {
		
			while ( $row = mysqli_fetch_row($result0) ) {
				echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";
			}
			mysqli_data_seek($result0, 0);
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

      for ($i=1; $i <= 5; $i++) {
        echo "<tr><td><input class=\"form_inputs\" type=\"date\" name=\"eqec_fuel_data[]\" /></td>
                  <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_fuel_faktura[]\" /></td>
                  <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_fuel_paliwo[]\" /></td>
		  <td>
			<select class=\"form_inputs\" name=\"eqec_fuel_personal_id[]\">
				<option></option>";
			if ( mysqli_num_rows($result0) > 0 ) {
			
				while ( $row = mysqli_fetch_row($result0)) {

					echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";
				}

				mysqli_data_seek($result0, 0);
	
			}
echo "</select></td>
</tr>";
      }

      echo "<tr><td colspan=\"2\">Razem</td><td><input class=\"form_inputs\" type=\"text\" name=\"eqec_fuel_rlitr\"</td></tr>
      </table>
      <table>
      <tr><th colspan=\"2\"></th><th colspan=\"3\">Litrów paliwa: </th></tr>
      <tr><td>1.</td><td>Pozostało z ubiegłego okresu: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_pozostalo0\" /></td></tr>
      <tr><td>2.</td><td>Pobrano w okresie bierzącym: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_pobrano\" /></td></tr>
      <tr><td>3.</td><td>Razem: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_razem0\" /></td></tr>
      <tr><td>4.</td><td>Przepracowano minut: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_minut\" /></td>
          <td>5.</td><td>zużyto:</td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_uzycie0\" /></td></tr>
      <tr><td>6.</td><td>Wykonano rozruchów: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_rozruch\" /></td>
          <td>7.</td><td>zużyto:</td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_uzycie1\" /></td></tr>
      <tr><td>8.</td><td>Zużyto w ciągu okresu razem: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_razem1\" /></td></tr>
      <tr><td>9.</td><td>Pozostało na okres następny: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"eqec_common2_pozostalo1\" /></td></tr>
      </table>";

      echo "<table>
            <tr>
            <th>Obliczył: </th><td>
	<select class=\"form_inputs\" name=\"eqec_common2_personal_id0\" >
		<option></option>";

		if ( mysqli_num_rows($result0) > 0 ) {

			while ( $row = mysqli_fetch_row($result0) ) {
				
				echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";

			}
			mysqli_data_seek($result0, 0);
		}
	
	echo "</select></td>
	
            <th>Sprawdził: </th>
		<td><select class=\"form_inputs\" name=\"eqec_common2_personal_id1\" >
			<option></option>";

		if ( mysqli_num_rows($result0) > 0 ) {
			while ( $row = mysqli_fetch_row($result0) ) {
				echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";
			}

		}

	echo "</select></td>
            </tr>
            </table>";
    echo "<div><input class=\"form_button\" type=\"submit\" value=\"Zapisz\">
		<a href=\"index.php?page=docs&form=eqEngine_card\"><button id=\"genCard\">Generuj kartę</button></a></div>
          </form>";




 ?>
