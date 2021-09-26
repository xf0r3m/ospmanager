<?php

echo "<a href=\"javascript:print()\"><button id=\"p_button\"><img id=\"p_image\" src=\"resources/printer.png\" /></button></a><br /><br />";

//$row = mysqli_fetch_row($result);
echo "<div style=\"width: 210mm; height: 277mm; padding-right: 5mm; padding-left: 5mm; padding-top: 20mm; background-color: white;\">
      <p>(pieczęć nagłówkowa zakładu opieki zdrowotnej lub lekarza)</p>
      <p style=\"text-align: center;\">ZAŚWIADCZENIE LEKARSKIE</p>
      <p style=\"text-align: justify;\">W wyniku badań lekarskich na podstawie &sect; 2 ust. 5 Rozporządzenia
      Ministra Zdrowia z dnia 30 listopada 2009 roku w sprawie przeprowadzania
      okresowych bezpłatnych badań lekarskich członka ochotniczej straży
      pożarnej biorącego bezpośredni udział w działaniach ratowniczych (DZ. U.
      2009 Nr 210 poz. 1627) orzeka się, że </p>
      <p>";
      if ( $_POST['plec'] === 'K' ) {
        echo "<s>Pan</s>/Pani ";
      } else {
        echo "Pan/<s>Pani</s> ";
      }
      echo "<strong>" . $_POST['imie'] . " " . $_POST['nazwisko'] . "</strong><br />";
      if ( $_POST['plec'] === 'K' ) {
        echo "<s>Syn</s>/Córka ";
      } else {
        echo "Syn/<s>Córka</s> ";
      }

      if ( stripos($_POST['imie_ojca'], 'marek') !== FALSE ) {
        $io = 'Marka';
        $modyfikator = '';
      } else if ( stripos($_POST['imie_ojca'], 'jacek') !== FALSE ) {
        $io = 'Jacka';
        $modyfikator = '';
      } else {
	$io_l = strlen($_POST['imie_ojca']);
        $io_Tab = str_split($_POST['imie_ojca']);
        $io_last = $io_Tab[($io_l - 1)];
        if ( $io_last === 'a' ) {
          $modyfikator = 'y';
          $io = substr($_POST['imie_ojca'], 0, (strlen($_POST['imie_ojca']) - 1));
	} else if ( $io_last === 'y' ) {

		$modyfikator = 'ego';
		$io = substr($_POST['imie_ojca'], 0, (strlen($_POST['imie_ojca']) - 1));
		
	} else {
          $modyfikator = 'a';
          $io = $_POST['imie_ojca'];
        }
      }
		

      echo "<strong>" . $io;

      if ( $_POST['plec'] === 'K' ) {
        echo $modyfikator . "</strong> <s>urodzony</s>/urodzona";
      } else {
        echo $modyfikator . "</strong> urodzony/<s>urodzona</s>";
      }
      $time = strtotime($_POST['data_ur']);
      echo " dnia <strong>" . date('d.m.Y', $time) . "</strong><br /> w <b>" . $_POST['msc_ur'] . "</b> w województwie <b>" . $_POST['woj'] . "</b> <br />";
      if ( $_POST['plec'] === 'K' ) {
        echo "<s>zamieszkały</s>/zamieszkała";
      } else {
        echo "zamieszkały/<s>zamieszkała</s>";
      }
      echo " w <b>" . $_POST['adres'] . "</b> ";
      if ( $_POST['plec'] === 'K' ) {
        echo "<s>posiadający</s>/posiadająca";
      } else {
        echo "posiadający/<s>posiadająca</s>";
      }
      echo " numer PESEL ";
			if ( strlen($_POST['pesel']) > 0 ) {
      	$pesel = str_split($_POST['pesel'], 1);
      	echo "<table border=\"1\" style=\"border-collapse: collapse; width: 40%;\"><tr>";
      	for ( $i=0; $i < count($pesel); $i++ ) {
        	echo "<td style=\"text-align: center; vertical-align: middle;\"><b>" . $pesel[$i] . "</b></td>";
      	}
			} else {
				echo "<table border=\"1\" style=\"border-collapse: collapse; width: 40%;\"><tr>";
				for ( $i=0; $i < 11; $i++ ) {
					echo "<td style=\"text-align: center; vertical-align: middle; height: 22px;\"></td>";
				}
			}
      echo "</tr></table><br />";
      echo "( w przypadku osoby nie posiadającej numeru PESEL, nazwa i numer dokumentu potwierdzającego tożsamość)<br />";
      echo "...............................................................................................................................<br />";

      if ( $_POST['plec'] === 'K' ) {
        echo "<s>który</s>/która";
      } else {
        echo "który<s>/która</s>";
      }

      $tName = 'h_osp';
      $csh = 'msc';
      $whereValue = 'true';
      $result1 = prepareForm($connection, $tName, $csh, $whereValue);
			if ( mysqli_num_rows($result1) > 0 ) {
      	$row1 = mysqli_fetch_row($result1);
      	echo " w Ochotniczej Straży Pożarnej w Gronowie<br />";
			} else {
				echo " w Ochotniczej Straży Pożarnej w ......................................................";
			}

      $tName = 'str_str';
      $csh = 'funkcja';
      $whereValue = 'true';
      $result2 = prepareForm($connection, $tName, $csh, $whereValue);
			if ( mysqli_num_rows($result2) > 0 ) {
				$row2 = mysqli_fetch_row($result2);
	$row2Tab = explode(' ', $row2[0]);
	$funkcja = "";

	for ( $i=0; $i < count($row2Tab); $i++ ) {
	
		if ( $i === 0 ) { $funkcja = $row2Tab[$i] . "a"; }
		else { $funkcja .= $row2Tab[$i]; }
	}

      	echo " pełni funkcję " . $funkcja . "<br />";
			} else {
				echo " pełni funkcję .................................. <br />";
			}
      echo "<p style=\"text-align: justify;\">Wobec braku przeciwskazań zdrowotnych jest ";
			if ( $_POST['plec'] === 'K' ) {
			 	echo "<strong><s>zdolny</s>/zdolna</strong>";
		 	} else {
			 	echo "<strong>zdolny/<s>zdolna</s></strong>";
		 	}
			echo " - ";
			if ( $_POST['plec'] === 'K' ) {
				echo "<strong><s>niezdolny</s>/niezdolna*</strong>";
			} else {
				echo "<strong>niezdolny/<s>niezdolna</s>*</strong>";
			}
			echo " do bezpośredniego udziało w działaniach ratowniczych polegających
      na walce z pożarami, klęskami żywiołowymi i innym miejscowymi zagrożeniami przy pomocy
      specjalistycznego sprzętu w tym również sprzętu ochrony dróg oddechowych.</p>";

      echo "<p>Ponadto stwierdzam, że ";
      if ( $_POST['plec'] === 'K' ) {
        echo "<strong><s>wymieniony</s>/wymieniona</strong>";
      } else {
        echo "<strong>wymieniony/<s>wymieniona</s></strong>";
      }
      echo " jest ";
			if ( $_POST['plec'] === 'K' ) {
				echo "<strong><s>zdolny</s>/zdolna*</strong>";
			} else {
				echo "<strong>zdolny/<s>zdolna</s>*</strong>";
			}
			echo "do udziału:<br />
          <br />
          - w szkoleniu ratowniczym<br />
          <br />
          - w zawodach sportowych<br />
          <br />
          - w zawodach sportow - pożarniczych<br />
          <br />
          - w cwiczeniach ratowniczych.<br /><br />
          Zaświadczenie jest ważne do dnia ............................................ <br />
          UWAGA niniejsze zaświadczenie lekarskie może być wydane na okres nie dłuższy niż 3 lata.<br />
          </p>
          <br /><br />
          <p style=\"margin-bottom: 1px;\">............................................
					<p style=\"margin-top: 1px; width: 22%; text-align: center;\">(miejscowość i data)</p><br /><p>
          <p style=\"text-align: center; width: 40%; margin-left: 50%;\">podpis i pieczęć lekarza<br />
            (uprawnionego do badań profilaktycznych osób u których występuje<br />
            narażenie na czynniki szkodliwe dla zdrowia)</p>";



echo "</div>";

 ?>
