<?php

echo "<a href=\"javascript:print()\"><button id=\"p_button\"><img id=\"p_image\" src=\"resources/printer.png\" /></button></a><br /><br />";

echo "
<div id=\"document\" style=\"width: 210mm; height: 282mm; padding-top:15mm; background-color: white;\">
<div style=\"width: 30%; margin-left: auto; margin-right: 10%; border: 1px solid black;\">
Numer ewidencyjny Karty pracy<br />
<hr />
Seria: " . $_POST['eqec_common_serial'] . "
</div>
<p style=\"width: 80%; text-align: center; margin-left: auto; margin-right: auto;\">
<span style=\"font-size: 22px; font-weight: bold;\">Okresowa karta pracy sprzętu silnikowego</span><br />
na okres " . $_POST['eqec_common_starts'] . " - " . $_POST['eqec_common_ends'] . "<br />
</p>
<table style=\"width: 60%; margin-left: auto; margin-right: auto; text-align: justify;\">
<tr><td>Marka: </td><td>" . $_POST['eqec_common_marka'] . "</td><td>Typ: </td><td>" . $_POST['eqec_common_typ'] . "</td><tr />
<tr><td>Rodzaj: </td><td>" . $_POST['eqec_common_rodzaj'] . "</td><td>Nr ewidencyjny:</td><td>" . $_POST['eqec_common_nrewi'] . "</td><tr />
<tr><td colspan=\"4\">Norma eksploatacyjna na 1 godzinę pracy: " . $_POST['eqec_common_norma'] . " litrów
</table>
<p>&nbsp;</p>
<table border=\"1\" style=\"border-collapse: collapse; width: 80%; margin: auto;\">
<tr><th>Data</th><th>Nazwisko obsługującego</th><th>Minut pracy</th>
<th>Cel użycia</th><th>Podpis dysponenta</th></tr>";

$tName='str_do';
$csh='imie,nazwisko';

for ($i=0; $i < (count($_POST['eqec_usage_data'])); $i++ ){

	if( strlen($_POST['eqec_usage_data'][$i]) === 0 ) { continue; }

	$whereValue='id=' . $_POST['eqec_usage_nazwisko'][$i];
	$result0 = prepareForm($connection, $tName, $csh, $whereValue);
	$row0 = mysqli_fetch_row($result0);

	if( strlen($_POST['eqec_usage_data'][$i]) === 0 ) { continue; }
		echo "<tr style=\"text-align: center\">
			<td>" . $_POST['eqec_usage_data'][$i] . "</td>
			<td>" . $row0[0] . " " . $row0[1] . "</td>
			<td>" . $_POST['eqec_usage_minuty'][$i] . "</td>
			<td>" . $_POST['eqec_usage_uzycie'][$i] . "</td>
			<td style=\"font-size: 10px;\"><span style=\"color: lightgray\">" . $row0[0] . " " . $row0[1] . "</span></td></tr>";

}
echo "<tr><td colspan=\"2\" style=\"text-align: right;\">Razem minut pracy: </td>
                <td colspan=\"3\" style=\"text-align: center; font-weight: bold;\">" . $_POST['eqec_usage_rmin'] . "</td></tr>";

echo "</table>
<p>&nbsp;</p>
<table border=\"1\" style=\"border-collapse: collapse; width: 80%; margin: auto;\">
<tr><th colspan=\"3\">POBRANO W LITRACH</th><th style=\"width: 270px;\" rowspan=\"2\">Podpis</th></tr>
<tr><th>Data</th><th>Nr faktury</th><th>Litry</th></tr>";

for ($i=0; $i < (count($_POST['eqec_fuel_data'])); $i++) {
	
	if ( strlen($_POST['eqec_fuel_data'][$i]) === 0 )  { continue; }

	$whereValue='id=' . $_POST['eqec_fuel_personal_id'][$i];
	$result0 = prepareForm($connection, $tName, $csh, $whereValue);
	$row0 = mysqli_fetch_row($result0);

		echo "<tr style=\"text-align: center\">
				<td>" . $_POST['eqec_fuel_data'][$i] . "</td>
				<td>" . $_POST['eqec_fuel_faktura'][$i] . "</td>
				<td>" . $_POST['eqec_fuel_paliwo'][$i] . "</td>
				<td style=\"width: 50px; font-size: 10px;\"><span style=\"color: lightgray;\">" . $row0[0] . " " . $row0[1] . "<span></td></tr>";

	}

echo "<tr><td colspan=\"2\" style=\"text-align: right;\">Razem:</td>
			<td style=\"text-align: center; font-weight: bold;\" colspan=\"2\">" . $_POST['eqec_fuel_rlitr'] . "</td></tr>";

$tName='str_do';
$csh='imie,nazwisko';
$whereValue='id=' . $_POST['eqec_common2_personal_id0'];
$result = prepareForm($connection, $tName, $csh, $whereValue);
$rowA = mysqli_fetch_row($result);

$whereValue='id=' . $_POST['eqec_common2_personal_id1'];
$result = prepareForm($connection, $tName, $csh, $whereValue);
$rowB = mysqli_fetch_row($result);

echo "</table>
<p>&nbsp;</p>
<table border=\"1\" style=\"border-collapse: collapse; width: 80%; margin: auto;\">
<tr><th colspan=\"2\"></th><th colspan=\"4\">Litrów paliwa: </th></tr>
<tr><td>1.</td><td>Pozostało z ubiegłego okresu: </td><td colspan=\"3\" style=\"text-align: center;\">" . $_POST['eqec_common2_pozostalo0'] . "</td></tr>
<tr><td>2.</td><td>Pobrano w okresie bierzącym: </td><td colspan=\"3\" style=\"text-align: center;\">" . $_POST['eqec_common2_pobrano'] . "</td></tr>
<tr><td>3.</td><td>Razem: </td><td colspan=\"3\" style=\"text-align: center;\">" . $_POST['eqec_common2_razem0'] . "</td></tr>
<tr><td>4.</td><td>Przepracowano minut: </td><td style=\"text-align: center;\">" . $_POST['eqec_common2_minut'] . "</td>
<td style=\"text-align: center;\">Zużycie: </td><td style=\"text-align: center;\">" . $_POST['eqec_common2_uzycie0'] . "</td></tr>
<tr><td>5.</td><td>Wykonano rozruchów: </td><td style=\"text-align: center;\">" . $_POST['eqec_common2_rozruch'] . "</td>
<td style=\"text-align: center;\">Zużycie: </td><td style=\"text-align: center;\">" . $_POST['eqec_common2_uzycie1'] . "</td></tr>
<tr><td>6.</td><td>Zużyto w ciągu okresu razem: </td><td colspan=\"3\" style=\"text-align: center;\">" . $_POST['eqec_common2_razem1'] . "</td></tr>
<tr><td>7.</td><td>Pozostało na okres następny:</td><td colspan=\"3\" style=\"text-align: center;\">" . $_POST['eqec_common2_pozostalo1'] . "</td></tr>
</table>
<p>&nbsp;</p>
<table style=\"width: 80%; margin: auto;\">
<tr>
<th>Obliczył: </th><td>" . $rowA[0] . " " . $rowA[1]  . "</td>
<th>Sprawdził: </th><td>" . $rowB[0] . " " . $rowB[1] . "</td>
</tr>
</table>
</div>
";
?>
