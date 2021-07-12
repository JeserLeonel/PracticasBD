<?php 
class Ayuda extends controller{

    function __construct(){
        
        parent::__construct();
        
    }

    function render(){
        $this->view->render('ayuda/index');
    }

}
?>