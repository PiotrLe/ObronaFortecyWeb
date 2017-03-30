<?php
session_start();
//mysql_connect('localhost','root','')or die('nie mozna polaczyc: '.mysql_error()); 
$db=mysqli_connect("localhost","root","","authentication");
//mysql_select_db('authentication');

?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
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
Here we are in home:)


Youre items:
<?php
$username=$_SESSION['username'];
$items=mysqli_query($db,"SELECT nazwa from items inner join users_items on items.id_it=users_items.id_it inner join users on users.id_uz=users_items.id_uz where users.username='$username'");

$money =mysqli_query($db,"SELECT money from users where username='$username'");
while($moneyreal=mysqli_fetch_array($money,MYSQLI_NUM)){$money1= $moneyreal[0];};
echo 'Money: ';
echo ' ';
echo $money1;
echo ' ';
while($row=mysqli_fetch_array($items,MYSQLI_NUM)){
	echo $row[0] ;
	echo ' ';


	//printf ("Cos: %s  Cos: %s", $row[0], $row[1]);  
//echo '<img src='.$row[0].'.png"/>';
//echo '<img src='.MieczPotegi.png.'">';
$pom=$row[0].".png";
echo "<img src='$pom ' width =100% height=100%>";

}


//$item=mysqli_real_escape_string($db,"SELECT nazwa from user-items join users using id_uz join items using id_it  where username='$username' ");
//echo $item;
?>

</div>
</div>
<div id="menu">
<li><a href="home.php" img src="przycisk.png">Home</a></li>
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
