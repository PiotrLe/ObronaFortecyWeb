<?php
session_start();
$db=mysqli_connect("localhost","root","","authentication");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body link="white" vlink="white" alink="white">
<div class="header">
    <h1>The game which will change your life</h1>
</div>
<?php
if(isset($_SESSION['message']))
{
echo "<div id='error_msg'>".$_SESSION['message']."</div>";
unset($_SESSION['message']);
}
?>
<div class="tekst">
    <h4>Welcome 
<?php 
echo $_SESSION['username'];
?></h4>
Game will be able to meet you soon. <br>
<div class="plansza">
<canvas width="400" height="400" id="can"> </canvas>

</div>
<div class="moves"></div>
<script> 
    function startGame() {  
    	function ChangeListener(){
    window.addEventListener('keydown', function(event) {
  czlowiek.print();
}, false);
}
    	function KeyListener(){ 
    	
    window.addEventListener('keydown', function(event) {

czlowiek.changePosition(event.keyCode);
}, false);
}
//----------------------------------------------------------------//
function Gracz(_x,_y) {
    this.x = _x;
    this.y = _y;
    this.vx = 5;
    this.vy =5;
    this.changePosition= function(number) { switch(number){
	    case 37: 
	    this.x-=this.vx;
	     break;
	     case 38:
	     this.y-=this.vy;
	     break;
	     case 39:
	     this.x+=this.vx;
	     break;
	     case 40:
	     this.y+=this.vy;
	     break; }  }
    this.print = function() {

    	var canvas = document.getElementById('can');
if (canvas.getContext){
    var c = canvas.getContext('2d');

    //rysujemy niebieski kwadrat
    c.fillRect(this.x,this.y,5,5);

};


        console.log(this.x+ 'x' + this.y)
    }
}
//----------------------------------------------------------------//
//inicjalizacja// 
 
var czlowiek = new Gracz(0,0);
KeyListener();
ChangeListener();
//----------------------------------------------------------------//
  czlowiek.print();
}



 
console.log('gefe');

(function() {    
    /*var LICZBA_KAFELKOW = 20;
    var KAFELKI_NA_RZAD = 5;
    var kafelki = [];
    var pobraneKafelki = [];
    var moznaBrac = true;
    var liczbaRuchow = 0;
    var paryKafelkow = 0;
    var obrazkiKafelkow = [
        'title_1.png',
        'title_2.png',
        'title_3.png',
        'title_4.png',
        'title_5.png',
        'title_6.png',
        'title_7.png',
        'title_8.png',
        'title_9.png',
        'title_10.png'
    ]; */


   /*     var plansza = $('.plansza').empty();

        for (var i=0; i<LICZBA_KAFELKOW; i++) {
            kafelki.push(Math.floor(i/2));
        }

        for (i=LICZBA_KAFELKOW-1; i>0; i--) {
            var swap = Math.floor(Math.random()*i);
            var tmp = kafelki[i];
            kafelki[i] = kafelki[swap];
            kafelki[swap] = tmp;
        }

        for (i=0; i<LICZBA_KAFELKOW; i++) {
            var tile = $('<div class="kafelek"></div>');
            plansza.append(tile);
            tile.data('cardType',kafelki[i]);
            tile.data('index', i);
            tile.css({
                left : 5+(tile.width()+5)*(i%KAFELKI_NA_RZAD)
            });
            tile.css({
                top : 5+(tile.height()+5)*(Math.floor(i/KAFELKI_NA_RZAD))
            });
            tile.bind('click',function() {klikniecieKafelka($(this))});
        }
        $('.moves').html(liczbaRuchow);
    }

    function klikniecieKafelka(element) {
        if (moznaBrac) {
            //jeżeli jeszcze nie pobraliśmy 1 elementu
            //lub jeżeli index tego elementu nie istnieje w pobranych...
            if (!pobraneKafelki[0] || (pobraneKafelki[0].data('index') != element.data('index'))) {
                pobraneKafelki.push(element);
                element.css({'background-image' : 'url('+obrazkiKafelkow[element.data('cardType')]+')'})    
            }

            if (pobraneKafelki.length == 2) {
                moznaBrac = false;
                if (pobraneKafelki[0].data('cardType')==pobraneKafelki[1].data('cardType')) {
                    window.setTimeout(function() {
                        usunKafelki();
                    }, 500);
                } else {
                    window.setTimeout(function() {
                        zresetujKafelki();
                    }, 500);
                }
                liczbaRuchow++;
                $('.moves').html(liczbaRuchow)
            }
        }
    }

    function usunKafelki() {
        pobraneKafelki[0].fadeOut(function() {
            $(this).remove();
        });
        pobraneKafelki[1].fadeOut(function() {
            $(this).remove();

            paryKafelkow++;
            if (paryKafelkow >= LICZBA_KAFELKOW / 2) {
                alert('gameOver!');
            }
            moznaBrac = true;
            pobraneKafelki = new Array();
        });
    }

    function zresetujKafelki() {
        pobraneKafelki[0].css({'background-image':'url(title.png)'})
        pobraneKafelki[1].css({'background-image':'url(title.png)'})
        pobraneKafelki = new Array();
        moznaBrac = true;
    }
*/
    $(document).ready(function() {

        $('.start_game').click(function() {
            startGame();
        });

    })
})();
//startGame();
</script>
<button class="start_game">Rozpocznij Grę</button>

</div>
</div>
<div id="menu">
<li><a href="home.php">Home</a></li>
</div>
<div id="menu">
<li><a href="aktualnosci.php">News</a></li>
</div>
<div id="menu">
<li><a href="gra.php">Game</a></li>
</div>
<div id="menu">
<li><a href="ranking.php">Ranking</a></li>
</div>
<div id="menu">
<li><a href="credits.php">Credits</a></li>
</div>
<div id="menu">
<li><a href="logout.php">Log Out</a></li>
</div>
</body>
</html>
