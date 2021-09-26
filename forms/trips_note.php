<?php

echo "<form action=\"index.php?page=trips_note\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"t_note_trips_id\" value=\"" . $trips_id . "\" />
			Notatka: <br />
			<textarea class=\"form_inputs\" name=\"t_note_note\"></textarea><br />
			<div style=\"margin-top: 1%;\"><input class=\"form_button\" type=\"submit\" value=\"Dodaj notatkę\" /></div>
			</form>";

?>
