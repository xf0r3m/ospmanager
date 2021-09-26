<?php

echo "<a href=\"javascript:print()\"><button id=\"p_button\"><img id=\"p_image\" src=\"resources/printer.png\" /></button></a><br /><br />";

echo "<div style=\"width: 195mm; height: 282mm; padding-top: 15mm; padding-left: 10mm; padding-right: 15mm; background-color: white;\" >
			<div id=\"sygnatura\" style=\"text-align: right;\">Załącznik Nr. 1 do Zarządzenia Nr 0151-66/10<br />
			Wójta Gminy Lubicz z dnia 2 grudnia 2010 r.<br /></div>";

      $currentDate = date('d.m.Y');
      $tName = 'h_osp';
      $csh = 'msc';
      $whereValue = 'true';
      $result = prepareForm($connection, $tName, $csh, $whereValue);

			if ( mysqli_num_rows($result) > 0 ) {
				$row = mysqli_fetch_row($result);
				$msc = $row[0];
						echo "<div style=\"font-size: 19px; text-align: right; margin-right: 2%; margin-top: 1%;\">" . $row[0] . " , dnia " . $currentDate . " r.</div>";
			} else {
								echo "<div id=\"mscdata\" style=\"font-size: 19px; text-align: right; margin-right: 2%; margin-top: 1%;\">
								..............................., dnia " . $currentDate . " r.</div>";
			}

echo "<div id=\"mpOSP\">...............................................................<br />
			      <div style=\"width: 22%; text-align: right;\">(Pieczęć OSP)</div></div>
      <div id=\"wojt\" style=\"text-align: right;\">
			<h2 style=\"margin: 0; width: 18%; text-align: center; margin-left: 72%;\">WÓJT</h2>
			<h3 style=\"margin: 0; margin-right: 10%;\">GMINY LUBICZ</h3><br />
			</div>
      <div id=\"tytul\"><h2 style=\"margin: 0; text-align: center;\">WNIOSEK</h2>
			<h3 style=\"margin: 0; text-align: center;\">o wypłatę ekwiwalentu za udział w działaniu
      ratowniczym lub szkoleniu pożarniczym organizowanym przez Państwową Straż
      Pożarną lub gminę.</h3><br />
			</div>
      <div id=\"tresc\">
	<ol>";
      if ( isset($msc) && ( $msc === 'Gronowo' ) ) {  echo "<li style=\"text-align: justify; margin-bottom: 1%;\">Zarząd Ochotniczej Straży Pożarnej w Gronowie, składa wniosek o wypłatę
              ekwiwalentu dla członków, którzy brali udział w działaniu ";
	} else {
	      
          echo "<li style=\"text-align: justify; margin-bottom: 1%;\">Zarząd Ochotniczej Straży Pożarnej w Gronowie, składa wniosek o wypłatę
	      ekwiwalentu dla członków, którzy brali udział w działaniu ";
	}
      if ( isset($_POST['typ']) && ( $_POST['typ'] === 'dz' ) ) {
          echo "działaniu ratowniczym / <s>szkoleniu pożarniczym</s> <sup>*)</sup>";
      } else if ( isset($_POST['typ']) && ( $_POST['typ'] === 'sz' ) ) {
          echo "<s>działaniu ratowniczym</s> / szkoleniu pożarniczym <sup>*)</sup>";
      } else {
          echo "działaniu ratowniczym / szkoleniu pożarniczym <sup>*)</sup>";
      }
echo " w " . $_POST['kwartal'] . " kwartale 2020 r.</li>
          <li style=\"text-align: justify; margin-bottom: 1%;\">Ponumerowane  wykazy  członków  OSP  biorących  udział  w
              jednostkowym ";

      if ( isset($_POST['typ']) && ( $_POST['typ'] === 'dz' ) ) {
          echo "działaniu ratowniczym / <s>szkoleniu pożarniczym</s> <sup>*)</sup>";
      } else if ( isset($_POST['typ']) && ( $_POST['typ'] === 'sz' ) ) {
          echo "<s>działaniu ratowniczym</s> / szkoleniu pożarniczym <sup>*)</sup>";
      } else {
          echo "działaniu ratowniczym / szkoleniu pożarniczym <sup>*)</sup>";
      }

echo " w ilości " . $_POST['ilosc'] . " szt., są załącznikami do niniejszego wniosku</li>
          <li style=\"text-align: justify; margin-bottom: 1%;\">Wymienieni w wykazach członkowie OSP spełniają warunki określone w art.
              19,  ust.1b ustawy  z  dnia  24 sierpnia 1991 roku o ochronie
              przeciwpożarowej (Dz.U. z 2009 r. Nr 178, poz. 1380 z późn. zm.).</li>
        </ol>
      </div>
      <div id=\"podpisy\" style=\"margin-left: 6%; margin-bottom: 3%;\">Podpisy osób upoważnionych: </div>
      <div id=\"oswiadczenie\" style=\"text-align: center;\">Oświadczamy, że przepisy o odpowiedzialności za
      podanie danych niezgodnych z prawdą są nam znane.</div>
			<div style=\"float: left; width: 100%; margin-top: 11%;\">
      <div id=\"podpis_naczelnik\" style=\"float: left; width: 50%; margin-left: 10%;\">
			............................................................<br />
        <div style=\"width: 45%; text-align: right;\">(Naczelnik OSP)</div>
				</div>
      <div id=\"podpis_prezes\" style=\"float: left; width: 40%;\">
			............................................................<br />
        <div style=\"width: 52%; text-align: right;\">(Prezes OSP)</div>
				</div>
      <div id=\"podpis_komendant\" style=\"width: 80%; margin-top: 16%; margin-left: 25%;\">
			..................................................................................................<br />
        (Komendant Zarządu Oddziału Gminnego Związku OSP RP)
				</div>
			</div>
      <div id=\"skreslic\" style=\"float: left; margin-top: 5%;\"> <sup>*)</sup> - niepotrzebne skreślić
      </div>";



 ?>
