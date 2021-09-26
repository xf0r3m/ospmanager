<?php

function theForm($connection, $event_id) {
	$tName = 'e_note';
	$csh = 'id,note,event_id';
	$whereValue = 'event_id=' . $event_id;

	$result = prepareForm($connection, $tName, $csh, $whereValue);
	if ( mysqli_num_rows($result) > 0 ) {
		include('forms/event_note_mod.php');
	} else {
		include('forms/event_note.php');
	}
}

if ( ! isset($_GET['event_id']) ) {
	$tName = 'e_about';
	$result1 = getLastIdOnTable($connection, $tName);
	$row1 = mysqli_fetch_row($result1);
	$event_id = $row1[0];
} else {
	$event_id = $_GET['event_id'];
}

if ( $event_id === NULL ) {

	echo "<div id=\"startinfo\"><h1>Aby móc dodać notatkę do akcji
	na początku należy zdefiniować samą akcje</h1></div>";

} else {

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ($_GET['action'] === 'mod') ) {

		$mod_id = $_GET['id'];
		$tName = 'e_note';
		$csh = 'note';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'id=' . $mod_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

	} else {

		$tName = 'e_note';
		$csh = 'note,event_id';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);
	}

	theForm($connection, $_POST['e_note_event_id']);

} else {

	if ( isset($_GET['action']) && ($_GET['action'] === 'del') ) {

		$del_id = $_GET['id'];
		$tName = 'e_note';
		$whereValue = 'id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		theForm($connection, $_GET['event_id']);

	} else {

			echo "<div id=\"form\">";
			theForm($connection, $event_id);
			echo "</div>";
	}
}
}

 ?>
