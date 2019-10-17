<?php
session_start();

$username = htmlspecialchars($_POST['user']);
$password = htmlspecialchars($_POST['pass']);
$_SESSION['username'] = $username;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="games.css">
    <link rel="icon" href="shark.png" type="image/gif">
    <title>Shark Games | Login</title>
</head>
<body>
    <header><h1>Login</h1></header>  
    <div class="sticky">
        <ul class="nav">
        <li class="active"><a href="login.php">Login</a></li>
        <li><a href="signUp.php">Sign up</a></li>
        </ul>
    </div>   
    <div class="login">
        <form action='main.php' method='post'>
        <input type="text"  name="user" placeholder="Username"/><br>
        <input type="password"  name="pass" placeholder="Password"/><br>
        <input type="submit" value="Login">
        </form>

    </div>
</body>
</html>

