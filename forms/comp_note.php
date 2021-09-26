<?php

echo "<form action=\"index.php?page=comp_note\" method=\"post\">
			<input class=\"form_inputs\" type=\"hidden\" name=\"c_note_comp_id\" value=\"" . $comp_id . "\" />
			Notatka: <br />
			<textarea class=\"form_inputs\" name=\"c_note_note\"></textarea><br />
			<div style=\"margin-top: 1%;\">
				<input class=\"form_button\" type=\"submit\" value=\"Dodaj notatkę\" />
			</div>
			</form>";

?>
