<?php

	function theTables($connection, $meet_id) {

		$tName = 'm_guest';
		$csh = 'id,dpguest,pochodzenie';
		$whereValue = 'meet_id=' . $meet_id;

		$result = prepareForm($connection, $tName, $csh, $whereValue);

		if ( mysqli_num_rows($result) > 0 ) {

			echo "<table class=\"moduleTable\">
						<tr class=\"nonParityTableRow\">
						<th class=\"tableHeaderCell\">Imię i nazwisko</th>
						<th class=\"tableHeaderCell\">Pochodzenie gościa</th>
						<th class=\"tableHeaderCell\" colspan=\"2\">Akcja</th>
				</tr>";

			$rcount = 2;

			while ( $row = mysqli_fetch_row($result) ) {

				if ( $rcount % 2 === 0 ) {
					echo "<tr class=\"parityTableRow\">";
				} else {
					echo "<tr class=\"nonParityTableRow\">";
				}

					echo "<td class=\"tableDataCell\">" . $row[1] . "</td><td>" . $row[2] . "</td>
							<td class=\"tableDataCell\"><a href=\"index.php?page=meeting_guest&action=mod&id=" . $row[0] . "\">
							<button id=\"m_button\"><img id=\"m_image\" src=\"resources/edit.png\" /></button>
							</a></td>
							<td class=\"tableDataCell\"><a href=\"index.php?page=meeting_guest&action=del&id=" . $row[0] . "&meeting_id=" . $meet_id . "\">
							<button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button>
							</a></td>
							</tr>";
				$rcount++;

			}

			echo "</table>";

		} else {
			echo "<h3>Brak danych do wyświetlenia</h3>";
		}
}

if ( ! isset($_GET['meeting_id']) ) {
	$meet_result = getLastIdOnTable($connection, 'm_about');
	$meet_row = mysqli_fetch_row($meet_result);
	$meet_id = $meet_row[0];
} else {
	$meet_id = $_GET['meeting_id'];
}

if ( $meet_id === null ) {

	echo "<div id=\"startinfo\">
		<h1>Aby móc dodać gości do zebrania, należy na początku zdefiniować zebranie, do którego tych
			gości należy dodać</h1>
		</div>";

} else {

if ( count($_POST) > 0 ) {

	$meet_id = $_POST['m_guest_meet_id'];

  if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

    $mod_id = $_GET['id'];
    $tName = 'm_guest';
    $csh = 'dpguest,pochodzenie';
    $pKL = generatePKL($tName, $csh);
    $whereValue = 'id=' . $mod_id;

    dbMod($connection, $tName, $csh, $pKL, $whereValue);

  } else {

    $tName = 'm_guest';
    $csh = 'dpguest,pochodzenie,meet_id';
    $pKL = generatePKL($tName, $csh);

    dbAdd($connection, $tName, $csh, $pKL);

  }

	theTables($connection, $meet_id);

} else {

    if ( isset($_GET['action']) && ( $_GET['action'] === 'del' ) ) {

      $del_id = $_GET['id'];
      $tName = 'm_guest';
      $whereValue = 'id=' . $del_id;

      dbDel($connection, $tName, $whereValue);

      theTables($connection, $meet_id);

    } else if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

      $mod_id = $_GET['id'];
      $tName = 'm_guest';
      $csh = 'dpguest,pochodzenie,meet_id';
      $whereValue = 'id= ' . $mod_id;

      $result = prepareForm($connection, $tName, $csh, $whereValue);

      include('forms/meeting_guest_mod.php');

    } else {

			echo "<div id=\"form\">";
				include('forms/meeting_guest.php');
			echo "</div>
						<hr id=\"theline\">
						<div id=\"result\">";
			theTables($connection, $meet_id);
			echo "</div>";

      }

    }

}


 ?>
