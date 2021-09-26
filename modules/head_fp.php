<?php

function theTables($connection) {
	
		$tName = 'h_fpstatus';
		$csh = "*";
		$whereValue = "true";
		$result0 = prepareForm($connection, $tName, $csh, $whereValue);

		if ( mysqli_num_rows($result0) > 0 ) {
			echo "<table class=\"moduleTable\">";
			echo "<tr class=\"nonParityTableRow\">
			<th class=\"tableHeaderCell\" style=\"margin-right: auto; padding: 0;\" rowspan=\"2\">Rok</th>
			<th class=\"tableHeaderCell\" style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\" colspan=\"2\">Budynki</th>
			<th class=\"tableHeaderCell\" style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\" colspan=\"2\">Zaopatrzenie wodne</td>
			<th class=\"tableHeaderCell\" style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\" colspan=\"2\">Zakłady pracy</th>
			<th class=\"tableHeaderCell\" style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\" colspan=\"2\">Łączność OSP</th>
			<th class=\"tableHeaderCell\" style=\"border-left: 1px solid lightgray; border-right: 1px solid lightgray;\" colspan=\"2\">Akcja</th>
			</tr>";
			echo "<tr class=\"parityTableRow\">
			<td class=\"tableDataCell\" style=\"font-weight: bold; border-bottom: 1px solid lightgray;\">Ilość gospodarstw<br />we wsi/dzielnicy</td>
			<td class=\"tableDataCell\" style=\"font-weight: bold; border-bottom: 1px solid lightgray;\">Gospodarstwa o dużym zagrożeniu</td>
			<td class=\"tableDataCell\" style=\"font-weight: bold; border-bottom: 1px solid lightgray;\">Rodzaj - zbiorniki<br />hydranty, stawy<br />rzeki</td>
			<td class=\"tableDataCell\" style=\"font-weight: bold; border-bottom: 1px solid lightgray;\">Ocena stanu zaopatrzeni<br />wystarczające lub nie<br />
					co trzeba wybudować:</td>
			<td class=\"tableDataCell\" style=\"font-weight: bold; border-bottom: 1px solid lightgray;\">Zakłady pracy w miejscowości</td>
			<td class=\"tableDataCell\" style=\"font-weight: bold; border-bottom: 1px solid lightgray;\">Główne zagrożenia w zakładach</td>
			<td class=\"tableDataCell\" style=\"font-weight: bold; border-bottom: 1px solid lightgray;\">Rodzaj łączności<br />telefon,<br />radiostacja, itp.</td>
			<td class=\"tableDataCell\" style=\"font-weight: bold; border-bottom: 1px solid lightgray;\">Co trzeba <br /> poprawić w <br />systemie<br />łączności</td>
			<td class=\"tableDataCell\" style=\"font-weight: bold; border-bottom: 1px solid lightgray;\">Modyfikuj</td>
			<td class=\"tableDataCell\" style=\"font-weight: bold; border-bottom: 1px solid lightgray;\">Usuń</td>
			</tr>";

			$rcount = 2;

			while ( $row0 = mysqli_fetch_row($result0) ) {

				if ( $rcount % 2 === 0 ) {
					echo "<tr class=\"parityTableRow\">";
				} else {
					echo "<tr class=\"nonParityTableRow\">";
				}
				
							echo "<td class=\"tableDataCell\">" . $row0[1] . "</td>
							<td class=\"tableDataCell\">" . $row0[2] . "</td>
							<td class=\"tableDataCell\">" . $row0[3] . "</td>
							<td class=\"tableDataCell\">" . $row0[4] . "</td>
							<td class=\"tableDataCell\">" . $row0[5] . "</td>
							<td class=\"tableDataCell\">" . $row0[6] . "</td>
							<td class=\"tableDataCell\">" . $row0[7] . "</td>
							<td class=\"tableDataCell\">" . $row0[8] . "</td>
							<td class=\"tableDataCell\">" . $row0[9] . "</td>
							<td class=\"tableDataCell\"><a href=\"index.php?page=head_fp&action=mod&id=" . $row0[0] . "\">
							<button id=\"m_button\"><img id=\"m_image\" src=\"resources/edit.png\" /></button>
							</a></td>
							<td class=\"tableDataCell\"><a href=\"index.php?page=head_fp&action=del&id=" . $row0[0] . "\">
							<button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button>
							</a></td>
							</tr>";

					$rcount++;
			}
		} else {
			echo "<h3>Brak danych do wyświetlenia</h3>";
		}

	}

  if ( count($_POST) > 0 ) {

    if ( isset($_GET['action']) && ($_GET['action'] === 'mod') ) {

      $mod_id = $_GET['id'];
      $tName = 'h_fpstatus';
      $csh = "rok,ilosc,gospodz,zaowr,zaows,zaklady,zagroz,laczr,laczp";
      $pKL = generatePKL($tName, $csh);
      $whereValue = "id=" . $mod_id;

      dbMod($connection, $tName, $csh, $pKL, $whereValue);

			theTables($connection);

    } else {

      $tName = 'h_fpstatus';
      $csh = "rok,ilosc,gospodz,zaowr,zaows,zaklady,zagroz,laczr,laczp";
      $pKL = generatePKL($tName, $csh);

      dbAdd($connection, $tName, $csh, $pKL);

      theTables($connection);
    }

  } else {

    if ( isset($_GET['action']) && ( $_GET['action'] === 'del') ) {

      $del_id = $_GET['id'];
      $tName = 'h_fpstatus';
      $whereValue = 'id=' . $del_id;

      dbDel($connection, $tName, $whereValue);

		 theTables($connection);

    } else if ( isset($_GET['action']) && ( $_GET['action'] === 'mod') ) {

      $mod_id = $_GET['id'];
      $tName = 'h_fpstatus';
      $csh = "*";
      $whereValue = "id=" . $mod_id;
      $result0 = prepareForm($connection, $tName, $csh, $whereValue);

      include('forms/head_fpstatus_mod.php');


    } else {

			echo "<div id=\"form\">";
      include('forms/head_fpstatus.php');
			echo "</div><hr id=\"theline\" />
					<div id=\"result\">";
			theTables($connection);
			echo "</div>";


    }

  }

 ?>
