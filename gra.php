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
<canvas width="555" height="444" id="can"> 

</canvas>

</div>

<div class="moves"></div>
<script> 
    //funkcja gry
function startGame() { 
function Round(n, k)
{
    var factor = Math.pow(10, k);
    return Math.round(n*factor)/factor;
} 
//<img id="gracz" src="gracz.png" alt="The Scream" width="10" height="10">
var licznik=0;
    	var xmouse=0;
        var ymouse=0;
    function KeyListener(){ 
    	canvas= document.getElementById('can');
    canvas.addEventListener('click', function(event) {
var rect = canvas.getBoundingClientRect();
 xmouse = event.clientX-rect.left;
 ymouse = event.clientY-rect.top;
 
 ymouse=Round(ymouse,0);
 console.log('xmouse '+ xmouse, +'ymouse '+ ymouse);
//czlowiek.changePosition(event.clientX-rect.left,event.clientY-rect.top);

}, false) ; }
function WB(a)
{
  
  if(a>0)
  return a;
  else return -a;
}
function Baza(){
  
  this.img =  images["baza1"];
   this.print = function() {
   
      var canvas = document.getElementById('can');
        if (canvas.getContext){
          var c = canvas.getContext('2d');
       ctx.drawImage(this.img,width/2-15,height/2-15);
                          }
                        }
                              }
function Gracz(_x,_y) {
    this.x = _x;
    this.y = _y;
    this.v = 5*60/100;
    var c = document.getElementById("can");
    var ctx = c.getContext("2d");
   // var img = document.getElementById("gracz");

   this.img= images["gracz"];
this.img1=images["gracz1"];

    //zmiana pozycji
    this.changePosition= function(xnew,ynew) { 
      var drogax = 0.0; 
      var drogay =0.0;
      var temdrx ;
      var temdry ;
drogax = xnew - this.x;
drogay = ynew -this.y;
var stos=Math.sqrt(Math.pow(drogax,2)+Math.pow(drogay,2))/this.v;
var predkoscx;
var predkoscy;
if(stos==0)
stos=1;
predkoscx=drogax/stos;
predkoscy=drogay/stos;
if((-1<drogax|| drogax<1) && (-1<drogay||drogay<1))
{ 
     
   if(WB(this.x - xmouse)< 2 && WB(this.y-ymouse) <2)
   {
  this.x=xmouse;
  this.y=ymouse;
 }
 else
 {this.x+=predkoscx;
   this.y+=predkoscy;
   licznik++;}
}
/*
if(drogax>0.1)
 {
   this.x+=predkoscx;
   this.y+=predkoscy;
}
 else
 {
   
   this.x+=predkoscx;
   this.y+=predkoscy;
 }*/


 console.log('this.x:' + this.x + ' this.y: '+ this.y);

//obliczam funkcje liniowa po ktorej ma sie poruszac gostek
/*var a=drogay/drogax;
console.log('a'+a);
if(drogax>2)
{ console.log('przesuwam ');
if(this.x==0)
this.x=1;
this.x+=this.vx/Math.sqrt(Math.pow(drogax,2)+Math.pow(drogay,2));
console.log('this.x='+this.x);
this.y=a*this.x;
}

*/


/* drogax = xnew - this.x;
     drogay = ynew -this.y;
        drogay=drogay%600;
 drogax= drogax%600;
if(drogax<0)
temdrx=-drogax;
if(drogay<0)
temdry=-drogay;
if(drogax>0)
temdrx=drogax;
if(drogay>0)
temdry=drogay;

if(temdrx>temdry)
this.vy=this.vy/(temdrx/temdry);
if(temdry>temdrx)
this.vx=this.vx/(temdry/temdrx);
*/
//------- stare
/*if(drogax>drogay)
this.vy=this.vy/(drogax/drogay);
if(drogay>drogax)
this.vx=this.vx/(drogay/drogax);
*/
/*
      if(drogax> 2)
      {licznik++;
        this.x+=this.vx;
      }
      if(drogax < -2)
      { licznik++;
       this.x-=this.vx;
}
     if(drogay> 2)
     this.y+=this.vy;
     if(drogay<-2)
     this.y-=this.vy;

this.vx=5*60/100;
this.vy=5*60/100;
                                        */     }
    //rysowanie
    this.print = function() {
   
      var canvas = document.getElementById('can');
        if (canvas.getContext){
          var c = canvas.getContext('2d');
             //rysujemy niebieski kwadrat
       
           if(licznik%40<20)
            // c.fillRect(this.x,this.y,5,5);
       ctx.drawImage(this.img,this.x,this.y);
       else
       ctx.drawImage(this.img1,this.x,this.y);
                              }


        console.log(this.x+ 'x' + this.y)
        //wypisywanie w konsoli
                             }
}
var pathToImages = "images/";
var images = ["tlo","baza1", "gracz", "gracz1"
              ];
// ladowanie obrazkow
(function loadImages(){
  for(var i = 0; i <images.length; i++){
    images[images[i]] = new Image();
    images[images[i]].src = pathToImages + images[i] + ".png";
  }
})();
//----------------------------------------------------------------//
//inicjalizacja// 
//ladowanie obrazkow

//----------------------------------------------------------------//
var baza = new Baza();
var c = document.getElementById("can");
var ctx = c.getContext("2d");
ctx.fillStyle = "#FF0000";
var width = c.width;
var height = c.height; 
var step = 1000/60;
var czlowiek = new Gracz(0,0);
KeyListener();
var tlo=images["tlo"];
ctx.drawImage(tlo,0,0);
//----------------------------------------------------------------//
//realna petla gry

function draw(timestamp) {
   // var predkosc=5;

    ctx.clearRect(0, 0, c.width, c.height); 
 ctx.drawImage(tlo,0,0);
   czlowiek.changePosition(xmouse,ymouse);
   czlowiek.print();
   //ctx.rotate(Math.PI /180);
    // ctx.translate(width/2-40, height/2-40);
   // ctx.rotate(Math.PI / 180); 
   // ctx.translate(-width/2+40, -height/2+40);   
    //ctx.fillRect(width/2+10, height/2+10, 20, 20); 
   
    baza.print();
 setTimeout(draw,step);
    //window.requestAnimationFrame(draw); // rekurencyjne wywołanie funkcji rysującej
}
// window.requestAnimationFrame(draw);
draw();
}

(function() {    
    
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

  
*/ // przycisk startu
    $(document).ready(function() {

        $('.start_game').click(function() {
            startGame();
        });

    })
})();

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
