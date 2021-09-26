<?php

function theTables($connection, $trips_id) {

			$tName = 't_vehicle';
			$csh = 'id,kilometry,praca_postuj,praca_autopompa,paliwo,uwagi,vehicle_id';
			$whereValue = 'true';

			$result1 = prepareForm($connection, $tName, $csh, $whereValue);

			if ( mysqli_num_rows($result1) > 0 ) {

				echo "<table class=\"moduleTable\">
				<tr class=\"nonParityTableRow\">
				<th class=\"tableHeaderCell\">Pojazd</th>
				<th class=\"tableHeaderCell\">Kilometry</th>
				<th class=\"tableHeaderCell\">Praca na postoju</th>
				<th class=\"tableHeaderCell\">Praca z autopompą</th>
				<th class=\"tableHeaderCell\">Zużyte paliwo</th>
				<th class=\"tableHeaderCell\">Uwagi</th>
				<th class=\"tableHeaderCell\" colspan=\"2\">Akcja</th></tr>";

				$rcount = 2;

				while ( $row1 = mysqli_fetch_row($result1) ) {
					
					if ( $rcount % 2 === 0 ) {
						echo "<tr class=\"parityTableRow\">";
					} else {
						echo "<tr class=\"nonParityTableRow\">";
					}
					
					echo "<td class=\"tableDataCell\">";

					$tName = 'vehicle_about';
					$csh = 'nazwa';
					$whereValue = 'id=' . $row1[6];
					$result2 = prepareForm($connection, $tName, $csh, $whereValue);
					$row2 = mysqli_fetch_row($result2);

					echo $row2[0] . "</td>";
					echo "<td class=\"tableDataCell\">" . $row1[1] . "</td>
							<td class=\"tableDataCell\">" . $row1[2] . "</td>
							<td class=\"tableDataCell\">" . $row1[3] . "</td>
							<td class=\"tableDataCell\">" . $row1[4] . "</td>
							<td class=\"tableDataCell\">" . $row1[5] . "</td>
							<td class=\"tableDataCell\"><a href=\"index.php?page=trips_vehicle&action=mod&id=" . $row1[0] . "\">
							<button id=\"m_button\"><img id=\"m_image\" src=\"resources/edit.png\" /></button></a></td>
							<td class=\"tableDataCell\"><a href=\"index.php?page=trips_vehicle&action=del&id=" . $row1[0] . "&trips_id=" . $trips_id ."\">
							<button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button></a></td>
							</tr>";
					
					$rcount++;

				}

				echo "</table>";

		} else {
			echo "<h3>Brak danych do wyświetlenia</h3>";
		}

}

if ( ! isset($_GET['trips_id']) ) {

		$tName = 't_about';
		$result = getLastIdOnTable($connection, $tName);
		$row = mysqli_fetch_row($result);
		$trips_id = $row[0];

} else {
		$trips_id = $_GET['trips_id'];
}

if ( $trips_id === NULL ) {

	echo "<div id=\"startinfo\"><h1>Aby móć dodać pojazdy do wyjazdu, na początku należy zdefiniować sam wyjazd</h1></div>";

} else {

if ( count($_POST) > 0 ) {

	if ( isset($_GET['action']) && ( $_GET['action'] === "mod" ) ) {

		$mod_id = $_GET['id'];
		$tName = 't_vehicle';
		$csh = 'kilometry,praca_postuj,praca_autopompa,paliwo,uwagi,vehicle_id,trips_id';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'id=' . $mod_id;

		dbMod($connection, $tName, $csh, $pKL, $whereValue);

	} else {

		$tName = 't_vehicle';
		$csh = 'kilometry,praca_postuj,praca_autopompa,paliwo,uwagi,vehicle_id,trips_id';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);

	}

	theTables($connection, $_POST['t_vehicle_trips_id']);

} else {

	if ( isset($_GET['action']) && ( $_GET['action'] === "del" ) ) {

		$del_id = $_GET['id'];
		$tName = 't_vehicle';
		$whereValue = 'id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		theTables($connection, $_GET['trips_id']);

	} else if ( isset($_GET['action']) && ( $_GET['action'] === "mod" ) ) {

		$mod_id = $_GET['id'];
		$tName = 't_vehicle';
		$csh = '*';
		$whereValue = 'id=' . $mod_id;

		$result1 = prepareForm($connection, $tName, $csh, $whereValue);

		$tName = 'vehicle_about';
		$csh = 'id,nazwa';
		$whereValue = 'true';
		$result2 = prepareForm($connection, $tName, $csh, $whereValue);

		include('forms/trips_vehicle_mod.php');

	} else {

		echo "<div id=\"form\">";

			$tName = 'vehicle_about';
			$csh = 'id,nazwa';
			$whereValue = 'true';

			$result0 = prepareForm($connection, $tName, $csh, $whereValue);

			include('forms/trips_vehicle.php');

		echo "</div>
				<hr id=\"theline\">
				<div id=\"result\">";

				theTables($connection, $trips_id);

		echo "</div>";

		echo "</div>";

	}

}

}

 ?>
