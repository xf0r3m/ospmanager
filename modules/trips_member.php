<?php

function theTable($connection, $trips_id) {

			$tName = 't_member';
			$csh = "personal_id,rozpoczecie,zakonczenie,udzial,pojazd,funkcja,uwagi,id";
			$whereValue = 'trips_id=' . $trips_id;

			$result0 = prepareForm($connection, $tName, $csh, $whereValue);
			if ( mysqli_num_rows($result0) > 0 ) {

				echo "<table class=\"moduleTable\">
				<tr class=\"nonParityTableRow\">
				<th class=\"tableHeaderCell\">Strażak</th>
				<th class=\"tableHeaderCell\">Czas rozpoczęcia</th>
				<th class=\"tableHeaderCell\">Czas zakończenia</th>
				<th class=\"tableHeaderCell\">Czas udziału</th>
				<th class=\"tableHeaderCell\">Pojazd</th>
				<th class=\"tableHeaderCell\">Funkcja</th>
				<th class=\"tableHeaderCell\">Uwagi</th>
				<th class=\"tableHeaderCell\" colspan=\"2\">Akcje</th>";

				$rcount=2;

				while ( $row0 = mysqli_fetch_row($result0) ) {
					if ( $rcount % 2 === 0 ) {
						echo "<tr class=\"parityTableRow\">";
					} else {
						echo "<tr class=\"nonParityTableRow\">";
					}
					echo "<td class=\"tableDataCell\">";

					$tName = "str_do";
					$csh = "imie,nazwisko";
					$whereValue = "id=" . $row0[0];
					$result1 = prepareForm($connection, $tName, $csh, $whereValue);
					$row1 = mysqli_fetch_row($result1);
					echo $row1[0] . " " . $row1[1];

					$row0[1] = convertData($row0[1]);
					$row0[2] = convertData($row0[2]);

					echo "</td><td class=\"tableDataCell\">" . $row0[1] . "</td>
					<td class=\"tableDataCell\">" . $row0[2] . "</td>
					<td class=\"tableDataCell\">" . $row0[3] . "</td>
					<td class=\"tableDataCell\">" . $row0[4] . "</td>
					<td class=\"tableDataCell\">" . $row0[5] . "</td>
					<td class=\"tableDataCell\">" . $row0[6] . "</td>
					<td class=\"tableDataCell\"><a href=\"index.php?page=trips_member&action=mod&id=" . $row0[7] . "\">
					<button id=\"m_button\"><img id=\"m_image\" src=\"resources/edit.png\" /></button></a></td>
					<td class=\"tableDataCell\"><a href=\"index.php?page=trips_member&action=del&id=" . $row0[7] . "&trips_id=" . $trips_id . "\">
					<button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button></a></td></tr>";

					$rcount++;
				}
				echo "</table>";

			} else {
				echo "<h3>Brak danych do wyświetlenia</h3>";
			}
}

if ( ! isset($_GET['trips_id']) ) {

	$tName = 't_about';
	$result2 = getLastIdOnTable($connection, $tName);
	$row2 = mysqli_fetch_row($result2);
	$trips_id = $row2[0];

} else {
	$trips_id = $_GET['trips_id'];
}

if ( $trips_id === NULL ) {

	echo "<div id=\"startinfo\"><h1>Aby móc dodać uczestników wyjazdów,
		na początku należy zdefiniować sam wyjazd</h1></div>";

} else {

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ( $_GET['action'] === "mod" ) ) {

			$mod_id = $_GET['id'];
			$tName = 't_member';
			$csh = "funkcja,rozpoczecie,zakonczenie,udzial,pojazd,uwagi,personal_id";
			$pKL = generatePKL($tName, $csh);
			$whereValue = "id=" . $mod_id;

			dbMod($connection, $tName, $csh, $pKL, $whereValue);


	} else {

			$tName = 't_member';
			$csh = 'funkcja,rozpoczecie,zakonczenie,udzial,pojazd,uwagi,personal_id,trips_id';
			$pKL = generatePKL($tName, $csh);

			dbAdd($connection, $tName, $csh, $pKL);



	}
		theTable($connection, $_POST['t_member_trips_id']);

} else {

	if ( isset($_GET['action']) && ( $_GET['action'] === "del" ) ) {

		$del_id = $_GET['id'];
		$tName = 't_member';
		$whereValue = "id=" . $del_id;

		dbDel($connection, $tName, $whereValue);

		theTable($connection, $_GET['trips_id']);

	} else if ( isset($_GET['action']) && ( $_GET['action'] === "mod" ) ) {

		$mod_id = $_GET['id'];
		$tName = 't_member';
		$csh = "id,funkcja,rozpoczecie,zakonczenie,udzial,pojazd,uwagi,personal_id,trips_id";
		$whereValue= "id=" . $mod_id;

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'str_do';
		$csh = "id,imie,nazwisko";
		$whereValue = "true";

		$result1 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'vehicle_about';
		$csh = "nazwa";
		$whereValue = "true";

		$result2 = prepareForm($connection, $tName, $csh, $whereValue);

		include('forms/trips_member_mod.php');


	} else {

		echo "<div id=\"form\">";

		$tName = 'str_do';
		$csh = "id,imie,nazwisko";
		$whereValue = "true";

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'vehicle_about';
		$csh = "nazwa";
		$whereValue = "true";

		$result1 = prepareForm($connection, $tName, $csh, $whereValue);

		include('forms/trips_member.php');

		echo "</div>
				<hr id=\"theline\">
				<div id=\"result\">";

		theTable($connection, $trips_id);

		echo "</div>";

	}
}

}
 ?>
