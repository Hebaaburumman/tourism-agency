<?php
require 'function.php';

$login = new Login();

if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = $login->login($email, $password);

    if($result == 1){
        echo "<script> alert('Login successful'); </script>";
        // Redirect to the dashboard or any other page after successful login
        header("Location: index.php");
        exit();
    }
    elseif($result === 10){
        echo "<script> alert('Email or password is incorrect'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="post" autocomplete="off">
        <label for="email">Email: </label>
        <input type="email" name="email" id="email"><br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password"><br>
        <button type="submit" name="submit">submit</button>
    </form>
    <br> <br>
    <a href="signup.php">Sign up</a>
</body>
</html>





 