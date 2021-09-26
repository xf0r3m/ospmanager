<?php

function createDivs($connection, $list, $label, $tName, $whereValue = 'true') {
	for ( $i=0; $i < count($list); $i++ ) {

		$fieldName = substr($list[$i], (strlen($tName) + 1));

		echo "<div id=\"" . $list[$i] . "\" style=\"display: none;\">";

		$result = prepareForm($connection, $tName, $fieldName, $whereValue);

			echo "<table class=\"tc_table\" style=\"border-spacing: 0;\">
						<tr class=\"nonParityTableRow\">
						<th style=\"height: 30px;\">" . $label[$i] . "</th>
						</tr>";
			$rcount = 2;

		while ( $row = mysqli_fetch_row($result) ) {
		
			//var_dump($row);

			if ( $rcount % 2 === 0 ) {
				echo "<tr class=\"parityTableRow\">";
			} else {
				echo "<tr class=\"nonParityTableRow\">";
			}

			if ( stripos($fieldName, 'data') !== FALSE ) {
				$row0Explode = explode(' ', $row[0]);
				$row[0] = $row0Explode[0];
			} else if ( stripos($fieldName, 'wyksztalcenie') !== FALSE ) {
				switch ($row[0]) {
					case 'P':
						$row[0] = 'podstawowe';
						break;
					case 'Z':
						$row[0] = 'zawodowe';
						break;
					case 'S':
						$row[0] = 'średnie';
						break;
					case 'W':
						$row[0] = 'wyższe';
						break;
					default:
						$row[0] = 'B.D.';
						break;
				}
			}

			if ( strlen($row[0]) === 0 ) { 
				echo "<td class=\"tc_cell\" style=\"height: 30px;\">" . $row[0] . "</td>"; 
			}
			else { echo "<td class=\"tc_cell\" style=\"height: 30px;\">" . $row[0] . "</td>"; }

			echo "</tr>";

			$rcount++;

		}
			echo "</table>";
		echo "</div>";

	}
}


$list27 = ['Imię', 'Nazwisko', 'Pesel', 'Data urodzenia', 'Data wstąpienia',
						'Stopień', 'Funkcja', 'Wykształcenie', 'Imię Ojca',
						'Miejsce urodzenia', 'Płeć', 'Zawód', 'Miejsce pracy',
						'Udział w akcjach', 'Numer legitymacji', 'Drugie imię', 'Rodzaj',
						'Nr telefonu'];

$list28 = ['str_do_imie', 'str_do_nazwisko', 'str_do_pesel', 'str_do_data_ur', 'str_str_data_wst',
						'str_str_stopien', 'str_str_funkcja', 'str_do_wyksztalcenie', 'str_do_imie_ojca',
						'str_do_msc_ur', 'str_do_plec', 'str_do_zawod', 'str_do_msc_pracy',
						'str_str_udzwakc', 'str_str_nr_legitymacji', 'str_do_imie2', 'str_str_rodzaj',
						'str_do_nr_tel'];

$list29 = ['str_do_imie', 'str_do_nazwisko', 'str_do_pesel', 'str_do_data_ur',
					'str_do_wyksztalcenie', 'str_do_imie_ojca', 'str_do_msc_ur', 'str_do_plec',
					'str_do_zawod', 'str_do_msc_pracy', 'str_do_imie2', 'str_do_nr_tel'];

$label29 = ['Imię', 'Nazwisko', 'Pesel', 'Data urodzenia',
						'Wykształcenie', 'Imie ojca', 'Miejsce urodzenia', 'Płeć',
						'Zawód', 'Miejsce pracy', 'Drugie imie', 'Numer telefonu'];

$list30 = ['str_str_data_wst', 'str_str_stopien', 'str_str_funkcja',
						'str_str_udzwakc', 'str_str_nr_legitymacji','str_str_rodzaj'];

$label30 = ['Data wstąpienia', 'Stopień', 'Funkcja', 'Udział w akcjach',
						'Numer legitymacji', 'Rodzaj'];


if ( isset($_GET['filters']) ) {

	if ( ( isset($_POST['szkolenie']) && (strlen($_POST['szkolenie']) > 0) ) &&
	 			( isset($_POST['badanie']) && (strlen($_POST['badanie']) > 0 ) ) ) {

			$prepareValue1 = mysqli_real_escape_string($connection, $_POST['szkolenie']);
			$prepareValue2 = mysqli_real_escape_string($connection, $_POST['badanie']);

			$whereValue	= "id IN (SELECT personal_id FROM str_szk WHERE nazwa='" . $prepareValue1 . "')
			AND id IN (SELECT personal_id FROM str_bad WHERE nazwa='" . $prepareValue2 . "');";

	} else if ( ! isset($_POST['szkolenie']) || ( strlen($_POST['szkolenie']) <= 0 ) ) {

		$prepareValue1 = mysqli_real_escape_string($connection, $_POST['badanie']);
		$whereValue = "id IN (SELECT personal_id FROM str_bad WHERE nazwa='" . $prepareValue1 . "');";

	} else if ( ! isset($_POST['badanie']) || ( strlen($_POST['badanie']) <= 0 ) ) {

		$prepareValue1 = mysqli_real_escape_string($connection, $_POST['szkolenie']);
		$whereValue = "id IN (SELECT personal_id FROM str_szk WHERE nazwa='" . $prepareValue1 . "');";

	}

	createDivs($connection, $list29, $label29, 'str_do', $whereValue);
	createDivs($connection, $list30, $label30, 'str_str', $whereValue);

} else {

	echo "
	<div id=\"filters\" style=\"font-size: 22px\">
	Szkolenie:
		<select name=\"szkolenie\">
				<option></option>";

		$list25 = ["Dowódców",
							 "Działania poszukiwawczo-ratownicze",
							 "Kierowców - konserwatorów sprzętu ratowniczego",
							 "Komendantów Gminnych ZOSP RP",
							 "Kwalifikowana pierwsza pomoc",
							 "Naczelników",
							 "Podstawowe strażaków ratowników OSP",
							 "Ratownictwo chemiczne i ekologiczne",
							 "Ratownictwo wodne",
							 "Ratownictwo wysokościowe",
							 "Współpraca z LPR"];

		for ( $i=0; $i < count($list25); $i++ ) {

			echo "<option value=\"" . $list25[$i] . "\">" . $list25[$i] . "</option>";

		}

echo "</select><br />
		Badanie:
		<select name=\"badanie\">
			<option></option>
			<option value=\"okresowe\">okresowe</option>
			<option value=\"kierowców\">kierowców</option>
		</select><br />
		<br />
		<button id=\"apply_filters\">Zastosuj filtry</button>
	</div>
	<hr id=\"theline\">
	<div id=\"form\" style=\"font-size: 22px;\">
		<form action=\"index.php\">";

		echo "<table>";

			for ( $i=0; $i < count($list27); $i++ ) {

				if ( $i === 0 ) { echo "<tr>"; }
				if ( $i % 2 === 0 ) { echo "</tr><tr>"; }

					echo "<td>" . $list27[$i] . ": </td><td>
					<input class=\"table_creator\" type=\"checkbox\" name=\"" . $list28[$i] . "\" style=\"width: 22px; height: 22px;\" />
					</td>";

				if ( $i === ( count($list27) - 1 ) ) { echo "</tr>"; }

			}

		echo "</table>
		</form>";
	echo "</div>
				<hr id=\"theline\">
				<div id=\"result\" style=\"font-size: 18px;\">";
echo "<a href=\"javascript:print()\"><button id=\"p_button\"><img id=\"p_image\" src=\"resources/printer.png\" /></button></a><br /><br />";



		createDivs($connection, $list29, $label29, 'str_do');
		createDivs($connection, $list30, $label30, 'str_str');


	echo "</div>";

}
 ?>
