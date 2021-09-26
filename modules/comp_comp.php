<?php

function theTable($connection, $comp_id) {

      $tName = 'c_comp';
      $csh = '*';
      $whereValue = 'true';
      $result1 = prepareForm($connection, $tName, $csh, $whereValue);

      if ( mysqli_num_rows($result1) > 0 ) {

        echo "<table class=\"moduleTable\">
        <tr class=\"nonParityTableRow\">
        <th class=\"tableHeaderCell\">Strażak</th>
				<th class=\"tableHeaderCell\">Funkcja sztafeta</th>
				<th class=\"tableHeaderCell\">Funkcja bojówka</th>
        <th class=\"tableHeaderCell\">Uwagi</th>
				<th class=\"tableHeaderCell\" colspan=\"2\">Akcje</th></tr>";

				$rcount=2;

        while( $row1 = mysqli_fetch_row($result1) ) {

				if ( $rcount % 2 === 0 ) {
					  echo "<tr class=\"parityTableRow\">";
				} else {
					  echo "<tr class=\"nonParityTableRow\">";
				}

              $tName = 'str_do';
              $csh = "imie,nazwisko";
              $whereValue = 'id=' . $row1[4];

              $result2 = prepareForm($connection, $tName, $csh, $whereValue);
              $row2 = mysqli_fetch_row($result2);

              echo "<td class=\"tableDataCell\">" . $row2[0] . " " . $row2[1] . "</td>";
              echo "<td class=\"tableDataCell\">" . $row1[2] . "</td>
                    <td class=\"tableDataCell\">" . $row1[1] . "</td>
                    <td class=\"tableDataCell\">" . $row1[3] . "</td>";
              echo "<td class=\"tableDataCell\"><a href=\"index.php?page=comp_comp&action=mod&id=" . $row1[0] . "\">
                    <button id=\"m_button\"><img id=\"m_image\" src=\"resources/edit.png\" /></button></a></td>";
              echo "<td class=\"tableDataCell\"><a href=\"index.php?page=comp_comp&action=del&id=" . $row1[0] . "&comp_id=" . $comp_id . "\">
                    <button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button></a></td>";

              echo "</tr>";
							$rcount++;
        }

        echo "</table>";

      } else {
        echo "<h3>Brak danych do wyświetlenia</h3>";
      }
}

if ( ! isset($_GET['comp_id']) ) {

     $tName = 'c_about';
     $result0 = getLastIdOnTable($connection, $tName);
     $row0 = mysqli_fetch_row($result0);
     $comp_id = $row0[0];

} else {

    $comp_id = $_GET['comp_id'];

}

if ( $comp_id === NULL ) {

    echo "<div id=\"startinfo\"><h1>Aby mieć możliwość zdefiniowania uczestników, należy na początku zdefiniować
    uczestnictwo w zawodach</h1></div>";

} else {

if ( count($_POST) > 0 ) {

  if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

    $mod_id = $_GET['id'];
    $tName = 'c_comp';
    $csh = 'personal_id,bj_func,sz_func,uwagi';
    $pKL = generatePKL($tName, $csh);
    $whereValue = 'id=' . $mod_id;

    dbMod($connection, $tName, $csh, $pKL, $whereValue);

  } else {

    $tName = 'c_comp';
    $csh = 'personal_id,bj_func,sz_func,uwagi,comp_id';
    $pKL = generatePKL($tName, $csh);

    dbAdd($connection, $tName, $csh, $pKL);

  }
    theTable($connection, $_POST['c_comp_comp_id']);

} else {
  if ( isset($_GET['action']) && ( $_GET['action'] === 'del' ) ) {

    $del_id = $_GET['id'];
    $tName = 'c_comp';
    $whereValue = 'id=' . $del_id;

    dbDel($connection, $tName, $whereValue);

    theTable($connection, $_GET['comp_id']);

  } else if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

    $mod_id = $_GET['id'];

    $tName = 'str_do';
    $csh = 'id,imie,nazwisko';
    $whereValue = 'true';
    $result0 = prepareForm($connection, $tName, $csh, $whereValue);

    $tName = 'c_comp';
    $csh = '*';
    $whereValue = 'id=' . $mod_id;
    $result1 = prepareForm($connection, $tName, $csh, $whereValue);

    include('forms/comp_comp_mod.php');

  } else {
    //formularz


    echo "<div id=\"form\">";

      $tName = 'str_do';
      $csh = 'id,imie,nazwisko';
      $whereValue = 'true';
      $result0 = prepareForm($connection, $tName, $csh, $whereValue);

      include('forms/comp_comp.php');

    echo "</div>
          <hr id=\"theline\">
          <div id=\"result\">";

      theTable($connection, $comp_id);

    echo "</div>";

  }
}
}
 ?>
