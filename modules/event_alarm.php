<?php

	function theTable($connection, $event_id) {

		$tName = 'e_alarm';
		$csh = 'personal_id,id';
		$whereValue = "event_id=" . $event_id;
		$result2 = prepareForm($connection, $tName, $csh, $whereValue);
		if ( mysqli_num_rows($result2) ) {
			echo "<table class=\"moduleTable\">
			<tr class=\"nonParityTableRow\">
			<th class=\"tableHeaderCell\">Strażak</th>
			<th class=\"tableHeaderCell\">Akcja</th></tr>";
			$rcount=2;
				while ( $row2 = mysqli_fetch_row($result2) ) {
					if ( $rcount % 2 === 0 ) {
						echo "<tr class=\"parityTableRow\">";
					} else {
						echo "<tr class=\"nonParityTableRow\">";
					}

					echo "<td class=\"tableDataCell\">";

						$tName = 'str_do';
						$csh = 'imie,nazwisko';
						$whereValue = 'id=' . $row2[0];
						$result3 = prepareForm($connection, $tName, $csh, $whereValue);
						$row3 = mysqli_fetch_row($result3);

						echo $row3[0] . " " . $row3[1];

					echo "</td>
					<td class=\"tableDataCell\">
					<a href=\"index.php?page=event_alarm&action=del&id=" . $row2[1] . "&event_id=" . $event_id . "\">
					<button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button></a></td></tr>";

					$rcount++;
				}
				echo "</table>";
	} else {
			echo "<h3>Brak danych do wyświetlenia</h3>";
	}

}

	if ( ! isset($_GET['event_id']) ) {
			$tName = 'e_about';
			$result0 = getLastIdOnTable($connection, $tName);
			$row0 = mysqli_fetch_row($result0);
			$event_id = $row0[0];
	} else {
			$event_id = $_GET['event_id'];
	}

	if ( $event_id === NULL ) {

				echo "<div id=\"startinfo\"><h1>Aby móc dodać przybyłych na alarm,
				na początku należy zdefiniować samą akcje</h1></div>";

	} else {

	if ( count($_POST) > 0 ) {

		$tName = "e_alarm";
		$csh = "personal_id,event_id";
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);
		theTable($connection, $_POST['e_alarm_event_id']);

	} else {

		if ( isset($_GET['action']) && ( $_GET['action'] === "del" ) ) {

			$del_id = $_GET['id'];
			$tName = 'e_alarm';
			$whereValue = "id=" . $del_id;

			dbDel($connection, $tName, $whereValue);
			theTable($connection, $event_id);

		} else {


			echo "<div id=\"form\">";

			$tName = 'str_do';
			$csh = 'id,imie,nazwisko';
			$whereValue = "id IN (SELECT id FROM str_str WHERE udzwakc='Nie bierze')";

			$result1 = prepareForm($connection, $tName, $csh, $whereValue);
			include('forms/event_alarm.php');

			echo "</div>
						<hr id=\"theline\" />
						<div id=\"result\">";
						theTable($connection, $event_id);
				echo "</div>";
	}
}
}


 ?>
