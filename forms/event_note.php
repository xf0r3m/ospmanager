<?php

echo "<form action=\"index.php?page=event_note\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"e_note_event_id\" value=\"" . $event_id . "\" />
			Notatka: <br />
			<textarea class=\"form_inputs\" name=\"e_note_note\"></textarea><br />
			<div style=\"margin-top: 1%;\"><input class=\"form_button\" type=\"submit\" value=\"Dodaj notatkę\" /></div>
			</form>";

?>
