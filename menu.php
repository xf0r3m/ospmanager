<?php

include('modules/reminder_count.php');
$cDate = date('Y-m-d');
echo "<div id=\"menu\">
  <ul>
      <li>
        <a href=\"index.php?page=firefighters\">
          <div class=\"menu_button\" id=\"firefighters\">Strażacy</div>
          </a>";
						if (isset ($_GET['page']) && ( $_GET['page'] === 'firefighters' ||
								 $_GET['page'] === 'addff' ||
								 $_GET['page'] === 'addfew' )) {
            echo "<ul id=\"subff\" class=\"menu_list\">
                    <li>
                      <a href=\"index.php?page=addfew\">
                        <div class=\"menu_button\" id=\"addfew\">Dodaj wiele</div>
                        </a>
                      </li>
                  </ul>";
						}
      echo " </li>
			<li><a href=\"index.php?page=events\">
						<div class=\"menu_button\" id=\"events\">Akcje</div>
					</a>";

					/*

					if ( isset($_GET['page']) && ( stripos($_GET['page'], 'event') !== FALSE ) ) {
						echo "<ul id=\"subaction\" class=\"menu_list\">
							<li><a href=\"index.php?page=events&form=about&data_scope=on&date_start=2019-01-01&date_end=" . $cDate . "\">
										<div class=\"menu_button\">Dodaj akcje</div>
									</a>
								</li>
						</ul>";
					}

					 */

			echo "</li>
			<li><a href=\"index.php?page=trips\">
						<div class=\"menu_button\" id=\"trips\">Wyjazdy gospodarcze</div>
					</a>";
					/*
					if ( isset($_GET['page']) && ( stripos($_GET['page'], 'trip') !== FALSE ) ) {
						echo "<ul id=\"subtrip\" class=\"menu_list\">
									<li><a href=\"index.php?page=trips&form=about&data_scope=on&date_start=2019-01-01&date_end=" . $cDate . "\">
										<div class=\"menu_button\">Dodaj wyjazd</div>
									</a>
								</li>
						</ul>";
					}
					 */

			echo "</li>
      <li><a href=\"index.php?page=jobs\">
            <div class=\"menu_button\" id=\"jobs\">Prace na rzecz straży</div>
	  </a>";
			/*

					if ( isset($_GET['page']) && ( stripos($_GET['page'], 'job') !== FALSE ) ) {
          	echo "<ul id=\"subjob\" class=\"menu_list\">
            	<li><a href=\"index.php?page=jobs&form=about&data_scope=on&date_start=2019-01-01&date_end=" . $cDate . "\">
                  	<div class=\"menu_button\">Dodaj prace na rzecz straży</div>
                	</a>
            	</li>
          	</ul>";
					}
			*/

      echo "</li>
			<li><a href=\"index.php?page=eq\">
						<div class=\"menu_button\" id=\"eq\">Sprzęt</div>
					</a>";

					/*

					if ( isset($_GET['page']) && ( stripos($_GET['page'], 'eq') !== FALSE ) ) {
							echo "<ul id=\"subeq\" class=\"menu_list\">
								<li><a href=\"index.php?page=eq&form=about\">
										<div class=\"menu_button\" >Dodaj sprzęt</div>
									</a>
								</li>
						</ul>";
					}

					 */

			echo "</li>
			<li><a href=\"index.php?page=vehicle\">
						<div class=\"menu_button\" id=\"vehicle\">Pojazdy</div>
					</a>";
					/*

					if ( isset($_GET['page']) && ( stripos($_GET['page'], 'vehicle') !== FALSE ) ) {

					echo "<ul id=\"subveh\" class=\"menu_list\">
							<li><a href=\"index.php?page=vehicle&form=about\">
										<div class=\"menu_button\">Dodaj pojazd</div>
									</a>
								</li>
						</ul>";
					}
					 */

			echo "</li>
			<li><a href=\"index.php?page=comp\">
						<div class=\"menu_button\" id=\"comp\">Zawody</div>
					</a>";
					/*
					if ( isset($_GET['page']) && ( stripos($_GET['page'], 'comp') !== FALSE ) ) {
							echo "<ul id=\"subcp\" class=\"menu_list\">
							<li><a href=\"index.php?page=comp&form=about\">
										<div class=\" menu_button long_text\">Dodaj uczestnictwo w zawodach</div>
									</a>
								</li>
						</ul>";
				}
					*/
			echo "</li>
      <li><a href=\"index.php?page=head\">
            <div class=\"menu_button\" id=\"head\">Naczelnik</div>
          </a>
      </li>";
      if ( $countReminds === 0 ) {
      echo "<li><a href=\"index.php?page=reminder\">
            <div class=\"menu_button\" id=\"reminder\">Przypomnienia</div>
          </a>
      </li>";
    } else {
      echo "<li><a href=\"index.php?page=reminder\">
            <div class=\"menu_button\" id=\"reminder\" style=\"background-color: red; color: white;\">
            Przypomnienia (" . $countReminds . ")</div>
          </a>
      </li>";
    }
		echo "<li><a href=\"index.php?page=stats\">
					<div class=\"menu_button\" id=\"stats\">Statystyki</div>
				</a>
		</li>";
    echo "<li><a href=\"index.php?page=table_creator\">
          <div class=\"menu_button\" id=\"table_creator\">Kreator tabel</div>
        </a>
    </li>";
	    echo "<li><a href=\"index.php?page=docs\">
          <div class=\"menu_button\" id=\"docs\">Dokumenty</div>
	</a>
    </li>";
          echo "<li><a href=\"index.php?page=meeting\">
              <div class=\"menu_button\" id=\"meeting\">Zebrania</div>
	    </a>";
       echo "</li>";
          echo "<li>
            <a href=\"index.php?page=system\">
              <div class=\"menu_button\" id=\"system\">System</div>
            </a>
          </li>
          <li>
            <a href=\"index.php?page=logout\">
              <div class=\"menu_button\" id=\"logout\">Wyloguj</div>
            </a>
        </li>
    </ul>
  </div>";

?>
