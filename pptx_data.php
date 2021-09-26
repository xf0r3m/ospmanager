<?php

if ( isset($_POST['pmeeting_info']) && ( strlen($_POST['pmeeting_info']) > 0) ) {
//echo "<h2>Informacje o jednostce</h2>";
$infoMSG = 'OSP Gronowo założona w 1966 r. we wsi Gronowo. Położona blisko wjazdu na autostradę A1';

$nextSlide = $phpPresentation->createSlide();

$shape = $nextSlide->createRichTextShape()
			-> setHeight(300)
			-> setWidth(600)
			-> setOffsetX(170)
			-> setOffsetY(10);

$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_CENTER );
$textRun = $shape->createTextRun('Informacje o jednostce');
$textRun->getFont()->setItalic(true)
									 ->setSize(28);

$shape = $nextSlide->createRichTextShape()
									 -> setHeight(300)
									 -> setWidth(600)
									 -> setOffsetX(170)
									 -> setOffsetY(180);

$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_CENTER );
$textRun = $shape->createTextRun($infoMSG);
$textRun->getFont()->setSize(20);


}

if ( isset($_POST['pmeeting_ff']) && ( strlen($_POST['pmeeting_ff']) > 0) ) {


	$nextSlide = $phpPresentation->createSlide();

	$shape = $nextSlide->createRichTextShape()
				-> setHeight(300)
				-> setWidth(600)
				-> setOffsetX(170)
				-> setOffsetY(10);

	$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_CENTER );
	$textRun = $shape->createTextRun('Strażacy');
	$textRun->getFont()->setItalic(true)
										 ->setSize(28);

//echo "<h2>Strażacy</h2>";
$query = "SELECT COUNT(id) FROM str_str WHERE udzwakc <> 'nie bierze';";
$czynnyFF = randomQuery($connection, $query);
$czynnyFFmsg = $czynnyFF . " - strażaków biorących udział w akcjach";
//echo $czynnyFFmsg . "<br />";

$shape = $nextSlide->createRichTextShape()
									 -> setHeight(300)
									 -> setWidth(600)
									 -> setOffsetX(170)
									 -> setOffsetY(90);

$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_LEFT );
$textRun = $shape->createTextRun($czynnyFFmsg);
$textRun->getFont()->setSize(20);

$query = "SELECT COUNT(id) FROM str_str WHERE udzwakc = 'nie bierze';";
$nieczynnyFF = randomQuery($connection, $query);
$nieczynnyFFmsg = $nieczynnyFF . " - strażaków niebiorących udział w akcjach";
//echo $nieczynnyFFmsg . "<br />";

$shape = $nextSlide->createRichTextShape()
									 -> setHeight(300)
									 -> setWidth(600)
									 -> setOffsetX(170)
									 -> setOffsetY(120);

$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_LEFT );
$textRun = $shape->createTextRun($nieczynnyFFmsg);
$textRun->getFont()->setSize(20);



}
if ( isset($_POST['pmeeting_event']) && ( strlen($_POST['pmeeting_event']) > 0) ) {
//echo "<h2>Akcje</h2>";

$nextSlide = $phpPresentation->createSlide();

$shape = $nextSlide->createRichTextShape()
			-> setHeight(300)
			-> setWidth(600)
			-> setOffsetX(170)
			-> setOffsetY(10);

$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_CENTER );
$textRun = $shape->createTextRun('Akcje');
$textRun->getFont()->setItalic(true)
									  ->setSize(28);

$list = ["Fałszywy alarm", "Miejscowe zagrożenie", "Pomoc policji",
					"Pożar", "Wypadek", "Zabezpieczenie rejonu"];

$list2 = ["otrzymanych fałszywych alarmów", "zneutralizowanych miejscowych zagrożeń",
					"pomocy policji", "gaszenia pożarów", "pomocy przy wypadkach",
			 		"zabezpieczania rejonu"];
$offsetY = 50;

for ( $i=0; $i < count($list); $i++ ) {

		$prepareString = mysqli_real_escape_string($connection, $list[$i]);
		$query = "SELECT COUNT(id) FROM e_about WHERE rodzaj='" . $prepareString . "'
							AND (alarm > '" . $_POST['pmeeting_start'] . "' AND alarm < '" . $_POST['pmeeting_end'] . "');";
		$result = randomQuery($connection, $query);

		$msg = $result . ' - ' . $list2[$i];

		$shape = $nextSlide->createRichTextShape()
											 -> setHeight(300)
											 -> setWidth(600)
											 -> setOffsetX(170)
											 -> setOffsetY($offsetY);

		$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_LEFT );
		$textRun = $shape->createTextRun($msg);
		$textRun->getFont()->setSize(20);

		$offsetY += 20;
}

}
if ( isset($_POST['pmeeting_eq']) && ( strlen($_POST['pmeeting_eq']) > 0) ) {
//echo "<h3>Sprzęt</h3>";

$nextSlide = $phpPresentation->createSlide();

$shape = $nextSlide->createRichTextShape()
			-> setHeight(300)
			-> setWidth(600)
			-> setOffsetX(170)
			-> setOffsetY(10);

$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_CENTER );
$textRun = $shape->createTextRun('Sprzęt');
$textRun->getFont()->setItalic(true)
									  ->setSize(28);

$list3 = ['Agregaty pożarnicze', 'Drabiny pożarnicze',
					'Podręczny sprzęt gaśniczy', 'Pompy pożarnicze',
					'Płachtowe urządzenie ratownicze', 'Sprzęt burzący',
					'Sprzęt i armatura wodna', 'Sprzęt nurkowy i pływający',
					'Sprzęt o napędzie elektrycznym', 'Sprzęt o napędzie pneumatycznym',
					'Sprzęt o napędzie spalinowym', 'Sprzęt oświetleniowy',
					'Sprzęt pianowy', 'Sprzęt łączności', 'Uzrbojenie osobiste'];

$offsetY = 50;

for ( $i=0; $i < count($list3); $i++ ) {

		$prepareString = mysqli_real_escape_string($connection, $list3[$i]);
		$query = "SELECT COUNT(id) FROM eq_about WHERE rodzaj='" . $prepareString . "'
							AND stan = 'Zdatny'";
		$result = randomQuery($connection, $query);

		$msg2 = $result . ' - ' . $list3[$i];

		$shape = $nextSlide->createRichTextShape()
											 -> setHeight(300)
											 -> setWidth(600)
											 -> setOffsetX(170)
											 -> setOffsetY($offsetY);

		$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_LEFT );
		$textRun = $shape->createTextRun($msg);
		$textRun->getFont()->setSize(20);

		$offsetY += 20;
}

//var_dump($msg2);
}
if ( isset($_POST['pmeeting_vehicle']) && ( strlen($_POST['pmeeting_vehicle']) > 0) ) {
//echo "<h2>Pojazdu</h2>";
$nextSlide = $phpPresentation->createSlide();

$shape = $nextSlide->createRichTextShape()
			-> setHeight(300)
			-> setWidth(600)
			-> setOffsetX(170)
			-> setOffsetY(10);

$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_CENTER );
$textRun = $shape->createTextRun('Pojazdy');
$textRun->getFont()->setItalic(true)
									  ->setSize(28);

$shape = $nextSlide->createRichTextShape()
										-> setHeight(300)
										-> setWidth(600)
										-> setOffsetX(170)
										-> setOffsetY(50);

$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_LEFT );
$textRun = $shape->createTextRun('Jednostka jest w posiadaniu następujących pojazdów');
$textRun->getFont()->setSize(20);

$query = "SELECT nazwa FROM vehicle_about";
$result = mysqli_query($connection, $query);
if ( mysqli_num_rows($result) > 0 ) {
	$vehicles="";
	while ( $row = mysqli_fetch_row($result) ) {
		$vehicles .= $row[0] . ",";
	}
	$vehicles = substr($vehicles, 0, -1);
} else {
	$vehicles = 'Brak pojazdów.';
}

$shape = $nextSlide->createRichTextShape()
										-> setHeight(300)
										-> setWidth(600)
										-> setOffsetX(170)
										-> setOffsetY(90);

$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_LEFT );
$textRun = $shape->createTextRun($vehicles);
$textRun->getFont()->setSize(20);

//Jednostka jest w posiadaniu następujących pojazdów:
//var_dump($vehicles);
}
if ( isset($_POST['pmeeting_comp']) && ( strlen($_POST['pmeeting_comp']) > 0) ) {
//echo "<h2>Zawody</h2>";

$nextSlide = $phpPresentation->createSlide();

$shape = $nextSlide->createRichTextShape()
			-> setHeight(300)
			-> setWidth(600)
			-> setOffsetX(170)
			-> setOffsetY(10);

$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_CENTER );
$textRun = $shape->createTextRun('Zawody');
$textRun->getFont()->setItalic(true)
									  ->setSize(28);

$shape = $nextSlide->createRichTextShape()
									 -> setHeight(300)
									 -> setWidth(600)
								 	 -> setOffsetX(170)
									 -> setOffsetY(40);

$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_LEFT );
$textRun = $shape->createTextRun('Jednostka wzieła udział w następujących zawodach: ');
$textRun->getFont()->setSize(20);


$query = "SELECT id, nazwa FROM c_about;";
$result = mysqli_query($connection, $query);
if ( mysqli_num_rows($result) > 0 ) {
	$i=1;
	$offsetY=60;
	while( $row = mysqli_fetch_row($result) ) {
		$query2 = "SELECT msc FROM c_score WHERE comp_id=" . $row[0];
		$result2 = mysqli_query($connection, $query2);
		$row2 = mysqli_fetch_row($result2);
		$msg3 = $row[1] . "- miejsce: " . $row2[0];

		$shape = $nextSlide->createRichTextShape()
											 -> setHeight(300)
											 -> setWidth(600)
										 	 -> setOffsetX(170)
											 -> setOffsetY($offsetY);

		$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_LEFT );
		$textRun = $shape->createTextRun($msg3);
		$textRun->getFont()->setSize(20);

		$offsetY += 20;
		$i++;
	}
} else {
	$msg3 = "Brak uczestnictwa w zawodach";

	$shape = $nextSlide->createRichTextShape()
										 -> setHeight(300)
										 -> setWidth(600)
										 -> setOffsetX(170)
										 -> setOffsetY(60);

	$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_LEFT );
	$textRun = $shape->createTextRun($msg3);
	$textRun->getFont()->setSize(20);

}

//var_dump($msg3);
}
if ( isset($_POST['pmeeting_jobs']) && ( strlen($_POST['pmeeting_jobs']) > 0) ) {

//echo "<h2>Prace na rzecz straży</h2>";

$nextSlide = $phpPresentation->createSlide();

$shape = $nextSlide->createRichTextShape()
			-> setHeight(300)
			-> setWidth(600)
			-> setOffsetX(170)
			-> setOffsetY(10);

$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_CENTER );
$textRun = $shape->createTextRun('Prace na rzecz straży');
$textRun->getFont()->setItalic(true)
									  ->setSize(28);

$query = "SELECT nazwa FROM j_about";
$result = mysqli_query($connection, $query);
if ( mysqli_num_rows($result) > 0 ) {
	$jobs="";
	while ( $row = mysqli_fetch_row($result) ) {
		$jobs .= $row[0] . ",";
	}
	$jobs = substr($jobs, 0, -1);
} else {
	$jobs = 'Brak prac';
}

$shape = $nextSlide->createRichTextShape()
									 -> setHeight(300)
									 -> setWidth(600)
								 	 -> setOffsetX(170)
									 -> setOffsetY(40);

$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_LEFT );
$textRun = $shape->createTextRun($jobs);
$textRun->getFont()->setSize(20);

//var_dump($jobs);

$query = "SELECT count(id) FROM t_about";
$trips = randomQuery($connection, $query);
$tripsMsg = 'Wyjazdy gospodarcze: ' . $trips;

$shape = $nextSlide->createRichTextShape()
									 -> setHeight(300)
									 -> setWidth(600)
								 	 -> setOffsetX(170)
									 -> setOffsetY(60);

$shape -> getActiveParagraph() -> getAlignment() -> setHorizontal( Alignment::HORIZONTAL_LEFT );
$textRun = $shape->createTextRun($tripsMsg);
$textRun->getFont()->setSize(20);

//var_dump($tripsMsg);

}
 ?>
