<?php

if ( count($_POST) > 0 )  {

	if ( $_POST['typ'] === 'ind' ) {

	  $currentDate = date('Y-m-d');

	$query = "SELECT personal_id, data_exp, nazwa FROM str_szk WHERE data_exp > '$currentDate'
        	  UNION SELECT personal_id, data_exp, nazwa FROM str_bad WHERE data_exp > '$currentDate';";

	} else {
		$lDni = $_POST['liczbadni'];
		$currentDate = date('Y-m-d');
		$date = date_create($currentDate);
	 	date_add($date, date_interval_create_from_date_string($lDni . ' days'));
	  $endDate = date_format($date, 'Y-m-d');

	  $query = "SELECT personal_id, data_exp, nazwa FROM str_szk WHERE data_exp > '$currentDate' AND data_exp <= '$endDate'
        	    UNION SELECT personal_id, data_exp, nazwa FROM str_bad WHERE data_exp > '$currentDate' AND data_exp <= '$endDate';";

	}
	$result = mysqli_query($connection, $query);
	if ( mysqli_num_rows($result) > 0 ) {

	echo "<table class=\"moduleTable\">
			<tr class=\"nonParityTableRow\">
			<th class=\"tableHeaderCell\">Imię</th>
			<th class=\"tableHeaderCell\">Nazwisko</th>
			<th class=\"tableHeaderCell\">Termin</th>
			<th class=\"tableHeaderCell\">Nazwa terminu</th>
			</tr>";

		$rcount = 2;

		  while ( $row = mysqli_fetch_row($result) ) {

			if ( $rcount % 2 === 0 ) {
				echo "<tr class=\"parityTableRow\">";
			} else {
				echo "<tr class=\"nonParityTableRow\">";
			}

      			$tName = 'str_do';
			 $csh = 'imie,nazwisko';
     			 $whereValue = 'id=' . $row[0];

      			$result1 = prepareForm($connection, $tName, $csh, $whereValue);
      			$row1 = mysqli_fetch_row($result1);

      			$row[1] = convertData($row[1], 'd');

     			 echo "<td class=\"tableDataCell\">" . $row1[0] . "</td>";
      			echo "<td class=\"tableDataCell\">" . $row1[1] . "</td>";
      			echo "<td class=\"tableDataCell\">" . $row[1] . "</td>";
      			echo "<td class=\"tableDataCell\">" . $row[2] . "</td>";

				  echo "</tr>";
				  
			$rcount++;
 		 }
	} else {
  		echo "<h3>Brak danych do wyświetlenia</h3>";
	}			
} else {

	echo "<div id=\"form\">";
		include('forms/reminder.php');
	echo "</div>
		<hr id=\"theline\">
		<div id=\"result\"></div>";
		
}
 ?>
