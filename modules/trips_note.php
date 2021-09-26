<?php

function theForm ($connection, $trips_id) {
				echo "<div id=\"form\">";

				$tName = 't_note';
				$csh = 'id,note,trips_id';
				$whereValue = 'trips_id=' . $trips_id;

				$result = prepareForm($connection, $tName, $csh, $whereValue);

				if ( mysqli_num_rows($result) > 0 ) {

					include('forms/trips_note_mod.php');

				} else {		

					include('forms/trips_note.php');
				}
			echo "</div>";

}

if ( ! isset($_GET['trips_id']) ) {
	$tName = 't_about';
	$result1 = getLastIdOnTable($connection, $tName);
	$row1 = mysqli_fetch_row($result1);
	$trips_id = $row1[0];

} else {
	$trips_id = $_GET['trips_id'];
}

if ( $trips_id === NULL ) {

	echo "<div id=\"startinfo\"><h1>Aby móc dodać notatkę z wyjazdu gospodarczego, 
			na początku należy zdefiniować sam wyjazd</h1></div>";

} else {

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ($_GET['action'] === 'mod') ) {

		$mod_id = $_GET['id'];
		$tName = 't_note';
		$csh = 'note';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'id=' . $mod_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

	} else {

		$tName = 't_note';
		$csh = 'note,trips_id';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

	}
		theForm($connection, $_POST['t_note_trips_id']);

} else {

	if ( isset($_GET['action']) && ($_GET['action'] === 'del') ) {

		$del_id = $_GET['id'];
		$tName = 't_note';
		$whereValue = 'id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		theForm ($connection, $_GET['trips_id']);

	} else {

		theForm($connection, $trips_id);
		echo "<hr id=\"theline\">";

	}
}

}
 ?>
