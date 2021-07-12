<?php

            
if(isset($_POST['username'])){
    
    $nombre = $_POST['nombre'];
    $username = $_POST['username'];
    $edad = $_POST['edad'];
    $sexo      = $_POST['sexo'];
    $email     = $_POST['email'];
    $direccion = $_POST['direccion'];
    $telefono  = $_POST['telefono'];
    $ciudad    = $_POST['ciudad'];
    $cp        = $_POST['cp'];
   // $imagner       = $_GET['imagensubida'];
    $password2 = $_POST['password2'];

    $campos = array();
    $hola = "si existe campo";

   

    $servidor = "localhost";
    $nombreusuario = "root";
    $password = "";
    $db = "mvc";

    $conexion = new mysqli($servidor, $nombreusuario, $password, $db);

    if($conexion->connect_error){
        //echo("error de conexion");

        die("Conexión fallida: " . $conexion->connect_error);
    }
   // echo("conecta bien");

  
    $sql = "SELECT * from usuarios WHERE username='$username'";
    $result = $conexion->query($sql);
    $fila = $result->fetch_assoc();
                   
    if($fila != 0){
        array_push($campos, "El Nombre de usuario ya existe");
    }
   
                            
    if(count($campos) > 0){
       
        echo "<div class='error'>";
        for($i = 0; $i < count($campos); $i++){
            echo "<li>".$campos[$i]."</i>";
        }
    }else{
      //  echo "<div class='correcto'>
         //       Datos correctos";
        $usern="Datos correctos";   
        //echo($email);     
               
            
                if(isset($_POST['username'])){
    
                    $clave=md5($password2);
                   // echo 'Clave encriptada: '.$clave;
                 
                                    
                    $sql = "INSERT INTO usuarios(nombre, username, edad, sexo, email, direccion, telefono, ciudad, cp, password)
                                       VALUES('$nombre', '$username',$edad, '$sexo', '$email', '$direccion', '$telefono', '$ciudad' , '$cp','$clave')";
                                       
                    if($conexion->query($sql) === true){
                       // echo("inserto datos");

                       $to = $email;
                       $subject = "Refistro MVC";
                       $headers = "MVC-Version: 1.0" . "\r\n";
                       $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        
                       $message = "
                       <html>
                        <body>
                            <h1>Registro de sistema MVC H1</h1>
                            <p>nombre: </p> 
                        </body>
                        </html>". $nombre ."
                        <html>
                        <body>
                        <br><p>usuario: </p>
                        </body>
                        </html>" .$username ."
                        <html>
                        <body>
                        <br><p>contraseña: </p>
                        </body>
                        </html>" . $password2 ;
                        

                     //  if(mail($to, $subject, $message, $headers)){
                     //        echo("El mensaje se envio");
                     //   }else{
                     //       echo("El mensaje no se ha enviado");
                     //  }
                     if(isset($_FILES['imagensubida']['name'])){
                        $nombre=$_FILES['imagensubida']['name'];

                        //$file = .$nombre;
                       // echo ($nombre_fichero );
                        

                                if (file_exists('../../imagenes/'.$nombre )){
                                    echo "El fichero existe";
                                }else{
                                    echo "El fichero no existe";

                                    $guardado=$_FILES['imagensubida']['tmp_name'];

                                    if(move_uploaded_file($guardado, '../../imagenes/'.$nombre)){
                                        echo "Archivo guardado con exito";
                                    }else{
                                        echo "Archivo no se pudo guardar";
                                    }

                                }

                            
                            
                               

                               
                    }else{
                        echo("no existe imagen");
                    }

                       

                     // header('Location: ../..?varCliente= "$usern"' );
                    }else{
                        die("Error al insertar datos: " . $conexion->error);
                        echo("error al isertar datos");
                    }
                    $conexion->close();
                    
                }                
          
               

            }
    echo "</div>";            
    
}
?>