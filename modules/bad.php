<?php

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

		$mod_id = $_GET['id'];
		$tName = 'str_bad';
		$csh = 'nazwa,data_bad,data_exp,nr_zaswiadczenia,uwagi,personal_id';
		$pKL = generatePKL($tName, $csh);
		$whereValue = "id=" . $mod_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

	} else {

		$tName = 'str_bad';
		$csh = 'nazwa,data_bad,data_exp,nr_zaswiadczenia,uwagi,personal_id';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

	}

	$p0 = 6;
	$t0 = 'str_do';
	$tName = 'str_bad';
	$th = "Strażak,Nazwa,Data badania,Data ważności,Zaświadczenie,Uwagi";
	$t0cols = 'imie,nazwisko';

	potoTables($connection, $p0, $t0, $tName, $th, $t0cols);


} else {


if ( isset($_GET['action']) && ( $_GET['action'] === 'del' ) ) {

	$del_id = $_GET['id'];
	$tName = 'str_bad';
	$whereValue = "id=" . $del_id;

	dbDel($connection, $tName, $whereValue);

	$p0 = 6;
	$t0 = 'str_do';
	$tName = 'str_bad';
	$th = "Strażak,Nazwa,Data badania,Data ważności,Zaświadczenie,Uwagi";
	$t0cols = 'imie,nazwisko';

	potoTables($connection, $p0, $t0, $tName, $th, $t0cols);

} else if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

	$mod_id = $_GET['id'];
	$p0 = 6;
	$t0 = 'str_do';
	$tName = 'str_bad';
	$whereValue = 'id=' . $mod_id;
	$t0cols = 'id,imie,nazwisko';
	$formPath = 'forms/addfew_bad_mod.php';
	$csh = 'id,nazwa,data_bad,data_exp,nr_zaswiadczenia,uwagi,personal_id';

	preparePOTOForm($connection, $p0, $t0, $tName, $whereValue, $t0cols, $formPath, $csh);

} else {

	$csh = "id,imie,nazwisko";
	$tName = "str_do";
	$whereValue = 'true';

	$result0 = prepareForm($connection, $tName, $csh, $whereValue);
	echo "<div id=\"form\">";
	include('forms/addfew_bad_add.php');
	echo "</div>";
	echo "<hr id=\"theline\" />";
	echo "<div id=\"result\">";

	$p0 = 6;
	$t0 = 'str_do';
	$tName = 'str_bad';
	$th = "Strażak,Nazwa,Data badania,Data ważności,Zaświadczenie,Uwagi";
	$t0cols = 'imie,nazwisko';

	potoTables($connection, $p0, $t0, $tName, $th, $t0cols);

	echo "</div>";

}
}
?>
