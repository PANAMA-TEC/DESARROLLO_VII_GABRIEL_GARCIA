<?php 
  session_start();  
  include_once "./login.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form method="post" action="./login.php">
     
            <label for="usuario">Usuario:</label><br>
           <input type="text" id="usuario" name="usuario" required><br><br>

           <label for="contrasena">Contraseña:</label><br>
           <input type="password" id="contrasena" name="contrasena" required><br><br>

           <input type="submit" value="Iniciar Sesión">
           

           
    </form>
    
</body>
</html>