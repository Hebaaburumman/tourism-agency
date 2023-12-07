<?php
require 'function.php';



$register = new Register();

if(isset($_POST["submit"])){
    $result = $register-> registration($_POST["username"],$_POST["password"],$_POST["email"]);
    
    if($result == 1){
        echo "<script> alert('registration successful'); </script>";
        header("Location: login.php");
        exit();

    }
    elseif($result === 10){
        echo "<script> alert('email has already been taken'); </script>";
    }
    else {
        echo "<script> alert('Registration failed. Error: " . $result . "'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup form</title>
</head>
<body>
    <?php
    if (!empty($mes)){
        echo $mes;
        $mes='';
    }
    ?>
    <form action="" method="post" autocomplete="off">
        
        <label for="username">username : </label>
        <input type="text" name="username" id="userame"><br>
        <label for="password">password : </label>
        <input type="password" name="password" id="password"><br>
        <label for="email">email : </label>
        <input type="email" name="email" id="email"><br>
        <button type="submit" name="submit">submit</button>
    </form>
    <br> <br>
    <a href="login.php"> login</a>
</body>
</html>