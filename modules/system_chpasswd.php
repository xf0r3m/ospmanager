<?php
if ( count($_POST) > 0 ) {

        $username = $_SESSION['username'];
        $oPassword = $_POST['old_passwd'];
        $query1 = "SELECT passwd_hash FROM user WHERE username='" . $username . "';";
        $result1 = mysqli_query($connection, $query1);

        if ( mysqli_num_rows($result1) > 0 ) {
            $row1 = mysqli_fetch_row($result1);
            $passwd_hash = $row1[0];
            if ( password_verify($oPassword, $passwd_hash) ) {

              $nPassword = $_POST['new_password'];
              $nPasswordHash = password_hash($nPassword, PASSWORD_DEFAULT);

              $query2 = 'UPDATE user SET passwd_hash=\'' .
                        mysqli_real_escape_string($connection, $nPasswordHash) .
                        '\' WHERE username=\'' . $username . '\';';
              $result2 = mysqli_query($connection, $query2);

              if ( $result2 ) {
                echo "<div id=\"corrpass\"><h3>Hasło zostało pomyślnie zmienione</h3></div>";
              }

	    } else {
		echo "<div id=\"wrgpass\"><h3>Hasło nie zostało zmienione.<br />Upewnij się że stare hasło jest poprawne</h3></div>";
	    }
        } else {
          echo "<h3>Zmiana hasła jest niemożliwa</h3>";
        }

} else {

  echo "<div id=\"form\">";
  echo "
    <script src=\"forms/add.js\"></script>";
    echo "<form action=\"index.php?page=system_chpasswd\" method=\"post\">
          <table>
          <tr><td>Stare hasło: </td><td><input class=\"form_inputs\" type=\"password\" name=\"old_passwd\" style=\"outline: none;\"/></tr>
          <tr><td>Nowe hasło: </td><td><input class=\"form_inputs\" id=\"p1\" type=\"password\" name=\"new_password\" style=\"outline: none;\"/></tr>
          <tr><td>Powtórz nowe hasło: </td><td><input class=\"form_inputs\" id=\"p2\" type=\"password\" style=\"outline: none;\"/></td></tr>
          <tr><td><div id=\"match\"></div></td></tr>
          <tr><td></td></tr>
          </table>
            <div>
            <input class=\"form_button\" type=\"submit\" value=\"Zapis\" />
            <button id=\"clear\">Wyczyść</button>
            </div>
          </form>"; 
  echo "</div>
        <hr id=\"theline\">
        <div id=\"result\">
        </div>";

}

 ?>
