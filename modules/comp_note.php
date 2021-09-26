<?php

function theForm ($connection, $comp_id) {

	$tName = 'c_note';
	$csh = 'id,note,comp_id';
	$whereValue = 'comp_id=' . $comp_id;

	$result = prepareForm($connection, $tName, $csh, $whereValue);

	if ( mysqli_num_rows($result) > 0 ) {

		include('forms/comp_note_mod.php');

	} else {  
				
		include('forms/comp_note.php');
	}

}

if ( ! isset($_GET['comp_id']) ) {

	$tName = 'c_about';
	$result1 = getLastIdOnTable($connection, $tName);
	$row1 = mysqli_fetch_row($result1);
	$comp_id = $row1[0];

} else {

	$comp_id = $_GET['comp_id'];
}

if ( $comp_id === NULL ) {

	echo "<div id=\"startinfo\"><h1>Aby mieć możliwość zdefiniowania notatki odnośnie uczestnictwa
				 	w zawodach, należy na początku zdefiniować samo uczestnictwo</h1></div>";

} else {

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ($_GET['action'] === 'mod') ) {

		$mod_id = $_GET['id'];
		$tName = 'c_note';
		$csh = 'note';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'id=' . $mod_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

	} else {

		$tName = 'c_note';
		$csh = 'note,comp_id';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

	}
		theForm($connection, $_POST['c_note_comp_id']);

} else {

	if ( isset($_GET['action']) && ($_GET['action'] === 'del') ) {

		$del_id = $_GET['id'];
		$tName = 'c_note';
		$whereValue = 'id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		theForm($connection, $_GET['comp_id']);

	} else {

		echo "<div id=\"form\">";

			theForm($connection, $comp_id);

		echo "</div>
				<hr id=\"theline\" />";

	}
}
}

 ?>
