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
<canvas width="555" height="444" id="can" > 

</canvas>

</div>

<div class="moves"></div>
<script> 
function Rand(min,max)
{
return  parseInt((Math.random() * (max - min + 1)), 10) + min;

}
function AtakPrzeciwnika(przeciwnik,baza){
  if(Kolizja(przeciwnik,baza))
  { 
    baza.hp=baza.hp-przeciwnik.atak;
  }
  

}
function Zniwiaz(obj){
  if(obj.hp<=0)
  {
    return true;
  }
  return false;
}
//can.addEventListener('mousemove',    cosik, false);
function Kolizja(obj1,obj2){
 if (obj1.x < obj2.x + obj2.img.width &&
   obj1.x + obj1.img.width > obj2.x &&
   obj1.y < obj2.y + obj2.img.height &&
   obj1.img.height + obj1.y > obj2.y)
   {
   //  console.log("KOLIZJA");

     return true;
   }

return false

}
function KolizjaMiecza(przeciwnik,miecz)
{
  
if(Kolizja(miecz,przeciwnik))
{ if(miecz.mieczI>0)
  {
  przeciwnik.hp--;
  console.log(przeciwnik.hp);
}
}
}
function NieZnamySie(obj1,obj2)
{
  if(Kolizja(obj1,obj2))
  {
    obj1.changePosition(obj1.prevX,obj1.prevY);
  }

}
//----------------Sluchacz klawiszy------------------//


function KeyListenerK(Gracz){

  window.addEventListener('keydown',function(event) {
switch(event.keyCode){
case 81: 
Gracz.miecz.mieczI=10;
console.log("Hahaha kliknales q");
  break;
  default: console.log(event.keyCode);
}
}, false) ;  
}

    //funkcja gry
function startGame() { 

  //------------Funkcja zaokraglajaca---------//
function Round(n, k)
{
    var factor = Math.pow(10, k);
    return Math.round(n*factor)/factor;
}
 
//---------------Zmienne globalne--------------//
var ruch=0;
var xmouse=0;
var ymouse=0;

//------------------Sluchacz myszki----------------//
    function KeyListener(){ 
    	canvas= document.getElementById('can');
    canvas.addEventListener('click', function(event) {
var rect = canvas.getBoundingClientRect();
 xmouse = event.clientX-rect.left;
 ymouse = event.clientY-rect.top;
 
 ymouse=Round(ymouse,0);
 xmouse=Round(xmouse,0);
 console.log('xmouse '+ xmouse +'ymouse '+ ymouse);


}, false) ; }

//--------------------Wartosc bezwzgledna------------------//
function WB(a)
{
  
  if(a>0)
  return a;
  else return -a;
}

//-------------------Baza------------------//
function Baza(){
 this.hp=200;
     this.x=width/2-15;
     this.y=height/2-15;
  this.img =  images["baza1"];
   this.print = function() {
   
      var canvas = document.getElementById('can');
        if (canvas.getContext){
         
          var c = canvas.getContext('2d');
             this.x=width/2-15;
     this.y=height/2-15;
       ctx.drawImage(this.img,this.x,this.y);
                          }
                        }
                              }
    function stworzMiecz(gracz)  {
        this.x=gracz.x-5;
       this.y=gracz.y-5;
       this.mieczI=0;
        this.img=images["atak"];
      return this;
    }
//------------------------Gracz-----------------------//               
function Gracz() {
 



    this.prevY=0;
    this.prevX=0;
    this.x = 0;
    this.y = 0;
    this.miecz = stworzMiecz(this);
    this.v = 5*60/100;
    var c = document.getElementById("can");
    var ctx = c.getContext("2d");

   this.img= images["gracz"];
this.img1=images["gracz1"];

//---------------------Gracz/zmiana pozycji-------------------//

    this.changePosition= function(xnew,ynew) { 
      var drogax = 0.0; 
      var drogay =0.0;
      
drogax = xnew - this.x;
drogay = ynew -this.y;
var stos=Math.sqrt(Math.pow(drogax,2)+Math.pow(drogay,2))/this.v;
var predkoscx;
var predkoscy;
this.prevX=this.x;
this.prevY=this.y;
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
 { this.miecz.x+=predkoscx;
  this.miecz.y+=predkoscy;
   this.x+=predkoscx;
   this.y+=predkoscy;
   ruch++;}
}
}
 this.print = function() {
   
      var canvas = document.getElementById('can');
        if (canvas.getContext){
         
          var c = canvas.getContext('2d');
           if(ruch%40>20)
           ctx.drawImage(this.img,this.x,this.y);
           else
                      ctx.drawImage(this.img1,this.x,this.y);
          if(this.miecz.mieczI>0)
          { this.miecz.mieczI--;
            ctx.drawImage(this.miecz.img,this.miecz.x,this.miecz.y);
          }
                              }
                             }
}

//-------------------Przeciwnik--------------//
function Przeciwnik(x,y) {
  this.atak=1;
    this.hp=100;
    this.prevY=0;
    this.prevX=0;
    this.x = x;
    this.y = y;
    this.v = 1*60/100;
    var c = document.getElementById("can");
    var ctx = c.getContext("2d");

   this.img= images["przeciwnik"];

//---------------------Przeciwnik/zmiana pozycji-------------------//

    this.changePosition= function(xnew,ynew) { 
      var drogax = 0.0; 
      var drogay =0.0;
    
drogax = xnew - this.x;
drogay = ynew -this.y;
var stos=Math.sqrt(Math.pow(drogax,2)+Math.pow(drogay,2))/this.v;
var predkoscx;
var predkoscy;
this.prevX=this.x;
this.prevY=this.y;
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
   }
}
}
//-----------------Przeciwnik/rysowanie-----------------------//
    this.print = function() {
   if(this.hp>0)
   {
      var canvas = document.getElementById('can');
        if (canvas.getContext){
          var c = canvas.getContext('2d');
           ctx.drawImage(this.img,this.x,this.y);
           ctx.fillStyle=="#FF0000";
           ctx.fillRect(this.x,this.y-5,this.hp/3.33,4);
    }      
                              }
                             }
}

//--------------------Inicjalizacja obrazkow-------------------//
var pathToImages = "images/";
var images = ["tlo","baza1", "gracz", "gracz1", "przeciwnik", "atak","end"
              ];
//------------------Funkcja ladujaca obrazki--------------------//
(function loadImages(){
  for(var i = 0; i <images.length; i++){
    images[images[i]] = new Image();
    images[images[i]].src = pathToImages + images[i] + ".png";
  }
})();


//-----------------------Inicjalizacja gry---------------------------// 


var baza = new Baza();
var c = document.getElementById("can");
var ctx = c.getContext("2d");
ctx.fillStyle = "#FF0000";
var width = c.width;
var height = c.height; 
//var step = 1000/60;
var czlowiek = new Gracz();
KeyListener();
 KeyListenerK(czlowiek);
var tlo=images["tlo"];
var end=images["end"];
var Tablica=[];

var PrzeciwnikI=0;
var startTime = Date.now();
var endTime;
var GameTime;

//---------------------------Realna petla gry------------------------------//

(function draw(timestamp) {
   // var predkosc=5;
PrzeciwnikI++;
if(PrzeciwnikI>400)
{
  Tablica.push(new Przeciwnik(Rand(0,555),0));
  PrzeciwnikI=0;
}
    ctx.clearRect(0, 0, c.width, c.height); 
 ctx.drawImage(tlo,0,0);
   
    baza.print();
 
      czlowiek.changePosition(xmouse,ymouse);
   czlowiek.print();

// if(Kolizja(czlowiek,przeciwnik1))
// {
// przeciwnik1.changePosition(przeciwnik1.prevX,przeciwnik1.prevY);
// }

for(var i=0;i<Tablica.length;i++)
{  
Tablica[i].print();

    Tablica[i].changePosition(baza.x,baza.y);
    AtakPrzeciwnika(Tablica[i],baza);
       KolizjaMiecza(Tablica[i],czlowiek.miecz);
  NieZnamySie(Tablica[i],czlowiek);
NieZnamySie(Tablica[i],baza);
if(Zniwiaz(Tablica[i]))
Tablica.splice(i,1);
console.log(baza.hp);
}

NieZnamySie(czlowiek,baza);
endTime = Date.now();
GameTime =  (endTime - startTime)/1000;
ctx.font = "20px Arial";
ctx.fillText("Twoj czas",380,30);
ctx.fillText(  GameTime       ,380,55);
if(baza.hp>0)
  window.requestAnimationFrame(draw);
else
{
endTime = Date.now();
GameTime =  (endTime - startTime)/1000;
console.log("Czas gry: " + GameTime); 
   ctx.drawImage(end,0,0);
}
})();
 //window.requestAnimationFrame(draw);
//draw();
}
//--------------------------Przycisk start game------------------------------//
(function() {    
 // przycisk startu
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
