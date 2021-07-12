<?php  
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 
 require 'PHPMailer-master/src/PHPMailer.php';
 require 'PHPMailer-master/src/Exception.php';
 require 'PHPMailer-master/src/SMTP.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="http://localhost/mvc/public/css/main.css">
</head>

<body>

    <form name='myform' enctype="multipart/form-data" action='index.php' method='post'>

        <?php

            
if(isset($_POST['nombre'])){
    
        $nombre    = $_POST['nombre'];
        $username  = $_POST['username'];
        $edad      = $_POST['edad'];
        $sexo      = $_POST['sexo'];
        $email     = $_POST['email'];
        $direccion = $_POST['direccion'];
        $telefono  = $_POST['telefono'];
        $ciudad    = $_POST['ciudad'];
        $cp        = $_POST['cp'];
        $password2 = $_POST['password2'];
        $password1  = $_POST['password'];

        $campos    = array();
        $hola      = "si existe campo";

        
        $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
        $patron_user = "/^[a-zA-Z0-9]+$/";
        $patron_email = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/";
        $patron_pass = "/^[a-zA-Z0-9]+$/";
        $patron_direc = "/^[a-zA-Z0-9#\s\.?]+$/";

        $patron_num = "/^[0-9]+$/";
        $patron_cp = "/^[0-9]{5,5}$/";
        $img = false;
    

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
   

        if($nombre == ""){
            array_push($campos, "El campo Nombre no pude estar vacío");
        }else{
            if(!(preg_match($patron_texto, $nombre ))){
                array_push($campos, "El campo Nombre Solo puede contener texto");
            }else{
                if(strlen( $nombre) < 3  ||  strlen( $nombre) > 60 ){
                    array_push($campos, "El campo Nombre Solo puede contener entre 3 y 60 caracteres");
                }
            }
        }

        if($username == ""){
            array_push($campos, "El campo Nombre de usuario no pude estar vacío");
        }else{
            if(!(preg_match($patron_pass, $username ))){
                array_push($campos, "El campo nombre usuario solo puede contener texto y numeros");
                
            }else{
                if(strlen( $username) < 4  ||  strlen( $username) > 20 ){
                    array_push($campos, "El campo nombre usuario  Solo puede contener entre 4 y 20 caracteres");
                }else{
                    $sql = "SELECT * from usuarios WHERE username='$username'";
                    $result = $conexion->query($sql);
                    $fila = $result->fetch_assoc();
                                
                    if($fila != 0){
                        array_push($campos, "El Nombre de usuario ya existe");
                    }
                }
            }
        }
    
        if(!( is_numeric( $edad ))){
            rray_push($campos, "Error en campo edad, Solo se aceptan digitos.");
        }else{
            if($edad == ""){
                array_push($campos, "Error en campo Edad. No puede estar vacio");
            }else{
                if($edad < 18 ){
                    array_push($campos, "Error en campo edad. Debe ser mayor de edad");
                }
            }
        }

        if(!($sexo == "Hombre" || $sexo == "Mujer" ) ){
            array_push($campos, "Error en el campor Sexo. Debe seleccionar un sexo");
        }
        

                if($email == ""){
                    array_push($campos, "Error en el campo campo Email. o pude estar vacío");
                }else{
                    
                    if(strlen( $email) > 60){
                        array_push($campos, "Error en el campo campo Email. no debe ser mayor a 60 caracteres");
                    }else{
                        if(!(filter_var($email, FILTER_VALIDATE_EMAIL))){
                            array_push($campos, "Error en el campo campo Email. Verifique su correo");
                        }
                    }
                }

        
                if($direccion == ""){
                    array_push($campos, "Error en campo Direccion. No pude estar vacío");
                }else{
                    if(!(preg_match($patron_direc, $direccion ))){
                        array_push($campos, "Error en campo Direccion. Solo puede contener texto y numeros");
                    
                    }else{
                        if(strlen( $direccion) < 4  ||  strlen( $direccion) > 60 ){
                            array_push($campos, "Error en campo Direccion. Solo puede contener entre 4 y 60 caracteres");
                        }
                    }
                }

                

                if($telefono == ""){
                    array_push($campos, "Error en campo Telefono. No pude estar vacío");
                }else{
                    if(!(preg_match($patron_num, $telefono ))){
                        array_push($campos, "Error campo Telefono. Solo puede contener numeros");
                        
                    }else{
                        if(strlen( $telefono) == 9 ){
                            array_push($campos, "Error campo Telefono. Solo puede contener 10 digitos");
                        }
                    }
                }

                if($ciudad == ""){
                    array_push($campos, "Error en campo Ciudad. No pude estar vacío");
                }else{
                    if(!(preg_match($patron_direc, $ciudad ))){
                        array_push($campos, "Error en campo Ciudad. Solo puede contener texto y numero ");
                    
                    }else{
                        if(strlen( $ciudad) < 4  ||  strlen( $ciudad) > 60 ){
                            array_push($campos, "Error en campo Ciudad. Solo puede contener entre 4 y 60 caracteres");
                        }
                    }
                }

                if($cp == ""){
                    array_push($campos, "Error en campo Codigo Postal. No pude estar vacío");
                }else{
                    if(!(preg_match($patron_num, $cp ))){
                        array_push($campos, "Error campo Codigo Postal. Solo puede contener numeros");
                        
                    }else{
                        if(strlen( $cp) == 4 ){
                            array_push($campos, "Error campo Codigo Postal. Solo puede contener 5 digitos");
                        }
                    }
                }

                 
                $archivo=$_FILES['imagensubida']['name'];
                if (isset($_FILES['imagensubida']['name'])) {
            
                       if (isset($archivo) && $archivo != "") {
                           
                            $tipo = $_FILES['imagensubida']['type'];
                            $tamano = $_FILES['imagensubida']['size'];
                            $temp = $_FILES['imagensubida']['tmp_name'];
                           
                        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) )) {
                                array_push($campos, "Error en campo Fotografia, Formatos validos png,jpg,jpge y gif");
                            }else {

                                    if(!($tamano < 200000)){
                                        array_push($campos, "Error en campo Fotografia, La fotografia se excede en peso");
                                    }else{
                                        if (strlen ($_FILES['imagensubida']['name']) > 60){
                                            array_push($campos, "Error en campo Fotografia, El nombre del archivo es muy largo.");
                                        }else{
                                                                                             
                                            if (file_exists('../../imagenes/'.$archivo )){
                                                array_push($campos, "Error en campo Fotografia, Archivo existente, se recomienda cambiar el nombre");
                                            }else{
                                                       
                                                $img= true;
            
                                            }
                                        }
                                        
                                    }
                                    
                                }
                            
                    } else{
                        array_push($campos, "Error en campo Fotografia, Debe seleccionar una fotografia");
                         }    
                } else{
                    array_push($campos, "Error en campo Fotografia, Debe seleccionar una fotografia");
                }

        if($password1 == "" ){
            array_push($campos, "El campo Password no puede estar vacío");
        }else{
            if(strlen($password1) < 4 || strlen($password1) > 8){
                array_push($campos, "El campo Password no puede tener menos de 4 o mas de 8 caracteres");
            }else{

                if(!(preg_match($patron_pass, $password1 ))){
                    array_push($campos, "El campo Password solo puede contener texto y numeros");
                    
                }else{
                    if(!($password1 == $password2)){
                        array_push($campos, "Errore en el campo Password. Las contraseñas no coinciden");
                    }
                }
                
            }
        }

      
  
    
   
                            
        if(count($campos) > 0){
            echo "<div class='error'>";
            for($i = 0; $i < count($campos); $i++){
                echo "<li>".$campos[$i]."</i>";
            }
        }else{
                 echo "<div class='correcto'> Datos correctos";
                  $usern="Datos correctos";   
       
                if($img==true){
                   
                    $archivo=$_FILES['imagensubida']['name'];
                    $temp=$_FILES['imagensubida']['tmp_name'];
                    if(!(move_uploaded_file($temp, '../../imagenes/'.$archivo))){
                        echo "Archivo no se pudo guardar";
                    }else{
                       // echo "Archivo guardado con exito";
                    
                    }

                }

            
                if(isset($_POST['username'])){
                   // error_log('$password2');
                    $clave=md5($password1);
                   // error_log('$clave');
                   // echo 'Clave encriptada: '.$clave;
                 
                                    
                    $sql = "INSERT INTO usuarios(nombre, username, edad, sexo, email, direccion, telefono, ciudad, cp, password,img)
                                       VALUES('$nombre', '$username','$edad', '$sexo', '$email', '$direccion', '$telefono', '$ciudad' , '$cp','$clave', '$archivo')";
                                       
                    if($conexion->query($sql) === true){

                      
                       
                                                                    
                                            //Crear una instancia de PHPMailer
                                            $mail = new PHPMailer(true);

                                            //Definir que vamos a usar SMTP
                                            $mail->IsSMTP();
                                            //Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
                                            // 0 = off (producción)
                                            // 1 = client messages
                                             //2 = client and server messages
                                            $mail->SMTPDebug  = 0;
                                            $mail->Host       = 'smtp.gmail.com';
                                            $mail->Port       = 587;
                                            $mail->SMTPSecure = 'tls';
                                            $mail->SMTPAuth   = true;
                                            $mail->Username   = "mapj16620249@gmail.com";
                                            $mail->Password   = "centerofgame";
                                            $mail->SetFrom('mapj16620249@gmail.com', 'Sistema MVC');
                                           
                                            $mail->AddAddress($email, $nombre);
                                            $mail->isHTML(true);                                  // Set email format to HTML
                                            $mail->Subject = 'Registro MVC';
                                            $cuerpo = '<html>
                                            </head>
                                           <title>Validacion de cuenta</title>
                                           </head>
                                           <body>Usuario: "'.$username.'"</p>
                                           <br>
                                           <p>contraseña: "'.$password1.'"</p>
                                           
                                            </body>
                                           </html>';
                                            $mail->Body = $cuerpo;
                                            //Enviamos el correo
                                            if(!$mail->Send()) {
                                            echo "Error al enviar el mensaje: " . $mail->ErrorInfo;
                                            } else {
                                           // echo "Enviado!";
                                            }
                      
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


        <div class="menu">
            <h2>Registro</h2>
            <p>Nombre : <br>
                <input type="text" name="nombre" id="nombre" placeholder="nombre apellido"></p>
            <p>Nombre de usuario: <br>
                <input type="text" name="username" id="username" placeholder="nameexample1995"></p>
            <p>edad: <br>
                <input type="number" name="edad" id="edad" value=18></p>
            Sexo: <input type="radio" name="sexo" value="Hombre" checked> Hombre
            <input type="radio" name="sexo" value="Mujer"> Mujer
            <p>Correo electronico: <br>
                <input type="text" name="email" id="email" placeholder="name_10@example.com" >
            </p>
            <p>Direccion: <br>
                <input type="text" name="direccion" id="direccion" placeholder="Francisco I. Madero No. 32"
                    ></p>
            <p>Telefono: <br>
                <input type="text" name="telefono" id="telefono" placeholder="9531154758" ></p>
            <p>Ciudad: <br>
                <input type="text" name="ciudad" id="ciudad" placeholder="Tlaxiaco Oax." ></p>
            <p>Codigo postal: <br>
                <input type="text" name="cp" id="cp" placeholder="47500" ></p>

            <p>Fotografia: <br><br>
                <input type="file" id="imagensubida" name="imagensubida">
                <ul class="list1">
                    <li>Tipo: .png/.jpg/.jpge/.gift</li>
                    <li>Peso: 200kb</li>
                </ul>

                <p>Password: <br>
                    <input type="password" name="password" id="password"></p>
                <p>Confirmar Password: <br>
                    <input type="password" name="password2" id="password2"></p>

                <p class="center">
                    <input type="submit" name="subir" value="Registrar">
                </p>

        </div>
    </form>


</body>

</html>