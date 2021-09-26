<?php

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ($_GET['action'] === 'mod') ) {

		$mod_id = $_POST['mod_id'];
		$tName = 'str_do';
		$csh = 'imie,imie2,nazwisko,data_ur,msc_ur,pesel,imie_ojca,plec,zawod,wyksztalcenie,msc_pracy,nr_tel,adres';
		$whereValue = "id=" . $mod_id;

		$pKL = generatePKL($tName, $csh);
		dbMod($connection, $tName, $csh, $pKL, $whereValue);

		$tName = 'str_str';
		$csh = 'rodzaj,stopien,funkcja,nr_legitymacji,data_wst,udzwakc';

		$pKL = generatePKL($tName, $csh);
		dbMod($connection, $tName, $csh, $pKL, $whereValue);

	} else {

		$tName = 'str_do';
		$csh = 'imie,imie2,nazwisko,data_ur,msc_ur,pesel,imie_ojca,plec,zawod,wyksztalcenie,msc_pracy,nr_tel,adres';

		$pKL = generatePKL($tName, $csh);
		dbAdd($connection, $tName, $csh, $pKL);

		$tName = 'str_str';
		$csh = 'rodzaj,stopien,funkcja,nr_legitymacji,data_wst,udzwakc';

		$pKL = generatePKL($tName, $csh);
		dbAdd($connection, $tName, $csh, $pKL);

		$tName = 'str_do';
		$csh = 'id';
		$whereValue = 'id > 0 ORDER BY id DESC LIMIT 1';

		$result = prepareForm($connection, $tName, $csh, $whereValue);
		if ( mysqli_num_rows($result) > 0 ) {

			$row = mysqli_fetch_row($result);
			$id = $row[0];

		}


	}

	$tName = 'str_do';
	$th = "Imię,Nazwisko,Pesel,Msc. Urodzenia,Numer Tel.";
	$csh = "id,imie,nazwisko,pesel,msc_ur,nr_tel";

	tables($connection, $tName, $th, $csh);

} else if ( isset($_GET['action']) && ($_GET['action'] === 'del') ) {

	$del_id = $_GET['id'];
	$tName = 'str_do';
	$whereValue = "id=" . $del_id;

	dbDel($connection, $tName, $whereValue);

	$tName = 'str_str';

	dbDel($connection, $tName, $whereValue);

	$tName = 'str_szk';
	$whereValue = "personal_id=" . $del_id;

	dbDel($connection, $tName, $whereValue);

	$tName = 'str_odz';

	dbDel($connection, $tName, $whereValue);

	$tName = 'str_bad';

	dbDel($connection, $tName, $whereValue);

	$tName = 'str_psl';

	dbDel($connection, $tName, $whereValue);

	$th = "Imię,Nazwisko,Pesel,Msc. Urodzenia,Numer Tel.";
	$csh = "id,imie,nazwisko,pesel,msc_ur,nr_tel";

	tables($connection, 'str_do', $th, $csh);

} else if ( isset($_GET['action']) && ($_GET['action'] === 'mod') ) {

	$mod_id = $_GET['id'];
	$whereValue = "id=" . $mod_id;
	$csh = 'id,imie,imie2,nazwisko,data_ur,msc_ur,pesel,imie_ojca,plec,zawod,wyksztalcenie,msc_pracy,nr_tel,adres';

	$result1 = prepareForm($connection, 'str_do', $csh, $whereValue);

	$csh = 'rodzaj,stopien,funkcja,nr_legitymacji,data_wst,udzwakc';

	$result2 = prepareForm($connection, 'str_str', $csh, $whereValue);

	include('forms/firefighters_mod.php');

} else {

	echo "<div id=\"form\">";

	include('forms/firefighters_add.php');

	echo "</div>
				<hr id=\"theline\" />";

	echo "<div id=\"result\" style=\"float: left;\">";
	$th = "Imię,Nazwisko,Pesel,Msc. Urodzenia,Numer Tel.";
	$csh = "id,imie,nazwisko,pesel,msc_ur,nr_tel";

	tables($connection, 'str_do', $th, $csh);
	echo "</div>";

}

 ?>
