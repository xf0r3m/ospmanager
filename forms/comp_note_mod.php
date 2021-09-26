<?php
$row = mysqli_fetch_row($result);

echo "<form action=\"index.php?page=comp_note&action=mod&id=" . $row[0] . "\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"c_note_comp_id\" value=\"" . $row[2] . "\" />
			Notatka: <br />
			<textarea class=\"form_inputs\" name=\"c_note_note\">" . $row[1] . "</textarea><br />
			<a href=\"index.php?page=comp_note&action=del&id=" . $row[0] . "&comp_id=" . $comp_id . "\">
			<button id=\"d_button\"><img id=\"d_image\" src=\"resources/delete.png\" /></button>
			</a>
			<div style=\"margin-top: 1%;\"><input class=\"form_button\" type=\"submit\" value=\"Zapisz zmiany!\" /></div>
			</form>";

?>
