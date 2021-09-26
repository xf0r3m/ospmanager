<?php

if ( ! isset($_GET['form']) ) {

	echo "<div id=\"contentmenu\">
		<ul>
			<li><a href=\"ajax.php?page=docs&form=eqEngine_card\"><button class=\"content_button\">Okresowa <br />karta pracy<br /> sprzętu silnikowego</button></a></li>
			<li><a href=\"ajax.php?page=docs&form=road_card\"><button class=\"content_button\">Miesięczna karta<br /> drogowa</button></a></li>
			<li><a href=\"ajax.php?page=docs&form=road_card_dev\"><button class=\"content_button\">Miesięczna karta<br /> drogowa pojazdu z<br /> urządzenim specjalnym</button></a></li>
			<li><a href=\"ajax.php?page=docs&form=bad\"><button class=\"content_button\">Zaświadczenie<br /> lekarskie</button></a></li>
			<li><a href=\"ajax.php?page=docs&form=request\"><button class=\"content_button\">Wniosek o <br /> wypłatę ekwiwalentu<br />za udział w <br /> szkoleniu/działaniu<br /> org. przez PSP <br /> lub gminę</button></a></li>
			<li><a href=\"ajax.php?page=docs&form=list\"><button class=\"content_button\">Wykaz - załącznik<br /> do wniosku<br /> o wypłatę ekwiwalentu<br /> za udział<br /> w szkoleniu/działaniu <br />org. przez PSP <br /> lub gminę </button></a></li>
			<li><a href=\"ajax.php?page=docs&form=statement\"><button class=\"content_button\">Oświadczenie<br /> dla członków<br /> OSP (ekwiwalent)</button></a></li>
			<li><a href=\"ajax.php?page=docs&form=years\"><button class=\"content_button\">Wniosek o odznakę <br />\"za wysługę lat\"</button></a></li>
			<li><a href=\"ajax.php?page=hydrant\"><button class=\"content_button\">Mapa hydrantów</button></a></li>
		</ul>
		</div>
	<div id=\"subcontent\">
		<h1 id=\"startinfo\">Aby rozpocząć należy wybrać jedną z opcji menu po prawej stronie</h1>
	</div>";
}


if ( count($_POST) > 0 ) {

	if ( isset($_GET['form']) ) {

			include('docs/' . $_GET['form'] . '.php');

	}

} else {

	if ( isset($_GET['form']) && ( $_GET['form'] === 'statement' ) ) {
		include("docs/statement.php");
	} else if ( isset($_GET['form']) && ( $_GET['form'] === 'years' ) ) {
		include("docs/years.php");
	} else {

	if ( isset($_GET['form']) ) {

			if ( $_GET['form'] === "eqEngine_card" ) {

				//include('forms/docs_' . $_GET['form'] . '.php');
				include('modules/docs_eqec.php');

			} else if ( $_GET['form'] === "road_card" ) {

				/*
				if ( isset($_GET['vehicle_id']) ) {
					$tName = 'vehicle_about';
					$csh = 'marka,nazwa,numer,rejestracja,zbiornik';
					$whereValue = 'id=' . $_GET['vehicle_id'];
					$result = prepareForm($connection, $tName, $csh, $whereValue);
					$row = mysqli_fetch_row($result);

						include('forms/docs_road_card.php');

				} else {

				$tName = 'vehicle_about';
				$csh = "id,nazwa";
				$whereValue = 'true';
				$result = prepareForm($connection, $tName, $csh, $whereValue);

						if ( mysqli_num_rows($result) > 0 ) {
									echo "<form action=\"index.php?page=docs&form=road_card\" method=\"get\">";
									echo "<input class=\"form_inputs\" type=\"hidden\" name=\"page\" value=\"docs\" />
												<input class=\"form_inputs\" type=\"hidden\" name=\"form\" value=\"road_card\" />";
									echo "<select class=\"form_inputs\" name=\"vehicle_id\">
												<option></option>";

									while ( $row = mysqli_fetch_row($result) ) {
											echo "<option value=\"" . $row[0] . "\">" . $row[1] . "</option>";
									}

									echo "</select><br />
													<div><input class=\"get_form_button\" type=\"submit\" value=\"Przygotuj kartę dla tego pojazdu\"></div>
												</form>";
						} else {
							echo "<h3>Nie dodano żadnych pojazdów</h3>";
						}

				}
				 */
				
				include ('modules/docs_rcard.php');

			} else if ( $_GET['form'] === "road_card_dev" ) {
				/*

				if ( isset($_GET['vehicle_id']) ) {
					$tName = 'vehicle_about';
					$csh = 'marka,nazwa,numer,rejestracja,zbiornik';
					$whereValue = 'id=' . $_GET['vehicle_id'];
					$result = prepareForm($connection, $tName, $csh, $whereValue);
					$row = mysqli_fetch_row($result);

						include('forms/docs_road_card_dev.php');

				} else {

				$tName = 'vehicle_about';
				$csh = "id,nazwa";
				$whereValue = 'true';
				$result = prepareForm($connection, $tName, $csh, $whereValue);

						if ( mysqli_num_rows($result) > 0 ) {
									echo "<form action=\"index.php?page=docs&form=road_card_dev\" method=\"get\">";
									echo "<input class=\"form_inputs\" type=\"hidden\" name=\"page\" value=\"docs\" />
												<input class=\"form_inputs\" type=\"hidden\" name=\"form\" value=\"road_card_dev\" />";
									echo "<select class=\"form_inputs\" name=\"vehicle_id\">
												<option></option>";

									while ( $row = mysqli_fetch_row($result) ) {
											echo "<option value=\"" . $row[0] . "\">" . $row[1] . "</option>";
									}

									echo "</select><br />
												<input class=\"get_form_button\" type=\"submit\" value=\"Przygotuj kartę dla tego pojazdu\">
												</form>";
						} else {
							echo "<h3>Nie dodano żadnych pojazdów</h3>";
						}

				}
				*/
			include('modules/docs_rcardev.php');
			} else if ( $_GET['form'] === "bad" ) {

				if ( isset($_GET['personal_id']) ) {

					$tName = 'str_do';
					$csh = 'id,imie,nazwisko,imie_ojca,plec,data_ur,msc_ur,pesel,adres';
					$whereValue = "id=" . $_GET['personal_id'];
					$result = prepareForm($connection, $tName, $csh, $whereValue);
					if ( mysqli_num_rows($result) > 0 ) {

						$row0 = mysqli_fetch_row($result);
						$row0[5] = convertData($row0[5], 'y');

						echo "<form action=\"index.php?page=docs&form=bad\" method=\"post\">
							<table>
								<tr>
									<td>Imie: </td>
									<td><input class=\"form_inputs\" type=\"text\" name=\"imie\" value=\"" . $row0[1] . "\" /></td>
								</tr>
								<tr>
									<td>Nazwisko: </td>
									<td><input class=\"form_inputs\" type=\"text\" name=\"nazwisko\" value=\"" . $row0[2] . "\" /></td>
								</tr>
								<tr>
									<td>Imię ojca: </td>
									<td><input class=\"form_inputs\" type=\"text\" name=\"imie_ojca\" value=\"" . $row0[3] . "\" /></td>
								</tr>
								<input class=\"form_inputs\" type=\"hidden\" name=\"plec\" value=\"" . $row0[4] . "\" />
								<tr>
									<td>Data ur.: </td>
									<td><input class=\"form_inputs\" type=\"date\" name=\"data_ur\" value=\"" . $row0[5] . "\" /></td>
								</tr>
								<tr>
									<td>Urodzony w: </td>
									<td><input class=\"form_inputs\" type=\"text\" name=\"msc_ur\" value=\"" . dictionary($row0[6]) . "\" /></td>
								</tr>
								<tr>
									<td>Województwo: </td>
									<td><select class=\"form_inputs\" name=\"woj\">
										<option></option>
										<option value=\"dolnośląskim\">dolnośląskie</option>
										<option value=\"kujawsko-pomorskim\">kujawsko-pomorskie</option>
										<option value=\"lubelskim\">lubelskie</option>
										<option value=\"lubuskim\">lubuskie</option>
										<option value=\"łódzkim\">łódzkie</option>
										<option value=\"małopolskim\">małopolskie</option>
										<option value=\"mazowieckim\">mazowieckie</option>
										<option value=\"opolskim\">opolskie</option>
										<option value=\"podkarpackim\">podkarpackie</option>
										<option value=\"podlaskim\">podlaskie</option>
										<option value=\"pomorskim\">pomorskie</option>
										<option value=\"śląskim\">śląskie</option>
										<option value=\"świętokrzyskim\">świętokrzyskie</option>
										<option value=\"warmińsko-mazurskim\">warmińsko-mazurskie</option>
										<option value=\"wielkopolskim\">wielkopolskie</option>
										<option value=\"zachodniopomorskim\">zachodniopomorskie</option>
									</select></td>
								</tr>
								<tr>
									<td>PESEL: </td>
									<td><input class=\"form_inputs\" type=\"text\" name=\"pesel\" value=\"" . $row0[7] . "\" /></td>
								</tr>
								<tr>
									<td>Adres zamieszkania: </td>
									<td><input class=\"form_inputs\" type=\"text\" name=\"adres\" value=\"" . $row0[8] . "\" />
								</tr>
								</table>
								<div><input class=\"form_button\" type=\"submit\" value=\"Generuj zaświadczenia\" />
								</div>
						</form>";

							
					}

					//include('docs/bad.php');

				} else {

					$tName = 'str_do';
					$csh = 'id,imie,nazwisko';
					$whereValue = 'true';
					$result = prepareForm($connection, $tName, $csh, $whereValue);
					if ( mysqli_num_rows($result) > 0 ) {
							include('forms/docs_bad.php');
					} else {
							echo "<h3>Nie dodano żadnych strażaków</h3>";
					}

				}
				
			} else if ( $_GET['form'] === "request") {
			
					$tName = 'h_osp';
					$csh = 'msc';
					$resutl3 = prepareForm($connection, $tName, $csh, 'true');
					if ( mysqli_num_rows($result3) > 0 ) {
						$row3 = mysqli_fetch_row($result3);
						$msc = $row3[0];
					}


					include('forms/docs_request.php');
			} else if ( $_GET['form'] === 'list' ) {

				if ( isset($_GET['akcja']) && ( strlen($_GET['akcja']) > 0 ) ) {
					$tName = 'e_about';
					$csh = 'id,alarm,rozpoczecie,zakonczenie,miejscowosc,ulica,posesja,rodzaj,nrmel';
					$whereValue = 'id=' . $_GET['akcja'];
					$result = prepareForm($connection, $tName, $csh, $whereValue);
					$row0 = mysqli_fetch_row($result);

					$tName = 'e_vehicle';
					$csh = 'vehicle_id';
					$whereValue = 'event_id=' . $row0[0];
					$result1 = prepareForm($connection, $tName, $csh, $whereValue);

					if ( mysqli_num_rows($result1) > 0 ) {

						$row1 = mysqli_fetch_row($result1);

						$tName = 'vehicle_about';
						$csh = 'nazwa';
						$whereValue = 'id=' . $row1[0];
						$result2 = prepareForm($connection, $tName, $csh, $whereValue);
						$row2 = mysqli_fetch_row($result2);

					}

					include('forms/docs_list_w_event.php');
				} else if ( isset($_GET['b']) ) {
					include('forms/docs_list.php');
				} else {

									echo "<form action=\"index.php\" method=\"get\">
												<input class=\"form_inputs\" type=\"hidden\"  name=\"page\" value=\"docs\" />
												<input class=\"form_inputs\" type=\"hidden\" name=\"form\" value=\"list\" />
												<table>
												<tr>";

									$tName = 'e_about';
									$csh = 'id,nazwa';
									$whereValue = 'true';
									$result = prepareForm($connection, $tName, $csh, $whereValue);

									if ( mysqli_num_rows($result) > 0 ) {
										$base=1;
										echo "<tr><td><select class=\"form_inputs\" name=\"akcja\">
												<option></option>";

											while ( $row = mysqli_fetch_row($result) ) {
												echo "<option value=\"" . $row[0] . "\">" . $row[1] . "</option>";
											}
										echo "</select></td></tr>";
									}
									echo "<tr><td>Typ wniosku</td><td><select class=\"form_inputs\" name=\"typ\"><option value=\"0\"></option><option value=\"zd\">Działanie ratownicze</option><option value=\"sz\">Szkolenie pożarnicze</option></select></td></tr>";

									if ( isset($base) ) {
										echo "<tr><td><input class=\"form_inputs\" type=\"checkbox\" name=\"b\" /> Tej akcji nie ma w bazie</td></tr>";
									} else {
										echo "<tr><td><input class=\"form_inputs\" type=\"checkbox\" name=\"b\" checked/> Tej akcji nie ma w bazie</td></tr>";
									}

									echo "<tr><td><input class=\"get_form_button\" type=\"submit\" value=\"Przygotuj wykaz\" /></td></tr>
												</table>
												</form>";
				}
			}
		}


	}


}



?>
