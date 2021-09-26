<?php

$row = mysqli_fetch_row($result);

echo "<form action=\"index.php?page=event_note&action=mod&id=" . $row[0] . "\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"e_note_event_id\" value=\"" . $row[2] . "\" />
			Notatka: <br />
			<textarea class=\"form_inputs\" name=\"e_note_note\">" . $row[1] . "</textarea><br />
			<a href=\"index.php?page=event_note&action=del&id=" . $row[0] . "&event_id=" . $row[2] . "\">
			<button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button></a>
			<div style=\"margin-top: 1%;\"><input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" /></div>
			</form>";

?>
