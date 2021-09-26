<?php

echo "<head>
    <meta charset=\"utf-8\">
    <title>OSPmgmt | morketsmerke.net</title>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\" />
    <link rel=\"shortcut icon\" type=\"image/png\" href=\"resources/favicon.png\" />
  </head>
  <body style=\"background-color: #ADBDCE;\">";

echo "<div id=\"div0\">";
echo "<div id=\"login_image\">
  <img src=\"resources/lp.png\" alt=\"Login image\" width=\"40%\" />
  </div>
  <div id=\"login_form\">";
include('db_conf.php');

function mysqliResult($connection, $result) {

  if ( $result ) {
    echo "<script>console.log('Zapytanie powidło się');</script>";
    return true;
  } else {
    echo "<script>console.log('Zapytanie nie powiodło się:" . mysqli_error($connection) . "');</script>";
    return false;
  }

}

function writeLogs($connection, $msg, $user = 'null' ) {
  $datetime = date('d-m-Y H:i:s');
  //--[DATA]--[USER/SYSTEM]: $msg --
  $query = sprintf("INSERT INTO logs (user, event, eventdt)
                    VALUES ('%s', '%s', '%s')",
                    mysqli_real_escape_string($connection, $user),
                    mysqli_real_escape_string($connection, $msg),
                    mysqli_real_escape_string($connection, $datetime));
  $result = mysqli_query($connection, $query);
  if ( ! mysqliResult($connection, $result) ) {
    echo "<script>console.log('Zapisanie zdarzeń do dziennika jest nie możliwe');</script>";
  }
}

if ( session_status() !== 2 ) {

$form = "
    <form action=\"login.php\" method=\"post\">
    <table>
        <td><input id=\"username\" type=\"text\" name=\"username\" placeholder=\"Nazwa użytkownika\"/></td>
    </tr>
        <td><input id=\"passwd\" type=\"password\" name=\"passwd\" placeholder=\"Hasło\"/></td>
    </tr>
    <tr><td><input id=\"zaloguj\" type=\"submit\" value=\"Zaloguj!\" /></td></tr>
	</table>
	</form>";

  if ( count($_POST) > 0 ) {

    $username = $_POST['username'];
    $haslo = $_POST['passwd'];

    $query = 'SELECT passwd_hash FROM user WHERE username=\'' . $username . '\';';
    $result = mysqli_query($connection, $query);

    if ( mysqli_num_rows($result) > 0 ) {
      $row = mysqli_fetch_row($result);
      $passwd_hash = $row[0];

          if ( password_verify($haslo, $passwd_hash) ) {
              session_start();
              $_SESSION['username'] = $username;
              writeLogs($connection, 'Pomyślnie zalogowano: ' . $_SESSION['username'], $_SESSION['username']);

              echo "<script>window.location.assign('index.php')</script>";

          } else {
              
              echo $form;
              echo "<div id=\"wrgpass\"><p><h3>Niepoprawna nazwa użytkownika lub hasło</h3></p></div>";
          }

    } else {
        echo $form;
        echo "<div id=\"wrgpass\"><p><h3>Niepoprawna nazwa użytkownika lub hasło</h3></p></div>";
    }

  } else {
    echo $form;
  }

}
echo "
</div>
</div></body>
</html>";

 ?>
