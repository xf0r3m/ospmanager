<?php

echo "<style>
	form { width: inherit; }
	.form_inputs, .form_button, #genCard { font-size: 10px; }
	</style>";

  if ( isset($_GET['typ']) && ( $_GET['typ'] === 'zd' ) ) {
    $action = "index.php?page=docs&form=list&zd=on";
  } else if ( isset($_GET['typ']) && ( $_GET['typ'] === 'sz' )  ) {
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

echo ": </td><td><input class=\"form_inputs\" type=\"date\" name=\"data\" /></td></tr>
      <tr><td>Typ dysponowanego samochodu: </td><td><input class=\"form_inputs\" type=\"text\" name=\"samochod\" /></td></tr>
      <tr><td>Czas udziału w ";

//unnecessaryDelete("działaniu ratowniczym", "szkoleniu", $_GET['zd'], $_GET['sz']);

      if ( isset($_GET['typ']) && ( $_GET['typ'] === "zd" ) ) {
        echo  "działaniu ratowniczym / <s>szkoleniu</s>";
      } else if ( isset($_GET['typ']) && ( $_GET['typ'] === "sz" ) ) {
        echo "<s>działaniu ratowniczym</s> / szkoleniu";
      } else {
        echo "działaniu ratowniczym / szkoleniu";
      }
      echo "<sup>*)</sup>";

echo "(od-do): </td><td><input class=\"form_inputs\" type=\"text\" name=\"czas\" /></td></tr>
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

echo ": </td><td><input class=\"form_inputs\" type=\"text\" name=\"miejsce\" /></td></tr>
      <tr><td>Rodzaj ";
//unnecessaryDelete("zdarzenia", "szkolenia", $_GET['zd'], $_GET['sz']);

      if ( isset($_GET['typ']) && ( $_GET['typ'] === "zd" ) ) {
          echo  "zdarzenia / <s>szkolenia</s>";
      } else if ( isset($_GET['typ']) && ( $_GET['typ'] === "sz" ) ) {
          echo "<s>zdarzenia</s> / szkolenia";
      } else {
          echo "zdarzenia / szkolenia";
      }
      echo "<sup>*)</sup>";

echo ": </td><td><input class=\"form_inputs\" type=\"text\" name=\"rodzaj\" /></td><tr>
      <tr><td colspan=\"2\">Imienny wykaz osób biorących udział w ";

//unnecessaryDelete("działaniu ratowniczym", "szkoleniu", $_GET['zd'], $_GET['sz']);

      if ( isset($_GET['typ']) && ( $_GET['typ'] === "zd" ) ) {
      echo  "działaniu ratowniczym / <s>szkoleniu</s>";
      } else if ( isset($_GET['typ']) && ( $_GET['typ'] === "sz" ) ) {
      echo "<s>działaniu ratowniczym</s> / szkoleniu";
      } else {
      echo "działaniu ratowniczym / szkoleniu";
      }
      echo "<sup>*)</sup>";

echo "</td></tr></table>";

    $query = "SELECT id,imie,nazwisko FROM str_do";
    $result = mysqli_query($connection, $query);
    $resultbak = $result;
    $row_count = mysqli_num_rows($result);
    if ( $row_count > 0 ) {

      echo "<table>
            <tr><th>Lp.</th><th>Imie i nazwisko członka OSP</th>
                <th>Ilość godzin udziału</th>
                <th>Należny ekwiwalent</th>
                <th>Podpis</th></tr>";

      for ( $i=1; $i <= $row_count; $i++) {
        //var_dump($result);
        echo "<tr><td>" . $i . "</td>
              <td><select class=\"form_inputs\" name=\"personal_id[]\">";


                while ( $row = mysqli_fetch_row($result) ) {
                  echo "<option value=\"" . $row[0] . "\">" . $row[1] . " " . $row[2] . "</option>";
                }


        echo "</select></td>
              <td><input class=\"form_inputs\" type=\"text\" name=\"iloscgodzin[]\" /></td>
              <td><input class=\"form_inputs\" type=\"text\" name=\"ekwiwalent[]\" /></td>
              <td><input class=\"form_inputs\" type=\"text\" /></td></tr>";

        mysqli_data_seek($result, 0);
      }
      echo "</table>";
   } else {
	   echo "<h3>Brak zdefiniowanych uczestników akcji</h3>";
	}

    echo "<div><input class=\"form_button\" type=\"submit\" value=\"Generuj wykaz\" /></div>
      </form>";



 ?>
