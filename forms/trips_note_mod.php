<?php

$row = mysqli_fetch_row($result);

echo "<form action=\"index.php?page=trips_note&action=mod&id=" . $row[0] . "\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"t_note_trips_id\" value=\"" . $row[2] . "\" />
			Notatka: <br />
			<textarea class=\"form_inputs\" name=\"t_note_note\">" . $row[1] . "</textarea><br />
			<a href=\"index.php?page=trips_note&action=del&id=" . $row[0] . "&trips_id=" . $row[2] . "\">
			<button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button></a>
			<input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" />
			</form>";

?>
