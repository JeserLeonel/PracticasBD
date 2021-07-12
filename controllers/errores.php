<?php 
class Errores extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->reder('errores/index');
        $this->view->mensaje = "Error Generico 1";
        //echo '<p>Error en cargar recurso</p>';
}
}
?>