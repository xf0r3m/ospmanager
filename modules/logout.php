<?php

  if ( session_status() !== 2 ) { session_start(); }

    unset($_SESSION['username']);

    session_destroy();
    writeLogs($connection, 'Wylogowano użytkownika: ' . $_SESSION['username'], $_SESSION['username']);
  echo "<script>window.location.assign('index.php')</script>";


 ?>
