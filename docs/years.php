<?php

echo "<a href=\"javascript:print()\"><button id=\"p_button\"><img id=\"p_image\" src=\"resources/printer.png\" /></button></a><br /><br />";

echo "<div style=\"width: 281mm; padding: 10mm; background-color: white; float: left;\">
      <div id=\"osp\">Ochotnicza Straż Pożarna w Gronowie</div>
      <div id=\"title\" style=\"text-align: center;\"><h3>Wniosek do prezydium Zarządu Gminnego Związku
      Ochotniczych Straży Pożarnych RP w Toruniu.</h3></div>
      <p style=\"text-align: justify;\">Stosownie do uchwały nr ........... Zarządu Ochotniczej Straży Pożarnej
      w Toruniu z dnia ............... 200... roku wnosimy o nadanie odznak
      \"Za wysługę Lat\"
      nizej wymienionym członkom naszej OSP:<br />
			</p>
      <div style=\"width: 80%; margin: auto;\">";
  $tName = 'str_do';
  $csh = 'id,imie,nazwisko,data_ur';
  $whereValue = 'true';
  $result = prepareForm($connection, $tName, $csh, $whereValue);

  if ( mysqli_num_rows($result) > 0 ) {

      echo "<table border=\"1\" style=\"border-collapse: collapse;\">
      <tr><th>Lp.</th><th>Imię i nazwisko</th><th>Data urodzenia</th>
      <th>Data wstąpienia do OSP lub MDP</th><th>Funkcja</th>
      <th>Liczba lat działalności w OSP lub MDP</th><th>Wnioskowana odznaka</th>
      <th>Nr legitymacji i data wydania</th></tr>";
      $i=1;
      while ( $row = mysqli_fetch_row($result) ) {

        $tName = 'str_str';
        $csh = 'funkcja,data_wst,nr_legitymacji';
        $whereValue = 'id=' . $row[0];
        $result1 = prepareForm($connection, $tName, $csh, $whereValue);

        if ( mysqli_num_rows($result1) === 0 ) {

          continue;

        } else {

          $row1 = mysqli_fetch_row($result1);

          $data_wst = $row1[1];
          $dwTab = explode("-", $data_wst);
          $currentD = date('d');
          $currentM = date('m');
          $currentY = date('Y');
          $LAT = ($currentY - $dwTab[0]);

          if ( $LAT < 5 ) { continue; }

          if ( $currentM >= $dwTab[1] ) {
            if ( $currentD >= $dwTab[2]) { $LAT++; }
          }
          $ODZNAKA = ( floor($LAT / 5) * 5 );

          $row3explode = explode(' ', $row[3]);
          $row11explode = explode(' ', $row1[1]);

          echo "<tr style=\"text-align: center;\"><td>" . $i . "</td>
                <td>" . $row[1] . " " . $row[2] . "</td>
                <td>" . $row3explode[0] . "</td>
                <td>" . $row11explode[0] . "</td>
                <td>" . $row1[0] . "</td>
                <td>" . $LAT . "</td>
                <td>" . $ODZNAKA . "</td>
                <td>" . $row1[2] . "</td>
                </tr>";

        }
        $i++;
      }
      echo "</table>";
  }
echo "
</div>
<div style=\"width: 100%; float: left; margin-top: 7%;\">
<div id=\"sekretarz\" style=\"float: left; margin-left: 11%; text-align: center;\">.................................<br />
Sekretarz OSP<br /></div>";
echo "<div id=\"mp\" style=\"float: left; margin-left: 25%;\">m.p.</div>";
echo "<div id=\"prezes\" style=\"float: left; margin-left: 25%; text-align: center;\">.................................<br />
Prezes OSP<br /></div>
</div>";
echo "<div id=\"decyzja\" style=\"float: left; margin-top: 5%;\">
Prezydium Zarządu Gminnego ZOSP RP w ....................................... uchwałą nr ..................... z dnia ........
................... 200... roku przyznało odznaki
<br />wyżej wymienionym członkom Ochotniczej Straży Pożarnej w Gronowie.
</div>
<div style=\"width: 100%; float: left; margin-top: 7%;\">";
echo "<div id=\"zgzosps\" style=\"float: left; margin-left: 10%; text-align: center;\">...............................<br />
Sekretarz ZG ZOSP RP</div>";
echo "<div id=\"zgzospmp\" style=\"float: left; margin-left: 25%;\">m.p.</div>";
echo "<div id=\"zgzospsp\" style=\"float: left; margin-left: 25%; text-align: center;\">..............................<br />
Prezes ZG ZOSP RP</div>";
echo "</div>
</div>";
 ?>
