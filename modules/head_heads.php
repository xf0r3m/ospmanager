<?php

function theTable($connection) {

	$tName = 'h_head';
	$csh = "id,nazwisko,lata,zawod,szkolenie,uwagi";
	$th = "Imię i Nazwisko<br />naczelnika,Lata sprawowania<br />funkcji,Zawód,Przeszkolenie,Uwagi";
	tables($connection,$tName,$th,$csh);

}

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ( $_GET['action'] === 'mod') ) {

			$mod_id = $_GET['id'];

		$tName = 'h_head';
		$csh = 'nazwisko,lata,zawod,szkolenie,uwagi';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'id=' . $mod_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

	} else {

		$tName = 'h_head';
		$csh = 'nazwisko,lata,zawod,szkolenie,uwagi';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

	}
		theTable($connection);

} else {

	if ( isset($_GET['action']) && ( $_GET['action'] === 'del' ) ) {

		$del_id = $_GET['id'];
		$tName = 'h_head';
		$whereValue = 'id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		theTable($connection);

	} else if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

		$mod_id = $_GET['id'];
		$tName = 'h_head';
		$csh = 'id,nazwisko,lata,zawod,szkolenie,uwagi';
		$whereValue = 'id=' . $mod_id;

		$result = prepareForm($connection,$tName,$csh,$whereValue);
		include('forms/head_heads_mod.php');

	} else {

				echo "<div id=\"form\">";
						include('forms/head_heads.php');
				echo "</div>
					<hr id=\"theline\">
				<div id=\"result\">";
					theTable($connection);
				echo "</div>";

	}
}

 ?>
