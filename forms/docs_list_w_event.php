<?php

echo "<style>
	form { width: inherit; }
	.form_inputs, .form_button, #genCard { font-size: 10px; }
	</style>";


  if ( isset($_GET['typ']) && ( $_GET['typ'] === 'zd' ) ) {
    $action = "index.php?page=docs&form=list&zd=on";
  } else if ( isset($_GET['typ']) && ( $_GET['typ'] === 'sz' ) ) {
    $action = "index.php?page=docs&form=list&sz=on";
  } else {
    $action = "index.php?page=docs&form=list";
  }


  echo "<form action=\"" . $action . "\" method=\"post\">
        <table>
        <tr><td>Numer wykazu: </td><td><input class=\"form_inputs\" type=\"number\" name=\"numer\" /></td></tr>
        <tr><td>Data ";

  //unnecessaryDelete("zdarzenia", "szkolenia", $_GET['zd'], $_GET['sz']);

  if ( isset($_GET['typ']) && ( $_GET['typ'] === 'zd' ) ) {
    echo  "zdarzenia / <s>szkolenia</s>";
  } else if ( isset($_GET['typ']) && ( $_GET['typ'] === 'sz' ) ) {
    echo "<s>zdarzenia</s> / szkolenia";
  } else {
    echo "zdarzenia / szkolenia";
  }
  echo "<sup>*)</sup>";

  $row0[1] = convertData($row0[1]);
  $row01Tab = explode(' ', $row0[1]);

  echo ": </td><td><input class=\"form_inputs\" type=\"text\" name=\"data\" value=\"" . $row01Tab[0] . "\" /></td></tr>";

  if ( ! isset($row2) ) {
    echo "<tr><td>Typ dysponowanego samochodu: </td><td><input class=\"form_inputs\" type=\"text\" name=\"samochod\" /></td></tr>";
  } else {
    echo "<tr><td>Typ dysponowanego samochodu: </td>
          <td><input class=\"form_inputs\" type=\"text\" name=\"samochod\" value=\"" . $row2[0] . "\" /></td></tr>";
  }

  echo "<tr><td>Czas udziału w ";

  //unnecessaryDelete("działaniu ratowniczym", "szkoleniu", $_GET['zd'], $_GET['sz']);

  if ( isset($_GET['typ']) && ( $_GET['typ'] === "zd" ) ) {
    echo  "działaniu ratowniczym / <s>szkoleniu</s>";
  } else if ( isset($_GET['typ']) && ( $_GET['typ'] === "sz" ) ) {
    echo "<s>działaniu ratowniczym</s> / szkoleniu";
  } else {
    echo "działaniu ratowniczym / szkoleniu";
  }
  echo "<sup>*)</sup>";

  $row02Tab = explode(' ', $row0[2]);
  $stime = substr($row02Tab[1], 0, 5);

  $row03Tab = explode(' ', $row0[3]);
  $etime = substr($row03Tab[1], 0, 5);

  echo "(od-do): </td><td><input class=\"form_inputs\" type=\"text\" name=\"czas\" value=\"" . $stime . " - " . $etime . "\" /></td></tr>
        <tr><td>Miejsce ";

  //unnecessaryDelete("zdarzenia", "szkolenia", $_GET['zd'], $_GET['sz']);

  if ( isset($_GET['typ']) && ( $_GET['typ'] === "zd" ) ) {
    echo  "zdarzenia / <s>szkolenia</s>";
  } else if ( isset($_GET['typ']) && ( $_GET['typ'] === "sz" ) ) {
    echo "<s>zdarzenia</s> / szkolenia";
  } else {
    echo "zdarzenia / szkolenia";
  }
  echo "<sup>*)</sup>";

  if ( strlen($row0[5]) > 0 ) {
	  
  	echo ": </td><td><input class=\"form_inputs\" type=\"text\" name=\"miejsce\"
        	value=\"" . $row0[5] . " " . $row0[6] . ", " . $row0[4] . "\" /></td></tr>
	<tr><td>Rodzaj ";
  } else {
  echo ": </td><td><input class=\"form_inputs\" type=\"text\" name=\"miejsce\"
        	value=\"" . $row0[4] . " " . $row0[6] . "\" /></td></tr>
	<tr><td>Rodzaj ";

  }

  //unnecessaryDelete("zdarzenia", "szkolenia", $_GET['zd'], $_GET['sz']);

  if ( isset($_GET['typ']) && ( $_GET['typ'] === 'zd' ) ) {
      echo  "zdarzenia / <s>szkolenia</s>";
  } else if ( isset($_GET['typ']) && ( $_GET['typ'] === 'sz' ) ) {
      echo "<s>zdarzenia</s> / szkolenia";
  } else {
      echo "zdarzenia / szkolenia";
  }
  echo "<sup>*)</sup>";

  echo ": </td><td><input class=\"form_inputs\" type=\"text\" name=\"rodzaj\" value=\"" . $row0[7] . "\" /></td><tr>
        <tr><td colspan=\"2\">Imienny wykaz osób biorących udział w ";

  //unnecessaryDelete("działaniu ratowniczym", "szkoleniu", $_GET['zd'], $_GET['sz']);


        if ( isset($_GET['typ']) && ( $_GET['typ'] === 'zd' ) ) {
        echo  "działaniu ratowniczym / <s>szkoleniu</s>";
        } else if ( isset($_GET['typ']) && ( $_GET['typ'] === 'sz' ) ) {
        echo "<s>działaniu ratowniczym</s> / szkoleniu";
        } else {
        echo "działaniu ratowniczym / szkoleniu";
        }
        echo "<sup>*)</sup>";

  echo "</td></tr></table>";

      $tName = 'e_member';
      $csh = 'udzial,personal_id';
      $whereValue = 'event_id=' . $row0[0];
      $result = prepareForm($connection, $tName, $csh, $whereValue);
      $row_count = mysqli_num_rows($result);

      if ( $row_count > 0 ) {
        $i=1;
        echo "<table>
              <tr><th>Lp.</th><th>Imie i nazwisko członka OSP</th>
                  <th>Ilość godzin udziału</th>
                  <th>Należny ekwiwalent</th>
                  <th>Podpis</th></tr>";

        while ( $row = mysqli_fetch_row($result) ) {

          $tName = 'str_do';
          $csh = 'imie,nazwisko';
          $whereValue = 'id=' . $row[1];
          $result1 = prepareForm($connection, $tName, $csh, $whereValue);
          $row1 = mysqli_fetch_row($result1);

          echo "<tr><td>" . $i . "</td>
		<td><select class=\"form_inputs\" name=\"personal_id[]\">
			<option value=\"" . $row[1] . "\">" . $row1[0] . " " . $row1[1] . "</option>
		</select>
		</td>
                <td><input class=\"form_inputs\" type=\"text\" name=\"iloscgodzin[]\" value=\"" . $row[0] . "\" /></td>
                <td><input class=\"form_inputs\" type=\"text\" name=\"ekwiwalent[]\" /></td>
                <td><input class=\"form_inputs\" type=\"text\" /></td></tr>";

          $i++;
        }

        echo "</table>";

      } else {
        echo "<h3>Brak zdefiniowanych uczestników akcji</h3>";
      }


      echo "
	<input class=\"form_inputs\" type=\"hidden\" name=\"nrmel\" value=\"" . $row0[8] . "\" />
    <div><input class=\"form_button\" type=\"submit\" value=\"Generuj wykaz\" /></div>
    </form>";
?>
