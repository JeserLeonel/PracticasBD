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
    <?php 
            
            $campos    = array();
            $campos ="";
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
                    echo "</div>"; 
                }
                
                
            }
            
            
            ?>
        <h1 class="center">Sección de consulta</h1><br>
        <div>
            <form id="buscador" name="buscador" method="post" action="<?php echo constant('URL') ?>consulta/buscarAlumno">
                <input id="buscar" name="search" type="text" placeholder="Buscar aquí…" autofocus>
                <input type="submit" name="buscador" class="bBuscar" value="buscar"> </form>

        </div><br>
        <div>
            <table width="100%" id="tabla">
                <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre</th>
                        <th>Paterno</th>
                        <th>Materno</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Fotografia</th>
                        <th></th>
                        <th></th>

                    </tr>
                </thead>

                <tbody id="tbody-alumnos">

                        <?php
                            include_once 'models/alumno.php';
                            foreach ($this->alumnos as $row) {
                                $alumno = new Alumno();
                                $alumno = $row;
                        ?>
                    <tr id="fila-<?php echo $alumno->matricula; ?>">
                        <td class="center"><?php echo $alumno->matricula; ?></td>
                        <td class="center"><?php echo $alumno->nombre; ?></td>
                        <td class="center"><?php echo $alumno->apellidop; ?></td>
                        <td class="center"><?php echo $alumno->apellidom; ?></td>
                        <td class="center"><?php echo $alumno->telefono; ?></td>
                        <td class="center"><a href="#"> <?php echo $alumno->email; ?></a></td>
                        <td class="center"> <img src="imagenes/<?php echo $alumno->img;?>" width="70" height="80"></td>
                        <td class="center"><button class="beditar" role="link"
                                onclick="window.location='<?php echo constant('URL') . 'consulta/verAlumno/' . $alumno->matricula; ?>'">Editar</button>
                        </td>

                        <td><td class="center"><button class="bEliminar" role="link"
                                onclick="window.location='<?php echo constant('URL') . 'consulta/eliminarAlumno/' . $alumno->matricula; ?>'">Eliminar</button></td>
                        
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php require 'views/footer.php'; ?>
    <script src="<?php echo constant('URL'); ?>/public/js/main.js"></script>
</body>

</html>