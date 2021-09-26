<?php

    echo "
        <div id=\"baner\">
         <h1>OSP Gronowo</h1>
        </div>
        <div id=\"logomap\">
            <div id=\"logo\">
                <img src=\"resources/logo.jpg\" alt=\"logo\" style=\"height: 400px;\" />
            </div>
            <div id=\"map\" style=\"width: 50%; height: 400px; background-color: gray;\">
            </div>
        </div>
        <!--<table id=\"info\">
            <tr>
            <td id=\"str\">
            <p>Jednostka w swoim zastępie liczy <span style=\"font-size: 32px;\">XXX</span> stażaków.</p>
            </div>
            <td id=\"veh\">
            <p>Posiada takie pojazdy jak <span style=\"font-size: 32px;\">GLM8 GCBA SDH-30</span></p>
            </div>
            <td id=\"evn\">
            <p>Jednostka brała udział w <span style=\"font-size: 32px;\">XXX</span> akcjach. Od wypadków po pożary</p>
            </tr>
        </table>-->        
        <div id=\"contact\">
        Ochotnicza Straż Pożarna w Gronowie<br />
        Gronowo 72<br />
        87-162 Lubicz<br />
        </div>
	<script>
		var osp = {lat: 53.101658, lng: 18.794057};
            function initMap() {
                //var osp = {lat: 53.101658, lng: 18.794057};
                var map = new google.maps.Map(
                    document.getElementById('map'), {zoom: 6, center: osp});

                var Marker = new google.maps.Marker({position: osp, map: map});
	    }
		function initMap2() {
		
			var map = new google.maps.Map(
				document.getElementById('map'), {zoom: 18, center: osp});

			var markerMain = new google.maps.Marker({position: osp, map: map});";
			
			$tName = "hydrant";
			$csh = "nazwa,sz,dl";
			$whereValue = 'true';

			$result = prepareForm($connection, $tName, $csh, $whereValue);

			if ( mysqli_num_rows($result) > 0 ) {
				$lp = 0;
				while ( $row  = mysqli_fetch_row($result) ) {
				
					echo "var pos" . $lp . " = {lat: " . $row[1] . ", lng: " . $row[2] . "};";
					echo "var marker" . $lp . " = new google.maps.Marker({position: pos" . $lp . ", label: '" . $row[0] . "', map: map});";

					$lp++;	
				}
			}		

		echo "}

		document.getElementById('map').onclick = function (e) {
			
			document.getElementById('map').style.width = '100%';
			document.getElementById('map').style.height = '600px';
			document.getElementById('logo').style.width = '100%';

			initMap2();

			document.getElementById('map').onclick = null;

		}
        </script>
        <script async defer
        src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyAweY442rmqb9UkMqPQDjoepOPfg0uCdSQ&callback=initMap\">
        </script>
            
    ";


?>
