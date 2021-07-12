<?php
include_once 'libs/database.php';

class User extends Database{

    private $nombre;
    private $username;

    public function userExists($user, $pass){
           $md5pass= md5($pass);
           // var_dump($md5pass);
          // echo($md5pass);
          // echo("---");

            $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND password = :pass');
            $query->execute(['user' => $user, 'pass' => $md5pass]);
    
            if($query->rowCount()){
                return true;
            }else{
                return false;
            }

    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuarios Where username = :user ');
        $query->execute(['user' => $user ]);

        foreach($query as $currentUser){
            $this->nombre = $currentUser['nombre'];
            $this->username = $currentUser['username'];

        }

    
    }
    public function getNombre(){
        echo("hola");
        return $this->nombre;
    }

    public function createUser(){
       

    }
    

}

?>