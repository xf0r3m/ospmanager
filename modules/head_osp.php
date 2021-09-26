<?php

function theForm($connection)
{

	$tName = 'h_osp';
	$csh = "*";
	$whereValue = "true";
	$result0 = prepareForm($connection, $tName, $csh, $whereValue);

	if ( mysqli_num_rows($result0) > 0 ) {
		include('forms/head_osp_mod.php');
	} else {
		include('forms/head_osp.php');
	}

}

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

		$mod_id = $_GET['id'];

		$tName = 'h_osp';
		$csh = 'msc,rok';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'id=' . $mod_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

	} else {

		$tName = 'h_osp';
		$csh = 'msc,rok';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

	}
		theForm($connection);
		echo "<hr id=\"theline\">";

} else {

	echo "<div id=\"form\">";
		theForm($connection);
	echo "</div>";
	echo "<hr id=\"theline\">";

}

 ?>
