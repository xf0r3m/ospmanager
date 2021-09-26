<?php
$db = 'ospmgmt';
$db_user = 'ospmgmt';
$db_passwd = 'Lh7TBLkzNzQv43KP';
$db_host = 'localhost';

$connection = mysqli_connect($db_host, $db_user, $db_passwd, $db);

if ( ! $connection ) {
  echo "<script>console.log('Połączenie nie powioło się!');
  console.log(\"Nr błędu: " . mysqli_connect_errno() . "\");
  console.log(\"Błąd: " . mysqli_connect_error() . "\");</script>";
  exit;
}
  else {
    echo "<script>console.log('Połączenie powiodło się!');</script>";
  }

function checkResult($mysqliResult, $connection) {

    if ( ! $mysqliResult ) {
      echo "<script>console.log(\"Błąd: " . mysqli_error($connection) . "\");</script>";
      return false;

    }
      else {

        echo "<script>console.log('Zapytanie powiodło się!');</script>";
        return true;

      }

    }
?>
