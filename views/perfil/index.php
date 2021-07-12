<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="<?php echo constant('URL')?>public/css/default.css">



        <title>Document</title>
    </head>

<body>

    <?php require 'views/header.php'; ?>

    <div id="main_d">
        
            <?php 
            $campos    = array();
            
            if(isset($this->mensaje)){
                $campos = $this->mensaje;
            }
            if($campos != ""){
                if(count($campos)>0){
                    echo "<div class='error'>";
                    for($i = 0; $i < count($campos); $i++){
                        echo "<li>".$campos[$i]."</i>";
                    }
                    //var_dump($campos);
                }else{
                    echo "<div class='correcto'> Alumno actualizado correctamente";
                }
                echo "</div>"; 
                
            }
            
            
            ?>
            <h1 class="center">Actualizar <?php echo $this->usuario->nombre;  ?></h1>

            <form action="<?php echo constant('URL') ?>perfil/actualizarUsuario" method="POST"
                enctype="multipart/form-data">
                <div class="center">
                    <img width="100" height="100" src="<?php echo constant('URL')?>imagenes/<?php echo $this->usuario->img; ?>" class="center" /><br>
                </div>
                <div  style="display: none">
                <input type="text" name="foto" value="<?php echo $this->usuario->img; ?>"><br>

                </div>
                <div class="menu">
                    <label for="">Nombre</label><br>
                    <input type="text" name="nombre" id="" value="<?php echo $this->usuario->nombre;  ?>"><br>
                    <label for="">Nombre de usuario</label><br>
                    <input type="text" name="username" disabled value="<?php echo $this->usuario->username; ?>"><br>
                    
                    <label for="">Eadad</label><br>
                    <input type="number" name="edad" value="<?php echo $this->usuario->edad; ?>"><br><br>
                    Sexo: <input type="radio" name="sexo" value="Hombre"> Hombre
                    <input type="radio" name="sexo" value="Mujer"> Mujer<br><br>
                    <label for="">Correo electronico</label><br>
                    <input type="text" name="email" value="<?php echo $this->usuario->email; ?>"><br>
                    <label for="">Direccion</label><br>
                    <input type="text" name="direccion" value="<?php echo $this->usuario->direccion; ?>"><br>
                    <label for="">Telefono</direccion><br>
                        <input type="text" name="telefono" value="<?php echo $this->usuario->telefono; ?>"><br>
                        <label for="">Ciudad</label><br>
                        <input type="text" name="ciudad" value="<?php echo $this->usuario->ciudad; ?>"><br>
                        <label for="">Codigo Postal</label><br>
                        <input type="text" name="cp" value="<?php echo $this->usuario->cp; ?>"><br>
                        <label for="">Fotografia</label><br>
                        <input type="text" name="f" disabled value="<?php echo $this->usuario->img; ?>"><br>

                        <br />
                        <input type='file' id="imgInp" name="fotografia" />
                        <ul class="list1">
                            <br />
                            <li>Para validar los cambios debes ingresar tu contraseña :
                        </ul>
                        <p>Contraseña: <br>
                            <input type="password" name="password" id="password"></p><br>
                        <p>Nueva Contraseña: <br>
                            <input type="password" name="password2" id="password2"></p>
                        <p>Confirma Nueva Contraseña: <br>
                            <input type="password" name="password3" id="password3"></p>
                        <br><br>
                        <div class="center">
                            <input type="submit" src="imagenes/<?php echo $this->usuario->img; ?>"
                                value="Actualizar usuario">
                        </div>
                </div>
            </form>
        </div>

        <?php require 'views/footer.php';  ?>

</body>

</html>

