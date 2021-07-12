<?php 
class Nuevo extends controller{

    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
    // echo '<p>Nueva Controlador Main</p>';   
    }

    function render(){
        $this->view->render('nuevo/index');
    }

    function registrarAlumno(){
        $matricula  = $_POST['matricula'];
        $nombre     = $_POST['nombre'];
        $apellidop  = $_POST['apellidop'];
        $apellidom  = $_POST['apellidom'];
        $telefono   = $_POST['telefono'];
        $email      = $_POST['email'];
        $mensaje = "";
        $campos    = array();
        $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
        $patron_user = "/^[a-zA-Z0-9]+$/";
        $patron_email = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/";
        $patron_pass = "/^[a-zA-Z0-9]+$/";
        $patron_direc = "/^[a-zA-Z0-9#\s\.?]+$/";

        $patron_num = "/^[0-9]+$/";
        $patron_cp = "/^[0-9]{5,5}$/";
        $img = false;
         
        if($matricula == ""){
            array_push($campos, "El campo Matricula no pude estar vacío");
        }else{
            if(!(preg_match($patron_num, $matricula ))){
                array_push($campos, "El campo Matricula Solo puede contener digitos");
            }else{
                if(strlen( $matricula) != 8   ){
                    array_push($campos, "El campo Matricula Solo puede contener entre 8 digitos");
                }
            }
        }

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

        if($apellidop == ""){
            array_push($campos, "El campo apellido Paterno no pude estar vacío");
        }else{
            if(!(preg_match($patron_texto, $apellidop ))){
                array_push($campos, "El campo apellido Paterno  Solo puede contener texto");
            }else{
                if(strlen( $apellidop) < 3  ||  strlen( $apellidop) > 20 ){
                    array_push($campos, "El campo apellido Paterno  Solo puede contener entre 3 y 60 caracteres");
                }
            }
        }
        if($apellidom == ""){
            array_push($campos, "El campo apellido Materno no pude estar vacío");
        }else{
            if(!(preg_match($patron_texto, $apellidom ))){
                array_push($campos, "El campo apellido Materno  Solo puede contener texto");
            }else{
                if(strlen( $apellidom) < 3  ||  strlen( $apellidom) > 20 ){
                    array_push($campos, "El campo apellido Materno  Solo puede contener entre 3 y 60 caracteres");
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

    
        if (isset($_FILES['fotografia']['name'])) {
            $archivo=$_FILES['fotografia']['name'];
               if (isset($archivo) && $archivo != "") {
                   
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
                                            $img= true;
        
                                        }
                                    }
                                    
                                }
                                
                            }
                    
                  }else{
                array_push($campos, "Error en campo Fotografia, Debe seleccionar una fotografia");
                  }
          
        } else{
            array_push($campos, "Error en campo Fotografia, Debe seleccionar una fotografia");
        }
        

        
        if(!(count($campos) > 0)){
            
                    if( $this->model->insert(['matricula' => $matricula, 'nombre' => $nombre, 'apellidop' => $apellidop, 'apellidom' => $apellidom, 'telefono' => $telefono, 'email' => $email, 'img' => $archivo])){
                       
                            $archivo=$_FILES['fotografia']['name'];
                            $temp=$_FILES['fotografia']['tmp_name'];
                            if(!(move_uploaded_file($temp, 'imagenes/'.$archivo))){
                           
                                array_push($campos, "Archivo no se pudo guardar");
                            }else{
                                // array_push($campos, "Archivo guardado con exito");
                            }
                       }else{
                            array_push($campos, "Ya existe la matricula");
                       }


            }  else{
                
                $alumno = new \stdClass();
                $alumno->matricula = $matricula;
                $alumno->nombre    = $nombre;
                $alumno->apellidop = $apellidop;
                $alumno->apellidom = $apellidom;
                $alumno->telefono  = $telefono;
                $alumno->email     = $email;

            $this->view->alumno = $alumno;
            }
            
            
            
       $this->view->mensaje = $campos;
       $this->render();
    }
}
 ?>