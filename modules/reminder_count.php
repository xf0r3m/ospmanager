<?php
  $countReminds=0;
  $currentDate = date('Y-m-d');
  #Zapytania
  $queries = ["SELECT COUNT(data_exp) FROM str_szk WHERE data_exp > '$currentDate'",
              "SELECT COUNT(data_exp) FROM str_bad WHERE data_exp > '$currentDate'",
              "SELECT COUNT(termin) FROM eq_deadlines WHERE termin > '$currentDate'",
              "SELECT COUNT(termin) FROM vehicle_deadlines WHERE termin > '$currentDate'"];

  for ( $i=0; $i < count($queries); $i++) {

    $query = $queries[$i];
    $result = mysqli_query($connection, $query);

    if ( mysqli_num_rows($result) > 0 ) {
        $row = mysqli_fetch_row($result);
        $countReminds += $row[0];
    }

  }
 ?>
