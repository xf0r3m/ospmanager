<?php

function theTables($connection) {

	$tName='eqec_common';
	$csh='serial,starts,ends,id';
	$whereValue='true';

	$result0 = prepareForm($connection, $tName, $csh, $whereValue);

	if ( mysqli_num_rows($result0) > 0 ) {

		echo "<table style=\"width: 100%; border-spacing: 0;\">
			<tr style=\"background-color: #ADBDCE;\">
			<th style=\"padding: 1%;\">Seria</th><th style=\"padding: 1%;\" colspan=\"2\">Okres karty</th><th style=\"padding: 1%;\" colspan=\"2\">Akcja</th>
			</tr>";

		$rcount = 0;
		while ( $row0 = mysqli_fetch_row($result0) ) {
			if ( $rcount % 2 === 0 ) {
				
				echo "<tr style=\"background-color: #748EA8; text-align: center;\">";

			} else {

				echo "<tr style=\"background-color: #ADBDCE; text-align: center;\">";
			}
		

			echo "
				<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\">" . $row0[0] . "</td>
				<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\">" . $row0[1] . "</td>
				<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\">" . $row0[2] . "</td>
				<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\"><a href=\"index.php?page=docs_eqec&action=load&id=" . $row0[3] . "\"><button id=\"l_button\"><img id=\"l_image\" src=\"resources/load.png\" /></button></a></td>
				<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\"><a href=\"index.php?page=docs_eqec&action=del&id=" . $row0[3] . "\"><button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button></a></td>
				<tr>";

			$rcount++;
		
		}

		echo '</table>';
	} else {
		echo "<h3>Brak zapisanych kart</h3>";	
	}

}

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ( $_GET['action'] === "load" ) ) {

		//var_dump($_POST);

		$eqec_id=$_POST['eqec_common_eqec_id'];

		$tName='eqec_common';
		$csh='serial,starts,ends,marka,typ,rodzaj,nrewi,norma';
		$whereValue='id=' . $eqec_id;
		$pKL=generatePKL($tName,$csh);

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		//echo "UPDATE " . $tName . " SET (serial='" . $_POST['eqec_common_serial'] . "', starts='" . $_POST['eqec_common_starts'] . "', ends='" . $_POST['eqec_common_ends'] . ", marka='" . $_POST['eqec_common_marka'] . "', typ='" . $_POST['eqec_common_typ'] . ", rodzaj='" . $_POST['eqec_common_rodzaj'] . "', nrewi='" . $_POST['eqec_common_nrewi'] . "', norma='" . $_POST['eqec_common_norma'] . "') WHERE " . $whereValue . ";<br />";

		$tName='eqec_usage';
		$csh='id';
		$whereValue='eqec_id=' . $eqec_id;

		$result1=prepareForm($connection, $tName, $csh, $whereValue);
		$countRows=mysqli_num_rows($result1);

		if ( mysqli_num_rows($result1) > 0 ) {

			$usageData=$_POST['eqec_usage_data'];
			$usageNazwisko=$_POST['eqec_usage_nazwisko'];
			$usageMinuty=$_POST['eqec_usage_minuty'];
			$usageUzycie=$_POST['eqec_usage_uzycie'];
			$usagePersonalId=$_POST['eqec_usage_personal_id'];

			
			while ($row1=mysqli_fetch_row($result1)) {

				$tName='eqec_usage';
				$csh='data,nazwisko,minuty,uzycie,personal_id';
				$pKL=generatePKL($tName, $csh);
				$whereValue='id=' . $row1[0];
				
				if (strlen($usageData[($row1[0] - 1)]) > 0 ) {


					$_POST['eqec_usage_data']=$usageData[($row1[0] - 1)];
					$_POST['eqec_usage_nazwisko']=$usageNazwisko[($row1[0] - 1)];
					$_POST['eqec_usage_minuty']=$usageMinuty[($row1[0] - 1)];
					$_POST['eqec_usage_uzycie']=$usageUzycie[($row1[0] - 1) ];
					$_POST['eqec_usage_personal_id']=$usagePersonalId[($row1[0] - 1)];
					dbMod($connection, $tName, $csh, $pKL, $whereValue);
					//echo "UPDATE " . $tName . " SET (data='" . $_POST['eqec_usage_data'] . "', nazwisko='" . $_POST['eqec_usage_nazwisko'] . "', minuty='" . $_POST['eqec_usage_uzycie'] . "', personal_id='" . $_POST['eqec_usage_personal_id'] . "') WHERE " . $whereValue . ";<br />";

				}

			}

			if ( $usageData > $countRows ) {

				$tName = 'eqec_usage';
				$csh = 'data,nazwisko,minuty,uzycie,personal_id,eqec_id';
				$pKL = generatePKL($tName, $csh);

				
				for ( $i=($countRows); $i < count($usageData); $i++ ) {


					if ( strlen($usageData[$i]) > 0 ) {

						$_POST['eqec_usage_data']=$usageData[$i];
						$_POST['eqec_usage_nazwisko']=$usageNazwisko[$i];
						$_POST['eqec_usage_minuty']=$usageMinuty[$i];
						$_POST['eqec_usage_uzycie']=$usageUzycie[$i];
						$_POST['eqec_usage_personal_id']=$usagePersonalId[$i];
						$_POST['eqec_usage_eqec_id']=$eqec_id;
						dbAdd($connection, $tName, $csh, $pKL);
					
					}

				}

		

			}

		}

		$tName='eqec_fuel';
		$csh='id';
		$whereValue='eqec_id=' . $eqec_id;

		$result2=prepareForm($connection, $tName, $csh, $whereValue);
		$countRows=mysqli_num_rows($result2);

		if ( mysqli_num_rows($result2) > 0 ) {
		
			$fuelData=$_POST['eqec_fuel_data'];
			$fuelFaktura=$_POST['eqec_fuel_faktura'];
			$fuelPaliwo=$_POST['eqec_fuel_paliwo'];
			$fuelPersonalId=$_POST['eqec_fuel_personal_id'];

			while ( $row2=mysqli_fetch_row($result2) ) {

				$tName='eqec_fuel';
				$csh='data,faktura,paliwo,personal_id';
				$pKL=generatePKL($tName, $csh);
				$whereValue='id=' . $row2[0];

				if ( strlen($fuelData[($row2[0] - 1)]) > 0 ) {

					$_POST['eqec_fuel_data']=$fuelData[($row2[0] - 1)];
					$_POST['eqec_fuel_faktura']=$fuelFaktura[($row2[0] - 1)];
					$_POST['eqec_fuel_paliwo']=$fuelPaliwo[($row2[0] - 1)];
					$_POST['eqec_fuel_personal_id']=$fuelPersonalId[($row2[0] - 1)];						
					dbMod($connection, $tName, $csh, $pKL, $whereValue);

					//echo "UPDATE eqec_fuel SET (data='" . $_POST['eqec_fuel_data'] . "', faktura='" . $_POST['eqec_fuel_faktura'] . "', paliwo='" . $_POST['eqec_fuel_paliwo'] . "', personal_id='" . $_POST['eqec_fuel_personal_id'] . "') WHERE " . $whereValue . ";<br />";

				}


			}

			if ( $fuelData > $countRows ) {
			
				$tName = 'eqec_fuel';
				$csh = 'data,faktura,paliwo,personal_id,eqec_id';
				$pKL = generatePKL($tName, $csh);

				for ($i=($countRows); $i < count($fuelData); $i++) {

				
					if ( strlen($fuelData[$i]) > 0 ) {
					
						$_POST['eqec_fuel_data']=$fuelData[$i];
						$_POST['eqec_fuel_faktura']=$fuelFaktura[$i];
						$_POST['eqec_fuel_paliwo']=$fuelPaliwo[$i];
						$_POST['eqec_fuel_personal_id']=$fuelPersonalId[$i];
						$_POST['eqec_fuel_eqec_id']=$eqec_id;


						dbAdd($connection, $tName, $csh, $pKL);
					}
				
				}	
			}

		}

		$tName='eqec_common2';
		$csh='id';
		$whereValue='eqec_id=' . $eqec_id;

		$result3=prepareForm($connection, $tName, $csh, $whereValue);

		if ( mysqli_num_rows($result3) > 0 ) {

			$row3=mysqli_fetch_row($result3);
			
			$tName='eqec_common2';
			$csh='pozostalo0,pobrano,razem0,minut,uzycie0,rozruch,uzycie1,razem1,pozostalo1,personal_id0,personal_id1';
			$pKL=generatePKL($tName, $csh);
			$whereValue='id=' . $row3[0];

			dbMod($connection,$tName,$csh,$pKL, $whereValue);

			//echo "UPDATE eqec_common2 SET (pozostalo0='" . $_POST['eqec_common2_pozostalo0'] . "', pobrano='" . $_POST['eqec_common2_pobrano'] . "', razem0='" . $_POST['eqec_common2_razem0'] . "', minut='" . $_POST['eqec_common2_minut'] . "', uzycie0='" . $_POST['eqec_common2_uzycie0'] . "', rozruch='" . $_POST['eqec_common2_rozruch'] . "', uzycie1='" . $_POST['eqec_common2_uzycie1'] . "', razem1='" . $_POST['eqec_common2_razem1'] . "', pozostalo1='" . $_POST['eqec_common2_pozostalo1'] . "', personal_id0='" . $_POST['eqec_common2_personal_id0'] . "', personal_id1='" . $_POST['eqec_common2_personal_id1'] . "') WHERE " . $whereValue . ";<br />";
 
		}

	} else {

		$tName='eqec_common';
		$csh='serial,starts,ends,marka,typ,rodzaj,nrewi,norma';
		$pKL=generatePKL($tName, $csh);
		
		dbAdd($connection, $tName, $csh, $pKL);

		$tName='eqec_common';
		$csh='id';
		$whereValue='true ORDER BY id DESC LIMIT 1';
		
		$result0=prepareForm($connection, $tName, $csh, $whereValue);
		$row0 = mysqli_fetch_row($result0);
	
		$_POST['eqec_usage_eqec_id']=$row0[0];
		$_POST['eqec_fuel_eqec_id']=$row0[0];
		$_POST['eqec_common2_eqec_id']=$row0[0];

		$tName='eqec_usage';
		$csh='data,nazwisko,minuty,uzycie,personal_id,eqec_id';
		$pKL=generatePKL($tName, $csh);

		if ( count($_POST['eqec_usage_data']) > 1 ) {

			$usageDate=$_POST['eqec_usage_data'];
			$usageNazwisko=$_POST['eqec_usage_nazwisko'];
			$usageMinuty=$_POST['eqec_usage_minuty'];
			$usageUzycie=$_POST['eqec_usage_uzycie'];
			$usagePId=$_POST['eqec_usage_personal_id'];

			for ( $i=0; $i < count($usageDate); $i++ ) {
				
				$_POST['eqec_usage_data']=$usageDate[$i];
				$_POST['eqec_usage_nazwisko']=$usageNazwisko[$i];
				$_POST['eqec_usage_minuty']=$usageMinuty[$i];
				$_POST['eqec_usage_uzycie']=$usageUzycie[$i];
				$_POST['eqec_usage_personal_id']=$usagePId[$i];

				if ( strlen($_POST['eqec_usage_data']) > 0 ) {

					//var_dump($_POST['eqec_usage_data']);
					//var_dump($_POST['eqec_usage_nazwisko']);
					//var_dump($_POST['eqec_usage_minuty']);
					//var_dump($_POST['eqec_usage_uzycie']);
					//var_dump($_POST['eqec_usage_personal_id']);

					dbAdd($connection, $tName, $csh, $pKL);

				}

			}

		} else {

			$_POST['eqec_usage_data']=$_POST['eqec_usage_data'][0];
			$_POST['eqec_usage_nazwisko']=$_POST['eqec_usage_nazwisko'][0];
			$_POST['eqec_usage_minuty']=$_POST['eqec_usage_minuty'][0];
			$_POST['eqec_usage_uzycie']=$_POST['eqec_usage_uzycie'][0];
			$_POST['eqec_usage_personal_id']=$_POST['eqec_usage_personal_id'][0];
			
			//var_dump($_POST['eqec_usage_date']);

			dbAdd($connection, $tName, $csh, $pKL);

		}

		$tName='eqec_fuel';
		$csh='data,faktura,paliwo,personal_id,eqec_id';
		$pKL=generatePKL($tName, $csh);

		if ( count($_POST['eqec_fuel_data']) > 1 ) {

			$fuelDate=$_POST['eqec_fuel_data'];
			$fuelFaktura=$_POST['eqec_fuel_faktura'];
			$fuelPaliwo=$_POST['eqec_fuel_paliwo'];
			$fuelPersonalId=$_POST['eqec_fuel_personal_id'];

			for ($i=0; $i < count($fuelDate); $i++ ) {

				$_POST['eqec_fuel_data']=$fuelDate[$i];
				$_POST['eqec_fuel_faktura']=$fuelFaktura[$i];
				$_POST['eqec_fuel_paliwo']=$fuelPaliwo[$i];
				$_POST['eqec_fuel_personal_id']=$fuelPersonalId[$i];

				if ( strlen($_POST['eqec_fuel_data']) > 0 ) {

					//var_dump($_POST['eqec_fuel_date']);
					//var_dump($_POST['eqec_fuel_faktura']);
					//var_dump($_POST['eqec_fuel_paliwo']);
					//var_dump($_POST['eqec_fuel_personal_id']);

					dbAdd($connection, $tName, $csh, $pKL);
							
				} 

			}
		

		} else {

			$_POST['eqec_fuel_data']=$_POST['eqec_fuel_data'][0];
			$_POST['eqec_fuel_faktura']=$_POST['eqec_fuel_faktura'][0];
			$_POST['eqec_fuel_paliwo']=$_POST['eqec_fuel_paliwo'][0];
			$_POST['eqec_fuel_personal_id']=$_POST['eqec_fuel_personal_id'][0];

			dbAdd($connection, $tName, $csh, $pKL);

			#var_dump($_POST['eqec_fuel_date']);
			#var_dump($_POST['eqec_fuel_faktura']);
			#var_dump($_POST['eqec_fuel_paliwo']);
			#var_dump($_POST['eqec_fuel_personal_id']);

		}

		$tName='eqec_common2';
		$csh='pozostalo0,pobrano,razem0,minut,uzycie0,rozruch,uzycie1,razem1,pozostalo1,personal_id0,personal_id1,eqec_id';
		$pKL=generatePKL($tName, $csh);

		#$pKLTable=explode(',', $pKL);
		#for( $i=0; $i < count($pKLTable); $i++ ) {

			//var_dump($_POST[$pKLTable[$i]]);
			dbAdd($connection, $tName, $csh, $pKL);	
		#}


	}

		theTables($connection);

} else {


if ( isset($_GET['action']) && ( $_GET['action'] === 'del' ) ) {
	
	$del_id = $_GET['id'];
	
	$tName="eqec_common";
	$whereValue='id=' . $del_id;

	dbDel($connection, $tName, $whereValue);

	$tName="eqec_usage";
	$whereValue='eqec_id=' . $del_id;

	dbDel($connection, $tName, $whereValue);

	$tName="eqec_fuel";
	dbDel($connection, $tName, $whereValue);

	$tName="eqec_common2";
	dbDel($connection, $tName, $whereValue);

	theTables($connection);

	
} else if ( isset($_GET['action']) && ( $_GET['action'] === 'load' ) ) {

	$load_id = $_GET['id'];
	$whereValue='id=' . $load_id;
	$whereValue2='eqec_id=' . $load_id;

	$tName='eqec_common';
	$csh='*';
	$result0 = prepareForm($connection, $tName, $csh, $whereValue);

	$tName='eqec_usage';
	$csh='*';
	$result1 = prepareForm($connection, $tName, $csh, $whereValue2);
	
	$tName='eqec_fuel';
	$csh='*';
	$result3 = prepareForm($connection, $tName, $csh, $whereValue2);

	$tName='eqec_common2';
	$csh='*';
	$result4 = prepareForm($connection, $tName, $csh, $whereValue2);

	include('forms/docs_eqEngine_card_mod.php');

} else {

	echo "<div id=\"form\">";
		include('forms/docs_eqEngine_card.php');
	echo "</div>
		<hr id=\"theline\">
		<div id=\"result\">";
		theTables($connection);
	echo "</div>";

}

}

?>
