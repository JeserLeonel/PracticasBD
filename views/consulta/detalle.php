


<html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">



    <title>Document</title>
</head>

<body>

    <?php require 'views/header.php'; ?>

    <div id="main_d" c>

        <?php 
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
                echo "<div class='correcto'> Alumno actualizado correctamente";
            }
            echo "</div>"; 
            
        }
        
        
        ?>
        <h1 class="center">Actualizar <?php echo $this->alumno->matricula;  ?></h1>


        <form action="<?php echo constant('URL') ?>consulta/actualizarAlumno" method="POST"
            enctype="multipart/form-data">
            <div class="center">
                <img width="100" height="10" src="<?php echo constant('URL')?>imagenes/<?php echo $this->alumno->img; ?>" class="center" /><br></div>
            <label for="">Matrícula</label><br>
            <div class="show" style="display: none">
                <input type="text" name="matricula" id="" value="<?php echo $this->alumno->matricula;  ?>"><br>
                <input type="text" name="foto" value="<?php echo $this->alumno->img; ?>"><br>
            </div>
            <input type="text" name="m" id="" disabled value="<?php echo $this->alumno->matricula;  ?>"><br>
            <label for="">Nombre</label><br>
            <input type="text" name="nombre" value="<?php echo $this->alumno->nombre; ?>"><br>
            <label for="">Paterno</label><br>
            <input type="text" name="paterno" value="<?php echo $this->alumno->apellidop; ?>"><br>
            <label for="">Materno</label><br>
            <input type="text" name="materno" value="<?php echo $this->alumno->apellidom; ?>"><br>
            <label for="">Telefono</label><br>
            <input type="text" name="telefono" value="<?php echo $this->alumno->telefono; ?>"><br>
            <label for="">Email</label><br>
            <input type="text" name="email" value="<?php echo $this->alumno->email; ?>"><br>
            <label for="">Fotografia</label><br>
            <input type="text" name="f" disabled value="<?php echo $this->alumno->img; ?>"><br>

            <br />
            <input type='file' id="imgInp" name="fotografia" />
            <br>



            <br><br>
            <div class="center">
                <input type="submit" src="imagenes/<?php echo $this->alumno->img; ?>" value="Crear nuevo alumno">
                <br />
            </div>

        </form>
    </div>

    <?php require 'views/footer.php';  ?>

</body>

</html>