<?php 
class Consulta extends controller{
    function __construct(){
        parent::__construct();
        $this->view->alumnos = [];
        // echo '<p>Nueva Controlador Main</p>';   
    }

    function render(){
        $alumnos =  $this->model->get();
        $this->view->alumnos = $alumnos;
        $this->view->render('consulta/index');
    }

    function verAlumno($param = null){
       $idAlumno = $param[0];
       $alumno = $this->model->getById($idAlumno);

       $this->view->alumno = $alumno;
       $this->view->mensaje = "";
       $this->view->render('consulta/detalle');

    }

    function actualizarAlumno(){
        $matricula     = $_POST['matricula'];
        $nombre     = $_POST['nombre'];
        $apellidop  = $_POST['paterno'];
        $apellidom  = $_POST['materno'];
        $telefono   = $_POST['telefono'];
        $email      = $_POST['email'];
        $imagen      = $_POST['foto'];
        //$archivo=$_FILES['fotografia']['name'];
        $mensaje = "";
      //var_dump($imagen);
      //var_dump($telefono);
      
        $campos    = array();
        $sin_img = false;
        $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
        $patron_user = "/^[a-zA-Z0-9]+$/";
        $patron_email = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/";
        $patron_pass = "/^[a-zA-Z0-9]+$/";
        $patron_direc = "/^[a-zA-Z0-9#\s\.?]+$/";

        $patron_num = "/^[0-9]+$/";
        $patron_cp = "/^[0-9]{5,5}$/";
       
         
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
                
                if(strlen( $telefono) != 10 ){
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
                                             // var_dump('imagenes/'.$archivo);                                     
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
                    if($this->model->update(['matricula' => $matricula, 'nombre' => $nombre, 'apellidop' => $apellidop, 'apellidom' => $apellidom, 'telefono' => $telefono, 'email' => $email, 'img' => $archivo]))
                    {
                        ////actualizar alumno
                        $alumno = new \stdClass();
                        $alumno->matricula = $matricula;
                        $alumno->nombre    = $nombre;
                        $alumno->apellidop = $apellidop;
                        $alumno->apellidom = $apellidom;
                        $alumno->telefono  = $telefono;
                        $alumno->email     = $email;
                        $alumno->img       = $archivo;
                        
            
                        $this->view->alumno = $alumno;
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
                       

                        
                    }else{
                        ///error
                        array_push($campos, "No se pudo actualizar el alumno");
                    }     
                
                }else
        
            $this->view->mensaje = $campos;

        $this->view->render('consulta/detalle');
    }




    function eliminarAlumno($param = null){

        $matricula = $param[0];
      

        $campos = array();
       $nombre_imagen = $this->model->nom_img($matricula);
      // var_dump($nombre_imagen);
        if($this->model->delete($matricula)){
       
                       if(unlink("imagenes/".$nombre_imagen)){
                        $campos  = "imagen aluno elimnada";
                       }else{
                        $campos  = "no se elimino la imagen alumnos";
                       }      
                       
        }else{
        
            $campos = "No se pudo eliminar el alumno";
           // $mensaje = "No se pudo eliminar el alumno";
        }
       // $this->view->mensaje = $campos;
        $alumnos =  $this->model->get();
        $this->view->alumnos = $alumnos;
       
        $this->view->render('consulta/index');
       // $this->render();

      
    }


    function buscarAlumno(){
        $patron_direc = "/^[a-zA-Z0-9#\s\.?]+$/";
        $campos    = array();
        $yt=false;
        if (isset($_POST['search'])) {
            $palabra = $_POST['search'];
                  // var_dump($palabra);     

            if($palabra == ""){
                array_push($campos, "El campo de Busqueda no pude estar vacío");
            }else{
                if(!(preg_match($patron_direc, $palabra ))){
                    array_push($campos, "El campo Busqueda Solo puede contener digitos y letras");
                }else{
                    if(strlen( $palabra) > 20  ){
                        array_push($campos, "El campo Busqueda Solo puede contener maximo 20 digitos");
                        
                    }else{
                    $yt=true;
                    }
                }
            }
           
            if( $yt==true){

                if( $this->model->vali($palabra)  == true){
                    $alumnos = $this->model->search($palabra);         
                    $this->view->alumnos = $alumnos; 
                }else{
                   
                    array_push($campos, "No existe coincidencias de busqueda");
                }
                                              
                              
                
            }else{
                $alumnos =  $this->model->get();
                $this->view->alumnos = $alumnos;
            }
           
                $this->view->mensaje = $campos;
                $this->view->render('consulta/index');
        
         }else{  //se ignora si existe busueda
            $alumnos =  $this->model->get();
            $this->view->alumnos = $alumnos;
            $this->view->render('consulta/index');
    

         }
    }



}
 ?>