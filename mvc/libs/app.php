<?php 
require_once ('controllers/errores.php');


class App{
function __construct(){
   // echo '<p>Nueva App</p>';
   
////-----------------------
    $url = isset($_GET['url'])? $_GET['url'] : null;
    $url = rtrim($url, '/');
    $url = explode ('/', $url);

  ////cuand se ingresa el controlador.
    if(empty($url[0])){
      $archivoController = 'controllers/main.php';
      require_once $archivoController;
      $controller = new Main();
      $controller -> loadmodel('main');
      $controller -> render(); 
      return false;
    }
  $archivoController = 'controllers/' . $url[0] . '.php';

  if(file_exists($archivoController)){
    require_once $archivoController;

      ////inizializa el controlador
      $controller = new $url[0];
      $controller ->loadmodel($url[0]);
      // numero de elemnetoss.
      $nparam = sizeof($url);

      if($nparam > 1){
          if($nparam > 2){
            $param = [];
            for($i = 2; $i < $nparam; $i++){
              array_push($param, $url[$i]);
          }
           
            $controller ->{$url[1]}($param);


            }else{
              $controller->{$url[1]}();
              
            }
          }else{
            $controller->render();
      }
      
     
  }else{
    $controller = new Errores();
  }
 
}
}
 ?>