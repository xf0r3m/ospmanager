<?php

function theTable($connection) {

	$tName = 'rcardev_common';
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
				<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\"><a href=\"index.php?page=docs_rcardev&action=load&id=" . $row[0] . "\">					<button id=\"l_button\"><img id=\"l_image\" src=\"resources/load.png\" /></button></a></td>
				<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\"><a href=\"index.php?page=docs_rcardev&action=del&id=" . $row[0] . "\">
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

		$rcardev_id = $_POST['rcardev_common_id'];

		$mode = 'dryrun';

		$tName = 'rcardev_common';
		$csh = 'seria,miesiac';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'id=' . $rcardev_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		$tName = 'rcardev_vehicle';
		$csh = 'marka,typ,rodzaj,rej,nrop,zbior,norma,normap';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'rcardev_id= ' . $rcardev_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		$tName = 'rcardev_usage';
		$csh='stkoniecbr,stkoniecpo,przebiegbr,przebieg,pdroz,postoj,rk,razem';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'rcardev_id= ' . $rcardev_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		$tName = 'rcardev_pompa';
		$csh='minut,norma';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'rcardev_id=' . $rcardev_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		$tName = 'rcardev_web';
		$csh = 'minut,norma';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'rcardev_id=' . $rcardev_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		$tName = 'rcardev_fuel1';
		$csh = 'id';
		$whereValue = 'rcardev_id=' . $rcardev_id;

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);

		$fuel1Data = $_POST['rcardev_fuel1_data'];
		$fuel1Faktura = $_POST['rcardev_fuel1_faktura'];
		$fuel1Paliwo = $_POST['rcardev_fuel1_paliwo'];
		$fuel1Olej = $_POST['rcardev_fuel1_olej'];
		$fuel1PersonalId0 = $_POST['rcardev_fuel1_personal_id0'];
		$fuel1PersonalId1 = $_POST['rcardev_fuel1_personal_id1'];


		if ( mysqli_num_rows($result0) > 0 ) {

			$csh = 'data,faktura,paliwo,olej,personal_id0,personal_id1';
			$pKL = generatePKL($tName, $csh);

			while ( $row = mysqli_fetch_row($result0) ) {

				
				if ( strlen($fuel1Data[($row[0] - 1)]) > 0 ) {

					$whereValue = 'id=' . $row[0];
			
					$_POST['rcardev_fuel1_data'] = $fuel1Data[($row[0] - 1)];
					$_POST['rcardev_fuel1_faktura'] = $fuel1Faktura[($row[0] - 1)];
					$_POST['rcardev_fuel1_paliwo'] = $fuel1Paliwo[($row[0] - 1)];
					$_POST['rcardev_fuel1_olej'] = $fuel1Olej[($row[0] - 1)];
					$_POST['rcardev_fuel1_personal_id0'] = $fuel1PersonalId0[($row[0] - 1)];
					$_POST['rcardev_fuel1_personal_id1'] = $fuel1PersonalId1[($row[0] - 1)];
					//var_dump($_POST);

					dbMod($connection, $tName, $csh, $pKL, $whereValue);

				}

				
			}
			
		}

		$f1DLength = count($fuel1Data);
		$res0Length = mysqli_num_rows($result0);

		if ( $f1DLength > $res0Length ) {

			$tName = 'rcardev_fuel1';
			$csh = 'data,faktura,paliwo,olej,personal_id0,personal_id1,rcardev_id';
			$pKL = generatePKL($tName, $csh);

			for ( $i = $res0Length; $i < $f1DLength; $i++ ) {

				if ( strlen($fuel1Data[$i]) > 0 ) {

					$_POST['rcardev_fuel1_data'] = $fuel1Data[$i];
					$_POST['rcardev_fuel1_faktura'] = $fuel1Faktura[$i];
					$_POST['rcardev_fuel1_paliwo'] = $fuel1Paliwo[$i];
					$_POST['rcardev_fuel1_olej'] = $fuel1Olej[$i];
					$_POST['rcardev_fuel1_personal_id0'] = $fuel1PersonalId0[$i];
					$_POST['rcardev_fuel1_personal_id1'] = $fuel1PersonalId1[$i];
					$_POST['rcardev_fuel1_rcardev_id'] = $rcardev_id;
					
					dbAdd($connection, $tName, $csh, $pKL);
					

				}

			
			} 
		
		}

		$tName = 'rcardev_fuel2';
		$csh = 'pozostalo_paliwo0,pozostalo_olej0,pobrano_paliwo,pobrano_olej,razem_paliwo0,razem_olej0,km,kmz_paliwo,kmz_olej,minut,m_paliwo,m_olej,rk,rk_paliwo,rk_olej,razem_paliwo1,razem_olej1,pozostalo_paliwo1,pozostalo_olej1';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'rcardev_id=' . $rcardev_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		$tName = 'rcardev_common2';
		$csh = 'personal_id0,personal_id1,msc,data,personal_id2';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'rcardev_id=' . $rcardev_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		$tName = 'rcardev_tab';
		$csh = 'id';
		$whereValue = 'rcardev_id=' . $rcardev_id;

		$result1 = prepareForm($connection, $tName, $csh, $whereValue);

			$tabData = $_POST['rcardev_tab_data'];
			$tabPersonalId0 = $_POST['rcardev_tab_personal_id0'];
			$tabTrasa = $_POST['rcardev_tab_trasa'];
			$tabCel = $_POST['rcardev_tab_cel'];
			$tabPersonalId1 = $_POST['rcardev_tab_personal_id1'];
			$tabOstanl = $_POST['rcardev_tab_ostanl'];
			$tabPstanl = $_POST['rcardev_tab_pstanl'];
			$tabDev = $_POST['rcardev_tab_dev'];
			$tabPersonalId2 = $_POST['rcardev_tab_personal_id2'];



		if ( mysqli_num_rows($result1) > 0 ) {

			$csh = 'data,personal_id0,trasa,cel,personal_id1,ostanl,pstanl,dev,personal_id2';
			$pKL = generatePKL($tName, $csh);

			while ($row1 = mysqli_fetch_row($result1))  {

				$whereValue='id=' . $row1[0];

				if ( strlen($tabData[($row1[0] - 1)]) > 0 ) {
				
					$_POST['rcardev_tab_data'] = $tabData[($row1[0] - 1)];
					$_POST['rcardev_tab_personal_id0'] = $tabPersonalId0[($row1[0] - 1 )];
					$_POST['rcardev_tab_trasa'] = $tabTrasa[($row1[0] - 1)];
					$_POST['rcardev_tab_cel'] = $tabCel[($row1[0] - 1 )];
					$_POST['rcardev_tab_personal_id1'] = $tabPersonalId1[($row1[0] - 1 )];
					$_POST['rcardev_tab_ostanl'] = $tabOstanl[($row1[0] - 1)];
					$_POST['rcardev_tab_pstanl'] = $tabPstanl[($row1[0] - 1)];
					$_POST['rcardev_tab_dev'] = $tabDev[($row1[0] - 1)];
					$_POST['rcardev_tab_personal_id2'] = $tabPersonalId2[($row1[0] - 1)];
					dbMod($connection, $tName, $csh, $pKL, $whereValue);

				}
			}
		
		}

		$dDataLength = count($tabData);
		$res1Length = mysqli_num_rows($result1);

		if ( $dDataLength > $res1Length ) {

			$csh = 'data,personal_id0,trasa,cel,personal_id1,ostanl,pstanl,dev,personal_id2,rcardev_id';
			$pKL = generatePKL($tName, $csh);

			for ($i=$res1Length; $i < $dDataLength; $i++) {

				if ( strlen($tabData[$i]) > 0  ) {

					$_POST['rcardev_tab_data'] = $tabData[$i];
					$_POST['rcardev_tab_personal_id0'] = $tabPersonalId0[$i];
					$_POST['rcardev_tab_trasa'] = $tabTrasa[$i];
					$_POST['rcardev_tab_cel'] = $tabCel[$i];
					$_POST['rcardev_tab_personal_id1'] = $tabPersonalId1[$i];
					$_POST['rcardev_tab_ostanl'] = $tabOstanl[$i];
					$_POST['rcardev_tab_pstanl'] = $tabPstanl[$i];
					$_POST['rcardev_tab_dev'] = $tabDev[$i];
					$_POST['rcardev_tab_personal_id2'] = $tabPersonalId2[$i];
					$_POST['rcardev_tab_rcardev_id'] = $rcardev_id;

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

		$whereValue = "vehicle_id=" . $_POST['vehicle_id'] . " AND nazwa='norma'";

		$norma = getParameters($connection, $whereValue);

		$whereValue = "vehicle_id=" . $_POST['vehicle_id'] . " AND nazwa='postoj_norma';";

		$postoj_norma = getParameters($connection, $whereValue);

		$whereValue = "vehicle_id=" . $_POST['vehicle_id'] . " AND nazwa='rk_norma';";

		$rk_norma = getParameters($connection, $whereValue);

		$whereValue = "vehicle_id=" . $_POST['vehicle_id'] . " AND nazwa='autopompa_norma';";

		$autopompa_norma = getParameters($connection, $whereValue);

		$whereValue = "vehicle_id=" . $_POST['vehicle_id'] . " AND nazwa='web_norma';";

		$web_norma = getParameters($connection, $whereValue);
	
		
		include('forms/docs_road_card_dev.php');
	
	} else {

		$mode='dryrun';

		$tName='rcardev_common';
		$csh='seria,miesiac';
		$pKL=generatePKL($tName,$csh);

		dbAdd($connection, $tName, $csh, $pKL);

		$tName='rcardev_common';
		$csh='id';
		$whereValue='true ORDER BY id DESC LIMIT 1';

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);
		$row0 = mysqli_fetch_row($result0);

		$_POST['rcardev_vehicle_rcardev_id']=$row0[0];
		$_POST['rcardev_usage_rcardev_id']=$row0[0];
		$_POST['rcardev_pompa_rcardev_id']=$row0[0];
		$_POST['rcardev_web_rcardev_id']=$row0[0];
		$_POST['rcardev_fuel1_rcardev_id']=$row0[0];
		$_POST['rcardev_fuel2_rcardev_id']=$row0[0];
		$_POST['rcardev_tab_rcardev_id']=$row0[0];
		$_POST['rcardev_common2_rcardev_id']=$row0[0];

		
		$tName = 'rcardev_vehicle';
		$csh = 'marka,typ,rodzaj,rej,nrop,zbior,norma,normap,rcardev_id';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

		$tName = 'rcardev_usage';
		$csh='stkoniecbr,stkoniecpo,przebiegbr,przebieg,pdroz,postoj,rk,razem,rcardev_id';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

		$tName = 'rcardev_pompa';
		$csh = 'minut,norma,rcardev_id';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

		$tName = 'rcardev_web';
		$csh = 'minut,norma,rcardev_id';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

		$tName = 'rcardev_fuel1';
		$csh = 'data,faktura,paliwo,olej,personal_id0,personal_id1,rcardev_id';
		$pKL = generatePKL($tName, $csh);
	
	
		$fuel1Data = $_POST['rcardev_fuel1_data'];
		$fuel1Faktura = $_POST['rcardev_fuel1_faktura'];
		$fuel1Paliwo = $_POST['rcardev_fuel1_paliwo'];
		$fuel1Olej = $_POST['rcardev_fuel1_olej'];
		$fuel1PersonalId0 = $_POST['rcardev_fuel1_personal_id0'];
		$fuel1PersonalId1 = $_POST['rcardev_fuel1_personal_id1'];

		for ($i=0; $i < count($fuel1Data); $i++) {
		
			if (strlen($fuel1Data[$i]) > 0 ) {
			
				$_POST['rcardev_fuel1_data'] = $fuel1Data[$i];
				$_POST['rcardev_fuel1_faktura'] = $fuel1Faktura[$i];
				$_POST['rcardev_fuel1_paliwo'] = $fuel1Paliwo[$i];
				$_POST['rcardev_fuel1_olej'] = $fuel1Olej[$i];
				$_POST['rcardev_fuel1_personal_id0'] = $fuel1PersonalId0[$i];
				$_POST['rcardev_fuel1_personal_id1'] = $fuel1PersonalId1[$i];

				dbAdd($connection, $tName, $csh, $pKL);		
				
			}
		
		}


		$tName = 'rcardev_fuel2';
		$csh = 'pozostalo_paliwo0,pozostalo_olej0,pobrano_paliwo,pobrano_olej,razem_paliwo0,razem_olej0,km,kmz_paliwo,kmz_olej,minut,m_paliwo,m_olej,rk,rk_paliwo,rk_olej,razem_paliwo1,razem_olej1,pozostalo_paliwo1,pozostalo_olej1,rcardev_id';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);
	
		$tName = 'rcardev_tab';
		$csh = 'data,personal_id0,trasa,cel,personal_id1,ostanl,pstanl,dev,personal_id2,rcardev_id';
		$pKL = generatePKL($tName, $csh);

		$tabData = $_POST['rcardev_tab_data'];
		$tabPersonalId0 = $_POST['rcardev_tab_personal_id0'];
		$tabTrasa = $_POST['rcardev_tab_trasa'];
		$tabCel = $_POST['rcardev_tab_cel'];
		$tabPersonalId1 = $_POST['rcardev_tab_personal_id1'];
		$tabOstanl = $_POST['rcardev_tab_ostanl'];
		$tabPstanl = $_POST['rcardev_tab_pstanl'];
		$tabDev = $_POST['rcardev_tab_dev'];
		$tabPersonalId2 = $_POST['rcardev_tab_personal_id2'];
		
		for ($i=0; $i < count($tabData); $i++) {

			if ( strlen($tabData[$i]) > 0  ) {

				$_POST['rcardev_tab_data'] = $tabData[$i];
				$_POST['rcardev_tab_personal_id0'] = $tabPersonalId0[$i];
				$_POST['rcardev_tab_trasa'] = $tabTrasa[$i];
				$_POST['rcardev_tab_cel'] = $tabCel[$i];
				$_POST['rcardev_tab_personal_id1'] = $tabPersonalId1[$i];
				$_POST['rcardev_tab_ostanl'] = $tabOstanl[$i];
				$_POST['rcardev_tab_pstanl'] = $tabPstanl[$i];
				$_POST['rcardev_tab_dev'] = $tabDev[$i];
				$_POST['rcardev_tab_personal_id2'] = $tabPersonalId0[$i];


				dbAdd($connection, $tName, $csh, $pKL);

			} 
		}

		$tName = 'rcardev_common2';
		$csh = 'personal_id0,personal_id1,msc,data,personal_id2,rcardev_id';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);
		theTable($connection);

	}

	//theTable($connection);

} else {


	if ( isset($_GET['action']) && ( $_GET['action'] === 'del' ) ) {

		$mode = 'dryrun';
		$del_id = $_GET['id'];
		$tName = 'rcardev_common';
		$whereValue = 'id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		$tName = 'rcardev_vehicle';
		$whereValue = 'rcardev_id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		$tName = 'rcardev_usage';
		$whereValue = 'rcardev_id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		$tName = 'rcardev_pompa';
		$whereValue = 'rcardev_id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		$tName = 'rcardev_web';
		$whereValue = 'rcardev_id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		$tName = 'rcardev_fuel1';
		$whereValue = 'rcardev_id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		$tName = 'rcardev_fuel2';
		$whereValue = 'rcardev_id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		$tName = 'rcardev_tab';
		$whereValue = 'rcardev_id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		$tName = 'rcardev_common2';
		$whereValue = 'rcardev_id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		theTable($connection);

	} else if ( isset($_GET['action']) && ( $_GET['action'] === 'load' ) ) {

		$load_id = $_GET['id'];

		$tName = 'rcardev_common';
		$csh = '*';
		$whereValue = 'id=' . $load_id;

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'rcardev_vehicle';
		$whereValue = 'rcardev_id=' . $load_id;

		$result1 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'rcardev_usage';
		$result2 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'rcardev_pompa';
		$result3 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'rcardev_web';
		$result4 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'rcardev_fuel1';
		$result5 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'rcardev_fuel2';
		$result6 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'rcardev_tab';
		$result8 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'rcardev_common2';
		$result9 = prepareForm($connection, $tName, $csh, $whereValue);

		include('forms/docs_road_card_dev_mod.php');

	} else {
		

		echo "<div id=\"form\">";

			$tName = 'vehicle_about';
			$csh='id,nazwa';
			$whereValue='true';

			$result = prepareForm($connection, $tName, $csh, $whereValue);

				if ( mysqli_num_rows($result) > 0 ) {

					echo "<form action=\"index.php?page=docs_rcardev&action=new\" method=\"post\">";
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
