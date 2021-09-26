<?php

echo "<h1 style=\"text-align: center; color: #748EA8;\">Aktywność OSP</h1>";

	$tName = 'e_about';
	$csh = 'COUNT(id)';
	$currentYear = date('Y');
	$labels = array('styczeń', 'luty', 'marzec', 'kwiecień', 'maj', 'czerwiec',
	'lipiec', 'sierpień', 'wrzesień', 'październiki', 'listopad', 'grudzień');
	$data = array();
	for ( $i=1; $i <= 12; $i++ ) {
	if ( $i < 10 ) {
		$whereValue = "alarm >='" . $currentYear . "-0" . $i . "-01 00:00:00'
		AND alarm <='" . $currentYear . "-0" . $i . "-" . date('t', strtotime($currentYear . '-' . $i . '-01')) . " 23:59:59'";
	} else {
		$whereValue = "alarm >='" . $currentYear . "-" . $i . "-01 00:00:00'
		AND alarm <='" . $currentYear . "-" . $i . "-" . date('t', strtotime($currentYear . '-' . $i . '-01')) . " 23:59:59'";
	}
		$result0 = prepareForm($connection, $tName, $csh, $whereValue);
		$row = mysqli_fetch_row($result0);
		$data[$i] = $row[0];
		$labels_data[$i] = $labels[($i - 1)];
	}

	/*
	if ( isset($_GET['data']) && ( $_GET['data'] === 'data' ) ){
		echo json_encode($data, JSON_FORCE_OBJECT);
	} else if ( isset($_GET['data']) && ( $_GET['data'] === 'labels' ) ) {
		echo json_encode($labels_data, JSON_FORCE_OBJECT+JSON_UNESCAPED_UNICODE);
	}
	 */
	echo "<canvas id=\"month\" width=\"400px\" height=\"100px\"></canvas>";
	echo "<script>
var ctx = document.getElementById('month').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
	labels: [";

	for( $i=1; $i <= count($labels_data); $i++ ) {

		if ( $i === count($labels_data) ) { 
			echo "'" . $labels_data[$i] . "'";
		} else {
			echo "'" . $labels_data[$i] . "', ";
		}
	
	}	

	echo "],
        datasets: [{
            label: 'Aktywność OSP',
	    data: [";
		for ( $i=1; $i <= count($data); $i++ ) {
			if ( $i === count($data) ) {
				echo $data[$i];
			} else {
				echo $data[$i] . ",";
			}
		}
 echo "],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
		'rgba(255, 159, 64, 0.2)',
		'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'

            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
		'rgba(255, 159, 64, 1)',
		'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'

            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
<p>&nbsp;</p>
<h1 style=\"text-align: center; color: #748E8A;\">Akcje przeprowadzone przez OSP</h1>";

	$tName = 'e_about';
	$csh = 'COUNT(id)';
	$labels = array("Fałszywy alarm", "Miejscowe zagrożenie", "Pomoc Policji", "Pożar", "Wypadek", "Zabezpieczenie rejonu");
	$data2 = array();
	for ($i=0; $i < count($labels); $i++) {

		$prepareValue = mysqli_real_escape_string($connection, $labels[$i]);
		$whereValue = 'rodzaj=\'' . $prepareValue . '\'';

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);
		$row = mysqli_fetch_row($result0);
		$data2[$i] = $row[0];

	}
	/*
	if ( isset($_GET['data']) && ( $_GET['data'] === 'data' ) ){
		echo json_encode($data2, JSON_FORCE_OBJECT);
	} else if ( isset($_GET['data']) && ( $_GET['data'] === 'labels' ) ) {
		echo json_encode($labels, JSON_FORCE_OBJECT+JSON_UNESCAPED_UNICODE);
	}
	 */
echo "<canvas id=\"evn\" width=\"400px\" height=\"200px\"></canvas>";
	echo "<script>
var ctx = document.getElementById('evn').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
	labels: [";

	for( $i=0; $i < count($labels); $i++ ) {

		if ( $i === ( count($labels) - 1 ) ) { 
			echo "'" . $labels[$i] . "'";
		} else {
			echo "'" . $labels[$i] . "', ";
		}
	
	}	

	echo "],
        datasets: [{
            label: 'Akcje OSP',
	    data: [";
		for ( $i=0; $i < count($data2); $i++ ) {
			if ( $i === ( count($data2) - 1 ) ) {
				echo $data2[$i];
			} else {
				echo $data2[$i] . ",";
			}
		}
 echo "],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
		'rgba(255, 159, 64, 0.2)',
		'rgba(120, 200, 37, 0.2)'

            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
		'rgba(255, 159, 64, 1)',
		'rgba(120, 200, 37, 1)'

            ],
            borderWidth: 1
        }]
    }
});
</script>
<p>&nbsp;</p>
<h1 style=\"text-align: center; color: #748E8A;\">Strażacy OSP</h1>";



	$tName = 'str_do';
	$csh = 'COUNT(id)';
	$labels = array("Kobiet", "Mężczyzn");
	$data = array();

	for ( $i=0; $i < count($labels); $i++ ) {

		if ( $i === 0 ) { $whereValue = 'plec=\'K\''; }
		else { $whereValue = 'plec=\'M\''; }

		$result0 = prepareForm($connection, $tName, $csh, $whereValue);
		$row = mysqli_fetch_row($result0);
		$data[$i] = $row[0];

	}
	/*
	if ( isset($_GET['data']) && ( $_GET['data'] === 'data' ) ){
		echo json_encode($data, JSON_FORCE_OBJECT);
	} else if ( isset($_GET['data']) && ( $_GET['data'] === 'labels' ) ) {
		echo json_encode($labels, JSON_FORCE_OBJECT+JSON_UNESCAPED_UNICODE);
	}
	 */
echo "<canvas id=\"str\" width=\"400px\" height=\"200px\"></canvas>";
	echo "<script>
var ctx = document.getElementById('str').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
	labels: [";

	for( $i=0; $i < count($labels); $i++ ) {

		if ( $i === ( count($labels) - 1 ) ) { 
			echo "'" . $labels[$i] . "'";
		} else {
			echo "'" . $labels[$i] . "', ";
		}
	
	}	

	echo "],
        datasets: [{
            label: 'Strażacy OSP',
	    data: [";
		for ( $i=0; $i < count($data); $i++ ) {
			if ( $i === ( count($data) - 1 ) ) {
				echo $data[$i];
			} else {
				echo $data[$i] . ",";
			}
		}
 echo "],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)'

            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)'

            ],
            borderWidth: 1
        }]
    }
});
</script>";



 ?>
