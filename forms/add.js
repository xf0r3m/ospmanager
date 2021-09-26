
function plus(param)
{
    /* param1 = div<numer>
       i<numer>
        d<numer>
    
    */
   var container =  document.getElementById('div'+param);
    container.innerHTML="<input value=\"Podaj wartość\" type=\"text\" id=\"i"+param+"\"></input><input onClick=\"dodawanie("+param+")\" id=\"d"+param+"\" value=\"Dodaj\" type=\"button\"></input>";
    
    
}

function dodawanie (param)
    {
        var a = document.getElementById('s'+param);
        var opcja = document.createElement('option');
        var i = document.getElementById('i'+param).value;
        opcja.text = i;
        a.add(opcja);
    }

function spalinowy()
{
    var wybor = document.getElementById('s1');
    var wartosc = wybor.value;
    if (wartosc == 'Sprzęt o napędzie spalinowym')
        {
            var u1 = document.getElementById('reado');
            var atrybut = u1.removeAttribute('readonly');
        }
    
}

function checkPassword()
{
    var nowehaslo = document.getElementById('p1').value;
    var nowehaslopowtorz = document.getElementById('p2').value;
    if (nowehaslo == nowehaslopowtorz)
        {
            document.getElementById('match').innerHTML='<p style="font-weight:bold">podane hasła są prawidłowe</p>';
        }
    else
        {
            document.getElementById('match').innerHTML='<p style="font-weight:bold">podane hasła się różnią</p>';
        }
}

function filter() {
    
    var filtr = document.getElementById('t1').value;
    console.log(filtr);
        if (filtr == 'ldni')
        {
            var inpucik = document.getElementById('liczba1');
            var l1 = inpucik.removeAttribute('disabled');
        }
    else
        {
        var filtr2 = document.getElementById('t1').value;
            var inpucik2 = document.getElementById('liczba1');
            var l2 = inpucik2.setAttribute('disabled','');
        }

}

function data() {
    
    var zm1 = document.getElementById('data1').value;
    var zm2 = document.getElementById('data2').value;
    var second = zm1.substring(zm1.indexOf('T')+1);
    var second2 = zm2.substring(zm2.indexOf('T')+1);
    var tab1 = second.split(':');
    var tab2 = second2.split(':');
    var g1 = tab1[0];
    var g2 = tab2[0];
    var m1 = tab1[1];
    var m2 = tab2[1];
    var godzina = Math.abs(g2-g1);
    var minuty = Math.abs(m1-m2);
    console.log(godzina);
    console.log(minuty);
        
    document.getElementById('data3').value=godzina+"h "+minuty+"m";
    
}

function paliwo() {
    
    var p1 = document.getElementById('n1').value;
    document.getElementById('n2').value=p1;
    document.getElementById('n3').value=p1;
    
}

function paliwo_dev() {
    
    var p1 = document.getElementById('n1').value;
    document.getElementById('n2').value=p1;
    document.getElementById('n3').value=p1;
    document.getElementById('n4').value=p1;
    document.getElementById('n5').value=p1;
}