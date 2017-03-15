<?php
session_start();
//connect to database
$db=mysqli_connect("localhost","root","","authentication");
if(isset($_POST['login_btn']))
{
$username=mysqli_real_escape_string($db,$_POST['username']);
$password=mysqli_real_escape_string($db,$_POST['password']);
$password=md5($password);
$sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
$result=mysqli_query($db,$sql);
if(mysqli_num_rows($result)==1)
{
$_SESSION['message']="You are now Loggged In";
$_SESSION['username']=$username;
header("location:home.php");
}
else
{
$_SESSION['message']="Username and Password combiation incorrect";
}
}
if(isset($_POST['rejestruj_btn']))
{
	header("location:register.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="header">
    <h1>Zaloguj</h1>
</div>
<?php
if(isset($_SESSION['message']))
{
echo "<div id='error_msg'>".$_SESSION['message']."</div>";
unset($_SESSION['message']);
}
?>
<form method="post" action="login.php">
  <table>
     <tr>
           <td>Username : </td>
           <td><input type="text" name="username" class="textInput"></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput"></td>
     </tr>
      <tr>
           <td></td>
           <td><input type="submit" name="login_btn" class="Log In" value="Login"></td>
     </tr>
     <tr>
           <td></td>
           <td><input type="submit" name="rejestruj_btn" class="Log In" value="Rejestracja"></td>
</tr>
</table>
</form>
</body>
</html>