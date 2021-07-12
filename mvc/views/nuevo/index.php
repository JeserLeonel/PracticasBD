<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
</head>

<body>

    <?php require 'views/header.php'; ?>

    <div id="main">

    <h1 class="center">Sección de Nuevo</h1>
        <div><?php 
        $campos    = array();
        $campos = $this->mensaje;

        if($campos != ""){
            if(count($campos)>0){
                echo "<div class='error'>";
                for($i = 0; $i < count($campos); $i++){
                    echo "<li>".$campos[$i]."</i>";
                }
                //var_dump($campos);
            }else{
                echo "<div class='correcto'> Nuevo alumno creado";
            }
            echo "</div>"; 
            
        }
        
        
        ?></div>
       
       <br>
        <form action="<?php echo constant('URL') ?>/nuevo/registrarAlumno" method="POST" enctype="multipart/form-data">
            <label for="">Matrícula</label><br>
            <input type="text" name="matricula" id="" placeholder="16620249"><br>

            <label for="">Nombre</label><br>
            <input type="text" name="nombre" id="" placeholder="Nombre"><br>

            <label for="apellidpo">Apellido Paterno</label><br>
            <input type="text" name="apellidop" id="" placeholder="Apellido" ><br>

            <label for="apellidom">Apellido Materno</label><br>
            <input type="text" name="apellidom" id="" placeholder="Apellido" ><br>

            <label for="telefono">Telefono</label><br>
            <input type="text" name="telefono" id="" placeholder="9531154758" ><br>

            <label for="email">Email</label><br>
            <input type="text" name="email" id="" placeholder="example@gmail.com" ><br>

            <label for="fotografia">Fotografia</label><br>
            <input type="file" name="fotografia" id="" ><br><br>

            <p class="center">
                <input type="submit" value="Crear nuevo alumno">
            </p>

        </form>
    </div>

    <?php require 'views/footer.php'; ?>

</body>

</html>