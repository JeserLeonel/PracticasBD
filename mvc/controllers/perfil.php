<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/SMTP.php';


class Perfil extends controller{
    function __construct(){
        parent::__construct();
        $this->view->alumnos = [];
        // echo '<p>Nueva Controlador Main</p>';   
    }

    function render(){
        $idAlumno = $_SESSION['user'];
        //var_dump($idAlumno);
        $alumno = $this->model->getByUser($idAlumno);
 
        $this->view->usuario = $alumno;
        $this->view->mensaje = "";
        $this->view->render('perfil/index');
    }

    function actualizarUsuario(){
        //session_start();
        $nombre    = $_POST['nombre'];
      
        $edad      = $_POST['edad'];
       
        $email     = $_POST['email'];
        $direccion = $_POST['direccion'];
        $telefono  = $_POST['telefono'];
        $ciudad    = $_POST['ciudad'];
        $cp        = $_POST['cp'];
        $password3 = $_POST['password2'];
        $password2 = $_POST['password2'];
        $password1  = $_POST['password'];
        $imagen  = $_POST['foto'];
        //$archivo=$_FILES['fotografia']['name'];
        $idUsuario = $_SESSION['user'];
        $campos    = array();
        $clave=md5($password1);
        $psaer = false;
       

        //var_dump($password1);
        //var_dump($idUsuario);
        //var_dump($clave);

        $usuarios = $this->model->com_pass($idUsuario, $clave);
       
        if($usuarios == true){
                   
                    $sin_img = false;
                    $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
                    $patron_user = "/^[a-zA-Z0-9]+$/";
                    $patron_email = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/";
                    $patron_pass = "/^[a-zA-Z0-9]+$/";
                    $patron_direc = "/^[a-zA-Z0-9#\s\.?]+$/";

                    $patron_num = "/^[0-9]+$/";
                    $patron_cp = "/^[0-9]{5,5}$/";
                
                    
                    if($nombre == ""){
                        array_push($campos, "El campo Nombre no pude estar vacío");
                    }else{
                        if(!(preg_match($patron_texto, $nombre ))){
                            array_push($campos, "El campo Nombre Solo puede contener texto");
                        }else{
                            if(strlen( $nombre) < 3  ||  strlen( $nombre) > 20 ){
                                array_push($campos, "El campo Nombre Solo puede contener entre 3 y 20 caracteres");
                            }
                        }
                    }

                    if( isset( $_POST['username'])){

                        $username  = $_POST['username'];
                        if($username == ""){
                            array_push($campos, "El campo Nombre de usuario no se puede modificar");
                        }else{
                            array_push($campos, "El campo Nombre de usuario no se puede modificar");
                           
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


                    if(isset( $_POST['sexo'])){
                        $sexo      = $_POST['sexo'];
                        if(!($sexo == "Hombre" || $sexo == "Mujer" )){
                            array_push($campos, "Error en el campor Sexo. Debe seleccionar un sexo");
                        } 
                    }else{

                        $se_user = $this->model->sex_user($idUsuario, "Hombre");
                        
                        if($se_user == true){
                            $sexo = "Hombre";
                        }else{
                            $sexo = "Hombre";
                        }

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

                            if($password2 == ""){
                                
                            }else{
                                if(!(preg_match($patron_pass, $password2 ))){
                                    array_push($campos, "Error campo Contraseña nueva. Solo puede contener texto y numeros");
                                    
                                }else{
                                    if((strlen( $password2) < 4  ||  strlen( $password2) > 8)){
                                        array_push($campos, "Error campo Contraseña nueva. Solo puede contener de 4 a 8 digitos");
                                    }else{
                                        if($password2 != $password3){
                                            array_push($campos, "Error campo Confirmar Contraseña nueva. La contraseña no coincide");
                                        }else{
                                            $password1 =$password2;
                                            $psaer = true;
                                        }
                                    }
                                }
                            }

                
                    if (isset($_FILES['fotografia']['name'])) {
                        $archivo=$_FILES['fotografia']['name'];

                        if ($archivo != "") {
                            
                                $tipo = $_FILES['fotografia']['type'];
                                $tamano = $_FILES['fotografia']['size'];
                                $temp = $_FILES['fotografia']['tmp_name'];
                            
                                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) )) {
                                        array_push($campos, "Error en campo Fotografia, Formatos validos png,jpg,jpge y gif");
                                    }else {

                                            if(!($tamano < 200000)){
                                                array_push($campos, "Error en campo Fotografia, La fotografia se excede en peso");
                                            }else{
                                                if (strlen ($_FILES['fotografia']['name']) > 60){
                                                    array_push($campos, "Error en campo Fotografia, El nombre del archivo es muy largo.");
                                                }else{
                                                                                                    
                                                    if (file_exists('imagenes/'.$archivo )){
                                                        array_push($campos, "Error en campo Fotografia, Archivo existente, se recomienda cambiar el nombre");
                                                    }else{
                                                    //array_push($campos, "fotografia valida");   
                                                    $sin_img = true;
                                                    //var_dump($archivo);
                    
                                                    }
                                                }
                                                
                                            }
                                            
                                        }
                                
                            }else{
                        // array_push($campos, "Error en campo Fotografia, Debe seleccionar una fotografia");
                            $archivo = $imagen;
                            }
                    
                    } else{
                    
                    $archivo = $imagen;
                    }
                
               // unset($_SESSION["id_verAlumno"]);

               if(!(count($campos) > 0)){                
                    $clave=md5($password1);
                    //var_dump($username);
                    if($this->model->updateUser(['nombre' => $nombre, 'username' => $idUsuario, 'edad' => $edad, 'sexo' => $sexo, 'email' => $email, 'direccion' => $direccion, 'telefono' => $telefono, 'ciudad' => $ciudad,'cp' => $cp, $ciudad,'password' => $clave,'img' => $archivo]))
                    {
                        ////actualizar alumno
                        $usuario = new \stdClass();
                        $usuario->nombre   = $nombre;
                        $usuario->username = $idUsuario;
                        $usuario->edad     = $edad;
                        $usuario->sexo     = $sexo;
                        $usuario->email    = $email;
                        $usuario->direccion  = $direccion;
                        $usuario->telefono   = $telefono;
                        $usuario->ciudad     = $ciudad;
                        $usuario->cp         = $cp;
                        $usuario->password   = $password1;
                        $usuario->img        = $archivo;
                        
            
                        $this->view->usuario = $usuario;
                      
                      //  array_push($campos, "Alumno actualizado correctamente");

                       
                      if($sin_img == true){
                            unlink("imagenes/".$imagen);
                            $archivo=$_FILES['fotografia']['name'];
                            $temp=$_FILES['fotografia']['tmp_name'];
                            if(!(move_uploaded_file($temp, 'imagenes/'.$archivo))){
                        
                                array_push($campos, "Archivo no se pudo guardar");
                            }else{
                                //array_push($campos, "Archivo guardado con exito");
                            }
                        } 

                        if($psaer == true){
             
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
                                            $mail->Subject = 'Actualizacion de datos MVC';

                                            $cuerpo = '<html>
                                            </head>
                                           <title>Validacion de cuenta</title>
                                           </head>
                                           <body>Usuario: "'.$idUsuario.'"</p>
                                           <br>
                                           <p>contraseña: "'.$password1.'"</p>
                                           <
                                            </body>
                                           </html>';
                                            $mail->Body = $cuerpo;

                                            
                                            
                                            //Enviamos el correo
                                            if(!$mail->Send()) {
                                            echo "Error al enviar el mensaje: " . $mail->ErrorInfo;
                                            } else {
                                           // echo "Enviado!";
                                            }
                        }
                                       



                        
                    }else{
                        ///error
                        array_push($campos, "No se pudo actualizar el aluusuariomno");
                        $alumno = $this->model->getByUser($idUsuario);
                        $this->view->usuario = $alumno;
                    }         
                }else{
                  //s  array_push($campos, "La no es valida contraseña");
                    $alumno = $this->model->getByUser($idUsuario);
                    $this->view->usuario = $alumno;
                }
             }else{
               array_push($campos, "La contraseña no es valida");
                    $alumno = $this->model->getByUser($idUsuario);
                    $this->view->usuario = $alumno;
          
         }     
           
        $this->view->mensaje = $campos;

        $this->view->render('perfil/index');
    }//fin de funcion actualizar

}//fin de clase
 ?>