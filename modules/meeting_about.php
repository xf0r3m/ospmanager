<?php

function theTables($connection) {

  $tName = 'm_about';
  $th = 'Nazwa,Data zebrania,Rodzaj';
  $csh = 'id,nazwa,data_zebrania,rodzaj';
  tables($connection, $tName, $th, $csh);

}

if ( count($_POST) > 0 ) {

    if ( isset($_GET['action']) && ( $_GET['action'] === 'mod' ) ) {

      $mod_id = $_GET['id'];

      $tName = 'm_about';
      $csh = 'nazwa,data_zebrania,rodzaj,notatka';
      $pKL = generatePKL($tName, $csh);
      $whereValue = 'id=' . $mod_id;

      dbMod($connection, $tName, $csh, $pKL, $whereValue);

    } else {

      $tName = 'm_about';
      $csh = 'nazwa,data_zebrania,rodzaj,notatka';
      $pKL = generatePKL($tName, $csh);

      dbAdd($connection, $tName, $csh, $pKL);

    }

    theTables($connection);

} else {

  if ( isset($_GET['action']) && ( $_GET['action'] === 'del') ) {

    $del_id = $_GET['id'];

    $tName = 'm_files';
    $csh = 'nazwa';
    $whereValue = 'meet_id=' . $del_id;

    $result = prepareForm($connection, $tName, $csh, $whereValue);

    if ( mysqli_num_rows($result) > 0 ) {
      while ( $row = mysqli_fetch_row($result) ) {
        unlink('files/' . $row[0]);
      }
    }

    dbDel($connection, $tName, $whereValue);

    $tName = 'm_guest';
    $whereValue = 'meet_id=' . $del_id;

    dbDel($connection, $tName, $whereValue);

    $tName = 'm_member';
    $whereValue = 'meet_id=' . $del_id;

    dbDel($connection, $tName, $whereValue);

    $tName = 'm_about';
    $whereValue = 'id=' . $del_id;

    dbDel($connection, $tName, $whereValue);

    theTables($connection);

  } else if ( isset($_GET['action']) && ( $_GET['action'] === 'mod') ) {

      $mod_id = $_GET['id'];
      $tName = 'm_about';
      $csh = 'nazwa,data_zebrania,rodzaj,notatka';
      $whereValue = 'id=' . $mod_id;
      $result = prepareForm($connection, $tName, $csh, $whereValue);
      $row = mysqli_fetch_row($result);
      include('forms/meeting_about_mod.php');

  } else {

	echo "<div id=\"form\">";
    	  include('forms/meeting_about.php');
	echo "</div>
		<hr id=\"theline\">
		<div id=\"result\">";
        theTables($connection);
    echo "</div>";


  }

}

 ?>
