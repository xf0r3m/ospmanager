<?php

function theForm($connection, $comp_id) {

	$tName = 'c_score';
	$csh = "msc,sztafeta,pktk_sz,bojowka,pktk_bj,pkt";
	$whereValue = "comp_id=" . $comp_id;

	$result0 = prepareForm($connection, $tName, $csh, $whereValue);

	if ( mysqli_num_rows($result0) > 0 ) {
			
		include("forms/comp_score_mod.php");

	} else {

		include('forms/comp_score.php');

	}

}

if ( ! isset($_GET['comp_id']) ) {

	$tName = 'c_about';
	$result0 = getLastIdOnTable($connection, $tName);
	$row0 = mysqli_fetch_row($result0);
	$comp_id = $row0[0];

} else {
	$comp_id = $_GET['comp_id'];
}

if ( $comp_id === NULL ) {

	echo "<div id=\"startinfo\"><h1>Aby mieć możliwość zdefiniowania wyników zawodów, na początku
	należy zdefiniować uczestnictwo w zawodach</h1></div>";

} else {

if ( count($_POST) > 0 ) {

	if ( isset($_GET['comp_id']) ) {

		$mod_id = $_GET['comp_id'];
		$tName = 'c_score';
		$csh = "msc,sztafeta,pktk_sz,bojowka,pktk_bj,pkt";
		$pKL = generatePKL($tName, $csh);
		$whereValue = "comp_id=" . $mod_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

	} else {

		$tName = 'c_score';
		$csh = "msc,sztafeta,pktk_sz,bojowka,pktk_bj,pkt,comp_id";
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

	}

	theForm($connection, $comp_id);
	echo "<hr id=\"theline\">";
	
} else {


	echo "<div id=\"form\">";
		theForm($connection, $comp_id);
	echo "</div>
			<hr id=\"theline\">";

}

}

 ?>
