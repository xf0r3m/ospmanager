<?php

$cDate = date('Y-m-d');

echo "<div id=\"contentmenu\">
<ul>
	<li>
	<a href=\"ajax.php?page=event_about&data_scope=on&date_start=2019-01-01&date_end=" . $cDate . "\"><button class=\"content_button\">Dodaj / Wyświetl akcje</button></a>
	</li>
	<li>
	<a href=\"ajax.php?page=event_member\"><button class=\"content_button\">Uczestnicy</button></a>
	</li>
	<li>
	<a href=\"ajax.php?page=event_alarm\"><button class=\"content_button\">Przybyli na alarm</button></a>
	</li>
	<li>
	<a href=\"ajax.php?page=event_eq\"><button class=\"content_button\">Użyty sprzęt</button></a>
	</li>
	<li>
	<a href=\"ajax.php?page=event_vehicle\"><button class=\"content_button\">Pojazdy</button></a>
	</li>
	<li>
	<a href=\"ajax.php?page=event_others\"><button class=\"content_button\">Inne służby</button></a>
	</li>
	<li>
	<a href=\"ajax.php?page=event_note\"><button class=\"content_button\">Notatka</button></a>
	</li>
</ul>
			</div>
			<div id=\"subcontent\">";

			if ( isset($_GET['form']) ) {
				if ( is_file('modules/event_' . $_GET['form'] . ".php") ) {
					include('modules/event_' . $_GET['form'] . ".php");
				} else {
					echo "<div id=\"startinfo\"><h1>404 - Nie odnaleziono strony</h1></div>";
				}
			} else {
				echo "<div id=\"startinfo\"><h1>Aby rozpocząć wybierz jedną z opcji menu po lewej stronie</h1></div>";
			}

echo "</div>";

 ?>
