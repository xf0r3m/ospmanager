<?php

  echo "<form action=\"index.php\" method=\"get\" />
        <input class=\"form_inputs\" type=\"hidden\" name=\"page\" value=\"docs\" />
        <input class=\"form_inputs\" type=\"hidden\" name=\"form\" value=\"bad\" />
        <select class=\"form_inputs\" name=\"personal_id\">
        <option></option>";

        while ($row = mysqli_fetch_row($result)) {

          echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";

        }

	echo "</select>
		<br />
	<p>&nbsp;</p>
        <input class=\"get_form_button\" type=\"submit\" value=\"Pobierz dane\" />
        </form>";


 ?>
