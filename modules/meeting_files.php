<?php

function theTables($connection, $meet_id) {

	$tName = 'm_files';
	$csh = 'id,nazwa,format,informacje';
	$whereValue = 'meet_id=' . $meet_id;

	$result = prepareForm($connection, $tName, $csh, $whereValue);
	if ( mysqli_num_rows($result) > 0 ) {

		echo "<table class=\"moduleTable\">
					<tr class=\"nonParityTableRow\">
					<th class=\"tableHeaderCell\">Nazwa</th>
					<th class=\"tableHeaderCell\">Format</th>
					<th class=\"tableHeaderCell\">Informacje</th>
					<th class=\"tableHeaderCell\">Usuń</th>
					</tr>";
		$rcount = 2;

		while ( $row = mysqli_fetch_row($result) ) {

			if ( $rcount % 2 === 0 ) {
				echo "<tr class=\"parityTableRow\">";
			} else {
				echo "<tr class=\"nonParityTableRow\">";
			}

			echo "<td class=\"tableDataCell\">
			<a class=\"link\" href=\"files/" . $row[1] . "\">" . $row[1] . " </td>
			<td class=\"tableDataCell\">" . $row[2] . "</td>
			<td class=\"tableDataCell\">" . $row[3] . "</td>
			<td class=\"tableDataCell\"><a href=\"index.php?page=meeting_files&action=del&name=" . $row[1] . "&id=" . $row[0] . "&meeting_id=" . $meet_id . "\">
			<button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button>
			</a></td></tr>";

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
		<h1>Aby móć dodać pliki, należy na początku zdefiniować zebranie, którego te pliki mają dotyczyć</h1>
		</div>";
} else {

if ( count($_POST) > 0 ) {

	$meet_id = $_POST['m_files_meet_id'];

    $tName = 'm_files';
    $csh = 'nazwa,format,informacje,meet_id';
    $pKL = generatePKL($tName, $csh);

    $_POST['m_files_nazwa'] = $_FILES['plik']['name'];
    //$_POST['m_files_format'] = $_FILES['plik']['type'];

    move_uploaded_file($_FILES['plik']['tmp_name'], 'files/' . $_FILES['plik']['name']);

    dbAdd($connection, $tName, $csh, $pKL);
   	theTables($connection, $meet_id);

} else {

  if ( isset($_GET['action']) && ( $_GET['action'] === 'del' ) ) {

      $del_id=$_GET['id'];
      $tName = 'm_files';
      $whereValue = 'id=' . $del_id;

      dbDel($connection, $tName, $whereValue);

      $filename = $_GET['name'];
      unlink('files/' . $filename);

      theTables($connection, $meet_id);
  } else {

			echo "<div id=\"form\">";
      	include('forms/meeting_files.php');
			echo "</div>
						<hr id=\"theline\">
						<div id=\"result\">";
			theTables($connection, $meet_id);
			echo "</div>";
  }

  }
}

 ?>
