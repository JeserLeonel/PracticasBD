<?php 
include_once 'includes/user.php';
include_once 'includes/user_session.php';


class Log{
    public function __construct(){
        $userSession = new UserSession();
        $user = new User();

        if(isset($_SESSION['user'])){
            //echo "Hay sesión";
            $user->setUser($userSession->getCurrentUser());
            $app = new App();
        }else {

        if(isset($_POST['username']) && isset($_POST['password'])){
          //  echo "Validación de login";
        
            $userForm = $_POST['username'];
            $passForm = $_POST['password'];
        
            //echo ($userForm);
           // echo($passForm);
            //echo($user->userExists($userForm, $passForm));
        
            if($user->userExists($userForm, $passForm)){
                //echo "usuario validado";
                $userSession->setCurrentUser($userForm);
                $user->setUser($userForm);
        
                //include_once 'views/main/index.php';
                $app = new App();
        
            }else{
                // echo "nombre de usuario y/o password incorrecto";
                $errorLogin = "Nombre de usuario y/o password es incorrecto";
                include_once 'views/login/login.php';
            }
        
        }else{
           // echo "Login";
           include_once 'views/login/login.php';
        }

    } 
}
 } 



        ?>