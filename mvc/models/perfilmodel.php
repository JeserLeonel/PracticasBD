<?php 
include_once 'models/usuario.php';
class Perfilmodel extends Model{
    public function __construct(){
        parent:: __construct();
    }

    public function gett(){

      //echo("Hola");
      $items = [];
      try{

        $query = $this->db->connect()->query("SELECT*FROM usuarios");

            while($row = $query->fetch()){
                $item = new Usuario();
                $item->id        = $row['id'];
                $item->nombre    = $row['nombre'];
                $item->username  = $row['username'];
                $item->edad      = $row['edad'];
                $item->sexo      = $row['sexo'];
                $item->email     = $row['email'];
                $item->telefono  = $row['telefono'];
                $item->direccion = $row['direccion'];
                $item->ciudad    = $row['ciudad'];
                $item->cp        = $row['cp'];
                $item->img       = $row['img'];


                array_push($items, $item);
            }
            return $items;
      }catch(PDOException $e){
        return [];

      }
    }


    public function getByUser($id){
      $item = new Usuario();

      $query = $this->db->connect()->prepare("SELECT * FROM usuarios WHERE username = :username ");
      try{
          $query->execute(['username' => $id]);

          while($row = $query->fetch()){
            $item->nombre     = $row['nombre'];
            $item->username   = $row['username'];
            $item->edad       = $row['edad'];
            $item->sexo       = $row['sexo'];
            $item->email      = $row['email'];
            $item->telefono  = $row['telefono'];
            $item->direccion  = $row['direccion'];
            $item->ciudad     = $row['ciudad'];
            $item->cp         = $row['cp'];
            $item->img  = $row['img'];
            $item->password  = $row['password'];
          }

        return $item;
      }catch(PDOException $e){
        return null;
      }
    }


    public function com_pass($user, $pass){
      $ght=false;
      $servidor = "localhost";
        $nombreusuario = "root";
        $password = "";
        $db = "mvc";
    
        $conexion = new mysqli($servidor, $nombreusuario, $password, $db);

        if($conexion->connect_error){
            //echo("error de conexion");
            die("Conexión fallida: " . $conexion->connect_error);
        }
                  
        $sql = "SELECT * from usuarios WHERE username='$user' && password = '$pass'";
        $result = $conexion->query($sql);
        $fila = $result->fetch_assoc();
                    
        if($fila != 0){
           //echo( "la contraseña es la misma");
           $ght= true;

        }else{
       // echo "la contraseña no e sla misma";
        $ght= false;
                }

            return $ght;
             
    }
           
    public function sex_user($user, $sex){
      $ght=false;
      $servidor = "localhost";
        $nombreusuario = "root";
        $password = "";
        $db = "mvc";
    
        $conexion = new mysqli($servidor, $nombreusuario, $password, $db);

        if($conexion->connect_error){
            //echo("error de conexion");
            die("Conexión fallida: " . $conexion->connect_error);
        }
                  
        $sql = "SELECT * from usuarios WHERE username='$user && sexo = $sex'";
        $result = $conexion->query($sql);
        $fila = $result->fetch_assoc();
                    
        if($fila != 0){
           //echo( "les mujer");
           $ght= false;

        }else{
       //echo "es hombre";
        $ght= true;
                }

            return $ght;
             
    }
         

    public function updateUser($item){
      $query = $this->db->connect()->prepare("UPDATE usuarios SET nombre = :nombre, edad = :edad, sexo = :sexo, email = :email,
       telefono = :telefono, ciudad = :ciudad, cp = :cp,password = :password,  img = :img where username = :username ");
  
              try{
                  $query->execute([
                    'nombre'   => $item['nombre'],
                    'username' => $item['username'],
                    'edad'     => $item['edad'],
                    'sexo'     => $item['sexo'],
                    'email'    => $item['email'],
                    'telefono' => $item['telefono'],
                    'ciudad'   => $item['ciudad'],
                    'cp'       => $item['cp'],
                    'password' => $item['password'],
                    'img'      => $item['img']
                  ]);
 //// var_dump($item);
                    return true;
              }catch(PFOException $e){
                return false;
              }
  
      }

   }

?>