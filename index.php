<?php
//session_start();
//connect to database
$server = "localhost";
$username = "root";
$password = "";
$database = "authentication";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['register_btn']))
{$username=mysqli_real_escape_string($conn,$_POST['username']);
$email1=mysqli_real_escape_string($conn,$_POST['email']);
$password=mysqli_real_escape_string($conn,$_POST['password']);
$password2=mysqli_real_escape_string($conn,$_POST['password2']);
if($password==$password2)
{$password= md5($password);
mysqli_query($conn,"INSERT INTO users(username,email,password) VALUES('$username','$email1','$password')");
$_SESSION['message']="You are now logged in"; 
$_SESSION['username']=$username;
header("location:home.php");
}
else{$_SESSION['message']="The two password do not match";
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register , login and logout user php mysql</title>
  <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="header">
    <h1>Registration</h1>
</div>
<?php
/*
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
*/
?>
<form method="post" action="index.php">
  <table>
<div>
     <tr>
           <td>Username : </td>
           <td><input type="text" name="username" class="textInput"></td>
     </tr>
     <tr>
           <td>Email : </td>
           <td><input type="email" name="email" class="textInput"></td>
     </tr>
      <tr>
           <td>Password : </td>
           <td><input type="password" name="password" class="textInput"></td>
     </tr>
      <tr>
           <td>Password again: </td>
           <td><input type="password" name="password2" class="textInput"></td>
     </tr>
      <tr>
           <td></td>
           <td><input type="submit" name="register_btn" class="Register"></td>
     </tr>
<tr>
</div>
<div id="menu">
<ul>
<li><a href="login.php">Zaloguj</a></li>

</ul>
</div>
</tr>
  
</table>
</form>
</body>
</html>
