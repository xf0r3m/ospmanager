<!DOCTYPE html>
<html lang="pl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>OSPmgmt | morketsmerke.net</title>
	<link rel="stylesheet" type="text/css" href="style.css" />
	<link rel="stylesheet" type="text/css" href="Chart.css" />
	<link rel="shortcut icon" type="image/png" href="resources/favicon.png" />
	<script src="Chart.js"></script>
	<?php
		echo "<style>";
			echo "#" . $_GET['page'] . " { background-color: #748ea8 !important; color: #fcfcfc !important; }";
		echo "</style>";
	?>
  </head>
  <body>
    <?php
      echo "<div id=\"div_0\">";
        include('db_conf.php');
        session_start();

      if (isset($_SESSION['username'])) {

		  include('library.php');
          include('fastaccess.php');
          include('menu.php');
          echo "<div id=\"content\">";



				  if ( isset($_GET['page']) ) {
					 if ( is_file("modules/" . $_GET['page'] . ".php") ) {
            writeLogs($connection, 'Odwiedzono moduł: ' . $_GET['page'], $_SESSION['username']);
						  include("modules/" . $_GET['page'] . ".php");
					 }
				  } else {
					//echo "<div id=\"startinfo\"><h1>Aby rozpocząć wybierz jedną z opcji menu po lewej stronie</h1></div>";
					include('frontpage.php');
				  }

				  echo "</div>";

      } else {
        echo "<script>window.location.assign('login.php');</script>";
      }
			echo "</div>";
?>
<script src="jquery-3.4.1.min.js"></script>
<script src="Chart.js"></script>
<script>

function dumbFunction() {

	return "Nothing...";

}

function chType(chId) {

	var el = document.getElementById(chId);

	function theForm(fid, sid) {
		document.getElementById(fid).removeAttribute('disabled');
		var fInputs = document.getElementsByClassName('form_inputs');

		for ( var i=0; i < fInputs.length; i++ ) {

			if ( fInputs[i].parentNode.getAttribute('class') === fid ) { continue; }
			else {

				var oldName = fInputs[i].getAttribute('name');
				var newName = oldName.replace(fid, sid);
				fInputs[i].setAttribute('name', newName);
			}

		}

		var cElements = document.getElementsByClassName(chId);
		document.getElementsByClassName(fid)[0].style.display = 'none';

		if ( sid === 'eqEngine' ) {

			if ( document.getElementsByClassName(fid)[1] !== undefined ) {
				document.getElementsByClassName(fid)[1].style.display = 'none';
			} else {
				document.getElementsByClassName(fid)[0].style.display = 'none';
			}

			cElements[0].removeAttribute('style');

			if ( cElements.length > 1 ) {
				cElements[1].removeAttribute('disabled');
				cElements[2].removeAttribute('style');
			}

		} else {
			//console.log(cElements);
			cElements[0].removeAttribute('style');

			if ( cElements.length > 1 ) {
				cElements[1].removeAttribute('style');
			}

			var cElements = document.getElementsByClassName(fid);
			//console.log(cElements);
			cElements[0].style.display = 'none';

			if ( cElements.length > 1 ) {
				cElements[1].setAttribute('disabled', 'disabled');
				cElements[2].style.display = 'none';
			}
		}
	}
	
	if ( chId === 'eqEngine' ) {

		theForm('eqManual', 'eqEngine');
		var oldAction = el.parentNode.nextElementSibling.nextElementSibling.lastElementChild.getAttribute('action');
		//console.log(oldAction);
		var newAction = oldAction.replace('eqManual', 'eqEngine');
		//console.log(newAction);
		el.parentNode.nextElementSibling.nextElementSibling.lastElementChild.setAttribute('action', newAction);
		//console.log(el.parentNode.nextElementSibling);

	} else {

		theForm('eqEngine', 'eqManual');
		var oldAction = el.parentNode.nextElementSibling.nextElementSibling.lastElementChild.getAttribute('action');
		var newAction = oldAction.replace('eqEngine', 'eqManual');
		el.parentNode.nextElementSibling.nextElementSibling.lastElementChild.setAttribute('action', newAction);
	}

	document.getElementById(chId).setAttribute('disabled', 'disabled');

}

function getFaButtons() {

	var ajax2 = new XMLHttpRequest();
	ajax2.open('GET', 'ajax.php?page=get_fa_buttons', true);
	ajax2.send();

	ajax2.onload = function() {
		if ( ajax2.status === 200 ) {
			document.getElementById('fastaccess').innerHTML = ajax2.responseText;
		}
	}

}

function changeInputs(element) {	

	var parentElement = element.parentNode;

	element.type = 'hidden';
	//console.log(element);
	element.nextElementSibling.type='date';
	parentElement.lastElementChild.type='time';

	var element_date = element.nextElementSibling;
	var element_time = parentElement.lastElementChild;

	if ( element.value !== "" ) {
		var oldElementValue = element.value;
		oldElementValue = oldElementValue.replace('T', ' ');
	} else {
		var oldElementValue;
	}

	var oEVTab;

	element_date.onchange = function(event) {

		if ( oldElementValue === undefined ) {
			element.value = event.target.value;
			oldElementValue = element.value;
		} else {
			oEVTab = oldElementValue.split(' ');
			element.value = event.target.value + ' ' + oEVTab[1];
			oldElementValue = element.value;
		}
			
	}

	element_time.onchange = function(event) {

		
		oEVTab = oldElementValue.split(' ');
		console.log(event.target.value);
		if ( event.target.value.lastIndexOf(':') === 16 || 
			event.target.value.lastIndexOf(':') === 5 ) {
			element.value = oEVTab[0] + 'T' + event.target.value;
		} else {
			element.value = oEVTab[0] + 'T' + event.target.value + ':00';

		}
		
				
	}

						
}

function enumTime (r, z) {

	var rTab = r.split(':');
	//console.log('rTab: ' + rTab);
	var zTab = z.split(':');
	//console.log('zTab: ' + zTab);

	var minR = ( parseInt(zTab[1]) - parseInt(rTab[1]) );
	//console.log('minR: ' + minR);
	var godzR = ( parseInt(zTab[0]) - parseInt(rTab[0]) );
	//console.log('godzR: ' + godzR);
	
	if ( godzR < 0 ) { godzR = godzR + 24; console.log('godzR2: ' + godzR); }

	var hTm = ( godzR * 60 );
	//console.log('hTm: ' + godzR);
	var timeInMinuts = hTm + minR;
	//console.log('timeInMinuts: ' + timeInMinuts); 
	var h = Math.floor(timeInMinuts / 60);
	//console.log('h: ' + h);
	var min = ( timeInMinuts - ( h * 60 ) );
	//console.log('min: ' + min);
	if ( h < 10 ) { h = '0' + h; }
	if ( min < 10 ) { min = '0' + min; }
	//console.log(h + ':' + min + ":00");	
	return h + ':' + min;	
}

function prepareToTime(name1, name2, name3) {


	var rValue = document.getElementsByName(name1)[0].value;
	var zValue = document.getElementsByName(name2)[0].value;

	//console.log('rValue: ' + rValue);
	//console.log('zValue: ' + zValue);
	
	if ( (rValue !== "") && (zValue !== "") ) {
	
		var rVTab = rValue.split('T');
		var zVTab = zValue.split('T');

		if ( (rVTab[1]) && ( zVTab[1] ) ) {
		
			//console.log('rVTab[1]: ' + rVTab[1] + ' ' + 'zVTab[1] + zVTab[1]);
			document.getElementsByName(name3)[0].value = enumTime(rVTab[1], zVTab[1]);
		}
	
	}

}

function sumEqecUsageMin() {

	var elements = document.getElementsByName('eqec_usage_minuty[]');
	var rmin;

	for ( var i=0; i < elements.length; i++) {

		if ( elements[i].value !== "" ) {
		
			if ( rmin === undefined ) {
				rmin = parseInt(elements[i].value);
			} else {
				rmin += parseInt(elements[i].value);
			}
		
		}
	
	}

	document.getElementsByName('eqec_usage_rmin')[0].value = rmin;
	document.getElementsByName('eqec_common2_minut')[0].value = rmin;

	var norma = document.getElementsByName('eqec_common_norma')[0].value;
	norma = norma.replace(',', '.');
	var result = (rmin / 60) * norma;
	result = String(result);
	result = result.replace('.', ',');
	result = result.substring(0,3);
	document.getElementsByName('eqec_common2_uzycie0')[0].value = result;


}

function sumEqecRPaliwo() {

	var elements = document.getElementsByName('eqec_fuel_paliwo[]');
	var rmin;

	for ( var i=0; i < elements.length; i++) {

		if ( elements[i].value !== "" ) {
		
			if ( rmin === undefined ) {
				rmin = parseInt(elements[i].value);
			} else {
				rmin += parseInt(elements[i].value);
			}
		
		}
	
	}

	document.getElementsByName('eqec_fuel_rlitr')[0].value = rmin;
	document.getElementsByName('eqec_common2_pobrano')[0].value = rmin;

}

function przebieg(element) {

	if ( element.name === 'rcard_usage_przebiegbr' || element.name === 'rcard_przebieg_wynik' ) { var prefix = 'rcard'; } else { var prefix = 'rcardev'; } 

	var p = document.getElementsByName(prefix + '_usage_przebiegbr')[0].value;
	document.getElementsByName(prefix + '_usage_przebieg')[0].value = p;
	document.getElementsByName(prefix + '_fuel2_km')[0].value = p;
	var norma = document.getElementsByName(prefix + '_vehicle_norma')[0].value;
	document.getElementById('n2').value = norma;
	norma = norma.replace(',', '.');
	var result = ( p * norma ) / 100;
	if ( result > 10 ) { var flag = 1; } else { var flag = 0; }
	result = String(result);
	result = result.replace('.', ',');
	if ( flag === 1 ) {
		result = result.substring(0,4);
	} else {
		result = result.substring(0,3);
	}
	document.getElementsByName(prefix + '_przebieg_wynik')[0].value = result;
	document.getElementsByName(prefix + '_fuel2_kmz_paliwo')[0].value = result;

}

function postuj(element) {

	if ( element.name === 'rcard_usage_postoj' || element.name === 'rcard_minuty_wynik' ) { var prefix = 'rcard'; } else { var prefix = 'rcardev'; }

	var min = document.getElementsByName(prefix + '_usage_postoj')[0].value; 
	document.getElementsByName(prefix + '_fuel2_minut')[0].value = min;
	var norma = document.getElementsByName(prefix + '_vehicle_normap')[0].value;
	document.getElementById('n3').value = norma;
	norma = norma.replace(',', '.');
	var result = min * norma;
	result = String(result);
	result = result.replace('.', ',');
	result = result.substring(0,3);
	document.getElementsByName(prefix + '_minuty_wynik')[0].value = result;
	document.getElementsByName(prefix + '_fuel2_m_paliwo')[0].value = result;


}

function rUsage(element) {

	if ( element.name === 'rcard_usage_rk' || element.name === 'rcard_usage_razem' ) { var prefix = 'rcard'; } else { var prefix = 'rcardev'; }

	//var rk = document.getElementsByName(prefix + '_usage_rk')[0].value;
	//rk = rk.replace(',', '.');
	var p = document.getElementsByName(prefix + '_usage_pdroz')[0].value;
	p = p.replace(',', '.');
	var m = document.getElementsByName(prefix + '_minuty_wynik')[0].value;
	m = m.replace(',', '.');
	if ( prefix === 'rcardev' ) {

		if ( document.getElementsByName('pompa_wynik')[0].value !== 0 ) {

			var o = document.getElementsByName('pompa_wynik')[0].value;
			o = o.replace(',', '.');
		} else {
			var o = 0;
		}

		if ( document.getElementsByName('web_wynik')[0].value !== 0 ) {
		
			var w = document.getElementsByName('web_wynik')[0].value;
			w = w.replace(',', '.');

		} else {

			var w = 0;
		}
		
	} else {
		var o = 0;
		var w = 0;
	}
	//var result = parseFloat(p) + parseFloat(m) + parseFloat(rk) + parseFloat(o) + parseFloat(w);
	var result = parseFloat(p) + parseFloat(m) + parseFloat(o) + parseFloat(w);
	//console.log(result);
	if ( result > 10 ) { var flag = 1; } else { var flag = 0; }
	result = String(result);
	result = result.replace('.', ',');
	if ( flag === 1 ) {
		result = result.substring(0,4);
	} else {
		result = result.substring(0,3);
	}

	document.getElementsByName(prefix + '_usage_razem')[0].value = result;

}

function pwUsage(element) {


	if ( element.name === 'rcardev_pompa_norma' ||
       		element.name === 'pompa_wynik'	) { var typ = 'pompa'; } else { var typ = 'web'; }

		var min = document.getElementsByName('rcardev_' + typ + '_minut')[0].value;
		var norma = document.getElementsByName('rcardev_' + typ + '_norma')[0].value;
		norma = norma.replace(',', '.');
		var min = parseFloat(min);
		var norma = parseFloat(norma);

		var result = min * norma;
		if ( result > 10 ) { var flag = 1; } else { var flag = 0; }

		result = String(result);
		result = result.replace('.', ',');

		if ( flag === 1 ) { 
			result = result.substring(0,4);
		} else {
			result = result.substring(0,3);
		}

		document.getElementsByName(typ + '_wynik')[0].value = result;

}

function membershipTime(element) {

		var biggestSibling = element.parentNode.firstElementChild;

		//console.log(biggestSibling.name.indexOf('rozpoczecie'));

		if ( ( biggestSibling.name.indexOf('rozpoczecie') > 0 ) || 
	       		( biggestSibling.name.indexOf('zakonczenie') > 0 )) {

			if ( biggestSibling.name.indexOf('rozpoczecie') > 0 ) {
				
				var newName = biggestSibling.name;
				newName = newName.replace('rozpoczecie', 'zakonczenie');
				var r = element.value;
				var zTime = document.getElementsByName(newName)[0].parentNode.lastElementChild;
				//console.log(zTime);
				if ( zTime.value !== "" ) {
					var z = zTime.value;
					console.log('r= ' + r + ' z= ' + z);
					var timeInput = element.parentNode.parentNode.nextElementSibling.nextElementSibling.lastElementChild.firstElementChild;
					timeInput.value = enumTime(r, z);
				}

			} else {
				var z = element.value;
				var newName = biggestSibling.name;
				newName = newName.replace('zakonczenie', 'rozpoczecie');
				//console.log(newName);
				var rTime = document.getElementsByName(newName)[0].parentNode.lastElementChild;
				//console.log(rTime);
				if ( rTime.value !== "" ) {
					var r = rTime.value;
					//console.log('r= ' + r + ' z= ' + z);
					var timeInput = element.parentNode.parentNode.nextElementSibling.lastElementChild.firstElementChild;
					timeInput.value = enumTime(r, z);
				}
			
			}
		}

}

function paliwo(element) {
		if ( element.name === 'rcard_fuel1_paliwo[]' ) { var prefix = 'rcard'; } else { var prefix = 'rcardev'; }

		var paliwoElements = document.getElementsByName(prefix + '_fuel1_paliwo[]');
		var rpaliwo = 0;
		for ( var i=0; i < paliwoElements.length; i++ ) {
			//console.log(rpaliwo);
			if ( paliwoElements[i].value !== "" ) {	
				if ( rpaliwo === 0 ) { rpaliwo = parseInt(paliwoElements[i].value); }
				else {rpaliwo = parseInt(rpaliwo) + parseInt(paliwoElements[i].value); }
			}
		}

		document.getElementsByName('razem_paliwo')[0].value = rpaliwo;
		document.getElementsByName(prefix + '_fuel2_pobrano_paliwo')[0].value = rpaliwo;
}

function olej(element) {
	
		if ( element.name === 'rcard_fuel1_olej[]' ) { var prefix = 'rcard'; } else { var prefix = 'rcardev'; }

			var olejElements = document.getElementsByName(prefix + '_fuel1_olej[]');
			var rolej = 0;
			for(var i=0; i < olejElements.length; i++) {
			
				if ( olejElements[i].value !== "" ) {
					if ( rolej === 0 ) { var rolej = parseInt(olejElements[i].value); }
					else { var rolej = parseInt(rolej) + parseInt(olejElements[i].value); }
				}
			}

			document.getElementsByName('razem_olej')[0].value = rolej;
			document.getElementsByName(prefix + '_fuel2_pobrano_olej')[0].value = rolej;

}

function rFuel2Paliwo(element) {

	if ( (element.name === 'rcard_fuel2_pozostalo_paliwo0') || (element.name === 'rcard_fuel2_razem_paliwo0') ) { var prefix = 'rcard'; } else { var prefix = 'rcardev'; }

	var pozostaloPaliwo = parseInt(document.getElementsByName(prefix + '_fuel2_pozostalo_paliwo0')[0].value);
	var pobranoPaliwo = parseInt(document.getElementsByName(prefix + '_fuel2_pobrano_paliwo')[0].value);

	document.getElementsByName(prefix + '_fuel2_razem_paliwo0')[0].value = pozostaloPaliwo + pobranoPaliwo;

} 

function rFuel2Olej(element) {

	if ( (element.name === 'rcard_fuel2_pozostalo_olej0') || (element.name === 'rcard_fuel2_razem_olej0')  ) { var prefix = 'rcard'; } else { var prefix = 'rcardev'; }
	
	var pozostaloOlej = parseInt(document.getElementsByName(prefix + '_fuel2_pozostalo_olej0')[0].value);
	var pobranoOlej = parseInt(document.getElementsByName(prefix + '_fuel2_pobrano_olej')[0].value);

	document.getElementsByName(prefix + '_fuel2_razem_olej0')[0].value = pozostaloOlej + pobranoOlej;

}

function rFuel2p(element) {

	if ( (element.name === 'rcard_fuel2_rk') || (element.name === 'rcard_fuel2_razem_paliwo1') ) { var prefix = 'rcard'; } else { var prefix = 'rcardev'; }

	var rks = parseFloat(document.getElementsByName(prefix + '_fuel2_rk')[0].value);
	var rk = document.getElementsByName(prefix + '_usage_rk')[0].value;
	rk = rk.replace(',', '.');
	rk = parseFloat(rk);
	var result = rks * rk;
	var kmz_p = document.getElementsByName(prefix + '_fuel2_kmz_paliwo')[0].value;
	
	kmz_p = kmz_p.replace(',', '.');
	kmz_p = parseFloat(kmz_p);
	
	var min_p = document.getElementsByName(prefix + '_fuel2_m_paliwo')[0].value;
	min_p = min_p.replace(',', '.');

	min_p = parseFloat(min_p);

	if ( prefix === 'rcardev' ) {
	
		if ( document.getElementsByName('pompa_wynik')[0].value !== 0 ) {

			var o = document.getElementsByName('pompa_wynik')[0].value;
			o = o.replace(',', '.');
		} else {
			var o = 0;
		}

		if ( document.getElementsByName('web_wynik')[0].value !== 0 ) {
		
			var w = document.getElementsByName('web_wynik')[0].value;
			w = w.replace(',', '.');
		} else {
			var w = 0;
		}
	
	} else {
	
		var o = 0;
		var w = 0;
	}

	console.log(result);
	console.log(kmz_p);
	console.log(min_p);
	console.log(o);
	console.log(w);

	var rpaliwo1 = parseFloat(result) + parseFloat(kmz_p) + parseFloat(min_p) + parseFloat(o) + parseFloat(w);
	var rpaliwo0 = parseFloat(document.getElementsByName(prefix + '_fuel2_razem_paliwo0')[0].value);
	var mResult = rpaliwo0 - rpaliwo1;
	result = String(result);
	rpaliwo1 = String(rpaliwo1);
	mResult = String(mResult);
	result = result.replace('.', ',');
	rpaliwo1 = rpaliwo1.replace('.', ',');
	mResult = mResult.replace('.', ',');
	result = result.substring(0,4);
	rpaliwo1 = rpaliwo1.substring(0,4);
	mResult = mResult.substring(0,5);

	document.getElementsByName(prefix + '_fuel2_rk_paliwo')[0].value = result;
	document.getElementsByName(prefix + '_fuel2_razem_paliwo1')[0].value = rpaliwo1;
	document.getElementsByName(prefix + '_fuel2_pozostalo_paliwo1')[0].value = mResult;

}

function properlyPrintDTElement() {

if ( window.navigator.appVersion.indexOf('Chrome') < 0 ) {

					
	if ( document.getElementsByName('e_about_alarm')[0] ) {
		changeInputs(document.getElementsByName('e_about_alarm')[0]); 
	}

						if ( document.getElementsByName('e_about_rozpoczecie')[0] ) {
							changeInputs(document.getElementsByName('e_about_rozpoczecie')[0]);
						}

						if ( document.getElementsByName('e_about_zakonczenie')[0] ) {
							changeInputs(document.getElementsByName('e_about_zakonczenie')[0]);
						}

						if ( document.getElementsByName('e_member_rozpoczecie')[0] ) {
							changeInputs(document.getElementsByName('e_member_rozpoczecie')[0]);
						}

						if ( document.getElementsByName('e_member_zakonczenie')[0] ) {
							changeInputs(document.getElementsByName('e_member_zakonczenie')[0]);
						}

						if ( document.getElementsByName('t_about_rozpoczecie')[0] ) {
							changeInputs(document.getElementsByName('t_about_rozpoczecie')[0]);
						}

						if ( document.getElementsByName('t_about_zakonczenie')[0] ) {
							changeInputs(document.getElementsByName('t_about_zakonczenie')[0]);
						}

						if ( document.getElementsByName('j_about_rozpoczecie')[0] ) {
							changeInputs(document.getElementsByName('j_about_rozpoczecie')[0]);
						}

						if ( document.getElementsByName('j_about_zakonczenie')[0] ) {
							changeInputs(document.getElementsByName('j_about_zakonczenie')[0]);
						}

						if ( document.getElementsByName('c_about_rozpoczecie')[0] ) {
							changeInputs(document.getElementsByName('c_about_rozpoczecie')[0]);
						}

						if ( document.getElementsByName('c_about_zakonczenie')[0] ) {
							changeInputs(document.getElementsByName('c_about_zakonczenie')[0]);
						}

					
						if ( document.getElementsByName('t_member_rozpoczecie')[0] ) {
							changeInputs(document.getElementsByName('t_member_rozpoczecie')[0]);
						}

						if ( document.getElementsByName('t_member_zakonczenie')[0] ) {
							changeInputs(document.getElementsByName('t_member_zakonczenie')[0]);
						}

						if ( document.getElementsByName('j_member_rozpoczecie')[0] ) {
							changeInputs(document.getElementsByName('j_member_rozpoczecie')[0]);
						}

						if ( document.getElementsByName('j_member_zakonczenie')[0] ) {
							changeInputs(document.getElementsByName('j_member_zakonczenie')[0]);
						}

						if ( document.getElementsByName('eq_deadlines_termin')[0] ) {
							changeInputs(document.getElementsByName('eq_deadlines_termin')[0]);
						}

						if ( document.getElementsByName('vehicle_deadlines_termin')[0] ) {
							changeInputs(document.getElementsByName('vehicle_deadlines_termin')[0]);
						}




					}

}
function eventVehicleFuelCount(prefix) {

var veh_id = document.getElementsByName(prefix + '_vehicle_vehicle_id')[0].value;
		//console.log(veh_id);
		if ( document.getElementsByName(veh_id + '_norma')[0] ) {
			var norma = document.getElementsByName(veh_id + '_norma')[0].value;
			norma = norma.replace(',', '.');
			norma = parseFloat(norma);
		} else { var norma = 0; }
		//console.log(norma)
		if ( document.getElementsByName(veh_id + '_postoj_norma')[0] ) {
			var postoj_norma = document.getElementsByName(veh_id + '_postoj_norma')[0].value;
			postoj_norma = postoj_norma.replace(',', '.');
			postoj_norma = parseFloat(postoj_norma);

		} else { var postoj_norma = 0; } 
		//console.log(postoj_norma);
		if ( document.getElementsByName(veh_id + '_autopompa_norma')[0] ) {
			var autopompa_norma = document.getElementsByName(veh_id + '_autopompa_norma')[0].value;
			autopompa_norma = autopompa_norma.replace(',', '.');
			autopompa_norma = parseFloat(autopompa_norma);
		} else { var autopompa_norma = 0; }
		//console.log(autopompa_norma);
		var przebieg = parseFloat(document.getElementsByName(prefix + '_vehicle_kilometry')[0].value);
		var przebieg_r = przebieg * norma;
		if ( przebieg_r !== 0 ) {przebieg_r = przebieg_r / 100;}

		var postoj = parseFloat(document.getElementsByName(prefix + '_vehicle_praca_postuj')[0].value);
		var postoj_r = postoj * postoj_norma;
		if ( postoj_r !== 0 ) { postoj_r = postoj_r / 100; }

		var autopompa = parseFloat(document.getElementsByName(prefix + '_vehicle_praca_autopompa')[0].value);
		var autopompa_r = autopompa * autopompa_norma;
		if ( autopompa_r !== 0 ) { autopompa_r = autopompa_r / 100; }

		var fuel = przebieg_r + postoj_r + autopompa_r;
		fuel = String(fuel);
		fuel = fuel.replace('.', ',');
		fuel = fuel.substring(0,4);

		document.getElementsByName(prefix + '_vehicle_paliwo')[0].value = fuel;


}

$('#content').on('click', function(e) {

	if ( e.target.type !== 'date' &&
		 e.target.type !== 'checkbox' &&
		 e.target.type !== 'file' &&
		 e.target.type !== 'datetime-local' &&
		 e.target.type !== 'radio' &&
		 e.target.id !== 'p_image' &&
		 e.target.id !== 'p_button' &&
	 	e.target.className !== 'link') { e.preventDefault(); }

	var el = e.target;
	//console.log(el);

		if ( el.getAttribute('class') === 'form_button' ) {
			//generateFFRow();

			var inputElements = document.getElementsByClassName('form_inputs');
			var fd = new FormData();

			for ( var i=0; i < inputElements.length; i++ ) {

				if ( inputElements[i].name === 'plik' ) {
					fd.append('plik', inputElements[i].files[0], inputElements[i].files[0].name);

					var fileNameSplit = inputElements[i].files[0].name.split('.');
					var extension = fileNameSplit[1];
					fd.append('m_files_format', extension);
				} else {
					fd.append(inputElements[i].name, inputElements[i].value);
				}

			}
			
			if ( document.getElementById('subcontent') !== null )  {
				var subcontentOld = document.getElementById('subcontent').innerHTML;
				document.getElementById('subcontent').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';
			} else  {
				contentOld = document.getElementById('content').innerHTML;
				document.getElementById('content').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';
			}

			var elementHref = el.parentNode.parentNode.getAttribute('action');
			elementHref = elementHref.replace('index', 'ajax');

			var ajax = new XMLHttpRequest();
			ajax.open("POST", elementHref, true);

			ajax.send(fd);

			ajax.onload = function() {
				if ( ajax.status === 200 ) {
					console.log(ajax.responseText);
					if ( subcontentOld ) {		
						document.getElementById('subcontent').innerHTML = subcontentOld;
					} else {
						document.getElementById('content').innerHTML = contentOld;
					}

					if ( document.getElementById('result') ) {
						document.getElementById('result').innerHTML = ajax.responseText;
						if ( elementHref.indexOf('_eq') > 0 ) {

							if ( elementHref.indexOf('action') > 0 ) {
								var chId = elementHref.substring(elementHref.indexOf('type') + 5, elementHref.indexOf('action') - 1);
								chType(chId);

							} else {

								var chId = elementHref.substring(elementHref.lastIndexOf('=') + 1);
								chType(chId);

							}

						} else if ( elementHref.indexOf('fastaccess') ) {
								getFaButtons();
						}

					} else if ( (elementHref.indexOf('note') > 0) ) {
						document.getElementById('form').innerHTML = ajax.responseText;
					} else {
						document.getElementById('subcontent').innerHTML = ajax.responseText;
					}
				}
			}

		} else if ( el.id === 'm_image' || el.id === 'm_button' ) {

			if ( el.nodeName === 'IMG' ) {
				var elementHref = el.parentNode.parentNode.getAttribute('href');
			} else {
				var elementHref = el.parentNode.getAttribute('href');
			}


			if ( (elementHref.indexOf('event_about') > 0) ||
				(elementHref.indexOf('trips_about') > 0) ||
			 	(elementHref.indexOf('jobs_about') > 0) ||
				(elementHref.indexOf('eq_about') > 0) ||
				(elementHref.indexOf('vehicle_about') > 0) ||
				(elementHref.indexOf('comp_about') > 0) ||
		       		(elementHref.indexOf('meeting_about') > 0) ) {

				var data_id = elementHref.substring(elementHref.indexOf('id'), (elementHref.indexOf('id') + 4));
				var module_id = elementHref.substring(elementHref.indexOf('page=') + 5, elementHref.indexOf('_'));
				var getVariable = module_id + '_' + data_id;
				var contentMenuButtons = document.getElementsByClassName('content_button');
				for (var i=1; i < contentMenuButtons.length; i++) {
					var oldHref = contentMenuButtons[i].parentNode.getAttribute('href');
					if ( oldHref.indexOf('_id') === -1 ) {

						var newHref = oldHref + '&' + getVariable;
						contentMenuButtons[i].parentNode.setAttribute('href', newHref);
					} else  {

						var newHref = oldHref.substring(0, ( oldHref.length - 4 )) + data_id;
						contentMenuButtons[i].parentNode.setAttribute('href', newHref);
					}

				}
			}

			if ( document.getElementById('subcontent') !== null ) {
				var subcontentOld = document.getElementById('subcontent').innerHTML;
				document.getElementById('subcontent').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';
			} else {
				var contentOld = document.getElementById('content').innerHTML;
				document.getElementById('content').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';
			}

			elementHref = elementHref.replace('index', 'ajax');

			var ajax = new XMLHttpRequest();
			ajax.open('GET', elementHref, true);
			ajax.send();

			ajax.onload = function() {

				if ( ajax.status === 200 ) {
					if ( subcontentOld ) { 
						document.getElementById('subcontent').innerHTML = subcontentOld;
					} else {
						document.getElementById('content').innerHTML = contentOld;
					}

					document.getElementById('form').innerHTML = ajax.responseText;

 					properlyPrintDTElement();	

					

				}
			}

		} else if ( el.id === 'd_image' || el.id === 'd_button' ) {

			if ( el.nodeName === 'IMG' ) {
				var elementHref = el.parentNode.parentNode.getAttribute('href');
			} else {
				var elementHref = el.parentNode.getAttribute('href');
			}

			elementHref = elementHref.replace('index', 'ajax');

			if ( document.getElementById('subcontent') !== null ) {
				var subcontentOld = document.getElementById('subcontent').innerHTML;
				document.getElementById('subcontent').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';
			} else {
				var contentOld = document.getElementById('content').innerHTML;
				document.getElementById('content').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';
			}


			var ajax = new XMLHttpRequest();
			ajax.open('GET', elementHref, true);
			ajax.send();

			ajax.onload = function() {
		
				if ( ajax.status === 200 ) {

					if ( subcontentOld ) { 
						document.getElementById('subcontent').innerHTML = subcontentOld;
					} else {
						document.getElementById('content').innerHTML = contentOld;
					}

					if ( document.getElementById('result') ) {
						document.getElementById('result').innerHTML = ajax.responseText;
						if ( ( elementHref.indexOf('_eq') > 0 ) && ( elementHref.indexOf('action') > 0 ) ) {
							//console.log(elementHref);
							var chId = elementHref.substring(elementHref.indexOf('type=') + 5, elementHref.indexOf('action') - 1);
							//var chId = elementHref.substring(elementHref.lastIndexOf('=') + 1);
							//console.log(chId);
							chType(chId);

						} else if ( elementHref.indexOf('fastaccess') ) {
							getFaButtons();
						}

					} else if ( elementHref.indexOf('note') > 0 ) {
						document.getElementById('form').innerHTML = ajax.responseText;
					} else {
						document.getElementById('subcontent').innerHTML = ajax.responseText;
					}
				}
			}

		} else if ( el.getAttribute('class') === 'content_button' ) {

		
			var elementHref = el.parentNode.getAttribute('href');
			elementHref = elementHref.replace('index', 'ajax');

			formInputs = document.getElementsByClassName('form_inputs');
				
			if ( formInputs.length > 0 ) {

				for (var i=0; i < formInputs.length; i++) {

					//console.log(formInputs[i].value);
					//console.log(flag);

					if ( formInputs[i].value !== "" ) {

						if ( formInputs[i].value !== 0 ) {

							if ( formInputs[i].type !== 'hidden' ) {

								if ( confirm('Jakieś dane zostały wprowadzone, na tej stronie. Czy na pewno chcesz ją opuścić ?') ) {

									var flag = 0;
									break;
								} else {

									var flag = 1;
									break;
								}

							}
							
						} else { var flag = 0; }
						
					} else { var flag = 0; }
				}
			} else {

			 var flag = 0;
			}	

			if ( flag === 0 ) {


				if ( document.getElementById('subcontent') !== null )  {
					var subcontentOld = document.getElementById('subcontent').innerHTML;
					document.getElementById('subcontent').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';
				} else  {
					contentOld = document.getElementById('content').innerHTML;
					document.getElementById('content').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';
				}
	
				var  ajax = new XMLHttpRequest();
				ajax.open("GET", elementHref, true);
				ajax.send();

				ajax.onload = function () {

					if ( ajax.status === 200 ) {
						if ( subcontentOld ) {
							document.getElementById('subcontent').innerHTML = ajax.responseText;
						} else {
							document.getElementById('content').innerHTML = ajax.responseText;

						}
						//console.log(window.navigator.appVersion.indexOf('Chrome'));
						
						properlyPrintDTElement();	
					}
				}	

			}

		} else if ( el.id === 'clear' ) {

			//console.log('clear');

			var elementHref = el.parentNode.parentNode.getAttribute('action');
			var searchQueryStart = elementHref.indexOf('?');
			var pageQueryEnd = elementHref.indexOf('&');
			var pageOut = elementHref.substring(searchQueryStart+1, pageQueryEnd);

			if ( pageOut !== 'index.php?' ) {
				var newURL = 'ajax.php?' + pageOut;
			} else {
				var newURL = elementHref.replace('index', 'ajax');
			}

			
			if ( document.getElementById('contentmenu') ) {

				var cMenuLastButtonHref = document.getElementById('contentmenu').firstElementChild.lastElementChild.firstElementChild.getAttribute('href');

				if ( cMenuLastButtonHref.indexOf('id') > 0 ) {
			
					var loiAmp = cMenuLastButtonHref.lastIndexOf('&');
					var loiLen = cMenuLastButtonHref.length;
					newURL = newURL + cMenuLastButtonHref.substring(loiAmp, loiLen);
				}

			}

			//console.log(newURL);

			var ajax = new XMLHttpRequest();
			ajax.open("GET", newURL, true);
			ajax.send();

			if ( document.getElementById('subcontent') !== null ) {
				var subcontentOld = document.getElementById('subcontent').innerHTML;
				document.getElementById('subcontent').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';
			} else {
				var contentOld = document.getElementById('content').innerHTML;
				document.getElementById('content').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';
			}

			ajax.onload = function () {
				if ( ajax.status === 200 ) {

					if ( subcontentOld !== undefined ) {
						document.getElementById('subcontent').innerHTML = ajax.responseText;
					} else {
						document.getElementById('content').innerHTML = ajax.responseText;
					}

					if ( elementHref.indexOf('_eq') > 0 ) {

						if ( elementHref.indexOf('action') > 0 ) {

							var chId = elementHref.substring(elementHref.indexOf('type') + 5, elementHref.indexOf('action') - 1);

						} else {

							var chId = elementHref.substring(elementHref.lastIndexOf('=') + 1);
						}

						chType(chId);

					}

					properlyPrintDTElement();

				}
			}


		} else if ( el.getAttribute('class') === 'chtype' ) {

			var button_id = el.id;
			var elementHref = el.parentNode.nextElementSibling.nextElementSibling.lastElementChild.getAttribute('action');
			elementHref = elementHref.substring(elementHref.indexOf('=') + 1, elementHref.indexOf('&'));
			elementHref = 'ajax.php?page=' + elementHref;

			var ajax = new XMLHttpRequest();
			ajax.open('GET', elementHref, true);
			ajax.send();

			if ( document.getElementById('subcontent') !== null ) {
				var subcontentOld = document.getElementById('subcontent').innerHTML;
				document.getElementById('subcontent').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';
			} else {
				var contentOld = document.getElementById('content').innerHTML;
				document.getElementById('content').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';
			}

			ajax.onload = function () {
				if ( ajax.status === 200 ) {

					if ( subcontentOld ) {	
						document.getElementById('subcontent').innerHTML = ajax.responseText;
					} else {
						document.getElementById('content').innerHTML = ajax.responseText;
					}
					chType(button_id);

				}

			}

		} else if ( el.getAttribute('class') === 'table_creator' ) {

			var divId = el.name;
			var divTable = document.getElementById(divId);

			if ( divTable.style.display === 'block' ) {
				divTable.style.display = 'none';
			} else {
				divTable.style.display = 'block';
				divTable.style.float = 'left';
			}


		} else if ( el.id === 'apply_filters' ) {

			//document.getElementById('form').style.display='none';

			var szk = document.getElementsByName('szkolenie')[0].value;
			var bad = document.getElementsByName('badanie')[0].value;

			var fd = new FormData();
			fd.append('szkolenie', szk);
			fd.append('badanie', bad);

			var contentOld = document.getElementById('content').innerHTML;
			document.getElementById('content').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';

			var ajax = new XMLHttpRequest();
			ajax.open('POST', 'ajax.php?page=tc_str&filters=1', true);
			ajax.send(fd);
			ajax.onload = function() {
				if ( ajax.status === 200 ) {
					document.getElementById('content').innerHTML = contentOld;
					document.getElementById('result').innerHTML = ajax.responseText;
					//document.getElementById('form').style.display='block';
				}

			}

		} else if ( el.getAttribute('class') === 'get_form_button' ) {

			var inputElements = document.getElementsByClassName('form_inputs');
			var baseurl = 'ajax.php?';

			for ( var i=0; i < inputElements.length; i++ ) {

				var name = inputElements[i].getAttribute('name');
				var value = inputElements[i].value;

				if ( i === ( inputElements.length - 1 ) ) {
					var appendValue = name + '=' + value;
				} else {
					var appendValue = name + '=' + value + '&';
				}

				baseurl = baseurl + appendValue;

			}

			if ( document.getElementById('subcontent') !== null )  {
				var subcontentOld = document.getElementById('subcontent').innerHTML;
				document.getElementById('subcontent').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';
			} else {
			
			
			}

			var ajax = new XMLHttpRequest();
			ajax.open('GET', baseurl, true);
			ajax.send();

			ajax.onload = function() {

				if ( ajax.status === 200 ) {
					document.getElementById('subcontent').innerHTML = subcontentOld;
					if ( document.getElementById('result') ) {
						document.getElementById('result').innerHTML = ajax.responseText;
					}
					document.getElementById('subcontent').innerHTML = ajax.responseText;
				}

			}

		} else if ( el.id === 'rst' ) {

			var d = new Date();
			var Y = d.getFullYear();
			var fdcy = Y + '-01-01';

			if ( d.getDate() <  10 ) {
				var day = '0' + d.getDate();
			} else {
				var day = d.getDate();
			}

			if ( d.getMonth() < 10 ) {
				month = (d.getMonth() + 1);
				var month = '0' + month;
			} else {
				var month = d.getMonth();
				month = month + 1;
			}

			var currentDate = Y + '-' + month + '-' + day;

			document.getElementsByName('date_start')[0].value = fdcy;
			document.getElementsByName('date_end')[0].value = currentDate;

		} else if ( el.id === 'l_image' || el.id === 'l_button' ) {

			if ( el.nodeName === 'IMG' ) {
				var elementHref = el.parentNode.parentNode.getAttribute('href');
			} else {
				var elementHref = el.parentNode.getAttribute('href');
			}

			elementHref = elementHref.replace('index', 'ajax');

			var subcontentOld = document.getElementById('subcontent').innerHTML;
			document.getElementById('subcontent').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';


			var ajax = new XMLHttpRequest();
			ajax.open('GET', elementHref, true);
			ajax.send();

			ajax.onload = function() {

				if ( ajax.status === 200 ) {
					document.getElementById('subcontent').innerHTML = subcontentOld;

					document.getElementById('form').innerHTML = ajax.responseText;						
					if ( document.getElementsByName('eqec_usage_minuty[]')[0] !== undefined ) {
						sumEqecUsageMin();
					}
				       	if ( document.getElementsByName('eqec_fuel_paliwo[]')[0] !== undefined ) {
						sumEqecRPaliwo();
					}	
					if ( document.getElementsByName('rcard_usage_przebiegbr')[0] !== undefined ) {
						przebieg(document.getElementsByName('rcard_usage_przebiegbr')[0]);
					}
					if ( document.getElementsByName('rcardev_usage_przebiegbr')[0] !== undefined ) {
						przebieg(document.getElementsByName('rcardev_usage_przebiegbr')[0]);
					}
					if ( document.getElementsByName('rcard_usage_postoj')[0] !== undefined ) {
						postuj(document.getElementsByName('rcard_usage_postoj')[0]);
					}
					if ( document.getElementsByName('rcardev_usage_postoj')[0] !== undefined ) {
						postuj(document.getElementsByName('rcardev_usage_postoj')[0]);
					}
					if ( document.getElementsByName('rcardev_pompa_norma')[0] !== undefined ) {
						pwUsage(document.getElementsByName('rcardev_pompa_norma')[0]);
						pwUsage(document.getElementsByName('rcardev_web_norma')[0]);
					}
					if ( document.getElementsByName('rcard_fuel1_paliwo[]')[0] !== undefined ) {
						paliwo(document.getElementsByName('rcard_fuel1_paliwo[]')[0]);
						olej(document.getElementsByName('rcard_fuel1_olej[]')[0]);
					}
					if ( document.getElementsByName('rcardev_fuel1_paliwo[]')[0] !== undefined ) {
						paliwo(document.getElementsByName('rcardev_fuel1_paliwo[]')[0]);
						olej(document.getElementsByName('rcardev_fuel1_olej[]')[0]);
					}
				}
			}

		} else if ( el.id === 'genCard' ) {

			var elementHref = el.parentNode.getAttribute('href');
			elementHref = elementHref.replace('index', 'ajax');
			var inputElements = document.getElementsByClassName('form_inputs');

			var fd = new FormData();

			for (var i=0; i < inputElements.length; i++) {
				fd.append(inputElements[i].name, inputElements[i].value);
			
			
			}

			var subcontentOld = document.getElementById('subcontent').innerHTML;
			document.getElementById('subcontent').innerHTML='<div id="waitinfo"><h1>Proszę czekać...</h1></div>';

			var ajax = new XMLHttpRequest();
			ajax.open('POST', elementHref, true);
			ajax.send(fd);

			//console.log(elementHref);

			ajax.onload = function() {
			
				console.log(ajax.responseText);

				if ( ajax.status === 200 ) {
				
					document.getElementById('subcontent').innerHTML = ajax.responseText;

				}
			
			}



			

		} else if ( el.className === 'plusButton' ) {

			var element = el;
			var select = el.previousElementSibling;
			var parentRow = el.parentNode.parentNode;

			if ( (parentRow.nextElementSibling.getAttribute('style')) ) { 

				parentRow.nextElementSibling.removeAttribute('style')
			} else {
				parentRow.nextElementSibling.style.display = 'none';
			}

		} else if ( el.className === 'addButton') {

			var optionValue = el.parentNode.firstElementChild;
			var select = el.parentNode.parentNode.previousElementSibling.lastElementChild.firstElementChild;

			var newOption = document.createElement('option');
			newOption.setAttribute('value', optionValue.value);
			newOption.textContent = optionValue.value;
			if ( ( select.firstElementChild.value === "" ) && ( select.children.lenght === 1 ) ) {
				select.removeChild(select.firstElementChild);
			}	
			select.appendChild(newOption);

		} else if ( el.id === 'szk_form_dataexp' ) {

			if ( document.getElementsByName('str_szk_data_exp')[0].getAttribute('disabled') !== "" ) {
				document.getElementsByName('str_szk_data_exp')[0].setAttribute('disabled', '');
				el.textContent = 'Aktywuj';
			} else {
				document.getElementsByName('str_szk_data_exp')[0].removeAttribute('disabled');
				el.textContent = 'Nie dotyczy';
				}
			
		
		} else if ( el.id === 'current' ) { 

		
			var dd = new Date();
			var Y = dd.getFullYear();
			var M = dd.getMonth();
			M = parseInt(M) + 1;
			var d = dd.getDate();
			
			if ( d < 10 ) { d = '0' + d; }
			
			var v = Y + '-' + M + '-' + d;
			
			var element = document.getElementsByName('str_psl_data_zak')[0];
			document.getElementsByName('str_psl_data_zak')[0].value = v;

		
		} else if ( el.name === 'e_vehicle_paliwo' ) {

			var k = document.getElementsByName('e_vehicle_kilometry')[0];
			var p = document.getElementsByName('e_vehicle_praca_postuj')[0];
			var a = document.getElementsByName('e_vehicle_praca_autopompa')[0];

			if ( k.value !== "" && p.value !== "" && a.value !== "" ) {
				eventVehicleFuelCount('e');
			}


		} else if ( el.name === 'eqec_fuel_rlitr' ) {
			sumEqecRPaliwo();
		} else if ( el.name === 't_vehicle_paliwo' ) {

			var k = document.getElementsByName('t_vehicle_kilometry')[0];
			var p = document.getElementsByName('t_vehicle_praca_postuj')[0];
			var a = document.getElementsByName('t_vehicle_praca_autopompa')[0];

			if ( k.value !== "" && p.value !== "" && a.value !== "" ) {
				eventVehicleFuelCount('t');
			}

		} else if ( el.name === 'rcard_fuel2_razem_olej0' || el.name === 'rcardev_fuel2_razem_olej0' ) {
		
			rFuel2Olej(el);
		} else if ( el.name === 'rcard_fuel2_razem_paliwo0' || el.name === 'rcardev_fuel2_razem_paliwo0' ) {
			rFuel2Paliwo(el);
		} else if ( el.name === 'rcard_fuel2_razem_paliwo1' || el.name === 'rcardev_fuel2_razem_paliwo1' ) {
			rFuel2p(el);
		} else if ( el.name === 'rcard_usage_razem' || el.name === 'rcardev_usage_razem' ) {
			rUsage(el);
		} else if ( el.name === 'pompa_wynik' || el.name === 'web_wynik' ) {
			pwUsage(el);
		} else if ( el.name === 'rcard_przebieg_wynik' || el.name === 'rcardev_przebieg_wynik' ) {
			przebieg(el);
		} else if ( el.name === 'rcard_postoj_wynik' || el.name === 'rcardev_postoj_wynik' ) {
			postoj(el);
		}

});


$('#content').on('change', function(e){

	var el = e.target;

	//console.log(e.target);
	if ( el.name === 'eq_about_rodzaj' ) {
		
		if ( el.value === "Sprzęt o napędzie spalinowym" ) {
			
			var pojemnosc = document.getElementsByName('eq_about_poj')[0];
			pojemnosc.removeAttribute('readonly');
		}
	} else if ( el.name === 'e_about_rozpoczecie' || el.name === 'e_about_zakonczenie' ) {

		prepareToTime('e_about_rozpoczecie', 'e_about_zakonczenie', 'e_about_trwanie');
	
	} else if ( el.name === 't_about_rozpoczecie' || el.name === 't_about_zakonczenie' ) {

		prepareToTime('t_about_rozpoczecie', 't_about_zakonczenie', 't_about_czas');

	} else if ( el.name === 'j_about_rozpoczecie' || el.name === 'j_about_zakonczenie' ) {

		prepareToTime('j_about_rozpoczecie', 'j_about_zakonczenie', 'j_about_czas');

	} else if ( el.name === 'e_member_rozpoczecie' || el.name === 'e_member_zakonczenie' ) {

		prepareToTime('e_member_rozpoczecie', 'e_member_zakonczenie', 'e_member_udzial');

	} else if ( el.name === 't_member_rozpoczecie' || el.name === 't_member_zakonczenie' ) {
		prepareToTime('t_member_rozpoczecie', 't_member_zakonczenie', 't_member_udzial');
	} else if ( el.name === 'j_member_rozpoczecie' || el.name === 'j_member_zakonczenie' ) {
		prepareToTime('j_member_rozpoczecie', 'j_member_zakonczenie', 'j_member_udzial');
	} else if ( el.name === 'c_about_rozpoczecie' || el.name === 'c_about_zakonczenie' ) {
		prepareToTime('c_about_rozpoczecie', 'c_about_zakonczenie', 'c_about_czas' );
	} else if ( el.name === 'typ' ) {
	
		if ( el.value === 'ldni' ) {
			document.getElementsByName('liczbadni')[0].removeAttribute('disabled');
		} else {
			document.getElementsByName('liczbadni')[0].setAttribute('disabled', '');
		}
	
	} else if ( el.name === 'eqec_usage_minuty[]' ) {
		sumEqecUsageMin();

	} else if ( el.name === 'rcard_usage_przebiegbr' || el.name === 'rcardev_usage_przebiegbr' ) {
		przebieg(el);

	} else if ( el.name === 'rcard_usage_postoj' || el.name === 'rcardev_usage_postoj' ) {

		postuj(el);

	} else if ( el.name === 'rcard_usage_rk' || el.name === 'rcardev_usage_rk' ) {
		rUsage(el);

	} else if ( el.name === 'rcardev_pompa_norma' || el.name === 'rcardev_web_norma' ) {
	
		pwUsage(el);
		rUsage(el);
	
	}  else if ( el.type === 'time' ) {

		membershipTime(el);
	} else if ( ( el.name === 'rcard_fuel1_paliwo[]' ) || ( el.name === 'rcardev_fuel1_paliwo[]' ) ) {
		paliwo(el);
	} else if ( ( el.name === 'rcard_fuel1_olej[]' ) || ( el.name === 'rcardev_fuel1_olej[]' ) ) {
		olej(el);
	} else if ( ( el.name === 'rcard_fuel2_pozostalo_paliwo0' ) || ( el.name === 'rcardev_fuel2_pozostalo_paliwo0' ) ) {
		rFuel2Paliwo(el);
	} else if ( ( el.name === 'rcard_fuel2_pozostalo_olej0' ) || ( el.name === 'rcardev_fuel2_pozostalo_olej0' ) ) {
		rFuel2Olej(el);
	} else if ( ( el.name === 'rcard_fuel2_rk' ) || ( el.name === 'rcardev_fuel2_rk' ) ) {
		rFuel2p(el);	
	} else if ( ( el.name === 'e_vehicle_vehicle_id' ) || ( el.name === 'e_vehicle_praca_autopompa' )  ) {
		var k = document.getElementsByName('e_vehicle_kilometry')[0];
		var p = document.getElementsByName('e_vehicle_praca_postuj')[0];
		var a = document.getElementsByName('e_vehicle_praca_autopompa')[0];

		if ( k.value !== "" && p.value !== "" && a.value !== "" ) {
			eventVehicleFuelCount('e');
		}
	} else if ( el.name === 'eqec_fuel_paliwo[]' ) {
		sumEqecRPaliwo();

	} else if ( (el.name === 't_vehicle_vehicle_id') || ( el.name === 't_vehicle_praca_autopompa' )  ) {

		var k = document.getElementsByName('t_vehicle_kilometry')[0];
		var p = document.getElementsByName('t_vehicle_praca_postuj')[0];
		var a = document.getElementsByName('t_vehicle_praca_autopompa')[0];

		if ( k.value !== "" && p.value !== "" && a.value !== "" ) {
			eventVehicleFuelCount('t');
		}

	} 
	

});

$('#content').on('keyup', function(e) {

	if ( e.target.id === 'p2' ) {
	
		if ( (document.getElementById('p1').value === e.target.value) && ( e.target.value !== "" ) ) {

				 e.target.style.borderBottomColor = 'green';
				document.getElementsByClassName('form_button')[0].removeAttribute('disabled');

		 } else {
			 e.target.style.borderBottomColor = 'red';
			 document.getElementsByClassName('form_button')[0].setAttribute('disabled', '');
		}
		 
	} else if ( e.target.id === 'p1' ) {	
		 if (  ( document.getElementById('p2').value === e.target.value ) && ( e.target.value !== "" ) ) {
		 
			 document.getElementById('p2').style.borderBottomColor = 'green';
		 	document.getElementsByClassName('form_button')[0].removeAttribute('disabled');

		 } else {
			 document.getElementById('p2').style.borderBottomColor = 'red';
			 document.getElementsByClassName('form_button')[0].setAttribute('disabled', '');

		}

	
	}

});


	</script>
	</body>
</html>
