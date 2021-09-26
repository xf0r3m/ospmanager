<?php

function theTables($connection, $meet_id) {

	$tName = 'm_member';
	$th = 'Imię,Nazwisko,Funkcja';
	$csh = 'id,personal_id,funkcja';
	$whereValue = "meet_id=" . $meet_id;
	$result = prepareForm($connection, $tName, $csh, $whereValue);

	if ( mysqli_num_rows($result) > 0 ) {

			echo "<table class=\"moduleTable\">
            <tr class=\"nonParityTableRow\">
            <th class=\"tableHeaderCell\">Imię</th>
            <th class=\"tableHeaderCell\">Nazwisko</th>
            <th class=\"tableHeaderCell\">Funkcja</th>
            <th class=\"tableHeaderCell\" colspan=\"2\">Akcja</th></tr>";

        $rcount = 2;

			while ( $row = mysqli_fetch_row($result) )  {

					$tName = 'str_do';
					$csh = 'imie,nazwisko';
					$whereValue = 'id=' . $row[1];

					$result1 = prepareForm($connection, $tName, $csh, $whereValue);
					if ( mysqli_num_rows($result1) > 0 ) {
              $row1 = mysqli_fetch_row($result1);
              
              if ( $rcount % 2 === 0 ) {
                echo "<tr class=\"parityTableRow\">";
              } else {
                echo "<tr class=\"nonParityTableRow\">";
              }

							echo "<td class=\"tableDataCell\">" . $row1[0] . "</td>
										<td class=\"tableDataCell\">" . $row1[1] . "</td>
										<td class=\"tableDataCell\">" . $row[2] . "</td>
										<td class=\"tableDataCell\"><a href=\"index.php?page=meeting_member&action=mod&id=" . $row[0] . "\">
										<button id=\"m_button\"><img id=\"m_image\" src=\"resources/edit.png\" /></button>
										</a></td>
										<td class=\"tableDataCell\"><a href=\"index.php?page=meeting_member&action=del&id=" . $row[0] . "\">
										<button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button>
                    </a></td></tr>";
                    
              $rcount++;
					} else {
							echo "<h3>Brak strażaków w bazie</h3>"; exit;
					}
			}

		echo "</table>";
	} else {
		echo "<h2>Brak danych do wyświetlenia</h2>";
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
  	    echo "<div id=\"startinfo\"><h1>Aby móc dodać uczestników, należy na początku dodać zebranie, którego członkowie mają dotyczyć</h1></div>";
} else {

if ( count($_POST) > 0 ) {

	$meet_id = $_POST['m_member_meet_id'];

  if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

      $mod_id = $_GET['id'];
      $tName = 'm_member';
      $csh = 'personal_id,funkcja';
      $pKL = generatePKL($tName, $csh);
      $whereValue = 'id=' . $mod_id;

      dbMod($connection, $tName, $csh, $pKL, $whereValue);

  } else {

      $tName = 'm_member';
      $csh = 'personal_id,funkcja,meet_id';
      $pKL = generatePKL($tName, $csh);

      dbAdd($connection, $tName, $csh, $pKL);
  }

	theTables($connection, $meet_id);

} else {

  if ( isset($_GET['action']) && ( $_GET['action'] === 'del' ) ) {

    $del_id = $_GET['id'];
    $tName = 'm_member';
    $whereValue = 'id=' . $del_id;

    dbDel($connection, $tName, $whereValue);

		theTables($connection, $meet_id);

  } else if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

    $mod_id = $_GET['id'];
    $tName = 'm_member';
    $csh = 'personal_id,funkcja,meet_id';
    $whereValue = 'id=' . $mod_id;

    $result = prepareForm($connection, $tName, $csh, $whereValue);
    $row = mysqli_fetch_row($result);

    $tName = 'str_do';
    $csh = 'id,imie,nazwisko';
    $whereValue = 'true';
    $result1 = prepareForm($connection, $tName, $csh, $whereValue);

    include('forms/meeting_member_mod.php');

  } else {

    echo "<div id=\"form\">";

      $tName = 'str_do';
      $csh = 'id,imie,nazwisko';
      $whereValue = 'true';
      $result = prepareForm($connection, $tName, $csh, $whereValue);

      include('forms/meeting_member.php');

    echo "</div>
          <hr id=\"theline\">
          <div id=\"result\">";
		theTables($connection, $meet_id);
    echo "</div>";
  }

}

}

 ?>
