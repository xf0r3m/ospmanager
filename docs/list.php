<?php

if ( count($_POST) > 0 ) {
		$labels = array("data", "samochod", "czas", "miejsce", "rodzaj");
		for ( $i=0; $i < count($labels); $i++ ) {
			if ( strlen($_POST[$labels[$i]]) <= 0 ) {
				$_POST[$labels[$i]] = "<span style=\"word-wrap: break-word;\">................................................................................................................................................</span>";
			}
		}
}

echo "<a href=\"javascript:print()\"><button id=\"p_button\"><img id=\"p_image\" src=\"resources/printer.png\" /></button></a><br /><br />";

echo "<div style=\"width: 210mm; padding-top: 10mm; background-color: white;\">
			<div id=\"sygnatura\" style=\"text-align: right; margin-right: 3%;\">
					Załącznik Nr 2 do Zarządzeni Nr 0151 - 66/10<br />
					Wójta Gminy Lubicz z dnia 2 grudnia 2010r.<br />
			</div>";

        $tName = 'h_osp';
        $csh = 'msc';
        $whereValue = 'true';
        $result = prepareForm($connection, $tName, $csh, $whereValue);
				if ( mysqli_num_rows($result) > 0 ) {
        			$row = mysqli_fetch_row($result);
      				echo "<div id=\"mscdate\" style=\"text-align: right; margin-right: 5%; font-size: 19px; margin-top: 1%;\">" . $row[0] . ", dnia " .  date('d.m.Y') . " r. </div>";
				} else {
							echo "<div id=\"mscdate\" style=\"text-align: right; margin-right: 5%; font-size: 19px; margin-top: 1%;\">......................................., dnia " .  date('d.m.Y') . " r. </div>";
				}
  echo "
			<div id=\"mp\" style=\"margin-left: 3%;\">.................................................................<br />
									<div style=\"width: 22%; text-align: right;\">(Pieczeć OSP)</div>
			</div>
      <div id=\"title\">";
			if ( isset($_POST['numer']) && strlen($_POST['numer']) > 0 ) {
      		echo "<h2 style=\"text-align: center;\">WYKAZ Nr " . $_POST['numer'] . "</h2>";
			} else {
					echo "<h2 style=\"text-align: center;\">WYKAZ Nr .....................</h2>";
			}

      echo "<h2 style=\"text-align: center;\">członków OSP biorących udział w działaniu ratowniczym lub szkoleniu
      pożarniczym organizowanym przez Państwową Straż Pożarną lub gminę.</h2>
      </div>
      <div>
        <ol style=\"font-size: 19px;\">
        <li>Data ";
        if ( isset($_GET['zd']) && ( strlen($_GET['zd']) > 0  ) ) {
          echo  "zdarzenia / <s>szkolenia</s>";
        } else if ( isset($_GET['sz']) && ( strlen($_GET['sz']) > 0 ) ) {
          echo "<s>zdarzenia</s> / szkolenia";
        } else {
          echo "zdarzenia / szkolenia";
        }
        echo "<sup>*)</sup>";
        $_POST['data'] = convertData($_POST['data'], 'd');
				if ( strpos($_POST['data'], '1970') !== FALSE ) {
					$_POST['data'] = ".......................................................................................";
				}
echo " – " . $_POST['data'] . "</li>
      <li>Typ dysponowanego samochodu – " . $_POST['samochod'] . "</li>
      <li>Czas udziału w ";

      if ( isset($_GET['zd']) && ( strlen($_GET['zd']) > 0  ) ) {
        echo  "działaniu ratowniczym / <s>szkoleniu</s>";
      } else if ( isset($_GET['sz']) && ( strlen($_GET['sz']) > 0 ) ) {
        echo "<s>działaniu ratowniczym</s> / szkoleniu";
      } else {
        echo "działaniu ratowniczym / szkoleniu";
      }
      echo "<sup>*)</sup>";
echo " (od – do) – " . $_POST['czas'] .  "</li>
      <li>Miejsce ";
      if ( isset($_GET['zd']) && ( strlen($_GET['zd']) > 0  ) ) {
        echo  "zdarzenia / <s>szkolenia</s>";
      } else if ( isset($_GET['sz']) && ( strlen($_GET['sz']) > 0 ) ) {
        echo "<s>zdarzenia</s> / szkolenia";
      } else {
        echo "zdarzenia / szkolenia";
      }
      echo "<sup>*)</sup>";
echo  " – " . $_POST['miejsce'] . "</li>
      <li>Rodzaj ";
      if ( isset($_GET['zd']) && ( strlen($_GET['zd']) > 0  ) ) {
          echo  "zdarzenia / <s>szkolenia</s>";
      } else if ( isset($_GET['sz']) && ( strlen($_GET['sz']) > 0 ) ) {
          echo "<s>zdarzenia</s> / szkolenia";
      } else {
          echo "zdarzenia / szkolenia";
      }
      echo "<sup>*)</sup>";
echo  " – " . $_POST['rodzaj'] . "</li>
      <li>Imienny wykaz osób biorących udział w ";

      if ( isset($_GET['zd']) && ( strlen($_GET['zd']) > 0  ) ) {
      echo  "działaniu ratowniczym / <s>szkoleniu</s>";
      } else if ( isset($_GET['sz']) && ( strlen($_GET['sz']) > 0 ) ) {
      echo "<s>działaniu ratowniczym</s> / szkoleniu";
      } else {
      echo "działaniu ratowniczym / szkoleniu";
      }
      echo "<sup>*)</sup>";

echo "</ol>
<p id=\"klauzula\" style=\"text-align: justify; margin-left: 3%; font-size: 14px; margin-right: 3%;\">
      Niżej wymienieni członkowie OSP spełniają warunki określone w art. 19, ust.1 b ustawy z dnia 24 sierpnia
      1991  roku  o  ochronie  przeciwpożarowej  (Dz.U.  z  2009  r.  Nr  178,  poz.  1380  z
      późn.  zm.),  a  także  nie zachowali  wynagrodzenia  za  czas  nieobecności  w  pracy,  spowodowanej  uczestnictwem w ";

      if ( isset($_GET['zd']) && ( strlen($_GET['zd']) > 0  ) ) {
      echo  "działaniu ratowniczym / <s>szkoleniu</s>";
      } else if ( isset($_GET['sz']) && ( strlen($_GET['sz']) > 0 ) ) {
      echo "<s>działaniu ratowniczym</s> / szkoleniu";
      } else {
      echo "działaniu ratowniczym / szkoleniu";
      }
      echo "<sup>*)</sup>";

echo "</p>
			<div style=\"width: 80%; display: block; margin: auto;\">
      <table border=\"1\" style=\"width: 100%; border-collapse: collapse;\">
      <tr><th>Lp.</th><th>Imie i nazwisko<br />członka OSP</th>
      <th>Ilość godzin<br /> udziału</th><th>Należny<br />ekwiwalent</th><th>Podpis</th></tr>
      <tr style=\"text-align: center; font-size: 12px;\">
			<td style=\"border-bottom-width: 2px; border-top-width: 2px;\">1</td>
			<td style=\"border-bottom-width: 2px; border-top-width: 2px;\">2</td>
			<td style=\"border-bottom-width: 2px; border-top-width: 2px;\">3</td>
			<td style=\"border-bottom-width: 2px; border-top-width: 2px;\">4</td>
			<td style=\"border-bottom-width: 2px; border-top-width: 2px;\">5</td>
			</tr>";


      for ( $i=0; $i < count($_POST['personal_id']); $i++ ) {

        $tName = 'str_do';
        $csh = 'imie,nazwisko';
        $whereValue = 'id=' . $_POST['personal_id'][$i];

        $result = prepareForm($connection, $tName, $csh, $whereValue);
        $row = mysqli_fetch_row($result);


        echo "<tr><td>" . ($i + 1) . "</td>
              <td>" . $row[0] . " " . $row[1] . "</td>
              <td>" . $_POST['iloscgodzin'][$i] . "</td>
              <td>" . $_POST['ekwiwalent'][$i] . "</td>
              <td></td></tr>";
      }

echo "</table>
			</div>
      </div>
      <div id=\"podpisy\" style=\"margin: 3%;\">
      <br />
      Podpisy osób upoważnionych: <br />
      </div>
      <div id=\"oswiadczenie\" style=\"text-align: center;\">
      Oświadczamy, że przepisy o odpowidzialności za podanie danych niezgodnych
      z prawdą są nam znane.<br />
      </div>
			<div style=\"width: 100%; float: left;\">
      <div id=\"dowodca\" style=\"width: 40%; float: left; margin-left: 8%; margin-top: 11%;\">
      ..............................................................<br />
      <div style=\"width: 65%; text-align: right;\">(Dowódca sekcji / zastępu)</div>
      </div>
      <div id=\"naczelnik\" style=\"width: 39%; float: left; margin-left: 11%; margin-top: 11%;\">
      ...............................................................<br />
      <div style=\"width: 59%; text-align: right;\">(Naczelnik OSP)</div>
      </div>
			</div>
      <div id=\"nrdz\" style=\"margin: 3%; margin-left: 15%; float: left; width: 100%;\">Nr zdarzenia: " . $_POST['nrmel'] . "</div>
			<div style=\"width: 80%; margin: auto;\">
      <div id=\"kmpsp\" style=\"width: 60%; text-align: center; margin: auto;\">Potwierdzenie KM PSP w Toruniu
        o uczestniczeniu jednostki OSP w ";
          if ( isset($_GET['zd']) && ( strlen($_GET['zd']) > 0  ) ) {
              echo  "zdarzeniu / <s>szkoleniu</s>";
          } else if ( isset($_GET['sz']) && ( strlen($_GET['sz']) > 0 ) ) {
              echo "<s>zdarzeniu</s> / szkoleniu";
          } else {
              echo "zdarzeniu / szkoleniu";
          }
          echo "<sup>*)</sup>";
echo "<div style=\"margin-top: 15%;\">.................................................</div>
      </div>
			</div>
      <div id=\"przypisy\" style=\"margin-left: 3%; margin-top: 1%;\">
      ________________________________<br />
      *) - niepotrzebne skreślić.
      </div>
      </div>";

 ?>
