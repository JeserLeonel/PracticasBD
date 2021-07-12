<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sesiones</title>

    <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/main.css">
</head>

<body>
    <form action="" method="POST">

        <?php

            if(isset($errorLogin)){
                echo $errorLogin;
                        }
            // code before the try-catch block
            
          
           // $cliente = $_GET["varCliente"];
            if(isset($_GET["varCliente"])){
                $cliente = $_GET["varCliente"];
            echo "<div class='correcto'>Datos correctos";
               
               // var_dump( $cliente );
                
            }else{
               
                
            }
            
            echo "</div>";
           
       ?>


        <h2>Iniciar sesión</h2>
        <p>Nombre de usuario: <br>
            <input type="text" name="username"></p>
        <p>Password: <br>
            <input type="password" name="password"></p>
        <p class="center"><input type="submit" value="Iniciar Sesión"></p>

        <h5>No esta registrado? <a href="views/registro/index.php">Registrate aqui!</a></h5>



    </form>
</body>

</html>