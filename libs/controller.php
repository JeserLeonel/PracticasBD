<?php 
class controller{
        function __construct(){
        // echo '<p>Controlador base</p>';

            $this->view = new View();
        }

        function loadModel($model){
            $url = 'models/'. $model.'model.php';
//var_dump($url);
            if(file_exists($url)){

                     require $url;

                    $modelName = $model.'Model';
                    $this->model = new $modelName();
            }
         }
    }
?>