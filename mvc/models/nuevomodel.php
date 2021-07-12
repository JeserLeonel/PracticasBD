<?php 
class NuevoModel extends Model{
    public function __construct(){
        parent:: __construct();
    }
    public function insert($datos){
        try{
           
        $query = $this->db->connect()->prepare('INSERT INTO alumnos (MATRICULA, NOMBRE, APELLIDOP, APELLIDOM, TELEFONO, EMAIL, IMG) VALUES(:matricula, :nombre, :apellidop, :apellidom, :telefono, :email, :img)');
        $query->execute(['matricula' => $datos['matricula'], 'nombre' => $datos['nombre'], 'apellidop' => $datos['apellidop'],'apellidom' => $datos['apellidom'], 'telefono' => $datos['telefono'], 'email' => $datos['email'], 'img' => $datos['img'] ]);
        return true;
           
        }catch(PDOException $e){
            //echo "Ya existe la matricula";
            return false;
        }  
    }


    public function insertuser($datos){
        try{
           
        $query = $this->db->connect()->prepare('INSERT INTO alumnos (NOMBRE, USERNAME, PASSWORD) VALUES(:nombre, :username, :password)');
        $query->execute(['nombre' => $datos['nombre'], 'username' => $datos['username'], 'password' => $datos['password']]);
        return true;
           
        }catch(PDOException $e){
            //echo "Ya existe la matricula";
            return false;
        }  
    }
}

?>