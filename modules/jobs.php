<?php

$cDate = date('Y-m-d');
echo "<div id=\"contentmenu\">
<ul>
<li><a href=\"ajax.php?page=jobs_about&data_scope=on&date_start=2019-01-01&date_end=" . $cDate . "\">
<button class=\"content_button\">Dodaj / wyświetl prace</button></a></li>
		<li><a href=\"ajax.php?page=jobs_member\"><button class=\"content_button\">Uczestnicy</button></a></li>
</ul>
			</div>
			<div id=\"subcontent\">";

				echo "<div id=\"startinfo\"><h1>Aby rozpocząć wybierz jedną z opcji menu po lewej stronie</h1></div>";

			echo "</div>";

?>
