<?php

function theTable($connection, $event_id) {

	$tName = 'e_others';
	$csh = '*';
	$whereValue = 'event_id=' . $event_id;

	$result1 = prepareForm($connection, $tName, $csh, $whereValue);

	if ( mysqli_num_rows($result1) > 0 ) {

		echo "<table class=\"moduleTable\">
		<tr class=\"nonParityTableRow\">
		<th class=\"tableHeaderCell\">Nazwa</th>
		<th class=\"tableHeaderCell\">Rodzaj</th>
		<th class=\"tableHeaderCell\">Nr operacyjny</th>
		<th class=\"tableHeaderCell\" colspan=\"2\">Akcja</th></tr>";

		$rcount = 2;
		while ($row1 = mysqli_fetch_row($result1)) {

			if ( $rcount % 2 === 0 ) {
				echo "<tr class=\"parityTableRow\">";
			} else {
				echo "<tr class=\"nonParityTableRow\">";
			}

			echo "<td class=\"tableDataCell\">" . $row1[1] . "</td>
			<td class=\"tableDataCell\">" . $row1[2] . "</td>
			<td class=\"tableDataCell\">" . $row1[3] . "</td>
			<td class=\"tableDataCell\"><a href=\"index.php?page=event_others&action=mod&id=" . $row1[0] . "\" />
			<button id=\"m_button\"><img id=\"m_image\" src=\"resources/edit.png\" /></button></td>
			<td class=\"tableDataCell\"><a href=\"index.php?page=event_others&action=del&id=" . $row1[0] . "&event_id=" . $event_id . "\" />
			<button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button></td>
			</tr>";

			$rcount++;

		}

	} else {
		echo "<h3>Brak danych do wyświetlenia</h3>";
	}

}

if ( ! isset($_GET['event_id']) ) {

	$tName = 'e_about';
	$result = getLastIdOnTable($connection, $tName);
	$row = mysqli_fetch_row($result);
	$event_id = $row[0];

} else {
	$event_id = $_GET['event_id'];
}

if ( $event_id === NULL ) {

	echo "<div id=\"startinfo\"><h1>Aby móc dodać inne służby,
	na początku należy zdefiniować samą akcje</h1></div>";

} else {

if ( count($_POST) > 0 ) {

  if ( isset($_GET['action']) && ($_GET['action'] === 'mod') ) {

    $mod_id = $_GET['id'];
    $tName = 'e_others';
    $csh = 'nazwa,rodzaj,nroperacyjny';
    $pKL = generatePKL($tName, $csh);
    $whereValue = 'id=' . $mod_id;

    dbMod($connection, $tName, $csh, $pKL, $whereValue);
  } else {

    $tName = 'e_others';
    $csh = 'nazwa,rodzaj,nroperacyjny,event_id';
    $pKL = generatePKL($tName, $csh);

    dbAdd($connection, $tName, $csh, $pKL);

  }
  theTable($connection, $event_id);

} else {

  if ( isset($_GET['action']) && ($_GET['action'] === "del") ) {

    $del_id = $_GET['id'];
    $tName = 'e_others';
    $whereValue = 'id=' . $del_id;

    dbDel($connection, $tName, $whereValue);
    theTable($connection, $_GET['event_id']);

  } else if ( isset($_GET['action']) && ($_GET['action'] === "mod") ) {

    $mod_id = $_GET['id'];
    $tName = 'e_others';
    $csh = '*';
    $whereValue = 'id=' . $mod_id;

    $result2 = prepareForm($connection, $tName, $csh, $whereValue);
    include('forms/event_others_mod.php');


  } else {

			echo "<div id=\"form\">";
				include('forms/event_others.php');
			echo "</div>
						<hr id=\"theline\">
						<div id=\"result\">";
			theTable($connection, $event_id);
			echo "</div>";
  }

}
}

 ?>
