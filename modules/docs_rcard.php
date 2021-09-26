<?php

function theTable($connection) {

	$tName = 'rcard_common';
	$csh = 'id,seria,miesiac';
	$whereValue = 'true';

	$result = prepareForm($connection, $tName, $csh, $whereValue);

	if ( mysqli_num_rows($result) > 0 ) {

		echo "<table style=\"width: 100%; border-spacing: 0\">
			<tr style=\"background-color: #ADBDCE;\">
			<th style=\"padding: 1%;\">Seria</th>
			<th style=\"padding: 1%;\">Miesiąc</th>
			<th style=\"padding: 1%;\" colspan=\"2\">Akcja</th><tr>";
		
		$rcount=0;
		while ( $row = mysqli_fetch_row($result) ) {

			if ( $rcount % 2 === 0 ) {

				echo "<tr style=\"background-color: #748EA8; text-align: center;\">";
			
			} else {

				echo "<tr style=\"background-color: #ADBDCE; text-align: center;\">";

			}

			echo "
				<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\">" . $row[1] . "</td>
				<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\">" . $row[2] . "</td>
				<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\"><a href=\"index.php?page=docs_rcard&action=load&id=" . $row[0] . "\">					<button id=\"l_button\"><img id=\"l_image\" src=\"resources/load.png\" /></button></a></td>
				<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\"><a href=\"index.php?page=docs_rcard&action=del&id=" . $row[0] . "\">
					<button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button></a></td>
				</tr>";
		$rcount++;
		}

		echo "</table>";

	} else {

		echo "<h3>Brak zapisanych kart</h3>";
	}


}


if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ( $_GET['action'] === 'load' ) ) {

		$rcard_id = $_POST['rcard_common_id'];

		$mode = 'dryrun';

		$tName = 'rcard_common';
		$csh = 'seria,miesiac';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'id=' . $rcard_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		$tName = 'rcard_vehicle';
		$csh = 'marka,typ,rodzaj,rej,nrop,zbior,norma,normap';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'rcard_id= ' . $rcard_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		$tName = 'rcard_usage';
		$csh='stkoniecbr,stkoniecpo,przebiegbr,przebieg,pdroz,postoj,rk,razem';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'rcard_id= ' . $rcard_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		$tName = 'rcard_fuel1';
		$csh = 'id';
		$whereValue = 'rcard_id=' . $rcard_id;

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);

		$fuel1Data = $_POST['rcard_fuel1_data'];
		$fuel1Faktura = $_POST['rcard_fuel1_faktura'];
		$fuel1Paliwo = $_POST['rcard_fuel1_paliwo'];
		$fuel1Olej = $_POST['rcard_fuel1_olej'];
		$fuel1PersonalId0 = $_POST['rcard_fuel1_personal_id0'];
		$fuel1PersonalId1 = $_POST['rcard_fuel1_personal_id1'];


		if ( mysqli_num_rows($result0) > 0 ) {

			$csh = 'data,faktura,paliwo,olej,personal_id0,personal_id1';
			$pKL = generatePKL($tName, $csh);

			while ( $row = mysqli_fetch_row($result0) ) {

				
				if ( strlen($fuel1Data[($row[0] - 1)]) > 0 ) {

					$whereValue = 'id=' . $row[0];
			
					$_POST['rcard_fuel1_data'] = $fuel1Data[($row[0] - 1)];
					$_POST['rcard_fuel1_faktura'] = $fuel1Faktura[($row[0] - 1)];
					$_POST['rcard_fuel1_paliwo'] = $fuel1Paliwo[($row[0] - 1)];
					$_POST['rcard_fuel1_olej'] = $fuel1Olej[($row[0] - 1)];
					$_POST['rcard_fuel1_personal_id0'] = $fuel1PersonalId0[($row[0] - 1)];
					$_POST['rcard_fuel1_personal_id1'] = $fuel1PersonalId1[($row[0] - 1)];
					//var_dump($_POST);

					dbMod($connection, $tName, $csh, $pKL, $whereValue);

				}

				
			}
			
		}

		$f1DLength = count($fuel1Data);
		$res0Length = mysqli_num_rows($result0);

		if ( $f1DLength > $res0Length ) {

			$tName = 'rcard_fuel1';
			$csh = 'data,faktura,paliwo,olej,personal_id0,personal_id1,rcard_id';
			$pKL = generatePKL($tName, $csh);

			for ( $i = $res0Length; $i < $f1DLength; $i++ ) {

				if ( strlen($fuel1Data[$i]) > 0 ) {

					$_POST['rcard_fuel1_data'] = $fuel1Data[$i];
					$_POST['rcard_fuel1_faktura'] = $fuel1Faktura[$i];
					$_POST['rcard_fuel1_paliwo'] = $fuel1Paliwo[$i];
					$_POST['rcard_fuel1_olej'] = $fuel1Olej[$i];
					$_POST['rcard_fuel1_personal_id0'] = $fuel1PersonalId0[$i];
					$_POST['rcard_fuel1_personal_id1'] = $fuel1PersonalId1[$i];
					$_POST['rcard_fuel1_rcard_id'] = $rcard_id;
					
					dbAdd($connection, $tName, $csh, $pKL);
					

				}

			
			} 
		
		}

		$tName = 'rcard_fuel2';
		$csh = 'pozostalo_paliwo0,pozostalo_olej0,pobrano_paliwo,pobrano_olej,razem_paliwo0,razem_olej0,km,kmz_paliwo,kmz_olej,minut,m_paliwo,m_olej,rk,rk_paliwo,rk_olej,razem_paliwo1,razem_olej1,pozostalo_paliwo1,pozostalo_olej1';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'rcard_id=' . $rcard_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		$tName = 'rcard_common2';
		$csh = 'personal_id0,personal_id1,msc,data,personal_id2';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'rcard_id=' . $rcard_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		$tName = 'rcard_tab';
		$csh = 'id';
		$whereValue = 'rcard_id=' . $rcard_id;

		$result1 = prepareForm($connection, $tName, $csh, $whereValue);

			$tabData = $_POST['rcard_tab_data'];
			$tabPersonalId0 = $_POST['rcard_tab_personal_id0'];
			$tabTrasa = $_POST['rcard_tab_trasa'];
			$tabCel = $_POST['rcard_tab_cel'];
			$tabPersonalId1 = $_POST['rcard_tab_personal_id1'];
			$tabOstanl = $_POST['rcard_tab_ostanl'];
			$tabPstanl = $_POST['rcard_tab_pstanl'];
			$tabDev = $_POST['rcard_tab_dev'];
			$tabPersonalId2 = $_POST['rcard_tab_personal_id2'];



		if ( mysqli_num_rows($result1) > 0 ) {

			$csh = 'data,personal_id0,trasa,cel,personal_id1,ostanl,pstanl,dev,personal_id2';
			$pKL = generatePKL($tName, $csh);

			while ($row1 = mysqli_fetch_row($result1))  {

				$whereValue='id=' . $row1[0];

				if ( strlen($tabData[($row1[0] - 1)]) > 0 ) {
				
					$_POST['rcard_tab_data'] = $tabData[($row1[0] - 1)];
					$_POST['rcard_tab_personal_id0'] = $tabPersonalId0[($row1[0] - 1 )];
					$_POST['rcard_tab_trasa'] = $tabTrasa[($row1[0] - 1)];
					$_POST['rcard_tab_cel'] = $tabCel[($row1[0] - 1 )];
					$_POST['rcard_tab_personal_id1'] = $tabPersonalId1[($row1[0] - 1 )];
					$_POST['rcard_tab_ostanl'] = $tabOstanl[($row1[0] - 1)];
					$_POST['rcard_tab_pstanl'] = $tabPstanl[($row1[0] - 1)];
					$_POST['rcard_tab_dev'] = $tabDev[($row1[0] - 1)];
					$_POST['rcard_tab_personal_id2'] = $tabPersonalId2[($row1[0] - 1)];
					dbMod($connection, $tName, $csh, $pKL, $whereValue);

				}
			}
		
		}

		$dDataLength = count($tabData);
		$res1Length = mysqli_num_rows($result1);

		if ( $dDataLength > $res1Length ) {

			$csh = 'data,personal_id0,trasa,cel,personal_id1,ostanl,pstanl,dev,personal_id2,rcard_id';
			$pKL = generatePKL($tName, $csh);

			for ($i=$res1Length; $i < $dDataLength; $i++) {

				if ( strlen($tabData[$i]) > 0  ) {

					$_POST['rcard_tab_data'] = $tabData[$i];
					$_POST['rcard_tab_personal_id0'] = $tabPersonalId0[$i];
					$_POST['rcard_tab_trasa'] = $tabTrasa[$i];
					$_POST['rcard_tab_cel'] = $tabCel[$i];
					$_POST['rcard_tab_personal_id1'] = $tabPersonalId1[$i];
					$_POST['rcard_tab_ostanl'] = $tabOstanl[$i];
					$_POST['rcard_tab_pstanl'] = $tabPstanl[$i];
					$_POST['rcard_tab_dev'] = $tabDev[$i];
					$_POST['rcard_tab_personal_id2'] = $tabPersonalId2[$i];
					$_POST['rcard_tab_rcard_id'] = $rcard_id;

					dbAdd($connection, $tName, $csh, $pKL);

				}
			}

		}

		theTable($connection);

	} else if ( isset($_GET['action']) && ( $_GET['action'] === 'new' ) ) {

		function getParameters($connection, $whereValue) {
		
			$tName = 'vehicle_parameters';
			$csh = 'value';

			$gPResult = prepareForm($connection, $tName, $csh, $whereValue);

			if ( mysqli_num_rows($gPResult) > 0 ) {

				$gPRow = mysqli_fetch_row($gPResult);
				return $gPRow[0];
			
			} else { return 0; }
		
		}


		$tName='vehicle_about';
		$csh='nazwa,marka,typ,rejestracja,numer,zbiornik';
		$whereValue='id=' . $_POST['vehicle_id'];

		$result = prepareForm($connection, $tName, $csh, $whereValue);
		$row = mysqli_fetch_row($result);

		$whereValue = "vehicle_id=" . $_POST['vehicle_id'] . " AND nazwa='norma';";

		$norma = getParameters($connection, $whereValue);

		$whereValue = "vehicle_id=" . $_POST['vehicle_id'] . " AND nazwa='postoj_norma';";
		
		$postoj_norma = getParameters($connection, $whereValue);

		$whereValue = "vehicle_id=" . $_POST['vehicle_id'] . " AND nazwa='rk_norma';";

		$rk_norma = getParameters($connection, $whereValue);

		include('forms/docs_road_card.php');
	
	} else {

		$mode='dryrun';

		$tName='rcard_common';
		$csh='seria,miesiac';
		$pKL=generatePKL($tName,$csh);

		dbAdd($connection, $tName, $csh, $pKL);

		$tName='rcard_common';
		$csh='id';
		$whereValue='true ORDER BY id DESC LIMIT 1';

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);
		$row0 = mysqli_fetch_row($result0);

		$_POST['rcard_vehicle_rcard_id']=$row0[0];
		$_POST['rcard_usage_rcard_id']=$row0[0];
		$_POST['rcard_fuel1_rcard_id']=$row0[0];
		$_POST['rcard_fuel2_rcard_id']=$row0[0];
		$_POST['rcard_tab_rcard_id']=$row0[0];
		$_POST['rcard_common2_rcard_id']=$row0[0];

		
		$tName = 'rcard_vehicle';
		$csh = 'marka,typ,rodzaj,rej,nrop,zbior,norma,normap,rcard_id';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

		$tName = 'rcard_usage';
		$csh='stkoniecbr,stkoniecpo,przebiegbr,przebieg,pdroz,postoj,rk,razem,rcard_id';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

		$tName = 'rcard_fuel1';
		$csh = 'data,faktura,paliwo,olej,personal_id0,personal_id1,rcard_id';
		$pKL = generatePKL($tName, $csh);
	
	
		$fuel1Data = $_POST['rcard_fuel1_data'];
		$fuel1Faktura = $_POST['rcard_fuel1_faktura'];
		$fuel1Paliwo = $_POST['rcard_fuel1_paliwo'];
		$fuel1Olej = $_POST['rcard_fuel1_olej'];
		$fuel1PersonalId0 = $_POST['rcard_fuel1_personal_id0'];
		$fuel1PersonalId1 = $_POST['rcard_fuel1_personal_id1'];

		for ($i=0; $i < count($fuel1Data); $i++) {
		
			if (strlen($fuel1Data[$i]) > 0 ) {

				/*
				echo "fuel1Data[" . $i . "]: ". $fuel1Data[$i] . "<br />";
				echo "fuel1Faktura[" . $i . "]: ". $fuel1Faktura[$i] . "<br />";
				echo "fuel1Paliwo[" . $i . "]: ". $fuel1Paliwo[$i] . "<br />";
				echo "fuel1Olej[" . $i . "]: ". $fuel1Olej[$i] . "<br />";
				echo "fuel1PersonalId0[" . $i . "]: ". $fuel1PersonalId0[$i] . "<br />";
				echo "fuel1PersonalId1[" . $i . "]: ". $fuel1PersonalId1[$i] . "<br />";
				*/
			
				$_POST['rcard_fuel1_data'] = $fuel1Data[$i];
				$_POST['rcard_fuel1_faktura'] = $fuel1Faktura[$i];
				$_POST['rcard_fuel1_paliwo'] = $fuel1Paliwo[$i];
				$_POST['rcard_fuel1_olej'] = $fuel1Olej[$i];
				$_POST['rcard_fuel1_personal_id0'] = $fuel1PersonalId0[$i];
				$_POST['rcard_fuel1_personal_id1'] = $fuel1PersonalId1[$i];

				dbAdd($connection, $tName, $csh, $pKL);		
				
			}
		
		}


		$tName = 'rcard_fuel2';
		$csh = 'pozostalo_paliwo0,pozostalo_olej0,pobrano_paliwo,pobrano_olej,razem_paliwo0,razem_olej0,km,kmz_paliwo,kmz_olej,minut,m_paliwo,m_olej,rk,rk_paliwo,rk_olej,razem_paliwo1,razem_olej1,pozostalo_paliwo1,pozostalo_olej1,rcard_id';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);
	
		$tName = 'rcard_tab';
		$csh = 'data,personal_id0,trasa,cel,personal_id1,ostanl,pstanl,dev,personal_id2,rcard_id';
		$pKL = generatePKL($tName, $csh);

		$tabData = $_POST['rcard_tab_data'];
		$tabPersonalId0 = $_POST['rcard_tab_personal_id0'];
		$tabTrasa = $_POST['rcard_tab_trasa'];
		$tabCel = $_POST['rcard_tab_cel'];
		$tabPersonalId1 = $_POST['rcard_tab_personal_id1'];
		$tabOstanl = $_POST['rcard_tab_ostanl'];
		$tabPstanl = $_POST['rcard_tab_pstanl'];
		$tabDev = $_POST['rcard_tab_dev'];
		$tabPersonalId2 = $_POST['rcard_tab_personal_id2'];
		
		for ($i=0; $i < count($tabData); $i++) {

			if ( strlen($tabData[$i]) > 0  ) {

				$_POST['rcard_tab_data'] = $tabData[$i];
				$_POST['rcard_tab_personal_id0'] = $tabPersonalId0[$i];
				$_POST['rcard_tab_trasa'] = $tabTrasa[$i];
				$_POST['rcard_tab_cel'] = $tabCel[$i];
				$_POST['rcard_tab_personal_id1'] = $tabPersonalId1[$i];
				$_POST['rcard_tab_ostanl'] = $tabOstanl[$i];
				$_POST['rcard_tab_pstanl'] = $tabPstanl[$i];
				$_POST['rcard_tab_dev'] = $tabDev[$i];
				$_POST['rcard_tab_personal_id2'] = $tabPersonalId0[$i];


				dbAdd($connection, $tName, $csh, $pKL);

			} 
		}

		$tName = 'rcard_common2';
		$csh = 'personal_id0,personal_id1,msc,data,personal_id2,rcard_id';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);
		theTable($connection);

	}

} else {


	if ( isset($_GET['action']) && ( $_GET['action'] === 'del' ) ) {

		$mode = 'dryrun';
		$del_id = $_GET['id'];
		$tName = 'rcard_common';
		$whereValue = 'id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		$tName = 'rcard_vehicle';
		$whereValue = 'rcard_id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		$tName = 'rcard_usage';
		$whereValue = 'rcard_id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		$tName = 'rcard_fuel1';
		$whereValue = 'rcard_id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		$tName = 'rcard_fuel2';
		$whereValue = 'rcard_id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		$tName = 'rcard_tab';
		$whereValue = 'rcard_id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		$tName = 'rcard_common2';
		$whereValue = 'rcard_id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		theTable($connection);

	} else if ( isset($_GET['action']) && ( $_GET['action'] === 'load' ) ) {

		$load_id = $_GET['id'];

		$tName = 'rcard_common';
		$csh = '*';
		$whereValue = 'id=' . $load_id;

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'rcard_vehicle';
		$whereValue = 'rcard_id=' . $load_id;

		$result1 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'rcard_usage';
		$result2 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'rcard_fuel1';
		$result3 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'rcard_fuel2';
		$result4 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'rcard_tab';
		$result5 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'rcard_common2';
		$result6 = prepareForm($connection, $tName, $csh, $whereValue);

		include('forms/docs_road_card_mod.php');

	} else {
		

		echo "<div id=\"form\">";

			$tName = 'vehicle_about';
			$csh='id,nazwa';
			$whereValue='true';

			$result = prepareForm($connection, $tName, $csh, $whereValue);

				if ( mysqli_num_rows($result) > 0 ) {

					echo "<form action=\"index.php?page=docs_rcard&action=new\" method=\"post\">";
					echo "Wybierz pojazd: <select class=\"form_inputs\" name=\"vehicle_id\">
						</option></option>";

					while ( $row = mysqli_fetch_row($result) ) {

						echo "<option value=\"" . $row[0] . "\">" . $row[1] . "</option>";
					}
				
					echo "</select>";
					echo "<div><input class=\"form_button\" type=\"submit\" value=\"Nowa karta\" /></div>
						</form>";

				}
			
		echo "</div>
		<hr id=\"theline\" />
		<div id=\"result\">";

			theTable($connection);

		echo "</div>";


	}
	
	
}
