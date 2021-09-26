<?php

function theTable($connection) {

	$tName = 'hydrant';
	$csh = 'id,nazwa,sz,dl';
	$whereValue = 'true';

	$result = prepareForm($connection, $tName, $csh, $whereValue);

	if ( mysqli_num_rows($result) > 0 ) {

		echo "<table style=\"width: 100%; border-spacing: 0;\">
			<tr style=\"background-color: #ADBDCE;\">
				<th style=\"padding: 1%;\">Nazwa</th>
				<th style=\"padding: 1%;\">Sz. geograficzna</th>
				<th style=\"padding: 1%;\">Dł. gegraficzna</th>
				<th style=\"padding: 1%;\"colspan=\"2\">Akcja</th>
			</tr>";
		$rcount = 0;
		while( $row = mysqli_fetch_row($result) )  {

			if ( $rcount % 2 === 0 ) {
				echo "<tr style=\"background-color: #748EA8; text-align: center;\">";
			} else {
				echo "<tr style=\"background-color: #ADBDCE; text-align: center;\">";
			}	

			echo "<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\">" . $row[1] . "</td>
				<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\">" . $row[2] . "</td>
				<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\">" . $row[3] . "</td>
				<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\"><a href=\"index.php?page=hydrant&action=mod&id=" . $row[0] . "\">
					<button id=\"m_button\">
						<img id=\"m_image\" src=\"resources/edit.png\" />
					</button>
				</a>
				</td>
				<td style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\"><a href=\"index.php?page=hydrant&action=del&id=" . $row[0] . "\">
					<button id=\"d_button\">
						<img id=\"d_image\" src=\"resources/delete.png\" />
					</button>
				</a>
				</td>
			</tr>";
		$rcount++;
				
		}

		echo "</table>";
		
	} else {
		
		echo "<h3>Brak danych do wyświetlenia</h3>";
	}

}

if ( count($_POST) > 0 ) {


	if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {
	
		$tName = 'hydrant';
		$csh = 'nazwa,sz,dl';
		$pKL = generatePKL($tName, $csh);
		$whereValue = 'id=' . $_POST['hydrant_id'];

		dbMod($connection, $tName, $csh, $pKL, $whereValue);		


	} else {

		$tName = 'hydrant';
		$csh = 'nazwa,sz,dl';
		$pKL = generatePKL($tName, $csh);

		dbAdd($connection, $tName, $csh, $pKL);
	
	}
	theTable($connection);

} else {

	if ( isset($_GET['action']) && ( $_GET['action'] === 'del' ) ) {

		$del_id = $_GET['id'];

		$tName = 'hydrant';
		$whereValue = 'id=' . $del_id;

		dbDel($connection, $tName, $whereValue);

		theTable($connection);
	
	} else if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {
		$mod_id = $_GET['id'];

		$tName = 'hydrant';
		$csh = 'nazwa,sz,dl';
		$whereValue = 'id=' . $mod_id;

		$result = prepareForm($connection, $tName, $csh, $whereValue);
		include('forms/hydrant_mod.php');

	} else {

		echo "<div id=\"form\">";

			include('forms/hydrant.php');
			
		echo "</div>
			<hr id=\"theline\">
			<div id=\"result\">";

		theTable($connection);

		echo "</div>";
	
	
	}

}
