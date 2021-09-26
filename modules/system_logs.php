<?php
    writeLogs($connection, 'Pobrano zapisy dziennika z bazy', $_SESSION['username']);

    $query='SELECT * FROM logs';
    $result = mysqli_query($connection, $query);
    writeLogs($connection, 'Wydano zapytanie: ' . $query, $_SESSION['username']);
    if ( mysqli_num_rows($result) > 0 ) {
        while ( $row = mysqli_fetch_row($result) ) {
          echo "--[" . $row[1] . "]--[" . $row[3] . "]: " . $row[2] . " --<br />";
        }
    } else {
      echo "<h3>Brak wpisów w dzienniku</h3>";
    }
 ?>
